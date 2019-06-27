<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LeaveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'leave_year') ?>

    <?= $form->field($model, 'leave_type') ?>

    <?= $form->field($model, 'leave_date_start') ?>

    <?php // echo $form->field($model, 'leave_date_end') ?>

    <?php // echo $form->field($model, 'leave_num') ?>

    <?php // echo $form->field($model, 'leave_reason') ?>

    <?php // echo $form->field($model, 'leave_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
