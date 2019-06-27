<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\EofficeExamExaminationItem */

$this->title ='ประกาศที่นั่งสอบ: ' . $model->name->STUDENTNAME . '   ' . $model->name->STUDENTSURNAME;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Exam Examination Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-examination-item-view">

    <h3><?= Html::encode($this->title) ?></h3>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject_id',
            'exam_date',
            'exam_start_time',
            'exam_end_time',
            'rooms_id',
            [
              'format'=>'html',
              'label' => 'เลขที่นั่งสอบ',
              'value' => '<span style="color:blue;">'.'<strong>'.$model->exam_seat.'</span>'.'</strong>'
            ],
            //'exam_seat',
            'STUDENTID',
            //'picsroom.rooms_pic',
        ],
    ]) ?>

    <?= Html::a('ย้อนกลับ', ['index'], ['class' => 'btn btn-success btn-3d pull-right']) ?>

</div>
