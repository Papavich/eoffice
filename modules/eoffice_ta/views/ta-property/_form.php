<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaProperty */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="content" class="padding-10">
<div class="ta-property-form">
    <div class="row">
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-6">

    <?= $form->field($model, 'ta_property_name')->dropDownList(
        [ 'A'=>'A','B+'=> 'B+','B'=> 'B','C+'=>'C+','C'=>'C','D+'=>'D+','D'=>'D' ], ['prompt' => '--- เลือก ---']) ?>

    <?= $form->field($model, 'ta_property_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level_degree')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'property_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_gpa')->textInput(['maxlength' => true]) ?>
    <br>
    <?= $form->field($model, 'active_status')->checkbox([ '0', '1', ], ['prompt' => ''],
        [ 'labelOptions' => [
            'class' => 'switch-label',
        ]]) ?>

    </div></div>

        <div class="form-group">
            <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success pull-right'] ) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
</div>
