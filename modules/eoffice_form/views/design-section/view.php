<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\DesignSection */

$this->title = 'Section : '.$model->design_section_name;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template->template_name, 'url' => ['req-template/view','id' => $model->template_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="design-section-view">

    <h3></h3>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('แก้ไขหมวดหมู่', ['update', 'id' => $model->design_section_id,'template_id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบหมวดหมู่', ['delete', 'id' => $model->design_section_id, 'template_id' => $model->template_id], [
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
                        //'design_section_id',
                        'design_section_name',
                        'sectionType.section_type_name',
                        'design_section_order',
                        //'template_id',

                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Field Section</strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('เพิ่มฟิลด์ ', ['design-attribute/create','design_section_id' => $model->design_section_id], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'attribute_ref',
                        'attribute_name',
                        'attribute_order',
                        //'design_section_id',
                        //'attribute_function_id',
                        'attributeType.attribute_type_name',
//                        [
//                            'format' => 'raw',
//                            //'options' => array('class' => 'btn btn-primary','color'=>'red'),
//                            'value'=>
//                                function($model){
//                                    $type = $model->attributeType->attribute_type_name;
//
//                                    if($type == 'Textbox' || $type == 'Areabox' || $type == 'File Upload' || $type == 'Picture' || $type == 'Paragraph'|| $type == 'Datepicker'){
//
//                                        return Html::a('ตรวจสอบ', ['design-attribute/view', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id  ], ['class'=>'']);
//                                    }else{
//                                        return Html::a('ตรวจสอบ', ['design-attribute/view-list', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id  ], ['class'=>'']);
//                                    }
//                                }
//                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                    $type = $model->attributeType->attribute_type_name;

                                    if($type == 'Textbox' || $type == 'Areabox' || $type == 'File Upload' || $type == 'Picture' || $type == 'Paragraph'|| $type == 'Datepicker'){
                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['design-attribute/view',
                                            'attribute_ref' => $model->attribute_ref,
                                            'design_section_id' => $model->design_section_id]);

                                       // return Html::a('ตรวจสอบ', ['design-attribute/view', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id  ], ['class'=>'']);
                                    }else{
                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['design-attribute/view-list',
                                            'attribute_ref' => $model->attribute_ref,
                                            'design_section_id' => $model->design_section_id]);

                                        //return Html::a('ตรวจสอบ', ['design-attribute/view-list', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id  ], ['class'=>'']);
                                    }
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['design-attribute/update',
                                        'attribute_ref' => $model->attribute_ref,
                                        'design_section_id' => $model->design_section_id]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['design-attribute/delete',
                                        'attribute_ref' => $model->attribute_ref,
                                        'design_section_id' => $model->design_section_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>





</div>
