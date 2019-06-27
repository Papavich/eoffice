<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaPropertySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title = controllers::t( 'label', 'Manage Property' );
$create = controllers::t( 'label', 'Create' );
$search = controllers::t( 'label', 'Search' );
$back = controllers::t( 'label', 'Back' );
$label_detail = controllers::t( 'label', 'Detail' );
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-property-index">
    <div class="panel-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Ta Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ta_property_id',
            [
                'attribute' => 'level_degree',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'options'=>['style'=>'width:100px;'],
            ],
            [
                'attribute' => 'ta_property_name',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'options'=>['style'=>'width:80px;'],
            ],
            [
                'attribute' => 'ta_property_value',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'options'=>['style'=>'width:80px;'],
            ],
            [
                'attribute' => 'property_gpa',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'options'=>['style'=>'width:80px;'],
            ],
            [
                'attribute' => 'property_detail',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
            ],
            //'crby',
            'crtime:datetime',

            //'udby',
            'udtime:datetime',

            [
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'filter'=>ArrayHelper::map(\app\modules\eoffice_ta\models\TaProperty::find()->all(),'active_status','active_status'),
                'attribute' => 'active_status',
                'value' => function($data) {
                    if ($data->active_status == '1') {
                        return ' <span class="label label-success size-15">เปิดใช้งาน</span>';
                    }else{
                        return '<span class="label label-danger size-15">ปิด</span>';
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '<center>'.Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-plus']) . $create, ['create'],
                        ['class' => 'btn btn-sm btn-green']).'</center>',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'options'=>['style'=>'width:180px;'],
                'template'=>'<div align="center" class="btn-group btn-group-sm " role="group" aria-label="..."><center>{active}{update}{delete}</center></div>',
                'buttons'=>[
                    'active'=>function($url,$model,$key){//['ta-property/active','id'=>$id]
                        if ($model->active_status=='1') {
                            return Html::a('<i class="fa fa-unlock"></i>',
                                ['ta-property/active', 'id' => $model->ta_property_id],
                                ['class' => 'btn btn-sm btn-success ']);
                        }else{
                            return Html::a('<i class="glyphicon glyphicon-lock"></i>',
                                ['ta-property/active', 'id' => $model->ta_property_id],
                                ['class' => 'btn btn-sm btn-primary ']);
                        }
                    },
                    'update'=>function($url,$model,$key){
                            return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                $url,['class'=>'btn btn-sm btn-warning']);

                    },
                    'delete'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class'=>'btn btn-sm btn-danger'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
    </div>
</div>
