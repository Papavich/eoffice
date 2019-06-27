<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\PmsProjectSub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pms-project-sub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prosub_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_years')->textInput() ?>

    <?= $form->field($model, 'prosub_type')->textInput() ?>

    <?= $form->field($model, 'prosub_deparment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_principle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_timestart')->textInput() ?>

    <?= $form->field($model, 'prosub_timeend')->textInput() ?>

    <?= $form->field($model, 'prosub_status')->textInput() ?>

    <?= $form->field($model, 'prosub_relevant_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_relevant_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prosub_result_evaluate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_project_id')->textInput() ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'duby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
