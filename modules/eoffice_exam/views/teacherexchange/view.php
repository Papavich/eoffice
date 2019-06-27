<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchange */

$this->title = $model->exam_exchange_date;
$this->params['breadcrumbs'][] = ['label' => 'Exam Teacher Exchanges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="exam-teacher-exchange-view">

    <h4>ข้อมูลการขอแลกเปลี่ยนวันคุมสอบ ประจำวันที่:
    <span class="label label-default"><?= Html::encode($this->title) ?></span></h4>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'exam_type_namethai',
            'subopen_year',
            'subopen_semester',
            'exam_exchange_date:date',
            'exam_exchange_start_time',
            'exam_exchange_end_time',
            'rooms_id',
            'positions.academic_positions_abb_thai',
            'name.person_name',
            'surname.person_surname',
            'mobile.person_mobile',
            'exam_exchange_note',
            //'person_id',

        ],
    ]) ?>

    <p>
        <?= Html::a('แลกเปลี่ยนวันคุมสอบ', ['update', 
        'exam_exchange_date' => $model->exam_exchange_date,
        'exam_exchange_start_time' => $model->exam_exchange_start_time,
         'exam_exchange_end_time' => $model->exam_exchange_end_time,
         'person_name' => $model->name->person_name,
         'person_surname' => $model->name->person_surname,
         'person_id' => $model->person_id],
         ['class' => 'btn btn-primary'])?>
                <?= Html::a('ย้อนกลับ', ['index'], ['class' => 'btn btn-primary'])?>
    </p>

</div>
