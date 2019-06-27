<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_version')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workload_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_payment_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_status_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
