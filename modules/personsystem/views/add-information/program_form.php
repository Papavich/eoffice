<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\MajorHasProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="major-has-program-form">
    <?php
    foreach ($modelMajor as $value){
        $arrayT[$value->major_id]=$value->major_name;
    } ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'major_id')->dropDownList($arrayT,['maxlength' => true]) ?>
    <?= $form->field($model, 'PROGRAMID')->textInput(['maxlength' => true,'disabled' => 'disabled']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
