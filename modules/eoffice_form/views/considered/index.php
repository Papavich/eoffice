<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ConsideredSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'คำร้องที่พิจารณาแล้ว';
$this->params['breadcrumbs'][] = $this->title;
?>


<h3></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="considered-index">


                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        ['label'=>'ชื่อ-นามสกุล',
                            'value' => function ($model){
                                return $model->username->STUDENTNAME.' '.$model->username->STUDENTSURNAME;
                            }
                        ],
                        'user.user.user.template.template_name',
                        'cr_date',
                        'cr_term',
                        'cr_year',
                        'user.user.req_status',
                        //'approve_group_queue',
                        //'approve_id',
                        //'approve_name',
                        //'approve_queue',
                        //'approve_status',
                        //'approve_comment',
                        //'approve_visible',
                        //'approve_enddate',
                        //'approve_json:ntext',
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['view',
                                        'user_id' => $model->user_id,
                                        'template_id' => $model->template_id,
                                        'cr_date' => $model->cr_date,
                                        'cr_term' => $model->cr_term,
                                        'approve_group_queue' => $model->approve_group_queue,
                                        'approve_id' => $model->approve_id,
                                        'cr_year' => $model->cr_year
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
