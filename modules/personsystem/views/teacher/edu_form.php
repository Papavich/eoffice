<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\HistoryEducation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-education-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
        <div class="col-xs-6"> <?= $form->field($model, 'educational_background')->textInput(['maxlength' => true])->label(controllers::t('label','Qualification')) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'educational_background_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Qualification (Eng)')) ?></div>
        </div>
        <div class="col-md-12">
        <div class="col-xs-6"><?= $form->field($model, 'educational_institution')->textInput(['maxlength' => true])->label(controllers::t('label','Educational Institution')) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'educational_institution_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Educational Institution (Eng)')) ?></div>
        </div>
        <div class="col-md-12">
        <div class="col-xs-6"> <?= $form->field($model, 'level_education')->dropDownList(['ปริญญาบัณฑิต'=>'ปริญญาบัณฑิต','ปริญญามหาบัณฑิต'=>'ปริญญามหาบัณฑิต','ปริญญาดุษฎีบัณฑิต'=>'ปริญญาดุษฎีบัณฑิต'],['maxlength' => true])->label(controllers::t('label','Level Education')) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'graduate_year')->textInput(['maxlength' => true])->label(controllers::t('label','Graduate Year')) ?></div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>