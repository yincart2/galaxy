<?php

namespace star\catalog\models;

use Yii;
use star\system\models\Tree;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;
use yii\imagine\Image;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property string $item_id
 * @property string $category_id
 * @property string $star_id
 * @property string $title
 * @property string $stock
 * @property string $min_number
 * @property string $price
 * @property string $currency
 * @property string $props
 * @property string $props_name
 * @property string $desc
 * @property string $shipping_fee
 * @property integer $is_show
 * @property integer $is_promote
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_best
 * @property string $click_count
 * @property string $wish_count
 * @property integer $review_count
 * @property integer $deal_count
 * @property string $create_time
 * @property string $update_time
 * @property string $language
 * @property string $country
 * @property string $state
 * @property string $city
 *
 * @property ItemImg[] $itemImgs
 * @property PropImg[] $propImgs
 * @property Sku[] $skus
 */
class Item extends \yii\db\ActiveRecord
{
    public $images;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'currency', 'props', 'props_name', 'desc','language'], 'required'],
            [['category_id', 'stock', 'star_id','min_number', 'is_show', 'is_promote', 'is_new', 'is_hot', 'is_best', 'click_count', 'wish_count', 'review_count', 'deal_count', 'create_time', 'update_time', 'country', 'state', 'city'], 'integer'],
            [['price', 'shipping_fee'], 'number'],
            [['props', 'props_name', 'desc'], 'string'],
            [[ 'language'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 20],
            [[  'price','stock', 'min_number', 'is_show', 'is_promote', 'is_new', 'is_hot', 'is_best', 'click_count', 'wish_count', 'review_count', 'deal_count'],'default','value'=>0]
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('catalog', 'Item ID'),
            'category_id' => Yii::t('catalog', '分类'),
            'star_id' => Yii::t('catalog', 'Star ID'),
            'title' => Yii::t('catalog', '名称'),
            'stock' => Yii::t('catalog', '库存'),
            'min_number' => Yii::t('catalog', '最少订货量'),
            'price' => Yii::t('catalog', '价格'),
            'currency' => Yii::t('catalog', '币种'),
            'props' => Yii::t('catalog', '商品属性 格式：pid:vid;pid:vid'),
            'props_name' => Yii::t('catalog', '商品属性名称。标识着props内容里面的pid和vid所对应的名称。格式为：pid1:vid1:pid_name1:vid_name1;pid2:vid2:pid_name2:vid_name2……(注：属性名称中的冒号\":\"被转换为：\"#cln#\"; 分号\";\"被转换为：\"#scln#\" )'),
            'desc' => Yii::t('catalog', '描述'),
            'shipping_fee' => Yii::t('catalog', '运费'),
            'is_show' => Yii::t('catalog', '是否显示'),
            'is_promote' => Yii::t('catalog', '是否促销'),
            'is_new' => Yii::t('catalog', '是否新品'),
            'is_hot' => Yii::t('catalog', '是否热销'),
            'is_best' => Yii::t('catalog', '是否精品'),
            'click_count' => Yii::t('catalog', '点击量'),
            'wish_count' => Yii::t('catalog', '收藏数'),
            'review_count' => Yii::t('catalog', 'Review Count'),
            'deal_count' => Yii::t('catalog', 'Deal Count'),
            'create_time' => Yii::t('catalog', '创建时间'),
            'update_time' => Yii::t('catalog', '更新时间'),
            'language' => Yii::t('catalog', '语言'),
            'country' => Yii::t('catalog', 'Country'),
            'state' => Yii::t('catalog', 'State'),
            'city' => Yii::t('catalog', 'City'),
            'images' => Yii::t('catalog', '图片'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Tree::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemImgs()
    {
        return $this->hasMany(ItemImg::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropImgs()
    {
        return $this->hasMany(PropImg::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkus()
    {
        return $this->hasMany(Sku::className(), ['item_id' => 'item_id']);
    }


    /**
     * save images to server and get path
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return array
     */
    public function getUploadImages(){
        $images = $this->loadUploadImages('Item');
        $imagesArray = [];
        if(isset($images['images'])){
            foreach($images['images'] as $image){
                if($image['size']){
                    $imagesArray[] = $this ->saveImage($image);
                }
            }
        }
        return $imagesArray;
    }

    /**
     * Creates serializable array from $_FILE recursively.
     * if you post Items[images] with multiple files,
     * like $model->loadUploadImages('Items')
     * it should be return
     * [
     *      'images'=> [
     *              [
     *                 'name'=>xxx,
     *                 'type'=>xxx,
     *                 'size'=>xxx,
     *                 'tmp_name' =>xx,
     *                 'error'=>xx
     *              ]
     *              ...
     *      ]
     * ]
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $file
     * @return array
     */
    public function loadUploadImages($file){
        $images = [];
        if(isset($_FILES[$file])){
            foreach ($_FILES[$file] as $key => $info) {
                foreach($info as $attributes => $v){
                    foreach($v as $num=>$value){
                        $images[$attributes][$num][$key] = $value;
                    }
                }
            }
        }
        return $images;
    }

    /**
     *  save  image
     *
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $image
     * @return array
     */
    public function saveImage($image)
    {
        if (!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            $this->addError('images', Yii::t('catalog', $image['type'] . 'Type is wrong'));
            return [];
        }
        $tmp = explode('.', $image['name']);
        $suffix = end($tmp);
        $imageName = md5(time().$image['name']).'.'.$suffix;
        $DatePath = date('Y',time()).'/'.date('m',time()).'/'.date('d',time());
        $pic = $DatePath . '/' . $imageName;
        $path = Yii::getAlias('@image');

        if (!is_dir($path . '/' . $DatePath) && !mkdir($path . '/' . $DatePath, 0777, true) && chmod($path . '/' . $DatePath, 0777)) {
            $this->addError('images', Yii::t('catalog', 'Create image dir fail.'));
        }
        if (!move_uploaded_file($image["tmp_name"], $path . '/' . $pic)) {
            $this->addError('images', Yii::t('catalog', 'Remove image fail.'));
        }

        return ['pic'=>$pic,'title'=>$image['name']];
    }


    public function saveSkus($item_id,$skus)
    {
        if (is_array($skus) && count($skus)) {
            $skuArray = array();
            foreach ($skus as $i => $sku) {
                if(isset($sku['sku_id']) && $sku['sku_id']) {
                    $skuModel = Sku::find()->where(['sku_id' => $sku['sku_id']])->one();
                } else {
                    $skuModel = Yii::createObject(Sku::className()) ;
                }
                $skuModel->item_id = $item_id;
                $skuModel->props = $sku['props'];
                $skuModel->props_name = $sku['props_name'];
                $skuModel->quantity = $sku['stock'];
                $skuModel->price = $sku['price'];
                $skuModel->outer_id = $sku['outer_id'];
                if (isset($sku['sku_id']) && $sku['sku_id']) {
                    if($skuModel->update()===false) {
                        Yii::$app->session->setFlash('sku-error',Yii::t('catalog','Every sku must have a value !'));
                        $this->addError('props', Yii::t('catalog', null));
                    }
                } else {
                    if(!$skuModel->save()){
                        Yii::$app->session->setFlash('sku-error',Yii::t('catalog','Every sku must have a value !'));
                        $this->addError('props', Yii::t('catalog', null));
                    }
                }
                $skuArray[$i] = $skuModel->sku_id;
            }
            //删除
            $models = Sku::findAll(['item_id' => $item_id]);
            $delArr = array();
            foreach ($models as $k1 => $v1) {
                if (!in_array($v1->sku_id, $skuArray)) {
                    $delArr[] = $v1->sku_id;
                }
            }
            if (count($delArr)) {
                Sku::deleteAll('sku_id IN (' . implode(', ', $delArr) . ')');
            }
        } else {
            //已经没有SKU了，要清除数据表内容
            Sku::deleteAll(['item_id' => $item_id]);
        }
    }

    public function beforeDelete(){
        if (parent::beforeDelete()) {
            //delete images and sku
            ItemImg::deleteAll(['item_id'=>$this->item_id]);
            Sku::deleteAll(['item_id'=>$this->item_id]);
            return true;
        } else {
            return false;
        }
    }

    public static function getItemsByCategory($id)
    {
        $treeNodes = Tree::getTreesById($id);
        //category has children
        if($treeNodes) {
            $categories = '(';
            foreach ($treeNodes as $key => $treeNode) {
                $categories = $categories . $key . ',';
            }
            $categories = substr($categories, 0, strlen($categories) - 1) . ')';
            $items = static::find()->where('category_id in ' . $categories);
        } else {
            $tree = Tree::findOne(['id' => $id]);
            if($tree) {
                $items = static::find()->where(['category_id' => $tree->id]);
            } else {
                return false;
            }
        }
        return $items;
    }

    /**
     * get main image to show
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return string
     */
    public function getMainImage(){
        $itemImages = $this->itemImgs;
        return isset($itemImages[0])?$itemImages[0]->pic:'';
    }
}
