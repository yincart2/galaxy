<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-7-8
 * Time: 下午7:46
 */

namespace star\system\widgets;

use kartik\widgets\FileInput;
use star\system\models\File;
use yii\base\Widget;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

class FileUploadWidget extends Widget{

    public $model;

    public $modelId;

    public function init(){

    }

    public function run(){
        if(isset($this->modelId)&&isset($this->model)&& !$this->model->isNewRecord){
            /** @var  $fileModel File*/
            $fileModel = \Yii::createObject(File::className());
            $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data']
            ]);

            $files = $fileModel->find()->where(['model'=>get_class($this->model),'model_id'=>$this->modelId])->all();
            $initialPreview = $initialPreviewConfig = [];
            foreach($files as $file){
                $initialPreview[] = "<img src='".\Yii::$app->params['imageDomain'].'/'.$file->url."' class='file-preview-image'>";
                $initialPreviewConfig[] = [
                    'caption'=>$file->name,
                    'url'=>Url::to(['/system/widgets/file-upload/delete','id'=>$file->file_id]),
                ];
            }
            echo $form->field($fileModel, 'files[]')->widget(FileInput::classname(), [
                'options' => [ 'multiple'=>true],
                'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig'=>$initialPreviewConfig,
                    'overwriteInitial'=>false,
                    'uploadUrl' => Url::to(['/system/widgets/file-upload/upload']),
                    'uploadExtraData' => [
                        'model' => get_class($this->model),
                        'modelId' => $this->modelId,
                    ],
                    'maxFileCount' => 10,
                    'allowedFileExtensions'=>['jpg','gif','png']
                ]
            ]);
            $form::end();
        }
    }
} 