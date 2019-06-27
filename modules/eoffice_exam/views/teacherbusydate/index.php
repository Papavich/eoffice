<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_exam\models\EofficeExamBusydateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ระบุวันที่ไม่ว่างในการคุมสอบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-exam-busydate-index">

    <blockquote>
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </blockquote>

    <div class="pull-right">
    <p>
        <?= Html::a('   เพิ่มวันที่ไม่ว่างในการคุมสอบ', ['create'], ['class' => 'btn btn-3d btn-xlg btn-teal et-calendar']) ?>
    </p>
    </div>

    <div class="col-sm-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'exam_busydate_date',
            'exam_busydate_time',
            'exam_busydate_note:text:หมายเหตุ',
            'viewperson.academic_positions_abb_thai',
            'viewperson.person_name',
            'viewperson.person_surname',
            //'person_id',

            [
              'options'=>['style'=>'width:150px;'],
              'format'=>'raw',
              'attribute'=>'exam_busy_file',
              'value'=>function($model){
                return Html::tag('div','',[
                  'style'=>'width:150px;height:95px;
                  border-top: 10px solid rgba(255, 255, 255, .46);
                  background-image:url('.$model->photoViewer.');
                  background-size: cover;
                  background-position:center center;
                  background-repeat:no-repeat;
                  ']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
  </div>

</div>
