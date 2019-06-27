<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-material-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'material_name') ?>

    <?= $form->field($model, 'material_detail') ?>

    <?= $form->field($model, 'material_amount_check') ?>

    <?= $form->field($model, 'material_order_count') ?>

    <?php // echo $form->field($model, 'material_unit_name') ?>

    <?php // echo $form->field($model, 'material_image') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'material_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
