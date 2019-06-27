<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\controllers;
use kartik\select2\Select2;
use app\modules\personsystem\models\Period;
use app\modules\personsystem\models\BoardOfDirectors;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\personsystem\models\StudentcsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Add Information';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label','Board Of Directors') ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add</a></li>
        <li class="active">Add Board Directers</li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-20">
    <div class="row">
                <!-- tabs -->
                <ul class="nav nav-tabs" style="margin-left: 14px;">
                    <li class="<?php if(empty($_GET["active"])){echo "active";} ?>">
                        <a href="#tab1_nobg" data-toggle="tab">
                            <i class="fa fa-user-plus"></i> <?php echo controllers::t( 'label','Add Position For Person'); ?>
                        </a>
                    </li>
                    <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                        <a href="#tab2_nobg" data-toggle="tab">
                            <i class="fa fa-table"></i> <?php echo controllers::t( 'label','Add Position Directors'); ?>
                        </a>
                    </li>
                    <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                        <a href="#tab3_nobg" data-toggle="tab">
                            <i class="fa fa-list-ul"></i> <?php echo controllers::t( 'label','Add Period'); ?>
                        </a>
                    </li>
                </ul>
                <!-- tabs1 content -->
                <div class="tab-content transparent">
                    <div id="tab1_nobg" class="tab-pane <?php if(empty($_GET["active"])){echo "active";} ?>">
                        <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <?php
                                    if($modelPerson!=null){
                                        foreach ($modelPerson as $value){
                                            $arrayT[$value->person_id]=$value->person_name."  ".$value->person_surname;
                                        }
                                    }else{
                                        $arrayT =[];
                                    }

                                    ?>
                                    <div class="col-md-4">
                                        <?= $form->field( $model, 'person_id' )
                                            ->widget( Select2::classname(), [
                                                'data' => $arrayT,
                                                'options' => ['placeholder' => controllers::t( 'label', 'Enter Person' )],
                                                'pluginOptions' => [
                                                    'allowClear' => false,
                                                ],
                                                'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                            ] )->label(''); ?>
                                            <br>
                                        <div class="form-group">
                                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field( $model, 'director_id' )
                                            ->widget( Select2::classname(), [
                                                'data' => controllers\GetModelController::getDirector(),
                                                'options' => ['placeholder' => controllers::t( 'label', 'Enter Position Directer' )],
                                                'pluginOptions' => [
                                                    'allowClear' => false,
                                                ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                            ] )->label(''); ?>
                                        </div>
                                    <div class="col-md-4">
                                        <?= $form->field( $model, 'period_id' )
                                            ->widget( Select2::classname(), [
                                                'data' => controllers\GetModelController::getPeriod(),
                                                'options' => ['placeholder' => controllers::t( 'label', 'Enter Period' )],
                                                'pluginOptions' => [
                                                    'allowClear' => false,
                                                ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                            ] )->label(''); ?>
                                       </div>
                                    <?php ActiveForm::end() ?>
                                    <div class="col-md-12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                        <!--  TABLE   -->
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-6">
                                    <h4><b><?php echo controllers::t( 'label','Table Show Person Directors'); ?></b></h4>
                                </div>
<br><br><br>
                                <?=
                                GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'panel'=>['before'=>' ','type'=>'default',
                                        // 'heading'=>controllers::t('label','Table Show Student')
                                    ],
                                    'layout' => '{items}{summary}{pager}',
                                    'tableOptions' => [
                                        'class' => 'table  table-bordered table-hover dataTable ',
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'header'=> controllers::t('label','Name'),
                                            'attribute'=> 'person_name',
                                            'value'=>function($data){
                                               // var_dump($data);
                                                return controllers\GetModelController::getFindAcademic2($data->person->academic_positions_id).' '.$data->person->person_name.'  '.$data->person->person_surname  ;
                                            }
                                        ],
                                        [
                                            'header'=> controllers::t('label','Position'),
                                            'attribute'=> 'position_name',
                                            'value'=>function($data){
                                                return $data->director->position_name;
                                            }
                                        ],
                                        [
                                            'header'=> controllers::t('label','Period'),
                                            'filter' => ArrayHelper::map(Period::find()->select(['period.period_id','period.period_describe'])->innerJoin('board_of_directors', 'board_of_directors.period_id = period.period_id')->distinct()->all(),'period_describe','period_describe'),
                                            'attribute'=> 'period_describe',
                                            'value'=>function($data){
                                                return $data->period->period_describe;
                                            }
                                        ],
                                        ['class' => 'yii\grid\ActionColumn',
                                            'template'=>'{view} {update} {delete}',
                                            'contentOptions'=>[
                                                'noWrap' => true
                                            ],

                                            'buttons'=>[
                                                'view' => function($url,$model,$key){
                                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['add-information/view','board_id'=>$model->board_id,'person_id'=>$model->person_id,'director_id'=>$model->director_id,'period_id'=>$model->period_id]);
                                                },
                                                'update' => function($url,$model,$key){
                                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['add-information/update','board_id'=>$model->board_id,'person_id'=>$model->person_id,'director_id'=>$model->director_id,'period_id'=>$model->period_id]);
                                                },
                                                'delete' => function($url,$model,$key){
                                                    return Html::a('<i class="fa fa-trash"></i>',['add-information/deletedirec','board_id'=>$model->board_id,'person_id'=>$model->person_id,'director_id'=>$model->director_id,'period_id'=>$model->period_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                                }
                                            ],
                                            ],
                                    ],
                                ]); ?>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>

                <!-- tabs2 content -->
                <div id="tab2_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                    <!------------------------------------------- แถบ2 ----------------------------------------------------------------->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="position-directors-form">
                                    <?php $form = ActiveForm::begin(['action'=>'add-position','method'=>'post']); ?>
                                    <?= $form->field($model2, 'position_name')->textInput(['maxlength' => true,'placeholder' => controllers::t( 'label',"Enter Position Directors (Thai)")])->label('') ?>
                                    <?= $form->field($model2, 'position_name_eng')->textInput(['maxlength' => true,'placeholder' => controllers::t( 'label',"Enter Position Directors (Eng)")])->label('') ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                                    </div>
                                    <div class="col-md-12">

                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!--  TABLE   -->
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="col-md-6" id="table">
                                            <h4><b><?php echo controllers::t( 'label','Table Show Directors'); ?></b></h4>

                                        </div>
                                        <br><br><br>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider2,
                                            'filterModel' => $searchModel2,
                                            'layout' => '{items}{summary}{pager}',
                                            'tableOptions' => [
                                                'class' => 'table  table-bordered table-hover dataTable ',
                                            ],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'header'=> controllers::t('label','Position'),
                                                    'attribute'=> 'position_name',
                                                ],
                                                [
                                                    'header'=> controllers::t('label','Position (Eng)'),
                                                    'attribute'=> 'position_name_eng',
                                                ],
                                                ['class' => 'yii\grid\ActionColumn',
                                                    'template'=>'{view} {update} {delete}',
                                                    'contentOptions'=>[
                                                        'noWrap' => true
                                                    ],
                                                    'buttons'=>[
                                                        'view' => function($url,$model,$key){
                                                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['add-information/position-view','id'=>$model->director_id,]);
                                                        },
                                                        'update' => function($url,$model,$key){
                                                            return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['add-information/position-update','id'=>$model->director_id,]);
                                                        },
                                                        'delete' => function($url,$model,$key){
                                                            return Html::a('<i class="glyphicon glyphicon-trash"></i>',['add-information/position-delete','id'=>$model->director_id,],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                                        }
                                                    ],],
                                            ],
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- tabs2 content -->
                    <div id="tab3_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                        <!------------------------------------------- แถบ2 ----------------------------------------------------------------->
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                        <?php $form = ActiveForm::begin(['action'=>'add-period','method'=>'post']); ?>
                                    <div class="col-md-6">
                                        <?= $form->field($model3, 'period_describe')->textInput(['maxlength' => true,'placeholder' => controllers::t( 'label',"Enter Period")])->label('') ?>
                                        <br>
                                        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field( $model3, 'date' )->widget(
                                            DatePicker::className(), [
                                            'language' => 'th',
                                            'clientOptions'=>[
                                                'changeMonth'=>true,
                                                'changeYear'=>true,
                                            ],
                                            'options' => ['class'=>'form-control','placeholder' => controllers::t( 'label','date of period') ],
                                            'dateFormat'=>'yyyy-MM-dd',
                                        ] )->label(''); ?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <!--  TABLE   -->
                                            <div class="col-md-6" id="table">
                                                <h4><b><?php echo controllers::t( 'label','Table Show Period'); ?></b></h4>
                                            </div>
                                            <br><br><br>
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider3,
                                        'filterModel' => $searchModel3,
                                        'layout' => '{items}{summary}{pager}',
                                        'tableOptions' => [
                                            'class' => 'table  table-bordered table-hover dataTable ',
                                        ],
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'header'=> controllers::t('label','Period'),
                                                'attribute'=> 'period_describe',
                                            ],
                                            [
                                                'header'=> controllers::t('label','Date Of Position'),
                                                'attribute'=>'date',
                                                'contentOptions' =>['class' => 'table_class'],
                                                'content'=>function($data){
                                                  //  return controllers\GetModelController::getDateThai('2018-04-3');
                                                    return controllers\GetModelController::getDateThai($data["date"]);
                                                }
                                            ],
                                            ['class' => 'yii\grid\ActionColumn',
                                                'template'=>'{view} {update} {delete}',
                                                'contentOptions'=>[
                                                    'noWrap' => true
                                                ],
                                                'buttons'=>[
                                                    'view' => function($url,$model,$key){
                                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['add-information/period-view','id'=>$model->period_id,]);
                                                    },
                                                    'update' => function($url,$model,$key){
                                                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['add-information/period-update','id'=>$model->period_id,]);
                                                    },
                                                    'delete' => function($url,$model,$key){
                                                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',['add-information/period-delete','id'=>$model->period_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                                    }
                                                ],],
                                        ],
                                    ]); ?>
                                </div>
                            </div>
                        </div>

                    </div>
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


