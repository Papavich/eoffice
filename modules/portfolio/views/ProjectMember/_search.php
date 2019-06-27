<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pro_member_id') ?>

    <?= $form->field($model, 'member_name') ?>

    <?= $form->field($model, 'member_lname') ?>

    <?= $form->field($model, 'project_project_id') ?>

    <?= $form->field($model, 'project_role_project_role_id') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
