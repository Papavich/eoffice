<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'project_name_thai') ?>

    <?= $form->field($model, 'project_name_eng') ?>

    <?= $form->field($model, 'project_start') ?>

    <?= $form->field($model, 'project_end') ?>

    <?php // echo $form->field($model, 'project_duration') ?>

    <?php // echo $form->field($model, 'project_budget') ?>

    <?php // echo $form->field($model, 'repayment') ?>

    <?php // echo $form->field($model, 'project_url') ?>

    <?php // echo $form->field($model, 'std_id') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'participation') ?>

    <?php // echo $form->field($model, 'cities_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
