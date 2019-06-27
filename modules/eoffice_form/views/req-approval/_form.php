<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqApproval */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-approval-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'template_id')->textInput() ?>

    <?= $form->field($model, 'cr_date')->textInput() ?>

    <?= $form->field($model, 'cr_term')->textInput() ?>

    <?= $form->field($model, 'cr_year')->textInput() ?>

    <?= $form->field($model, 'approve_group_queue')->textInput() ?>

    <?= $form->field($model, 'approve_id')->textInput() ?>

    <?= $form->field($model, 'approve_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_queue')->textInput() ?>

    <?= $form->field($model, 'approve_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_visible')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_enddate')->textInput() ?>

    <?= $form->field($model, 'approve_json')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
