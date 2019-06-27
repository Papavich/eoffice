<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveFieldList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approve-field-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'approve_field_list_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_field_list_order')->textInput() ?>

    <?= $form->field($model, 'approve_field_ref')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
