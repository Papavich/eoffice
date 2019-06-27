<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterial */

$this->title = 'Update Matsys Material: ' . $model->material_id;
$this->params['breadcrumbs'][] = ['label' => 'Matsys Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->material_id, 'url' => ['view', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = 'Update';

//CSS Page
$this->registerCssFile('@mat_assets/material/css/material.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

//JS Page
$this->registerJsFile('@mat_assets/material/js/script-update.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="matsys-material-index">
    <!-- Head -->
    <header id="page-header" style="margin-bottom: 20px">
        <h1>จัดการวัสดุ</h1>
        <ol class="breadcrumb">
            <li><a href="../material">จัดการวัสดุ</a></li>
            <li><a href="#">แก้ไขวัสดุ</a></li>
        </ol>
    </header>
</div>

<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto panel-heading-height">
        <span class="title elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">แก้ไขข้อมูลวัสดุ : <?= $model->material_name ?></strong> <!-- panel title -->
        </span>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <div class="row">
            <div class="col-md-7">
                <?php $form = ActiveForm::begin([
                    'id' => 'detail-material',
                    'action' => null,
                ]); ?>

                <?= $form->field($model, 'material_id', [
                    'options' => [
                        'class' => 'form-group col-md-3',
                    ]
                ])->textInput(
                    [
                        'maxlength' => true,
                        'class' => 'form-control'
                    ]
                ) ?>

                <?= $form->field($model, 'material_name', [
                    'options' => [
                        'class' => 'form-group col-md-5',
                    ]
                ])->textInput(
                    [
                        'maxlength' => true,
                        'class' => 'form-control',
                    ]
                ) ?>

                <?= $form->field($model, 'material_unit_name', [
                    'options' => [
                        'class' => 'form-group col-md-4'
                    ]
                ])->textInput(
                    [
                        'maxlength' => true,
                        'class' => 'form-control',
                    ]
                ) ?>

                <?= $form->field($model, 'material_amount_check', [
                    'options' => [
                        'class' => 'form-group col-md-12'
                    ]
                ])->textInput(
                    [
                        'type' => 'number',
                        'class' => 'form-control',
                    ]
                ) ?>

                <?= $form->field($model, 'material_detail', [
                    'options' => [
                        'class' => 'form-group col-md-12'
                    ]
                ])->textarea(
                    [
                        'rows' => '2'
                    ]
                ) ?>
                <input id="temp_image" type="hidden" value="<?= $model->material_image ?>">
                <div class="form-group col-md-6">
                    <label>สถานที่จัดเก็บ</label>
                    <!--  ,'id'=>'search-company'-->
                    <?= \yii\helpers\Html::activeDropDownList($model, 'location_id', $modelLocation, ['class' => 'form-control select2']) ?>
                </div>
                <div class="form-group col-md-6">
                    <label>ประเภทวัสดุ</label>
                    <!--  ,'id'=>'search-company'-->
                    <?= \yii\helpers\Html::activeDropDownList($model, 'material_type_id', $modelType, ['class' => 'form-control select2']) ?>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="text-align: center;margin-top: 10px;">
                        <button type="submit" class="btn btn-primary" style="width: 150px">ยืนยัน</button>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-5">
                <div class="thumbnail" style="height: 225px !important;">
                    <img id="image-product" src="<?= Yii::$app->homeUrl ?>web_mat/images/<?= $model->material_image ?>" alt=""
                         style="height: 100%">
                    <div class="caption">
                    </div>
                </div>
                <?php $formImage = ActiveForm::begin(['options' => ['action' => false,'enctype'=>false]]) ?>

                <div class="col-md-12">
                    <div class="form-inline">
                        <?= $formImage->field($modelImage, 'imageFile', [
                            'options' => ['class' => 'form-group i-file'],
                            'template' => "{label}\n\n{input}\n{hint}\n{error}<button type=\"button\" id=\"addfile\" class=\"btn btn-info btn-sm btn-i-file margin-right-10\">อัพโหลด</button><button type=\"button\" id=\"cancelfile\" class=\"btn btn-default btn-sm btn-i-file\">ยกเลิก</button>"
                        ])->fileInput(['class' => 'form-control i-input-file'])->label('อัพโหลดรูปภาพ') ?>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
