<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmApprovalformsfSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-approvalform-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eolm_app_id') ?>

    <?= $form->field($model, 'eolm_app_date') ?>

    <?= $form->field($model, 'eolm_app_subject') ?>

    <?= $form->field($model, 'eolm_app_number') ?>

    <?= $form->field($model, 'eolm_app_deprture_date') ?>

    <?php // echo $form->field($model, 'eolm_app_retuen_date') ?>

    <?php // echo $form->field($model, 'eolm_app_vehicle_type') ?>

    <?php // echo $form->field($model, 'eolm_app_vehicle_detail') ?>

    <?php // echo $form->field($model, 'eolm_app_borrow_money') ?>

    <?php // echo $form->field($model, 'eolm_approver_major') ?>

    <?php // echo $form->field($model, 'eolm_approver_dean') ?>

    <?php // echo $form->field($model, 'eolm_approver_finance') ?>

    <?php // echo $form->field($model, 'eolm_budget_year') ?>

    <?php // echo $form->field($model, 'eolm_link') ?>

    <?php // echo $form->field($model, 'eolm_type_id') ?>

    <?php // echo $form->field($model, 'eolm_status_id') ?>

    <?php // echo $form->field($model, 'eolm_prot_id') ?>

    <?php // echo $form->field($model, 'eolm_budp_id') ?>

    <?php // echo $form->field($model, 'eolm_budt_id') ?>

    <?php // echo $form->field($model, 'eolm_exp_id') ?>

    <?php // echo $form->field($model, 'eolm_act_id') ?>

    <?php // echo $form->field($model, 'pro_id') ?>

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
