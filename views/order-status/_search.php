<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\OrderStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'order_date') ?>

    <?= $form->field($model, 'order_date_accept') ?>

    <?= $form->field($model, 'order_staff') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <?php // echo $form->field($model, 'order_status_confirm') ?>

    <?php // echo $form->field($model, 'order_status_notification') ?>

    <?php // echo $form->field($model, 'order_status_return') ?>

    <?php // echo $form->field($model, 'order_budget_per_year') ?>

    <?php // echo $form->field($model, 'order_cancel_description') ?>

    <?php // echo $form->field($model, 'order_id_ai') ?>

    <?php // echo $form->field($model, 'order_detail_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
