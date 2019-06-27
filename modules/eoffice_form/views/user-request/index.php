<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\UserRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Requests';
$this->params['breadcrumbs'][] = $this->title;
?>


<h3><?= Html::encode($this->title) ?></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Design Section</strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="user-request-index">

                <p>
                    <?= Html::a('Create User Request', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'user_id',
                        'template_id',
                        'cr_date',
                        'cr_term',
                        'cr_year',
                        //'req_json:ntext',
                        //'req_doc:ntext',

                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['user-request/view',
                                        'user_id'=>$model->user_id,
                                        'template_id'=>$model->template_id,
                                        'cr_date'=>$model->cr_date,
                                        'cr_term'=>$model->cr_term,
                                        'cr_year'=>$model->cr_year,]);
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['user-request/update',
                                        'user_id'=>$model->user_id,
                                        'template_id'=>$model->template_id,
                                        'cr_date'=>$model->cr_date,
                                        'cr_term'=>$model->cr_term,
                                        'cr_year'=>$model->cr_year,]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['user-request/delete',
                                        'user_id'=>$model->user_id,
                                        'template_id'=>$model->template_id,
                                        'cr_date'=>$model->cr_date,
                                        'cr_term'=>$model->cr_term,
                                        'cr_year'=>$model->cr_year,],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
