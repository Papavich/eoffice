<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Menu;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaTypeRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = controllers::t( 'label', 'Setting Type Rules'); //'ตั้งค่าประเภทสูตร'; //Type Rules
$this->params['breadcrumbs'][] = $this->title;
$create = controllers::t( 'label', 'Create' );


?>
<div class="ta-type-rule-index">

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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  //echo Html::a('Create Ta Type Rule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'ta_type_rule_id',
            'ta_type_rule_name',
            'ta_type_detail',
            //'crby',
            'crtime',
            // 'udby',
            'udtime',

            [

                'class' => 'yii\grid\ActionColumn',
                'header' =>'Action',
                /*=> '<center>'.Html::a(Html::tag('i', '',
                             ['class' => 'glyphicon glyphicon-plus']) . $create, ['create'],
                         ['class' => 'btn btn-sm btn-green']).'</center>',
                 */
                'options'=>['style'=>'width:100px;'],
                //'contentOptions' => ['class' => 'text-center'],
                'template'=>'<div align="center" class="btn-group btn-group-sm " role="group" aria-label="..."><center>{view}{update}</center></div>',
                'buttons'=>[

                    'view'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                            $url,['class'=>'btn btn-sm btn-default ']);
                    },
                    'update'=>function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            $url,['class'=>'btn btn-sm btn-default ']);
                    },
                    /* 'delete'=>function($url,$model,$key){
                         return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
                             'title' => Yii::t('yii', 'Delete'),
                             'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                             'data-method' => 'post',
                             'data-pjax' => '0',
                             'class'=>'btn btn-sm btn-danger'
                         ]);
                     }*/
                ]
            ],
        ],
    ]); ?>
</div>
</div>