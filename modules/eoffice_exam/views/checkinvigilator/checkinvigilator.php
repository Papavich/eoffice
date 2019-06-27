<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_exam\controllers;
?>
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">ตรวจสอบกรรรมการคุมสอบ</strong> <!-- panel title -->
      </span>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'exam_busydate_date:date:วันที่',
                'exam_busydate_time:text:เวลา',
                'exam_busydate_note:text:หมายเหตุ',
                'person_id:text:รหัสกรรรมการคุมสอบ',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
