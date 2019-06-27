<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamExaminationItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-examination-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STUDENTID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rooms_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_date')->textInput() ?>

    <?= $form->field($model, 'exam_start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_seat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
