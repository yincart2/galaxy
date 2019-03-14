<?php
/**
 * @author Cangzhou.Wu (wucangzhou@gmail.com)
 * @Date 14-11-22
 * @Time 上午10:48
 */

namespace cluster\modules\cart\models;

use star\catalog\models\Item;
use star\catalog\models\Sku;
use Yii;
use yii\base\Component;
use yii\base\ModelEvent;
use yii\web\Cookie;

class ShoppingCart extends Component
{
    const EVENT_BEFORE_ADD = 'beforeAdd';
    const EVENT_AFTER_ADD = 'afterAdd';
    const EVENT_BEFORE_REMOVE = 'beforeRemove';
    const EVENT_AFTER_REMOVE = 'afterRemove';
    const EVENT_BEFORE_UPDATE = 'beforeUpdate';
    const EVENT_AFTER_UPDATE = 'afterUpdate';
    const COOKIE_KEY = 'cart';

    /** @var Cart[] */
    public $cartItems = [];

    /**
     * save cart into cookies and database
     */
    public function init()
    {
        $cookies = Yii::$app->request->cookies;
        $this->cartItems = $cookies->getValue(self::COOKIE_KEY,[]);
        //@TODO need to take a event to login;
        if (!Yii::$app->getUser()->getIsGuest()) {
            $cartItems = Cart::find()->where(['user_id' => Yii::$app->user->id])->indexBy('sku_id')->all();
            if($cartItems){
                $this->cartItems = $cartItems+ $this->cartItems;
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => self::COOKIE_KEY,
                    'value' => $this->cartItems,
                ]));
            }
            foreach ($this->cartItems as $cart) {
                $cart->user_id = Yii::$app->user->id;
                $cart->create_time = time();
                $cart->save();
            }
        }
        $this->attachEvent();
    }

    public function beforeAdd($item_id,$star_id, $qty,$data)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
        $event->star_id = $star_id;
        $event->qty =$qty;
        $event->content = $data;
        $this->trigger(self::EVENT_BEFORE_ADD, $event);
        return $event->isValid;
    }

    public function afterAdd()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_ADD, $event);
    }

    public function beforeUpdate($item_id, $qty,$data)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
        $event->qty =$qty;
        $event->content =$data;
        $this->trigger(self::EVENT_BEFORE_UPDATE, $event);
        return $event->isValid;
    }

    public function afterUpdate()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_UPDATE, $event);
    }

    public function beforeRemove($sku_id)
    {
        $event = new CartEvent;
        $event->item_id = $sku_id;
        $this->trigger(self::EVENT_BEFORE_REMOVE, $event);
        return $event->isValid;
    }

    public function afterRemove()
    {
        $event = new CartEvent;
        $this->trigger(self::EVENT_AFTER_REMOVE, $event);
    }

    public function attachEvent()
    {
        $this->on(self::EVENT_BEFORE_ADD, [$this, 'validate']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'validate']);

        $this->on(self::EVENT_AFTER_ADD, [$this, 'save']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'save']);

        $this->on(self::EVENT_AFTER_REMOVE, [$this, 'save']);
    }

    /**
     * @param $event CartEvent
     */
    public function validate($event)
    {
        //@TODO need to move to cart model the have error message
        $sku =  Sku::find()->where($event->item_id)->one();
        if(!$sku){
            $event->isValid = false;
            return;
        }

        $item = Item::find()->where($sku->item_id)->one();
        if (!$item || intval($event->qty) != $event->qty) {
            $event->isValid = false;
            return;
        }

        if ($event->qty <= 0) {
            $event->isValid = false;
            return;
        }
    }

    /**
     * @param $event
     */
    public function save($event)
    {
        $cookies = Yii::$app->response->cookies;
        $cartItems = $cookies->getValue(self::COOKIE_KEY,[]);

        $toDelCartItems = array_diff_key($cartItems, $this->cartItems);

        $cookies->add(new Cookie([
            'name' => self::COOKIE_KEY,
            'value' => $this->cartItems,
        ]));
        if (!Yii::$app->user->isGuest) {
            foreach ($this->cartItems as $cart) {
                $cart->user_id = Yii::$app->user->id;
                $cart->create_time = time();
                $cart->save();
            }
            Cart::deleteAll(['sku_id' => array_keys($toDelCartItems), 'user_id' => Yii::$app->user->id]);
        }
    }

    /**
     *  add item to cart
     * @param $sku_id
     * @param $star_id
     * @param $qty
     * @param $data
     * @return bool
     */
    public function add($sku_id,$star_id, $qty,$data)
    {
        if ($this->beforeAdd($sku_id,$star_id, $qty,$data)) {
            if (isset($this->cartItems[$sku_id])) {
                $this->cartItems[$sku_id]->qty += $qty;
            } else {
                $this->cartItems[$sku_id] = new Cart(['sku_id' => $sku_id, 'qty' => $qty,'star_id'=>$star_id]);
            }
            $this->cartItems[$sku_id]->data = $data;
            $this->afterAdd();
            return true;
        }
        return false;
    }

    /**
     * update cart
     * @param $sku_id
     * @param $qty
     * @param $data
     * @return bool
     */
    public function update($sku_id, $qty,$data)
    {
        if ($this->beforeUpdate($sku_id, $qty,$data)) {
            if (isset($this->cartItems[$sku_id])) {
                $this->cartItems[$sku_id]->qty = $qty;
                $this->cartItems[$sku_id]->data = $data;
                $this->afterUpdate();
                return true;
            }
        }
        return false;
    }

    /**
     * delete item
     * @param $sku_id
     * @return bool
     */
    public function remove($sku_id)
    {
        if ($this->beforeRemove($sku_id)) {
            if (isset($this->cartItems[$sku_id])) {
                unset($this->cartItems[$sku_id]);
                $this->afterRemove();
                return true;
            }
        }
        return false;
    }

    /**
     * delete all item
     * @return bool
     */
    public function clearAll()
    {
        //@TODO need to add event
        Yii::$app->response->cookies->remove(self::COOKIE_KEY);
        $this->cartItems = [];
        if (! Cart::deleteAll(['user_id' => Yii::$app->user->id])) {
            return false;
        }
        return true;
    }

    /**
     * return subtotal.
     * @param int $sku_id , if it is exist, it will return the price of this sku .
     * @param int $star_id, if it is exist, it will return the price of store .
     * if they were null. it will return the total price of shopping cart.
     * @return number
     */
    public function getSubTotal($sku_id = 0,$star_id=0)
    {
        //@TODO need to add event
        if ($sku_id) {
            $cartItem = $this->cartItems[$sku_id];

            $price_true = $cartItem->sku->price;
            return $price_true * $cartItem->qty;
        }

        $cartItems = $this->cartItems;
        if($star_id){
            $serialCartItems = $this->serialCartItems();
            $cartItems = $serialCartItems[$star_id];
        }
        $subTotals = [];
        foreach($cartItems as $sku_id => $carItem) {
            $subTotals[$sku_id] = $this->getSubTotal($sku_id);
        }
        return array_sum($subTotals);
    }

    public function getShippingFee()
    {
        //@TODO need to add event
        $subTotals = [];
        foreach($this->cartItems as $item_id => $carItem) {
            $subTotals[$item_id] =  $carItem->sku->item->shipping_fee;
        }

        return array_sum($subTotals);
    }

    public function getTotal()
    {
        //@TODO need to add event
        return $this->getSubTotal() + $this->getShippingFee();
    }

    /**
     * serial cart
     * return array like cart['star_id']['sku_id'] = cartModel
     * @return array
     */
    public function serialCartItems(){
        $carItems = [];
        foreach($this->cartItems as $sku_id=>$carItem){
            $carItems[$carItem->star_id][$sku_id] = $carItem;
        }
        return $carItems;
    }
}

class CartEvent extends ModelEvent
{
    public $item_id;

    public $star_id;

    public $qty;

    public $content;
}