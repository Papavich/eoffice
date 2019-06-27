<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamEnroll */

$this->title = 'Update Eoffice Exam Enroll: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Enrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->section_no, 'url' => ['view', 'section_no' => $model->section_no, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'subopen_semester' => $model->subopen_semester, 'subopen_year' => $model->subopen_year, 'program_id' => $model->program_id, 'program_class' => $model->program_class, 'teacher_id' => $model->teacher_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-exam-enroll-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
