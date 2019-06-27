<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use app\modules\eoffice_form\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\PositionActingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Position Actings';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
<span>เพิ่มรักษาการใหม่</span>
        </div>
        <div class="panel-body">
            <div class="position-acting-form">

                <?php $form = ActiveForm::begin(['action'=>'create']); ?>



                <?php
                $attributeFunction = app\modules\eoffice_form\models\ViewPositionJoinAssign::find()->all();
                $listData=ArrayHelper::map($attributeFunction,'position_id','position_name');
                ?>

                <?= $form->field($model, 'position_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --'])?>


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

                <?= $form->field($model, 'user_id')->dropDownList($listData,['prompt'=>'-- เลือกบุคคลากร --']) ?>

                <div class="row">
                    <div class="col-lg-6">

                        <?= $form->field($model, 'acting_startDate')->textInput(['class' => 'datepicker form-control']) ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($model, 'acting_endDate')->textInput(['class' => 'datepicker form-control']) ?>
                    </div>
                </div>



                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
            <span>ตารางการรักษาการแทน</span>
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
                    'acting_startDate',
                    'acting_endDate',

                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>'{view} {update} {delete}',
                        'contentOptions'=>[
                            'noWrap' => true
                        ],
                        'buttons'=>[
                            'view' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['position-acting/view',
                                    'position_id'=>$model->position_id,
                                    'user_id'=>$model->user_id,
                                    'acting_startDate'=>$model->acting_startDate,
                                    'acting_endDate'=>$model->acting_endDate,]);
                            },
                            'update' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['position-acting/update',
                                    'position_id'=>$model->position_id,
                                    'user_id'=>$model->user_id,
                                    'acting_startDate'=>$model->acting_startDate,
                                    'acting_endDate'=>$model->acting_endDate,
                                    ]);
                            },
                            'delete' => function($url,$model,$key){
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',[
                                        'position-acting/delete',
                                        'position_id'=>$model->position_id,
                                        'user_id'=>$model->user_id,
                                        'acting_startDate'=>$model->acting_startDate,
                                        'acting_endDate'=>$model->acting_endDate,
                                        ],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                            }
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>