<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use app\modules\eoffice_eolm\models\EolmDisbursementform;

use app\modules\eoffice_eolm\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmRepay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-repay-form col-md-6 col-sm-6">

    <?php $form = ActiveForm::begin();
        $command2 = 'SELECT * FROM eolm_approvalform WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
        $appform = EolmApprovalform::findBySql($command2)->one();
        $command4 = 'SELECT * FROM eolm_loancontract WHERE eolm_loancontract.eolm_app_id ='.$model->eolm_app_id;
        $loan = EolmLoancontract::findBySql($command4)->one();
        $command5 = 'SELECT * FROM eolm_disbursementform WHERE eolm_disbursementform.eolm_app_id ='.$model->eolm_app_id;
        $dis = EolmDisbursementform::findBySql($command5)->one();
    ?>
    <div class="row">
        <!--div class="col-md-12 col-sm-12">
            <b>เรียน </b> หัวหน้างานคลังและพัสดุ
        </div-->
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label> <?php echo controllers::t( 'label', 'MOE')?></label>
            <input type="text"  value="<?php echo $appform->eolm_app_number ;?>" class="form-control" disabled>
        </div>
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'eolm_repay_date')->textInput(['readonly' => true, 'value' => date("Y-m-d")])->label(controllers::t( 'label', 'Return date')) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><?php echo controllers::t( 'label', 'Subject')?></label>
            <input type="text"  value="<?php echo $appform->eolm_app_subject ;?>" class="form-control" disabled>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label><?php echo controllers::t( 'label', 'Contract number')?></label>
            <input type="text" value="<?php echo $loan->eolm_loa_number ;?>" class="form-control" disabled>
        </div>
        <div class="col-md-6 col-sm-6">
            <label><?php echo controllers::t( 'label', 'Financial amount')?></label>
            <input type="text" value="<?php if (!empty($loan->eolm_loa_total_amout)){echo $loan->eolm_loa_total_amout ;} ?>" class="form-control" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label><?php echo controllers::t( 'label', 'Amount of expenses')?></label>
            <input type="text" value="<?php echo $dis->eolm_dis_total ;?>" class="form-control" disabled>
        </div>
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'eolm_repay')->textInput(['maxlength' => true])->label(controllers::t( 'label', 'Refund')) ?>
        </div>
    </div>
    <hr/>

    <!--?/*= $form->field($model, 'eolm_app_id')->textInput() */?-->





    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
