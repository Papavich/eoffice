<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysBillDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-bill-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_master_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_detail_price_per_unit')->textInput() ?>

    <?= $form->field($model, 'bill_detaill_amount')->textInput() ?>

    <?= $form->field($model, 'bill_detail_use_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_detail_counter')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
