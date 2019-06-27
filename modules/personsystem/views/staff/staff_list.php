<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\personsystem\controllers;
?>
<?= Html::csrfMetaTags() ?>
<!-- /page title -->
<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>   <i class="fa fa-edit"></i> <?= controllers::t('label','Edit Staff') ?></strong>
							</span>
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

            </ul>
        </div>
        <!-- panel content -->
        <div class="panel-body">
            <div align="right">
                <a href="../person/staff-create" type="button" class="btn btn-success btn-3d"><i class="fa fa-plus-square"></i><?= controllers::t('label','Add Staff')?></a>
            </div>
            <br>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'panel'=>['before'=>' ','type'=>'default', 'heading'=>controllers::t('label','Table Show Staff')],
                'layout' => '{items}{summary}{pager}',
                'tableOptions' => [
                    'class' => 'table  table-bordered table-hover dataTable ',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=>controllers::t('label','Prefix'),
                        'attribute'=> 'PREFIXNAME',
                        'value'=>function($data){
                            return $data->prefix->PREFIXNAME;
                        }
                    ],
                    [
                        'header'=>controllers::t('label','Name'),
                        'attribute'=> 'person_name',
                        'value'=>function($data){
                            return $data->person_name;
                        }
                    ],
                    [
                        'header'=>controllers::t('label','Surname'),
                        'attribute'=> 'person_surname',
                        'value'=>function($data){
                            return $data->person_surname;
                        }
                    ],
                    [
                        'header'=>controllers::t('label','Position'),
                        'attribute'=> 'person_position_staff',
                        'value'=>function($data){
                            return $data->person_position_staff;
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'contentOptions'=>[
                            'noWrap' => true
                        ],
                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['staff/admin-view-staff','id'=>$model->person_id,]);
                            },
                            'update' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['staff/admin-update-staff','id'=>$model->person_id,]);
                            },
                            'delete' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['staff/admin-delete-staff'],[
                                    'data' => [
                                        'confirm' => controllers::t('label','Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                        'params' => ['id'=>$model->person_id]
                                    ]]);
                            }
                        ]],
                ],
            ]); ?>


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