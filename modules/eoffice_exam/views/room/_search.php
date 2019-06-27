<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamEnrollSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-enroll-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'section_no') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'subopen_semester') ?>

    <?= $form->field($model, 'subopen_year') ?>

    <?php // echo $form->field($model, 'program_id') ?>

    <?php // echo $form->field($model, 'program_class') ?>

    <?php // echo $form->field($model, 'teacher_id') ?>

    <?php // echo $form->field($model, 'section_size') ?>

    <?php // echo $form->field($model, 'exam_enroll_seat') ?>

    <?php // echo $form->field($model, 'exam_enroll_start_time') ?>

    <?php // echo $form->field($model, 'exam_enroll_end_time') ?>

    <?php // echo $form->field($model, 'exam_enrolll_date') ?>

    <?php // echo $form->field($model, 'LEVELID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
