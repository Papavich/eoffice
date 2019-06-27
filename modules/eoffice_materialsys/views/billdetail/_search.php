<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysBillDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-bill-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'bill_master_id') ?>

    <?= $form->field($model, 'bill_detail_price_per_unit') ?>

    <?= $form->field($model, 'bill_detaill_amount') ?>

    <?= $form->field($model, 'bill_detail_use_amount') ?>

    <?php // echo $form->field($model, 'bill_detail_counter') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
