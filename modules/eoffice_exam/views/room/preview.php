<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamExaminationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แสดงผลการจัดห้องสอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-examination-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rooms_id',
            'room_tag',
            'subject_id',
            'Section',
            'subname.subject_namethai',
            //'program_class',
            'exam_date',
            //'roomseat.exam_rooms_seat_temp',
            'exam_start_time',
            'exam_end_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
