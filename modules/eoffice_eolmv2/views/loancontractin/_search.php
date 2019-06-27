<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmLoancontractinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-loancontract-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eolm_app_id') ?>

    <?= $form->field($model, 'eolm_loa_date') ?>

    <?/*= $form->field($model, 'eolm_loa_use_date') */?><!--

    --><?/*= $form->field($model, 'eolm_loa_refund_date') */?>

    <?= $form->field($model, 'eolm_loa_examiner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
