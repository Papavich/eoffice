<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-working-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_work_plan_id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'section') ?>

    <?php // echo $form->field($model, 'term_id') ?>

    <?php // echo $form->field($model, 'year_id') ?>

    <?php // echo $form->field($model, 'ta_type_work_id') ?>

    <?php // echo $form->field($model, 'ta_work_title') ?>

    <?php // echo $form->field($model, 'ta_work_role') ?>

    <?php // echo $form->field($model, 'time_start') ?>

    <?php // echo $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'hr_working') ?>

    <?php // echo $form->field($model, 'ta_working_note') ?>

    <?php // echo $form->field($model, 'working_date') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <?php // echo $form->field($model, 'active_status') ?>

    <?php // echo $form->field($model, 'working_evidence') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
