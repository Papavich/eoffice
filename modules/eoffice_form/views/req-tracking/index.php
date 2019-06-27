<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ReqTrackingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ติดตามคำร้อง';
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
            <div class="req-tracking-index">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'user_id',
                        'user.template.template_name',
                        'cr_date',
                        'cr_term',
                        'cr_year',
                        'req_status',
                        //'req_enddate',
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
                                        'cr_year' => $model->cr_year]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>