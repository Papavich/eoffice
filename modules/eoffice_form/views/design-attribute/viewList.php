<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Boxattribute */


$this->title = 'Field : '.$model->attribute_ref;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->designSection->template->template_name, 'url' => ['req-template/view','id' => $model->designSection->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->designSection->design_section_name, 'url' => ['design-section/view','id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box-attribute-view">

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('แก้ไขฟิลด์', ['update', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบฟิลด์', ['delete', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id], [
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
                        'attribute_ref',
                        'attribute_name',
                        'attribute_order',
                        //'design_section_id',
                        //'attribute_function_id',
                        //'attribute_type_id',
                    ],
                ]) ?>


            </div>
        </div>
    </div>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>LIST</strong>
                  </span>
            </div>
            <div class="panel-body">





                <p>
                    <?= Html::a('เพิ่มลิสต์', ['attribute-data/create','design_section_id' => $model->design_section_id,'attribute_ref' => $model->attribute_ref], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'attribute_data_id',
                        'attribute_data',
                        'attribute_order',
                        //'attribute_ref',
                        //'design_section_id',

                        ['class' => 'yii\grid\ActionColumn',
                            'template'=>'{view} {update} {delete}',
                            'contentOptions'=>[
                                'noWrap' => true
                            ],
                            'buttons'=>[
                                'view' => function($url,$model,$key){
                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['attribute-data/view',
                                            'id' => $model->attribute_data_id]);
                                        },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['attribute-data/update',
                                        'id' => $model->attribute_data_id,
                                        'attribute_ref' => $model->attribute_ref,
                                        'design_section_id' => $model->design_section_id]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['attribute-data/delete',
                                        'id' => $model->attribute_data_id,
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



