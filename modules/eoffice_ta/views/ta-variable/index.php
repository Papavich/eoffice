<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Menu;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaVariableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตั้งค่าตัวแปร'; //Ta Variables
$this->params['breadcrumbs'][] = $this->title;
$create = controllers::t( 'label', 'Create' );

?>
<div class="ta-variable-index">

    <div class="panel-body">
        <div class="navbar navbar-default">
            <div class="navbar-header">
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'ตั้งค่าประเภทสูตร', 'url' => ['ta-type-rule/index']],
                        ['label' => 'ตั้งค่าตัวแปร', 'url' => ['ta-variable/index']],
                        ['label' => 'ตั้งค่าสูตร', 'url' => ['ta-equation/index']],
                    ],
                    'options' => [
                        'class' => 'navbar-nav nav',
                        'id'=>'navbar-id',
                        'style'=>'font-size: 14px;',
                        'data-tag'=>'yii2-menu',
                    ],
                ]);
                ?>
            </div></div>
    <p>
        <?php //echo Html::a('Create Ta Variable', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'ta_variable_id',
            //'ta_variable_name',
           [
               'contentOptions' => ['class' => 'text-center'],
               'headerOptions' => ['class' => 'text-center'],
               'attribute' => 'ta_variable_name',
               'format' => 'html',
               'value'=>function($model) {
                     return '<strong style="color: blue">'.$model->ta_variable_name.'</strong>';
               }
           ],
           // 'ta_variable_value',

            //'status',

            [
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'attribute' => 'ta_variable_value',
                'value' => function($model) {
                    if ($model->status == 'main') {
                        if ($model->ta_variable_value == NULL) {
                            return ' <strong style="color: #229922">ค่าได้จากการคำนวณ</strong>';
                        }
                    }
                        elseif ($model->status == 'nonfix'){
                            if ($model->ta_variable_value==NULL) {
                                return ' <strong style="color: #720e9e">ค่าได้จากฐานข้อมูล</strong>';
                            }
                        } else{
                            return '<strong style="color: #f65d20">'.$model->ta_variable_value.'</strong>';
                        }

                },
            ],
            'ta_variable_detail',
            [
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'html',
                'attribute' => 'status',
                'value' => function($data) {
                  if ($data->status == 'main') {

                      return ' <span class="label label-success size-15">ตัวแปรรับค่าคำตอบ</span>';
                  }elseif ($data->status=='fix'){
                      return '<span class="label label-warning size-15">ตัวแปรค่าคงที่</span>';
                   }elseif ($data->status =='var'){
                      return '<span class="label label-warning size-15">var</span>';
                  }else{
                      return '<span class="label label-primary size-15">ดึงค่าจากฐานข้อมูล</span>';
                  }
                },
            ],
            [
               'class' => 'yii\grid\ActionColumn',
               'header' =>'Action',
                'options'=>['style'=>'width:100px;'],
                'template'=>'<div align="center" class="btn-group btn-group-sm " role="group" aria-label="..."><center>{view}{update}</center></div>',
                'buttons'=>[
                    'view'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                            $url,['class'=>'btn btn-sm btn-default ']);
                    },
                    'update'=>function($url,$model,$key){
                        if ($model->status == 'fix'){
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            $url,['class'=>'btn btn-sm btn-default']);
                    }
                    },

                ]
            ],
        ],
    ]); ?>
</div>
<div>
