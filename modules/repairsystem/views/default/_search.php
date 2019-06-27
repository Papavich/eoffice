<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rep-des-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rep_des_id') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'lname') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'rep_date') ?>

    <?php // echo $form->field($model, 'asset_code') ?>

    <?php // echo $form->field($model, 'asset_type_dept_id') ?>

    <?php // echo $form->field($model, 'building_id') ?>

    <?php // echo $form->field($model, 'room_id') ?>

    <?php // echo $form->field($model, 'rep_des_detail') ?>

    <?php // echo $form->field($model, 'rep_status_id') ?>

    <?php // echo $form->field($model, 'rep_photo_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
