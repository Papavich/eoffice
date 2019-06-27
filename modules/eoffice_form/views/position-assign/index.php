<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\PositionAssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การดำรงตำแหน่ง';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
            <span>เพิ่มการดำรงตำแหน่ง</span>
        </div>

        <div class="panel-body">

            <div class="position-assign-form">


                <?php $form = ActiveForm::begin(['action'=>'create']); ?>


                <div class="form-group">
                    <br>
                    <div class="row">
                        <div class="col-lg-9">
                            <?php
                            $position = app\modules\eoffice_form\models\Position::find()
                                ->all();
                            $listData=ArrayHelper::map($position,'position_id','position_name');
                            ?>

                            <?= $form->field($model, 'position_id')->dropDownList($listData,['prompt'=>'-- เลือกตำแหน่ง --'])->label(false) ?>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <?php
                            $person = app\modules\eoffice_form\models\ViewPisPerson::find()
                                ->orderBy('PREFIXABB DESC')
                                ->all();
                            $listData=ArrayHelper::map($person,'person_card_id',
                                function($model) {
                                    return $model['PREFIXABB'].' '.$model['person_name'].' '.$model['person_surname'];
                                }
                            );
                            ?>

                            <?= $form->field($model, 'user_id')->dropDownList($listData,['prompt'=>'-- เลือกบุคคลากร --'])->label(false) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= Html::submitButton('เพิ่ม', ['class' => 'btn btn-success col-lg-3 pull-bottom']) ?>
                        </div>
                    </div>
                </div>

                <?= $form->field($model, 'cr_date')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

                <?= $form->field($model, 'cr_by')->hiddenInput(['maxlength' => true,'value' => Yii::$app->user->identity->username])->label(false) ?>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>


<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
<span>ตารางการดำรงตำแหน่ง</span>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'position.position_name',

                    ['label'=>'ชื่อ-นามสกุล',
                        'value' => function ($model){
                            return $model->username->PREFIXABB.' '.$model->username->person_name.' '.$model->username->person_surname;
                        }
                    ],
                    //'cr_date',
                    //'cr_by',
                    //'ud_date',
                    //'ud_by',

                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'contentOptions'=>[
                            'noWrap' => true
                        ],
                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['position-assign/view','position_id'=>$model->position_id,'user_id'=>$model->user_id]);
                            },
                            'update' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['position-assign/update','position_id'=>$model->position_id,'user_id'=>$model->user_id]);
                            },
                            'delete' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['position-assign/delete','position_id'=>$model->position_id,'user_id'=>$model->user_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                            }
                        ],
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>