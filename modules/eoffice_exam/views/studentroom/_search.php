<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamExaminationItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-exam-examination-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'STUDENTID') ?>

    <?= $form->field($model, 'rooms_id') ?>

    <?= $form->field($model, 'exam_date') ?>

    <?= $form->field($model, 'exam_start_time') ?>

    <?= $form->field($model, 'exam_end_time') ?>

    <?php // echo $form->field($model, 'exam_seat') ?>

    <?php // echo $form->field($model, 'subject_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
