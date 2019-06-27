<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-invigilate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'exam_date')->textInput() ?>

    <?= $form->field($model, 'examstart_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rooms_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
