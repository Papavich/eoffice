<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\modules\eoffice_form\models\ViewStudentJoinUser;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ReqApprovalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'พิจารณาคำร้องใหม่';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-approval-index">

<h3></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
<span><strong><?= Html::encode($this->title) ?></strong></span>
        </div>
        <div class="panel-body">

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
                    //'cr_term',
                    //'cr_year',
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
                                    'cr_year' => $model->cr_year,
                                    'approve_queue' => $model->approve_queue]);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        </div>
    </div>
</div>
