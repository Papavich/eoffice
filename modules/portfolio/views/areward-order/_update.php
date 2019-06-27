<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ArewardOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areward-order-form">
    <div class="row">
        <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'areward_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'date_areward')->textInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'date_areward')->textInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'project_member_pro_member_id')->textInput(['readonly' => true]) ?>

            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'level_level_id')->textInput(['readonly' => true, 'value' => $model->levelLevel->level_name]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'agency_award_areward_order_id')->textInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'advisor_id')->textInput() ?>
            </div>

            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'std_id')->textInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'person_id')->textInput() ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'institution_ag_award_id')->textInput() ?>
            </div>


        <div class="col-md-6 col-sm-6">
           &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
        </div>


    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
