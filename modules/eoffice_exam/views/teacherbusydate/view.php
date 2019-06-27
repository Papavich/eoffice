<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamBusydate */

$this->title = $model->viewperson->person_name;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Busydates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-busydate-view">

    <blockquote>
    <h4>ข้อมูลวันที่ไม่ว่างในการคุมสอบ : <?= Html::encode($this->title)?></h4>
    </blockquote>
    <p>
        <?= Html::a('แก้ไข', ['update', 'exam_busydate_date' => $model->exam_busydate_date, 'exam_busydate_time' => $model->exam_busydate_time, 'person_id' => $model->person_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'exam_busydate_date' => $model->exam_busydate_date, 'exam_busydate_time' => $model->exam_busydate_time, 'person_id' => $model->person_id],
         [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
         ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'viewperson.academic_positions_abb_thai',
            'viewperson.person_name',
            'viewperson.person_surname',
            'exam_busydate_date:date',
            'exam_busydate_time',
            'exam_busydate_note',
            //'person_id',
            [
            'format'=>'raw',
            'attribute'=>'exam_busy_file',
            'value'=>Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;'])
            ],
        ],
    ]) ?>

</div>
