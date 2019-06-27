<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;
use dosamigos\fileupload\FileUploadUI;
use app\modules\scholar_b\controllers;

$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>
<?= Html::csrfMetaTags() ?>
<div class="scb-news-form">
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <!-- Form -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                        ],
                            ['options' => [
                                'autocomplete' => 'off',
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data'
                            ]]) ?>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'news_name')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'news_detail')->widget(CKEditor::className(), [
                                        'options' => ['rows' => 1],
                                        'preset' => 'basic',
                                    ]) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>อัพโหลดภาพ </label>
                                    <?= FileUploadUI::widget([
                                        //$model_file
                                        'model' => $model_file,
                                        'attribute' => 'news_image',
                                        'url' => ["news/image-upload?id=" . $model_file->news_image], // your url, this is just for demo purposes,
                                        'options' => ['accept' => 'images/*'],
                                        'clientOptions' => [
                                            'maxFileSize' => 2000000
                                        ],
                                        'clientEvents' => [
                                            'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                  var li = e.delegateTarget;
  var span = li.querySelector(\'p\');
  console.log(span.innerText);
  var li = e.currentTarget;
  var span = li.querySelector(\'p\');
  console.log(span.innerText);
  setNewImg(span.innerText);
                                            }'
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" align="right">
                                <?= Html::submitButton('<i class="fa fa-save"></i>' . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                        <?= $form->field($model, 'news_image')->hiddenInput(['id' => 'news_image'])->label(false); ?>
                        <?= $form->field($model, 'staff_id_card')->hiddenInput(['value' => Yii::$app->user->identity->username])
                            ->label(false)->error(false) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var date = '<?=date("dmY") . '-' ?>';
</script>
<?php

$this->registerJs(<<<JS
       function setNewImg(name) {
         $('#news_image').val(date+name);
       }
JS
);

?>




