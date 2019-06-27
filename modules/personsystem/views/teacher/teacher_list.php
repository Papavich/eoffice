<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use app\modules\personsystem\controllers;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\personsystem\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::csrfMetaTags() ?>
<div id="content" class="padding-20">
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>
                                  <i class="fa fa-edit"></i>  <?= controllers::t('label','Edit Teacher') ?>
                                </strong>
							</span>
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                       data-placement="bottom"><i class="fa fa-expand"></i></a></li>

            </ul>
        </div>
        <div class="panel-body">
            <div align="right">
                <a href="../person/teacher-create" type="button" class="btn btn-success btn-3d"><i class="fa fa-plus-square"></i><?= controllers::t('label','Add Teacher')?></a>
            </div>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'panel'=>[ 'before'=>' ',
                    'type'=>'default', 'heading'=>controllers::t('label','Table Show Teacher')
                ],
//                'summary'=>'',
                'layout' => '{items}{summary}{pager}',
                'tableOptions' => [
                    'class' => 'table  table-bordered table-hover dataTable ',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=> controllers::t('label','Teacher ID'),
                        'attribute'=> 'person_card_id',
                    ],
                    [
                        'header'=> controllers::t('label','Name'),
                        'attribute'=> 'person_name',
                    ],
                    [
                        'header'=> controllers::t('label','Surname'),
                        'attribute'=> 'person_surname',
                    ],
                    [
                        'filter' => \yii\helpers\ArrayHelper::map(\app\modules\personsystem\models\Major::find()->select('major_name')->all(), 'major_name', 'major_name'),
                        'header'=>controllers::t('label','Lecturer'),
                        'attribute'=> 'major_name',
                        'value'=>function($data){
                            if($data->major_id!=""){
                                return $data->major->major_name;
                            }else{
                                return "";
                            }
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'contentOptions'=>[
                            'noWrap' => true
                        ],
                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['teacher/admin-view-teacher','id'=>$model->person_id,]);
                            },
                            'update' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['teacher/admin-update-teacher','id'=>$model->person_id,]);
                            },
                            'delete' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['teacher/admin-delete-teacher'],[
                                    'data' => [
                                        'confirm' => controllers::t('label','Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                        'params' => ['id'=>$model->person_id]
                                    ]]);
                            }
                        ],],

                ],
            ]); ?>

        </div>
        <div class="panel-footer">
        </div>
    </div>
    </div>
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