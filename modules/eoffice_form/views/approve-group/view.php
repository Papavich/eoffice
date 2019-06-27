<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveGroup */

$this->title = 'Group : '.$model->group_name;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template->template_name, 'url' => ['req-template/view','id' => $model->template_id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="attribute-data-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve Group</strong>
                  </span>
            </div>
            <div class="panel-body">
                <div class="approve-group-view">

                    <p>
                        <?= Html::a('แก้ไขกลุ่มผู้พิจารณา', ['update', 'id' => $model->group_id,'template_id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                        <?= Html::a('ลบกลุ่มผู้พิจารณา', ['delete', 'id' => $model->group_id, 'template_id' => $model->template_id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                //'method' => 'post',
                            ],
                        ]) ?>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'group_id',
                            'group_name',
                            'group_order',
                            'template.template_name',
                            'approveType.approve_type_name',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve</strong>
                  </span>
            </div>
            <div class="panel-body">
                    <?= Html::a('เพิ่มผู้พิจารณา', ['approve-position/create', 'group_id' => $model->group_id], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'position_id',
                        'position_name',
                        'position_order',
                        //'approve_group_id',
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['approve-position/view',
                                        'position_id' => $model->position_id,
                                        'approve_group_id' => $model->approve_group_id,
                                    ]);
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['approve-position/update',
                                        'position_id' => $model->position_id,
                                        'approve_group_id' => $model->approve_group_id,]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['approve-position/delete',
                                        'position_id' => $model->position_id,
                                        'approve_group_id' => $model->approve_group_id,],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <!--<div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve Design</strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    < Html::a('ออกแบบฟอร์มการอนุมัติ', ['approve-design-section/create', 'group_id' => $model->group_id,'template_id' => $model->template_id], ['class' => 'btn btn-success']) ?>
                </p>

                <= GridView::widget([
                    'dataProvider' => $ApproveDesignDataProvider,
                    'filterModel' => $ApproveDesignSearchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'approve_design_id',
                        'approve_design_name',
                        'approve_design_order',
                        'approve_group_id',
                        'section_type_id',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); >
            </div>
        </div>
    </div>-->

</div>
