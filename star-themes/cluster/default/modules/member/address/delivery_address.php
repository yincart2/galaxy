<?php
use kartik\widgets\DepDrop;
use \yii\helpers\Url;
use \yii\helpers\Html;
use yii\grid\GridView;
use star\member\models\DeliveryAddress;

$dataList = ['1' => '是', '0' => '否'];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member', 'Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = '收货地址';
$this->params['delivery-address'] = true;
$link = $this->getAssetManager()->getPublishedUrl('@theme/cluster/default/assets');
$this->registerJsFile($link . '/js/address.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php $count = DeliveryAddress::find()->where(['user_id' => Yii::$app->user->id])->count();
if ($count == 0) {
    echo '您还没有创建收货地址! 请填写以下信息并保存：<br /><br />';
} else {
    ?>

    <span id="item" style="margin-left: 0px">已保存有效的地址:</span>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name:text:收货人',
            'provinceArea.name:text:省',
            'cityArea.name:text:市',
            'districtArea.name:text:区',
            'address:text:详细地址',
            'zip_code',
            'phone',
            [
                'attribute' => 'is_default',
                'value' => function ($model) {
                    $dataList = ['1' => '是', '0' => '否'];
                    return $dataList[$model->is_default];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                "buttons" =>
                    [
                        'view' => function ($url, $model) {
                            return;
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['address/delivery-address', 'view_id' => $model->delivery_address_id]);
                        }
                    ]
            ],
        ],
    ]);
}

//index view
$viewId = Yii::$app->request->get('view_id');
?>
<button type="button" id="new_address" class="button_blue middle_btn" onclick="javascript:void(0);"
    <?php if (isset($viewId) || $count == 0) {
        echo 'style="display: none"';
    } ?> >新建收货地址
</button>


<div id="address" style="display: <?= (isset($viewId) || $count == 0) ? 'block' : 'none'; ?>">
    <?php
    if (!isset($viewId)) {
        $model = new DeliveryAddress();
    }
    $form = \yii\widgets\ActiveForm::begin([
        'requiredCssClass' => '',
        'options' => ['class' => 'type_2'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'required'],
            'template' => "<div class=\"col-lg-2\">{label}</div><div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-12\">{error}\n{hint}</div>",
        ],
    ]);
    $select = ['' => '请选择...'];
    $catList = $select + $catList;

    /* @var \star\member\models\DeliveryAddress $model */
    echo $form->field($model, 'province')->dropDownList($catList, ['id' => 'cat-id']);

    // Child # 1
    echo $form->field($model, 'city')->widget(DepDrop::classname(), [
        'data' => [$model->city => isset($model->cityArea) ? $model->cityArea->name : ''],
        'options' => ['id' => 'subcat-id'],
        'pluginOptions' => [
            'depends' => ['cat-id'],
            'placeholder' => '请选择...',
            'loadingText' => '载入中...',
            'url' => Url::to(['/member/address/get-cities'])
        ]
    ]);
    // Child # 2
    echo $form->field($model, 'district')->widget(DepDrop::classname(), [
        'data' => [$model->district => isset($model->districtArea) ? $model->districtArea->name : ''],
        'pluginOptions' => [
            'depends' => ['cat-id', 'subcat-id'],
            'placeholder' => '请选择...',
            'loadingText' => '载入中...',
            'url' => Url::to(['/member/address/get-district'])
        ]
    ]);

    ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'is_default')->dropDownList($dataList) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => 'button_blue small_btn']) ?>
            <button type="button" id="<?= $model->isNewRecord ? 'cancel' : 'back' ?>" class="button_dark_grey small_btn"
                    onclick="javascript:void(0);">取消
            </button>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
