<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamEnroll */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-enroll-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'section_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_version')->textInput() ?>

    <?= $form->field($model, 'subopen_semester')->textInput() ?>

    <?= $form->field($model, 'subopen_year')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_class')->textInput() ?>

    <?= $form->field($model, 'teacher_id')->textInput() ?>

    <?= $form->field($model, 'section_size')->textInput() ?>

    <?= $form->field($model, 'exam_enroll_seat')->textInput() ?>

    <?= $form->field($model, 'exam_enroll_start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_enroll_end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_enrolll_date')->textInput() ?>

    <?= $form->field($model, 'LEVELID')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
