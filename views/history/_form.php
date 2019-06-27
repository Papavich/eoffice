<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'order_date_accept')->textInput() ?>

    <?= $form->field($model, 'order_staff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_status_confirm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_status_notification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_status_return')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_budget_per_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_cancel_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_detail_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
