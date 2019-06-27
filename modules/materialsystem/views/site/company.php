<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\base\view;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

ini_set("memory_limit","10M");

/* @var $this yii\web\View */
/* @var $company \app\modules\materialsystem\models\MatsysCompany */
/* @var $companyDel \app\modules\materialsystem\models\MatsysMaterialHasStock */
?>

<!-- page title -->
<header id="page-header">
    <h1>ตั้งค่าบริษัท</h1>
</header>
<!-- /page title -->

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการบริษัท</strong> <!-- panel title -->
							</span>
        </div>
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div id="panel-ui-tan-l1" class="panel panel-default">

                    <div class="panel-heading">
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><!-- TAB 1 -->
                                <a href="#search_page1" data-toggle="tab">ค้นหาจากรหัส หรือ ชื่อบริษัท</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">

                        <!-- tabs content -->
                        <div class="tab-content transparent">

                            <div id="search_page1" class="tab-pane active"><!-- TAB 1 CONTENT -->
                                <div class="col-md-3 col-sm-3">
                                    <select class="form-control select2" style="width: 230px;">
                                        <option value=""></option>
                                        <option value="1">รหัส : 020145323</option>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-white">
                                    <i class="fa fa-search"> ค้นหา</i>
                                </button>

                            </div><!-- /TAB 1 CONTENT -->
                        </div>
                        <!-- /tabs content -->

                    </div>
                    <!-- /panel content -->

                    <!-- Seacrch Page -->
        <!-- panel content -->
        <div class="panel-body">

            <table class="table table-striped table-bordered table-hover">

                <table class="table table-striped table-bordered table-hover">


                <button type="button" class="btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myAdd">เพิ่มบริษัท</button>
                <thead>
                <tr>
                    <th width="1%">ลำดับ</th>
                    <th width="13%">รหัสบริษัท</th>
                    <th>ชื่อบริษัท</th>
                    <th>รายละเอียด</th>
                    <th width="20%">การจัดการ</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 1;?>

                <?php foreach ($mat_company as $company) { ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $company->company_id ?></td>
                    <td><?= $company->company_name ?></td>
                    <td>
                        <!-- Modal Ajax Lightbox >-->
                        <a class="btn btn-leaf btn-xs btn-3d lightbox" data-toggle="modal" data-target="#myDetail<?= $company->company_id ?>">
                            <i class="glyphicon glyphicon-zoom-in" aria-hidden="false"></i>รายละเอียด</a>
                        </a>
                    </td>
                    <td>
                        <div class="col-md-3 col-xs-2">
                            <a class="btn btn-xs btn-warning btn-3d" data-toggle="modal" data-target="#myEdit<?= $company->company_id ?>">แก้ไข</a>
                        </div>
                        <div class="col-md-3 col-xs-2">
                            <a class="btn btn-xs btn-danger btn-3d" data-toggle="modal" data-target="#myDel<?= $company->company_id ?>">ลบ</a>
                        </div>
                    </td>
                </tr>
                <?php $count ++ ; } ?>

                </tbody>
            </table>
        </div>
    </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>
                </div>
    <!-- ======================================= Modal Add =============================================== -->
    <div id="myAdd" class="modal fade bs-example-modal-full" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>เพิ่มบริษัท</strong>
                    </div>

                    <div class="panel-body">
                        <?php $form1 = ActiveForm::begin(['action'=>['company/create'],]) ?>
                                <!-- required [php action request] -->
                                <input type="hidden" name="action" value="contact_send"/>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>ลำดับ</label>
                                            <input type="text" name="count" value="<?= $count ?>" class="form-control required" disabled>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>รหัสบริษัท</label>
                                            <input type="text" name="mat_id" row="4" class="form-control required" placeholder="กรอกรหัสบริษัท เช่น company-001" value="<?= $count ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <label>ชื่อบริษัท</label>
                                            <input type="text" name="mat_name" value="" class="form-control required" placeholder="กรอกชื่อบริษัท เช่น บริษัท A">
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <label>ที่อยู่</label>
                                            <textarea name="mat_address" row="4" class="form-control required" placeholder="กรอกที่อยู่ของบริษัท เช่น บริษัท A ตำบล B อำเภอ C จังหวัด D"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <label>ชื่อผู้ติดต่อ</label>
                                            <input type="text" name="mat-sellman" value="" class="form-control required" placeholder="กรอกชื่อผู้ติดต่อซื้อขาย เช่น คุณ A">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12" >
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text" name="mat_phone" class="form-control required" placeholder="กรอกเบอร์โทรศัพท์">
                                            <!--<input type="text" class="form-control masked" name="mat_phone" data-format="999-999?-9999" data-placeholder="X" placeholder="กรอกเบอร์โทรศัพท์" required>-->
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input onclick="myAlert()" class="btn btn-3d btn-success btn-sm btn-block margin-top-30" type="submit" value="บันทึก">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <a href="#" class="btn btn-danger btn-sm btn-block margin-top-30" data-dismiss="modal">ยกเลิก</a>
                                </div>
                            </div>
                        <?php ActiveForm::end() ?>
                    </div>

                </div>
                <!-- /----- -->

            </div>
        </div>
    </div>
    <!-- ======================================= Modal Add =============================================== -->

    <!-- ============================= modal detail ====================================-->
    <?php foreach ($mat_company as $company) { ?>
    <div id="myDetail<?= $company->company_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><label>รายละเอียด</label></h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>ชื่อบริษัท : <?= $company->company_name ?></p>
                    <p>ที่อยู่ : <?= $company->company_address ?></p>
                    <p>ชื่อผู้ติดต่อ : <?= $company->company_sellman ?></p>
                    <p>เบอร์โทรศัพท์ : <?= $company->company_phone ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- ============================= modal detail ====================================-->

    <!-- ============================= modal delete ====================================-->
    <?php foreach ($mat_company as $company) { ?>
        <div id="myDel<?= $company->company_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default" align="center">
                            <div class="panel-heading panel-heading-transparent">
                                <h4 class="modal-title" id="myModalLabel">คุณต้องการลบใช่หรือไม่</h4>
                            </div>
                            <div class="modal-body">
                                <?php $form0 = ActiveForm::begin(['action'=>['company/deletecompany'],]) ?>
                                <div class="modal-body" align="center">
                                    <input type="hidden" name="type_id[]" value="<?= $company->company_id ?>">
                                    <input onclick="myDel()" class="btn btn-success btn-3d" type="submit" value="ยืนยัน">
                                    <a href="#" class="btn btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                        <!-- /----- -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <!-- ============================= modal delete ====================================-->

    <!-- ======================================= Modal Edit =============================================== -->
    <?php $count = 1 ?>
    <?php foreach ($mat_company as $company) { ?>
    <div id="myEdit<?= $company->company_id ?>" class="modal fade bs-example-modal-full" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full">
            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>แก้ไขบริษัท</strong>
                    </div>

                    <div class="panel-body">
                        <?php $form2 = ActiveForm::begin(['action'=>['company/updatecompany'],])?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>ลำดับ</label>
                                    <input type="text" name="count" value="<?= $count ?>" class="form-control required" disabled>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>รหัสบริษัท</label>
                                    <input type="hidden" name="mat_id[]" value="<?= $company->company_id ?>">
                                    <input type="text" name="company_id[]" row="4" value="<?= $company->company_id ?>" class="form-control required" placeholder="กรอกรหัสบริษัท เช่น company-001" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>ชื่อบริษัท</label>
                                    <input type="text" name="mat_name[]" value="<?= $company->company_name ?>" class="form-control required" placeholder="กรอกชื่อบริษัท เช่น บริษัท A">
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <label>ที่อยู่</label>
                                    <textarea name="mat_address[]" row="4" class="form-control required" placeholder="กรอกที่อยู่ของบริษัท เช่น บริษัท A ตำบล B อำเภอ C จังหวัด D"><?= $company->company_address ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>ชื่อผู้ติดต่อ</label>
                                    <input type="text" name="mat-sellman[]" value="<?= $company->company_sellman ?>" class="form-control required" placeholder="กรอกชื่อผู้ติดต่อซื้อขาย เช่น คุณ A">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12" >
                                    <label>เบอร์โทรศัพท์</label>
                                    <input type="text" name="mat_phone[]"value="<?= $company->company_phone ?>" class="form-control required" placeholder="กรอกเบอร์โทรศัพท์" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input onclick="myAlert()" class="btn btn-3d btn-success btn-sm btn-block margin-top-30" type="submit" value="บันทึก">
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="#" class="btn btn-danger btn-sm btn-block margin-top-30" data-dismiss="modal">ยกเลิก</a>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>

                </div>
                <!-- /----- -->

            </div>
        </div>
    </div>
    <!-- ======================================= Modal Edit =============================================== -->
    <?php $count ++; } ?>
</div>

<!--<script>-->
<!--    function myAlert(){-->
<!--        alert("บันทึกข้อมูลสำเร็จ");-->
<!--    }-->
<!--    function myDel(){-->
<!--        alert("ลบรายการสำเร็จ");-->
<!--    }-->
<!--</script>-->