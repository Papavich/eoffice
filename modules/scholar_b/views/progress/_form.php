<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbProgressReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-progress-report-form">
    <div id="content" class="padding-20">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'progress_seq')->textInput() ?>

            <?= $form->field($model, 'student_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'project_year')->textInput() ?>

            <?= $form->field($model, 'project_semester')->textInput() ?>

            <?= $form->field($model, 'project_code')->textInput() ?>

            <?= $form->field($model, 'year')->textInput() ?>

            <?= $form->field($model, 'semester')->textInput() ?>

            <?= $form->field($model, 'proj_summary')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'proj_activity')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'proj_factual')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'proj_plan_next_year')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'plan_year1')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'plan_year2')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'plan_year3')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'plan_year4')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'proj_problem')->textarea(['rows' => 6]) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
