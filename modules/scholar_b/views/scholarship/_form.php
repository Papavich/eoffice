<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbEnrollScholarship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-enroll-scholarship-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'candidate_id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scholarship_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scholarship_year')->textInput() ?>

    <?= $form->field($model, 'gpax_4to5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_math4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_math4to5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_chem4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_chem5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_math5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_physic4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_physic5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gpa_sum_chem_physic_math_4to5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
