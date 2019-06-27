<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'prefix_id') ?>

    <?= $form->field($model, 'person_firstname') ?>

    <?= $form->field($model, 'person_lastname') ?>

    <?= $form->field($model, 'person_date_work_start') ?>

    <?php // echo $form->field($model, 'position_id') ?>

    <?php // echo $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'person_address') ?>

    <?php // echo $form->field($model, 'person_tel') ?>

    <?php // echo $form->field($model, 'person_picture') ?>

    <?php // echo $form->field($model, 'person_work_status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'publication_pub_id') ?>

    <?php // echo $form->field($model, 'project_project_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
