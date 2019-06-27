<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamBusydate */

$this->title = 'แก้ไขข้อมูลวันที่ไม่ว่างในการคุมสอบ: ' . $model->exam_busydate_date;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Busydates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->exam_busydate_date, 'url' => ['view', 'exam_busydate_date' => $model->exam_busydate_date, 'exam_busydate_time' => $model->exam_busydate_time, 'person_id' => $model->person_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-exam-busydate-update">

    <blockquote>
    <h3><?= Html::encode($this->title) ?></h3>
    </blockquote>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
