<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignField */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approve-design-field-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'approve_field_ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_field_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_field_order')->textInput() ?>

    <?= $form->field($model, 'approve_design_id')->textInput() ?>

    <?= $form->field($model, 'attribute_type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
