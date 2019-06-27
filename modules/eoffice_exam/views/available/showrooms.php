<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\ExamRoomDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการห้องที่สามารถจัดสอบได้';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-room-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rooms_detail_date',
            'rooms_detail_time',
            'rooms_id',
            'exam_room_tag',
//            'exam_room_status',
            //'exam_rooms_seat',
            //'rooms_pic',
            //'exam_rooms_seat_temp',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
