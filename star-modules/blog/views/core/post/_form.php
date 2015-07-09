<?php
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model star\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">



    <?php
    $items = [
        ['label' => Yii::t('post', 'Post'), 'content' => $this->render('_postForm',[
            'model' => $model,
    ])],
        ['label' => Yii::t('post', 'File Upload'), 'content' => \star\system\widgets\FileUploadWidget::widget([
                'model'=>$model,
                'modelId' =>$model->id
            ])],
    ];

    echo \yii\bootstrap\Tabs::widget(['items' => $items]);
    ?>
</div>