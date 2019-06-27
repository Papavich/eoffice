<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-invigilate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'exam_date') ?>

    <?= $form->field($model, 'examstart_time') ?>

    <?= $form->field($model, 'exam_end_time') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?php // echo $form->field($model, 'section_no') ?>

    <?php // echo $form->field($model, 'rooms_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
