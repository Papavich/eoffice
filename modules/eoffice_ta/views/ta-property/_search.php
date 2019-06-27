<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaPropertySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-property-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_property_id') ?>

    <?= $form->field($model, 'ta_property_name') ?>

    <?= $form->field($model, 'ta_property_value') ?>

    <?= $form->field($model, 'level_degree') ?>

    <?= $form->field($model, 'property_detail') ?>

    <?php // echo $form->field($model, 'property_gpa') ?>

    <?php // echo $form->field($model, 'active_status') ?>

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
