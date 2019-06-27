<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\controllers;
use kartik\select2\Select2;
use app\modules\personsystem\controllers\GetModelController;

$this->title = 'Add Information';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t( 'label','Map Program To Major') ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information</a></li>
        <li class="active">Add Program And Major</li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="row">
        <!-- tabs -->
        <ul class="nav nav-tabs" style="margin-left: 14px;">
            <li class="<?php if(empty($_GET["active"])){echo "active";} ?>">
                <a href="#tab1_nobg" data-toggle="tab">
                    <i class="fa fa-book"></i> <?php echo controllers::t( 'label','Add Program To Major'); ?>
                </a>
            </li>
            <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <a href="#tab2_nobg" data-toggle="tab">
                    <i class="fa fa-briefcase"></i> <?php echo controllers::t( 'label','Add Major'); ?>
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
                            <?php
                            if($program!=null) {
                                foreach ($program as $value) {
                                    $arrayT[$value->PROGRAMID] = $value->PROGRAMID . " : " . $value->PROGRAMNAME;
                                }
                            }else{
                                $arrayT=[];
                            }
                            ?>

                            <?php $form = ActiveForm::begin(); ?>
                            <div class="col-md-6">
                                <?= $form->field( $model, 'PROGRAMID' )
                                    ->widget( Select2::classname(), [
                                        'data' => $arrayT,
                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Program ID' )],
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                    ] )->label(''); ?>
                           <br>
                            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field( $model, 'major_id' )
                                    ->widget( Select2::classname(), [
                                        'data' => GetModelController::getMajor(),
                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Major' )],
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                    ] )->label(''); ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
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
                                        'header'=> controllers::t('label','Program'),
                                        'attribute'=> 'PROGRAMID',
                                        'value'=>function($data){
                                            return $data->PROGRAMID.' : '.controllers\GetModelController::getFindProgram($data->PROGRAMID);
                                        }
                                    ],
                                    [
                                        'header'=> controllers::t('label','Major Name'),
                                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\Major::find()->select('major_name')->all(), 'major_name', 'major_name'),
                                        'attribute'=> 'major_name',
                                        'value'=>function($data){
                                            return $data->major->major_name;
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template'=>'{view} {update} {delete}',
                                        'contentOptions'=>[
                                            'noWrap' => true
                                        ],
                                        'buttons'=>[
                                            'view' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['add-information/program-view','major_id'=>$model->major_id,'PROGRAMID'=>$model->PROGRAMID]);
                                            },
                                            'update' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['add-information/program-update','major_id'=>$model->major_id,'PROGRAMID'=>$model->PROGRAMID]);
                                            },
                                            'delete' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['add-information/program-delete','major_id'=>$model->major_id,'PROGRAMID'=>$model->PROGRAMID],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                            }
                                        ],
                                        ],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>


            <div id="tab2_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['action'=>'major-create']); ?>
                            <div class="col-md-12">
                            <div class="col-md-6">
                            <?= $form->field($model2, 'major_name')->textInput(['maxlength' => true,'placeholder'=> controllers::t( 'label','Major Name')])->label('') ?>
                            </div>
                            <div class="col-md-6">
                            <?= $form->field($model2, 'major_name_eng')->textInput(['maxlength' => true,'placeholder'=> controllers::t( 'label','Major Name Eng')])->label('') ?>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <?= $form->field($model2, 'major_code')->textInput(['maxlength' => true,'placeholder'=> controllers::t( 'label','Major Code Name')])->label('') ?>
                            </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
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
                                        'header'=> controllers::t('label','Major Name'),
                                        'attribute'=> 'major_name',
                                    ],
                                    [
                                        'header'=> controllers::t('label','Major Name (Eng)'),
                                        'attribute'=> 'major_name_eng',
                                    ],
                                    [
                                        'header'=> controllers::t('label','Major Code'),
                                        'attribute'=> 'major_code',
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template'=>'{view} {update} {delete}',
                                        'contentOptions'=>[
                                            'noWrap' => true
                                        ],
                                        'buttons'=>[
                                            'view' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['add-information/major-view','id'=>$model->major_id]);
                                            },
                                            'update' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['add-information/major-update','id'=>$model->major_id]);
                                            },
                                            'delete' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['add-information/major-delete','id'=>$model->major_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                            }
                                        ],
                                        ],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab3_nobg" class="tab-pane  <?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['action'=>'create-level-bachelor']); ?>
                            <div class="col-md-6">
                                <?= $form->field( $model4, 'LEVELID' )
                                    ->widget( Select2::classname(), [
                                        'data' => GetModelController::getLevel(),
                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Level' )],
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                    ] )->label(''); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field( $model4, 'branch_id' )
                                    ->widget( Select2::classname(), [
                                        'data' => GetModelController::getBranch(),
                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Bachelor' )],
                                        'pluginOptions' => [
                                            'allowClear' => false,
                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                    ] )->label(''); ?>
                            </div>
                            <div class="col-md-12">
                                <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?><br><br><br>
                            </div>
                            <?php ActiveForm::end(); ?>
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



