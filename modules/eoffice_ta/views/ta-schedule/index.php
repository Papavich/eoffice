<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\components\NextPage;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title = controllers::t('label','Manage Schedules');
$create = controllers::t('label','Create');
$search = controllers::t('label','Search');
$label_TStart = controllers::t('label','Time Start');
$label_TEnd = controllers::t('label','Time End');
$list = 'รายการกำหนดการ';
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$time = time();
?>
<style>
    .grid-view table thead  {
      //  background-color: #FFA000;

    }
</style>
<div class="ta-schedule-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!-- <div id="panel-1" class="panel panel-info">
        <div class="panel-heading">
            <span class="title elipsis size-18"><!-- panel title -->
    <!--		<strong><?php //$list ?></strong>
    <strong class="text-blue">
                                     -->
        <!--	     </strong>
</span>
</div> -->

        <div class="panel-body">


            <div class="table-responsive">

            <?php
           /* foreach ($model as  $item){
                $id = $item->ta_schedule_id;
                $title_name = $item->ta_schedule_title;
                $url = $item->ta_schedule_url;
                $detail = $item->ta_schedule_detail;
                $time_start = $item->time_start;
                $time_end = $item->time_end;
                $status = $item->active_status;
                $term = $item->term;
                $year = $item->year;
                $crby = $item->crby;
                $udby = $item->udby;
                $crtime = $item->crtime;
                $udtime = $item->udtime;   */
                ?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
               // 'filterModel' =>  $searchModel,
                'layout' => "{summary}\n{items}\n<div align='right'>{pager}</div>",
                'summary'=>'',
                'showFooter'=>false,
                'showHeader' => true,
                //'options'=>['class'=> 'info'],
               // 'options' => ['style' => 'background-color:#ccf8fe'],
                'columns' => [

                    ['class' => 'yii\grid\SerialColumn',

                      ],
                    [
                    'attribute' => 'time_start',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    'format' => ['date', 'php:d/m/Y'],

                    ],
                    [
                        'attribute' => 'time_end',
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'format' => ['date', 'php:d/m/Y']
                    ],
                    [
                        'attribute' => 'ta_schedule_title',
                        //'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    'term',
                    //'active_status',
                    [
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                        'format' => 'html',
                        'attribute' => 'active_status',
                        'value' => function($data) {
                            return ($data->active_status == 1 ? '
                     <span class="label label-success size-14">active</span>' :
                                '<span class="label label-danger size-14">not active</span>');
                        },
                    ],

                  /*  [

                        'class' => 'yii\grid\ActionColumn',
                        'buttonOptions'=>['class'=>'btn btn-sm btn-default'],
                        'template'=>'<div class="btn-group" role="group"> {view} {update} {delete} </div>',
                        'options'=> ['style'=>'width:150px;'],
                        'buttons'=>[
                            'copy' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-duplicate"></i>',$url,['class'=>'btn btn-default']);
                            }
                        ]

                    ]*/
                    [

                        'class' => 'yii\grid\ActionColumn',
                        'header' => '<center>'.Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-plus']) . $create, ['create'],
                            ['class' => 'btn btn-sm btn-green']).'</center>',
                        'options'=>['style'=>'width:140px;'],
                        'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>',
                        'buttons'=>[
                            'view'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                                    $url,['class'=>'btn btn-sm btn-default']);
                            },
                            'update'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                    $url,['class'=>'btn btn-sm btn-default']);
                            },
                            'delete'=>function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                    'class'=>'btn btn-sm btn-default'
                                ]);
                            }
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
            <div id="custom-pagination">
                <?php
              /* echo NextPage::widget([
                   //'dataProvider' => $dataProvider,
                    'pagination' => $pages,
                ]); */
                ?>
            </div>
</div>
