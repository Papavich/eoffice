<?php

use yii\widgets\ActiveForm;
// Register Jquery UI
$this->registerJsFile('@mat_components/jqueryui/jquery-ui.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);

// Register Files Assets
$this->registerCssFile('@mat_assets/css/insertmaterial.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_assets/insertmaterial.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

// Select2 Plugin
$this->registerCssFile('@mat_components/select2/css/select2.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/select2/js/select2.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// My Select2
$this->registerJsFile('@mat_assets/mySelect2.js', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);
$this->registerJsFile('@mat_assets/select2-user.js', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);
//$this->registerJsFile('@mat_assets/mySelect2-test.js', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);

//DropzoneJS
$this->registerJsFile('@web/plugins/dropzone/dropzone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//DropzoneJS Config
$this->registerJsFile('@mat_assets/insert-dropzone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//DropzoneJS Css
$this->registerCssFile('@web/plugins/dropzone/css/dropzone.css', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);


?>
<!-- Head -->
<header id="page-header" style="margin-bottom: 20px">
    <h1>เพิ่มวัสดุ</h1>
    <ol class="breadcrumb">
        <li><a href="#">เพิ่มวัสดุ</a></li>
        <li class="active">สร้างรายการ</li>
    </ol>
</header>
<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto">
        <span class="title elipsis">
            <strong class="topic-import">ใบนำเข้าวัสดุ </strong> <!-- panel title -->
        </span>
        <!-- Button Create material to Session -->
        <button type="button" id="addmat" class="btn btn-info btn-sm pull-right" data-toggle="modal"
                data-target="#ModalInsert">เพิ่มรายการ
        </button>
        <button class="text-bill pull-right">
            <i id="detail_bill" class="fa fa-minus-circle fa-2x btn-bill"
               aria-hidden="true"></i><span class="hidden-xs"> รายละเอียด</span>
        </button>
        <div class="pull-right mat-pass">
            <input type="checkbox" id="material_pass">:วัสดุผ่านมือ
        </div>
        <div class="detail-bill row">
            <div class="col-md-6 bill-detail-input">
                <?php $form = ActiveForm::begin([
                    'id' => 'detail-bill',
                    'enableAjaxValidation' => true,
                    'action' => null,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                    'options' => [
                    ]
                ]);
                ?>
                <?= $form->field($model_bill_master, 'bill_master_date', [
                    'options' => [
                        'class' => 'form-group col-md-4'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true,'validateOnBlur' => false])
                    ->textInput(
                        [
                            'class' => 'form-control datepicker',
                            'data-format' => 'dd/mm/yyyy',
                            'placeholder' => 'วว/ดด/ปปปป',
                            'data-RTL'=>"false"
                        ]
                    )
                ?>
                <?= $form->field($model_bill_master, 'bill_master_id', [
                        'options' => [
                            'class' => 'form-group col-md-4 col-xs-6'],'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true,'validateOnBlur' => false]
                )->textInput(
                    [
                        'class' => 'form-control',
                        'placeholder' => 'K61010595',
                    ]
                )
                ?>
                <?= $form->field($model_bill_master, 'bill_master_id_no', [
                        'options' => [
                                'class' => 'form-group col-md-4 col-xs-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true,'validateOnBlur' => false]
                )->textInput(
                    [
                        'class' => 'form-control',
                        'placeholder' => '001',
                    ]
                )
                ?>
                <?= $form->field($model_bill_master, 'bill_master_check', [
                        'options' => [
                                'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true,'validateOnBlur' => false]
                )->textInput(
                    [
                        'class' => 'form-control',
                        'placeholder' => '02RE6102/0002',
                    ]
                )
                ?>
                <?= $form->field($model_bill_master, 'bill_mater_record', [
                        'options' => [
                                'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true,'validateOnBlur' => false]
                )->textInput(
                    [
                        'class' => 'form-control',
                        'placeholder' => 'ศธ 02142.6/357',
                    ]
                )
                ?>
                <div class="form-group col-md-12">
                    <label>สั่งซื้อจากบริษัท</label>
                    <!--  ,'id'=>'search-company'-->
                    <?= \yii\helpers\Html::activeDropDownList($model_bill_master, 'company_id',$model_company,['class'=>'form-control']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-6">
                <label>อัพโหลดไฟล์ PDF <span id="dropfile-help"
                                             class="notFound hidden-text">**กรุณาอัพไฟล์**</span></label>
                <?php $form = ActiveForm::begin([
                    'action' => 'upfile',
                    'id' => 'myDropzone',
                    'options' => [
                        'class' => 'dropzone dropzone-size',
                    ],
                ]) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <div id="mat-pass" class="hidden-text">
            <div class="row" id="layout-ModalCreate">
                <div class="col-md-12">
                    <label>ชื่อผู้เบิก</label>
                    <select id="search_user" class="form-control" name="state">
                    </select>
                    <span id="errorEnter_user" class="hidden-text"
                          style="color: red;">กรุณาเลือกผู้เบิกวัสดุ</span>
                </div>
                <div class="col-md-6">
                    <label>รายละเอียดการนำไปใช้(*)</label>
                    <select id="detail3" style="width: 100%">
                        <option value="D3001">วิชาเรียน</option>
                        <option value="D3002">โครงการ</option>
                        <option value="D3003">กิจกรรม</option>
                        <option value="D3004" selected>อื่น ๆ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div style="display: none" id="boxdetail1" name="D3001">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสวิชา</label>
                                <input name="order_detail_name_id" type="text" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อวิชา</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" id="boxdetail2" name="D3002">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสโครงการ</label>
                                <input name="order_detail_name_id" type="text" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อโครงการ</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" id="boxdetail3" name="D3003">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ชื่อกิจกรรม</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: block" id="boxdetail4" name="D3004">
                        <div class="row">
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <div class="row">
            <div id="list-material" class="col-md-8">
                <!-- Content Material List-->
            </div>
            <div class="col-md-4">
                <div class="panel panel-summary">
                    <div class="panel-body">
                        สรุปรายการทั้งหมด
                    </div>
                    <!-- Summary Material List -->
                    <div class="panel-footer">
                        <div class="row" style="font-size: 14px">
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <span>ราคารวม</span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                                <span id="price">0</span> บาท
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <span>รายการทั้งหมด</span>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                                <span id="amount-list">0</span> รายการ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <button></button>
            <button id="commit" type="button" class="btn btn-info btn-sm">ยืนยันรายการ</button>
            <button id="cancel-list" type="button" class="btn btn-default btn-sm">ยกเลิกรายการ</button>
        </div>
    </div>
</div>
<!-- Modal Insert Material -->
<div id="ModalInsert" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php
        $form = ActiveForm::begin([
            'options' => ['action' => 'form'],
        ]) ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <button type="button" style="display: none" id="close" data-dismiss="modal">close</button>
                <h4 class="modal-title">เพิ่มรายการวัสดุ</h4>
            </div>
            <div class="modal-body">
                <div class="panel-body setpadding-0">
                    <ul class="nav nav-tabs">
                        <li class="active "><a data-toggle="tab" href="#select1">ค้นหาวัสดุ</a></li>
                    </ul>
                    <div class="row setpad-con">
                        <div class="tab-content input-modal">
                            <!-- Page 1 -->
                            <div id="select1" class="tab-pane fade in active">
                                <div class="col-md-10">
                                    <label>ชื่อวัสดุ
                                        <small class="size-12 weight-300 text-mutted hidden-xs">(รหัสวัสดุ)</small>
                                    </label>
                                    <div class="form-group">
                                        <select id="search_mat" class="form-control" name="state">
                                        </select>
                                        <span id="errorEnter" class="hidden-text"
                                              style="color: red;">กรุณาเลือกวัสดุ</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Page1 -->
                        </div>
                        <div class="col-lg-2 col-md-2 margin-top-25">
                            <button type="button" name="btn-select-material" class="btn btn-info cs-main-btn"
                                    style="width: 100%">
                                <div class="glyphicon glyphicon-plus">เลือก</div>
                            </button>
                        </div>
                    </div>
                    <div id="obj-material">
                        <!-- Content obj_Material -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="addmattosession" type="button" class="btn btn-info">เพิ่ม</button>
                <button id="cancel" type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
<!-- Modal Delete Material -->
<div id="modaldelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ยืนยันการลบ</h4>
            </div>
            <div class="modal-body">
                <div class="loading-text">
                    <button type="button" class="btn btn-danger" id="commit-delete" data-dismiss="modal">ยืนยัน</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Cancel Bill -->
<div id="modalcancel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ยืนยันการยกเลิกรายการ</h4>
            </div>
            <div class="modal-body">
                <div class="loading-text">
                    <button type="button" class="btn btn-danger" id="commit-cancel" data-dismiss="modal">ยืนยัน</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Edit material -->
<div id="modaledit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="modalEdit">
                </div>
                <div class="modal-footer modal-edit">
                    <div class="loading-text">
                        <button type="button" class="btn btn-info btn-sm" id="edit-confirm">ยืนยัน</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                        <button id="close_edit" style="display: none" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Update-->
<div class="modal fade" id="ErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                    <small>ไฟล์[<i id="filename"></i>]</small>
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>รูปแบบไฟล์ไม่รองรับ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Size-->
<div class="modal fade" id="ErrorModalSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                    <small>ไฟล์[<i id="filenamesize"></i>]</small>
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>ไฟล์มีขนาดใหญ่เกิน</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error MaxFile -->
<div class="modal fade" id="ErrorModalmaxFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>ไม่สามารถอัพไฟล์เกิน 1
                    ไฟล์</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Database -->
<div class="modal fade" id="ErrorDatabase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>รหัสใบเบิกวัสดุซ้ำ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Preview -->
<div class="modal fade bs-example-modal-lg" id="preview" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-preview" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"><i class="fa fa-list-alt" style="vertical-align: middle" aria-hidden="true"></i>
                    ตรวจสอบรายการ</h3>
            </div>
            <div id="preview-content" class="modal-body">
                    <!-- Preview Content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">แก้ไขข้อมูล</button>
                <button id="submit-database" type="button" class="btn btn-primary btn-sm">ยืนยันรายการ</button>
            </div>
        </div>
    </div>
</div>
<input id="homeurl" type="hidden" value="<?= Yii::$app->homeUrl ?>">