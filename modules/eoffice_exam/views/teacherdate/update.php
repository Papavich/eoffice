<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamInvigilate */

$this->title = 'Update Eoffice Exam Invigilate: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Invigilates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_id, 'url' => ['view', 'person_id' => $model->person_id, 'exam_date' => $model->exam_date, 'examstart_time' => $model->examstart_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id, 'section_no' => $model->section_no, 'rooms_id' => $model->rooms_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-exam-invigilate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
