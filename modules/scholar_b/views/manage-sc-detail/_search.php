<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbScholarshipTypeHasYearSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-scholarship-type-has-year-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'scholarship_id') ?>

    <?= $form->field($model, 'scholarship_year') ?>

    <?= $form->field($model, 'scholarship_condition') ?>

    <?= $form->field($model, 'scholarship_file') ?>

    <?= $form->field($model, 'scholarship_image') ?>

    <?php // echo $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
