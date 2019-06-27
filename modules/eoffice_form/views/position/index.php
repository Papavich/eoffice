<?php
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\PositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Positions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
            <span>เพิ่มตำแหน่งใหม่</span>
        </div>
        <div class="panel-body">
            <div class="position-form">

                <?php $form = ActiveForm::begin(['action'=>'create']); ?>

                <div class="form-group">
                    <br>
                    <div class="row">
                        <div class="col-lg-9">
                <?= $form->field($model, 'position_name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                        <div class="col-lg-3">
                    <?= Html::submitButton('เพิ่ม', ['class' => 'btn btn-success col-lg-3']) ?>
                        </div>
                </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-default ">

        <div class="panel-body">
            <div class="user-request-index">


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'position_id',
                        'position_name',



                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['position/view','id'=>$model->position_id]);
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['position/update','id'=>$model->position_id]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['position/delete','id'=>$model->position_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
