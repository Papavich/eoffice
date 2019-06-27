<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\modules\eoffice_form\models\ReqTemplate;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTemplate */

$this->title = 'Template : '.$model->template_name;
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-template-view">

    <h3></h3>

    <!-- ส่วนของแบบฟอร์ม -->
    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('ตรวจสอบแบบฟอร์ม', ['req-template/preview','id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('แก้ไขแบบฟอร์ม', ['req-template/update','id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบแบบฟอร์ม', ['req-template/delete','id' => $model->template_id], [
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
                        'template_id',
                        'template_name',
                        'cr_date',
                        'cr_by',
                        'template_available',

                        ['attribute'=>'template_file','value'=>$model->listDownloadFiles('template_file'),'format'=>'html'],
                        //'template_file:ntext',
                        'template_level',
                        'template_operation',
                        'template_category',
                        'ud_by',
                        'ud_date',
                        'template_description',
                    ],
                ]) ?>
            </div>
        </div>
    </div>


<!--    <div id="content" class="dashboard">-->
<!--        <div id="panel-1" class="panel panel-primary">-->
<!--            <div class="panel-heading">-->
<!--                  <span class="title elipsis">-->
<!--                    <strong>Preview Document</strong>-->
<!--                  </span>-->
<!--            </div>-->
<!---->
<!---->
<!--            <style>-->
<!--                .myofficeviewer{-->
<!--                    box-shadow: 0 0.25em 0.25em rgba(0, 0, 0, 0.1);-->
<!--                    border: 1px solid #ECECEC;-->
<!--                }-->
<!--            </style>-->
<!---->
<!--            <script>-->
<!--                $(document).ready(function() {-->
<!--                    $(".word").fancybox({-->
<!--                        'width': 600, // or whatever-->
<!--                        'height': 320,-->
<!--                        'type': 'iframe'-->
<!--                    });-->
<!--                }); //  ready-->
<!--            </script>-->
<!---->
<!--            <div class="panel-body">-->
<!--                --><?php
//                $getTemplate = ReqTemplate::find()->where(['template_id' => $model->template_id])->all();
//                foreach ($getTemplate as $temp) {
//                    $TempDoc = $temp->template_file;
//                }
//
//                $FileDoc[] = json_decode($TempDoc, JSON_UNESCAPED_UNICODE);
//                $DocCode = array_keys($FileDoc[0]);
//
//                echo "<iframe align=\"middle\" width=\"700\"  height=\"800\"src='https://docs.google.com/viewer?url=../modules/eoffice_form/template/".$model->template_id."/".$DocCode[0]."&embedded=true' frameborder='0'></iframe>";
//
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <!-- ส่วนของ Design Section -->
        <div id="content" class="dashboard">
            <div id="panel-1" class="panel panel-primary">
                <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Design Section</strong>
                  </span>
                </div>
                <div class="panel-body">
                    <p>
                        <?= Html::a('เพิ่มหมวดหมู่', ['design-section/create','template_id' => $model->template_id], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'design_section_id',
                            'design_section_name',
                            'design_section_order',
                            //'template_id',
                            //'section_type_id',
//                            [
//                                'format' => 'raw',
//                                'value' => function($model, $key, $index, $column) {
//                                    return Html::a('ตรวจสอบ', ['design-section/view', 'id' => $model->design_section_id ], ['class'=>'']);
//
//                                }
//                            ],
//                            [
//                            'format' => 'raw',
//                            //'options' => array('class' => 'btn btn-primary','color'=>'red'),
//                            'value'=>
//                                function($model){
//                                    $type = $model->sectionType->section_type_name;
//                                    if($type == 'รายวิชา'){
//                                        return Html::a('ตรวจสอบ', ['design-section/view-subject', 'id' => $model->design_section_id ], ['class'=>'']);
//                                    }else{
//                                        return Html::a('ตรวจสอบ', ['design-section/view', 'id' => $model->design_section_id ], ['class'=>'']);
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
                                        $type = $model->sectionType->section_type_name;
                                        if($type == 'รายวิชา'){
                                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['design-section/view-subject',
                                                'id' => $model->design_section_id]);
                                        }else{
                                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['design-section/view',
                                                'id' => $model->design_section_id]);
                                        }
                                    },
                                    'update' => function($url,$model,$key){
                                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['design-section/update',
                                            'id' => $model->design_section_id,
                                            'template_id' => $model->template_id]);
                                    },
                                    'delete' => function($url,$model,$key){
                                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',['design-section/delete',
                                            'id' => $model->design_section_id,
                                            'template_id' => $model->template_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                    }
                                ],
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve Section</strong>
                  </span>
            </div>

            <!-- panel content -->
            <div class="panel-body">
                <p>
                    <?= Html::a('เพิ่มกลุ่มผู้พิจารณา', ['approve-group/create','template_id' => $model->template_id], ['class' => 'btn btn-success']) ?>
                </p>
                <?= GridView::widget([
                    'dataProvider' => $ApproveDataProvider,
                    'filterModel' => $ApproveSearchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                       // 'group_id',
                        'group_name',
                        'group_order',
                       // 'template_id',
                        //'approveType.approve_type_name',
//
//                        [
//                            'format' => 'raw',
//                            //'options' => array('class' => 'btn btn-primary','color'=>'red'),
//                            'value'=>
//                                function($model){
//                                    $groupType =  $model->groupType->group_type_name;
//                                    if($groupType == 'อาจารย์ประจำวิชา'){
//                                        return Html::a('ตรวจสอบ', ['approve-group/view-subject', 'id' => $model->group_id ], ['class'=>'']);
//                                    }else{
//                                        return Html::a('ตรวจสอบ', ['approve-group/view', 'id' => $model->group_id], ['class'=>'']);
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
                                    $groupType =  $model->groupType->group_type_name;
                                    if($groupType == 'อาจารย์ประจำวิชา'){
                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['approve-group/view-subject',
                                            'id' => $model->group_id]);
                                    }else{
                                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['approve-group/view',
                                            'id' => $model->group_id]);
                                    }
                                },
                                'update' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['approve-group/update',
                                        'id' => $model->group_id,
                                        'template_id' => $model->template_id]);
                                },
                                'delete' => function($url,$model,$key){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',['approve-group/delete',
                                        'id' => $model->group_id,
                                        'template_id' => $model->template_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                }
                            ],
                        ],

                    ],
                ]); ?>
            </div>
            <!-- /panel content -->

        </div>
        <!-- /PANEL -->

    </div>


    <!-- GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'section_id',
            'section_name',
            'design_section_type_design_section_type_id',
            'section_order',
            //'req_template_template_id',
           /* [
                'format' => 'raw',
                //'options' => array('class' => 'btn btn-primary','color'=>'red'),
                'value'=>
                    function($model){
                        $type = $model->section_type;
                        if($type == 'ผู้พิจารณา'){
                            return Html::a('ตรวจสอบ', ['section/approve-view', 'id' => $model->section_id ], ['class'=>'']);
                        }else{
                            return Html::a('ตรวจสอบ', ['section/view', 'id' => $model->section_id ], ['class'=>'']);
                        }
                    }
            ],*/
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return Html::a('ตรวจสอบ', ['section/view', 'id' => $model->section_id ], ['class'=>'']);

                }
            ]
        ],
    ]); -->

    <p>
        <!--
        //Html::a('Create Approve Group', ['approve-group/create','template_id' => $model->template_id], ['class' => 'btn btn-success'])
        -->
    </p>

    <!-- GridView::widget([
        'dataProvider' => $ApproveDataProvider,
        'filterModel' => $ApproveSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'approve_group_id',
            'approve_group_name',
            'approve_group_order',
            'approve_group_type',
            //'req_template_template_id',

            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return Html::a('ตรวจสอบ', ['approve-group/view', 'id' => $model->approve_group_id ], ['class'=>'']);

                }
            ]
        ],
    ]); -->

</div>
