<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'member_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_project_id')->textInput() ?>

    <?= $form->field($model, 'project_role_project_role_id')->textInput() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
