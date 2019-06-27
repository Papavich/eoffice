<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\models\TaVariable;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaEquationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$create = controllers::t( 'label', 'Create' );

$this->title = 'ตั้งค่าสมการ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-equation-index">

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
        <?php //echo Html::a('Create Ta Equation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ta_equation_id',
            'ta_equation_name',

            'ta_equation_detail:ntext',
            /*[ 'attribute'=>'ta_equation_detail',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],

            ],*/
            [ 'attribute'=>'ans',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                  'filter'=>ArrayHelper::map(TaVariable::find()->all(),'ta_variable_id','ta_variable_name'),
               'value'=>function($model){
                   return $model->ans0->ta_variable_name;
               }
              ],
            [ 'attribute'=>'ta_type_rule_id',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'filter'=>ArrayHelper::map(TaTypeRule::find()->all(),'ta_type_rule_id','ta_type_rule_name'),
                'value'=>function($model){
                    return $model->taTypeRule->ta_type_rule_name;
                }
            ],
           // 'active_status',
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


            //['class' => 'yii\grid\ActionColumn'],
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
    </div>
</div>

