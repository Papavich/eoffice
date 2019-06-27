<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_name_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_name_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_start')->textInput() ?>

    <?= $form->field($model, 'project_end')->textInput() ?>

    <?= $form->field($model, 'project_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repayment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'participation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cities_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
