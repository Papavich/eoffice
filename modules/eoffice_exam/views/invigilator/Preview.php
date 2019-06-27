<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_exam\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamInvigilateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประกาศห้องที่คุมสอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-invigilate-index">



    <blockquote>
      <span class="title elipsis">
        <strong class="size-20"><?= Html::encode($this->title) ?></strong>
          <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
      </span><br><br>
    </blockquote>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'ชื่อผู้คุมสอบ',
                'value'=>function($dataProvider){
                    return $dataProvider->pername->PREFIXABB.$dataProvider->pername->person_name.' '.$dataProvider->pername->person_surname;
                }
            ],
//            'pername.PREFIXABB',
//            'pername.person_name',
//            'pername.person_surname',
            'exam_date:date:วันที่',
            'examstart_time:text:เวลาที่เริ่มคุมสอบ',
            'exam_end_time:text:เวลาสิ้นสุดการคุมสอบ',
            'rooms_id:text:หมายเลขห้องคุมสอบ',

            //'section_no',
            //'room_id',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{view}'],

        ],
    ]); ?>


</div>
