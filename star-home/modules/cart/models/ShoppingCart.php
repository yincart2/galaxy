<?php
/**
 * @author Cangzhou.Wu (wucangzhou@gmail.com)
 * @Date 14-11-22
 * @Time 上午10:48
 */

namespace home\modules\cart\models;

use star\catalog\models\Item;
use star\catalog\models\Sku;
use Yii;
use yii\base\Component;
use yii\base\ModelEvent;

class ShoppingCart extends Component
{
    const EVENT_BEFORE_ADD = 'beforeAdd';
    const EVENT_AFTER_ADD = 'afterAdd';
    const EVENT_BEFORE_REMOVE = 'beforeRemove';
    const EVENT_AFTER_REMOVE = 'afterRemove';
    const EVENT_BEFORE_UPDATE = 'beforeUpdate';
    const EVENT_AFTER_UPDATE = 'afterUpdate';
    const SESSION_KEY = 'cart';

    /** @var Cart[] */
    public $cartItems = [];

    public function init()
    {
        $this->cartItems = Yii::$app->getSession()->has(self::SESSION_KEY) ? Yii::$app->getSession()->get(self::SESSION_KEY) : [];
        //@TODO need to take a event to login;
        if (!Yii::$app->getUser()->getIsGuest()) {
            $cartItems = Cart::find()->where(['user_id' => Yii::$app->user->id])->indexBy('sku_id')->all();
            $this->cartItems = $cartItems + $this->cartItems;
            Yii::$app->getSession()->set(self::SESSION_KEY, $this->cartItems);
            foreach ($this->cartItems as $cart) {
                $cart->save();
            }
        }
        $this->attachEvent();
    }

    public function beforeAdd($item_id, $qty,$data)
    {
        $event = new CartEvent;
        $event->item_id = $item_id;
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
        $cartItems = Yii::$app->getSession()->has(self::SESSION_KEY) ? Yii::$app->getSession()->get(self::SESSION_KEY) : [];
        $toDelCartItems = array_diff_key($cartItems, $this->cartItems);
        Yii::$app->getSession()->set(self::SESSION_KEY, $this->cartItems);
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
     * add item to cart
     * @param $sku_id
     * @param $qty
     * @param $data
     * @return bool
     */
    public function add($sku_id, $qty,$data)
    {
        if ($this->beforeAdd($sku_id, $qty,$data)) {
            if (isset($this->cartItems[$sku_id])) {
                $this->cartItems[$sku_id]->qty += $qty;
            } else {
                $this->cartItems[$sku_id] = new Cart(['sku_id' => $sku_id, 'qty' => $qty]);
            }
            $this->cartItems[$sku_id]->data = $data;
            $this->afterAdd();
            return true;
        }
        return false;
    }

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
        if (Yii::$app->getSession()->remove(self::SESSION_KEY) && Cart::deleteAll(['user_id' => Yii::$app->user->id])) {
            $this->cartItems = [];
            return true;
        }
        return false;
    }

    /**
     * @param int $sku_id
     * @return number
     */
    public function getSubTotal($sku_id = 0)
    {
        //@TODO need to add event
        if ($sku_id) {
            $cartItem = $this->cartItems[$sku_id];

            $price_true = $cartItem->sku->price;
            return $price_true * $cartItem->qty;

//            return $cartItem->item->price * $cartItem->qty;
        }
        $subTotals = [];
        foreach($this->cartItems as $sku_id => $carItem) {
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
}

class CartEvent extends ModelEvent
{
    public $item_id;

    public $qty;

    public $content;
}