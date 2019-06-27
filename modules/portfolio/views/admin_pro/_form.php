<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_name_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_name_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sponsor_sponsor_id')->textInput() ?>

    <?= $form->field($model, 'project_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repayment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_end')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
