<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
?>
<!-- page title -->
<header id="page-header">
    <h1>Add Information</h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information</a></li>
        <li class="active">Add Level And Bachelor</li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="row">
        <!-- tabs -->
        <ul class="nav nav-tabs" style="margin-left: 14px;">
            <li class="<?php if(empty($_GET["active"])){echo "active";} ?>">
                <a href="#tab1_nobg" data-toggle="tab">
                    <i class="fa fa-book"></i> <?php echo controllers::t( 'label','Add Level To Major'); ?>
                </a>
            </li>
            <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <a href="#tab2_nobg" data-toggle="tab">
                    <i class="fa fa-briefcase"></i> <?php echo controllers::t( 'label','Add Bachelor'); ?>
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
                            <?php $form = ActiveForm::begin(['action'=>'create-level-bachelor']); ?>
                            <div class="col-md-6">
                            <?= $form->field($model, 'LEVELID')->dropDownList(GetModelController::getLevel(),['maxlength' => true,'prompt'=> controllers::t( 'label',"Enter Level")])->label('') ?>
                            </div>
                            <div class="col-md-6">
                            <?= $form->field($model, 'branch_id')->dropDownList(GetModelController::getBranch(),['maxlength' => true,'prompt'=> controllers::t( 'label',"Enter Bachelor")])->label('')?>
                            </div>
                            <div class="col-md-12">
                                <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?><br><br><br>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                //'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute'=> 'LEVELNAME',
                                        'value'=>function($data){
                                            return $data->lEVEL->LEVELNAME;
                                        }
                                    ],
                                    [
                                        'attribute'=> 'branch_name',
                                        'value'=>function($data){
                                            return $data->branch->branch_name;
                                        }
                                    ],

                                    ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";}  ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
