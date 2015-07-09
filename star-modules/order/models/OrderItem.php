<?php

namespace star\order\models;

use star\catalog\models\Sku;
use star\system\models\Tree;
use Yii;
use yii\helpers\ArrayHelper;
use star\catalog\models\Item;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property integer $order_item_id
 * @property integer $order_id
 * @property integer $item_id
 * @property string $price
 * @property integer $qty
 * @property string $name
 * @property string $picture
 */
class OrderItem extends \yii\db\ActiveRecord
{
    //used by deal_log
    public $data;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['order_id', 'item_id', 'price', 'qty', 'name', 'picture'], 'required'],
            [['order_id', 'item_id', 'qty'], 'integer'],
            [['price'], 'number'],
            [['name', 'picture'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_item_id' => Yii::t('order', 'Order Item ID'),
            'order_id' => Yii::t('order', 'Order ID'),
            'item_id' => Yii::t('order', 'Item ID'),
            'price' => Yii::t('order', 'Price'),
            'qty' => Yii::t('order', 'Qty'),
            'name' => Yii::t('order', 'Item Name'),
            'picture' => Yii::t('order', 'Picture'),
        ];
    }

    //todo
    public static function getSalesOrderBy($categoryId = '')
    {
        $where = '';
        if ($categoryId) {
            $items = Tree::find()->where(['tree_id' => $categoryId])->all();
            $itemIds = ArrayHelper::getColumn($items, 'item_id');
            $where = ' where item_id in ('.implode(',', $itemIds).') ';
        }
        $sql = 'SELECT name, count(item_id) as count FROM `order_item` '.$where.' group by item_id order by count desc';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    //todo
    public static function getCategoryOrderBy()
    {
        $sql = <<<EOF
select tree.name,
(SELECT count(qty) as num FROM `order_item` where item_id in (SELECT item_id FROM `item_tree` where item_tree.tree_id = tree.id)) as total
from tree
where tree.type = 'yincart-tag'
order by total desc
limit 5
EOF;
        return Yii::$app->db->createCommand($sql)->queryAll();
    }


    public function getItem(){
        return $this->hasOne(Item::className(),['item_id' => 'item_id']);
    }
    public function getSku(){
        return $this->hasOne(Sku::className(),['item_id' => 'item_id']);
    }
}
