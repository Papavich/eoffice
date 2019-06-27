<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaDocuments */
/* @var $form yii\widgets\ActiveForm */

$save =  controllers::t( 'label', 'Save');
$update = controllers::t( 'label', 'Update');
?>

<div class="ta-documents-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ta_documents_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'ta_doc_detail')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <div class="well text-center">
                <?= Html::img($model->getPhotoViewer(),['style'=>'width:80px;','class'=>'img-rounded']); ?>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ta_documents_path')->fileInput() ?>
        </div>
    </div>
    <div class="form-group">
        <?php //Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::submitButton($model->isNewRecord ?  '<i class="glyphicon glyphicon-floppy-disk"></i>'.$save : '<i class="glyphicon glyphicon-floppy-disk"></i>'.$update, ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-success pull-right']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
