<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\modules\eoffice_eolmv2\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmHotel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-hotel-form">
    <br>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-6"><?= $form->field($model, 'eolm_hotel_name')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6"> <?=$form->field($model, 'eolm_hotel_address')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
