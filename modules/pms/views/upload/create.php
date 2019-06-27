<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 2/2/2561
 * Time: 20:37
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use dosamigos\fileupload\FileUploadUI;
use dosamigos\fileupload\FileUpload;
?>


<div class="">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>
    <?= Html::csrfMetaTags() ?>


        <label class="control-label col-sm-4">อัปโหลดไฟล์เพิ่มเติม:</label>
        <br>
        <div class="col-sm-8">
            <?php
            echo FileUploadUI::widget([
                'model' => $model_file,
                'attribute' => 'file',
                'url' => ['upload/update-file?id=60-05-04-03-05-01'],
                'gallery' => false,
                'fieldOptions' => [
                    'accept' => '/*',
                ],
                'clientOptions' => [
                    'maxFileSize' => 2000000,
                    'maxFiles' => 10
                ],
                // ...
                'clientEvents' => [
                    'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                                
                            }',
                    'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);                                                        
                            }',

                ],
            ]);

            ?>
        </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'แก้ไข', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
