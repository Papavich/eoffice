<?php

use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;
//JS
//$this->registerJsFile('@mat_assets/insertmaterial_file.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//CSS
$this->registerCssFile('@mat_assets/css/insertmaterialfile.css', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);

//StepWizard
$this->registerJsFile('@mat_components/smartwizard-master/js/jquery.smartWizard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@mat_components/smartwizard-master/css/smart_wizard_theme_circles.css', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()], [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);
//StepWizard Config
$this->registerJsFile('@mat_assets/jquerysteps-importfile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//DropzoneJS
$this->registerJsFile('@web/plugins/dropzone/dropzone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//DropzoneJS Config
$this->registerJsFile('@mat_assets/dropfile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//DropzoneJS Css
$this->registerCssFile('@web/plugins/dropzone/css/dropzone.css', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);

// Select2 Plugin
$this->registerCssFile('@mat_components/select2/css/select2.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/select2/js/select2.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<!-- Head -->
<header id="page-header" style="margin-bottom: 20px">
    <h1>เพิ่มวัสดุ</h1>
    <ol class="breadcrumb">
        <li><a href="#">เพิ่มวัสดุ</a></li>
        <li class="active">นำเข้าผ่านไฟล์</li>
    </ol>
</header>
<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto">
        <span class="title elipsis">
            <strong class="topic-import">นำเข้าวัสดุ</strong> <!-- panel title -->
            <small class="size-12 weight-300 text-mutted hidden-xs">XML</small>
        </span>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- SmartWizard html -->
                <div id="smartwizard" class="sw-main sw-theme-circles">
                    <ul class="circle-topic">
                        <li><a href="#step-1">Step 1
                                <small>อัพโหลดไฟล์นำเข้าวัสดุ</small>
                            </a></li>
                        <li><a href="#step-2">Step 2<br/>
                                <small>ตรวจสอบความถูกต้อง</small>
                            </a></li>
                        <li><a href="#step-3">Step 3<br/>
                                <small>ยืนยันรายการสำเร็จ</small>
                            </a></li>
                    </ul>
                    <div>
                        <!-- Page 1 -->
                        <div id="step-1" class="" style="display: none">
                            <?php $form = ActiveForm::begin([
                                'action' => 'upfile',
                                'id' => 'myDropzonexml',
                                'options' => [
                                    'class' => 'dropzone',
                                ],
                            ]) ?>
                            <?php ActiveForm::end() ?>
                        </div>
                        <!-- Page 2 -->
                        <div id="step-2" class="" style="display: none">
                            </select>
                            <div id="contentxml" class="margin-top-30">
                                <!-- Content xml -->
                            </div>
                        </div>
                        <!-- Page 3 -->
                        <div id="step-3" class="" style="display: none">
                            <div style="text-align: center;padding: 80px">
                                <h2>ทำรายการสำเร็จ</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <button class="btn btn-default btn-sm" id="prev-btn" type="button">ย้อนกลับ</button>
            <button class="btn btn-default btn-sm next-btn" id="next-btn" type="button">ถัดไป</button>
            <button class="btn btn-info btn-sm" id="success-btn" type="button">ยืนยันรายการ</button>
        </div>
    </div>
</div>
<!-- Modal Confirm -->
<div id="Modalconfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ยืนยันการทำรายการ</h4>
            </div>
            <div class="modal-body">
                <div class="loading-text modal-center">
                    <button name="confirm" type="button" class="btn btn-info" id="confirm" data-dismiss="modal">ยืนยัน</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
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