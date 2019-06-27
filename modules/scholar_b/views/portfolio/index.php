<?php

use app\modules\scholar_b\models\ScbProject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Portfolio') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'List Portfolio') ?></a></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-portfolio-index">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div>
                <a href="../portfolio/create" type="button" class="btn btn-success btn-3d"><i class="fa fa-plus-square"></i>
                    <?= controllers::t('label','Create Portfolio')?></a>
            </div><br>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => '{items}{summary}{pager}',
                'tableOptions' => [
                    'class' => 'table  table-bordered table-hover dataTable ',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=> controllers::t('label','port_name'),
                        'attribute'=> 'port_name',
                    ],
                    [
                        'filter' => controllers\GetModelController::getPortType(),
                        'header'=>controllers::t('label','port_type_id'),
                        'attribute'=> 'port_type_id',
                        'value' => function ($model) {
                            return $model->portType->type_name;
                        }
                    ],
                    [
                        'filter' => ArrayHelper::map(ScbProject::find()->where(['crby' => Yii::$app->user->identity->getId()])->all(), 'project_code', 'project_name'),
                        'header'=>controllers::t('label','project_code'),
                        'attribute'=> 'project_code',
                        'value' => function ($model) {
                            return $model->projectCode->project_name;
                        }
                    ],
                    [
                        'filter' => controllers\GetModelController::getYear(),
                        'header'=>controllers::t('label','year'),
                        'attribute'=> 'year',
                    ],
                    [
                        'filter' => controllers\GetModelController::getSemester(),
                        'header'=>controllers::t('label','semester'),
                        'attribute'=> 'semester',
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {deleteport}',
                        'contentOptions'=>[
                            'noWrap' => true
                        ],
                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['portfolio/view','id'=>$model->id_portfolio,]);
                            },
                            'update' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['portfolio/update','id'=>$model->id_portfolio,]);
                            },
                            'deleteport' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['portfolio/deleteport','id'=>$model->id_portfolio],[
                                    'data' => [
                                        'confirm' => controllers::t('label','Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                        'params' => ['id'=>$model->id_portfolio]
                                    ]]);
                            }
                        ],]
                ],
            ]); ?>
        </div>
    </div>
</div>

    <!--Get all flash messages and loop through them -->
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>