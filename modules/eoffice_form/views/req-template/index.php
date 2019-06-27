<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ReqTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Req Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>ตารางแบบฟอร์ม</strong>
                  </span>
            </div>
            <div class="panel-body">
<!--                <p>
 Html::a('สร้างแบบฟอร์มใหม่', ['create'], ['class' => 'btn btn-success'])
                </p>-->

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'template_id',
                        'template_name',
                        //'cr_date',
                        //'cr_by',

                        //'template_file:ntext',
                        'template_level',
                        //'template_operation',
                        'template_category',
                        'template_available',


                        //'ud_by',
                        //'ud_date',
                        //'template_description',

                        //['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['req-template/view',
                                        'id' => $model->template_id]);
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['req-template/update',
                                        'id' => $model->template_id]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['req-template/delete',
                                        'id' => $model->template_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ],

                    ],
                ]); ?>
            </div>
        </div>
    </div>









</div>
