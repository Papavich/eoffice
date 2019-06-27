<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamExaminationItem */

$this->title = 'Update Eoffice Exam Examination Item: ' . $model->STUDENTID;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Examination Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->STUDENTID, 'url' => ['view', 'STUDENTID' => $model->STUDENTID, 'rooms_id' => $model->rooms_id, 'exam_date' => $model->exam_date, 'exam_start_time' => $model->exam_start_time, 'exam_end_time' => $model->exam_end_time, 'subject_id' => $model->subject_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-exam-examination-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
