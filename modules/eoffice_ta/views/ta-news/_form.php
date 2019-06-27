<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaDocuments;
use dosamigos\ckeditor\CKEditor;
use app\modules\eoffice_ta\models\Type;
use app\modules\eoffice_ta\models\TaStatus;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNews */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile( '@web/ckeditor/ckeditor.js' )
?>
<div id="content" class="padding-10">
<div class="ta-news-form">

    <?php $form = ActiveForm::begin(
           // ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <?= $form->field($model, 'ta_news_name')->textInput(['maxlength' => true]) ?>
    <?=  $form->field($model, 'ta_documents_id')->dropdownList(
                ArrayHelper::map(TaDocuments::find()->all(),
                    'ta_documents_id',
                    'ta_documents_name'),
                [
                    'id'=>'ddl-document',
                    'prompt'=>'เลือกเอกสารที่เกี่ยวข้อง'
                ]); ?>

    <?= $form->field( $model, 'ta_news_detail' )->widget( CKEditor::className(), [
        'options' => ['rows' => 1],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => \yii\helpers\Url::toRoute(['site/upload']),
        ]
    ] ) ?>


    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success pull-right'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
