<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbProgressReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-progress-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'progress_seq') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'project_year') ?>

    <?= $form->field($model, 'project_semester') ?>

    <?= $form->field($model, 'project_code') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <?php // echo $form->field($model, 'proj_summary') ?>

    <?php // echo $form->field($model, 'proj_activity') ?>

    <?php // echo $form->field($model, 'proj_factual') ?>

    <?php // echo $form->field($model, 'proj_plan_next_year') ?>

    <?php // echo $form->field($model, 'plan_year1') ?>

    <?php // echo $form->field($model, 'plan_year2') ?>

    <?php // echo $form->field($model, 'plan_year3') ?>

    <?php // echo $form->field($model, 'plan_year4') ?>

    <?php // echo $form->field($model, 'proj_problem') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
