<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmDisbursementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-disbursementform-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eolm_app_id') ?>

    <?= $form->field($model, 'eolm_dis_date') ?>

    <?= $form->field($model, 'eolm_dis_go_from') ?>

    <?= $form->field($model, 'eolm_dis_go_date') ?>

    <?= $form->field($model, 'eolm_dis_go_time') ?>

    <?php // echo $form->field($model, 'eolm_dis_back_to') ?>

    <?php // echo $form->field($model, 'eolm_dis_back_date') ?>

    <?php // echo $form->field($model, 'eolm_dis_back_time') ?>

    <?php // echo $form->field($model, 'eolm_dis_disburse_for') ?>

    <?php // echo $form->field($model, 'eolm_dis_allowance_type') ?>

    <?php // echo $form->field($model, 'eolm_dis_allowance_day') ?>

    <?php // echo $form->field($model, 'eolm_dis_hotal_type') ?>

    <?php // echo $form->field($model, 'eolm_dis_hotal_day') ?>

    <?php // echo $form->field($model, 'eolm_vehicletype') ?>

    <?php // echo $form->field($model, 'eolm_dis_vehicle_cost') ?>

    <?php // echo $form->field($model, 'eolm_dis_other_expenses') ?>

    <?php // echo $form->field($model, 'eolm_dis_other_expenses_cost') ?>

    <?php // echo $form->field($model, 'eolm_attach_doc_count') ?>

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
