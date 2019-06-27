<?php

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $item \app\modules\materialsystem\models\MatsysMaterial */
/* @var $item_detail \app\modules\materialsystem\models\MatsysBillDetail */
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType */
?>

<!-- page title -->
<header id="page-header">
    <h1>รายการวัสดุคงเหลือ</h1>
</header>

<div id="content" class="padding-20">



    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการรับเข้า</strong> <!-- panel title -->
							</span>


        </div>

        <!-- panel content -->
        <div class="panel-body">

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
                                    <a href="#search_page1" data-toggle="tab">ค้นหาจากชื่อ หรือรหัส </a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#search_page2" data-toggle="tab">ค้นหาตามหมวดหมู่</a>
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
                                            <?php foreach ($mat as $item ) { ?>
                                            <option value="">รหัส : <?= $item->material_id ?> <?= $item->material_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-white">
                                        <i class="fa fa-search"> ค้นหา</i>
                                    </button>

                                </div><!-- /TAB 1 CONTENT -->

                                <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                                    <div class="col-md-3 col-sm-3">
                                        <select class="form-control select2" style="width: 230px;">
                                            <option value=""></option>
                                            <?php foreach ($mat_type as $type ) { ?>
                                            <option value=""><?= $type->material_type_name ?></option>
                                            <?php } ?>
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

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th width="3%">รูปภาพ</th>
                                <th width="30%">รายการ</th>
                                <th width="10%">ราคา/บาท</th>
                                <th width="9%">หน่วยนับ</th>
                                <th width="8%">รับเข้า</th>
                                <th width="5%">เบิก</th>
                                <th width="8%">คงเหลือ</th>
                                <th width="8%">ต่ำสุด</th>
                                <th></th>
                                <th width="17%">จัดการข้อมูล</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($bill_detail as $item_detail ) { ?>
                            <!-- data table -->
                            <tr>
                                <td>
                                    <div class="w3-container">
                                        <img src="/cs-e-office/web/web_mat/images/default.jpg" width="80" height="80" onclick="document.getElementById('modal01/cs-e-office/web/web_mat/images/default.jpg').style.display='block'">
                                        <div id="modal01/cs-e-office/web/web_mat/images/default.jpg" class="modal" onclick="this.style.display='none'">
                                            <div class="w3-modal-content w3-animate-zoom" align="center">
                                                <img src="/cs-e-office/web/web_mat/images/default.jpg" style="width:40%">
                                            </div>
                                        </div>
                                        <div align="center">
                                            <label align="center"><?= $item_detail->material_id ?></label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <label>ชื่อวัสดุ : <?= $item_detail->material->material_name ?><br><br>
                                        หมวดหมู่ : <?= $item->materialType->material_type_name ?> <br>
                                    </label>
                                </td>
                                <td><label><?= $item_detail->bill_detail_price_per_unit ?></label></td>
                                <td><?= $item_detail->material->material_unit_name ?></td>
                                <td><label><?= $item_detail->bill_detaill_amount ?></label></td>
                                <td><label><?= $item_detail->material->material_order_count ?></label></td>
                                <td><label><?= $item_detail->bill_detail_use_amount ?></label></td>
                                <td><label><?= $item_detail->material->material_amount_check ?></label></td>
                                <td>
                                    <!-- Modal Ajax Lightbox >-->
                                    <a class="btn btn-leaf btn-xs btn-3d lightbox" data-toggle="modal" data-target="#myDetail<?= $item_detail->bill_master_id ?>">
                                        <i class="glyphicon glyphicon-zoom-in" aria-hidden="false"></i>รายละเอียด</a>
                                    </a>
                                </td>
                                <td>
                                <span>
                                    <a class="btn btn-xs btn-warning btn-3d" data-toggle="modal" data-target="#myEdit<?= $item_detail->bill_master_id ?>">
                                        <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>แก้ไข</a>
                                </span>
                                <!--<span>
                                    <a href="#" class="btn btn-xs btn-danger btn-3d">
                                        <i class="glyphicon glyphicon-trash" aria-hidden="false"></i>ลบ</a>
                                </span>-->
                                </td>
                            </tr>
                            <!-- data table -->
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /panel content -->
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php
                            echo LinkPager::widget([
                                'pagination' => $pages,
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /PANEL -->
            </div>

            <!-- ============================= modal ====================================-->
            <?php foreach ($bill_detail as $item_detail ) { ?>
            <div id="myDetail<?= $item_detail->bill_master_id ?>" class="modal fade bs-example-modal-xl" tabindex="-1"
                 role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><label>รายละเอียดวัสดุ</label></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <p><label><b>รหัสใบสั่งซื้อ</b> : <?= $item_detail->bill_master_id ?></label></p>
                                    <p><label><b>รหัสใบบันทึกข้อความ</b> : <?= $item_detail->billMaster->bill_mater_record ?></label></p>
                                    <p><label><b>รหัสเล่มใบสั่งซื้อ</b> : <?= $item_detail->billMaster->bill_master_id_no ?></label></p>
                                    <p><label><b>สถานที่จัดเก็บ</b> : <?= $item_detail->material->location->location_name ?></label></p>
                                </div>
                                <div class="col-md-6">
                                    <p><label><b>วันที่สั่งซื้อ</b> : <?= $item_detail->billMaster->bill_master_date ?></label></p>
                                    <p><label><b>รหัสใบตรวจรับ</b> : <?= $item_detail->billMaster->bill_master_check ?></label></p>
                                    <p><label><b>บริษัท</b> : <?= $item_detail->billMaster->company->company_name ?></label></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- ============================= modal ====================================-->
            <?php foreach ($bill_detail as $item_detail ) { ?>
            <!-- =============================  edit modal ====================================-->
            <div id="myEdit<?= $item_detail->bill_master_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                 <div class="row">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php $form = Activeform::begin(['action'=>['default/editlist']]) ?>
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">แก้ไขจำนวนวัสดุ</h4>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                    <input type="hidden" name="mat_id[]" value="<?= $item_detail->material_id ?>">
                                <div class="padding-bottom-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label>ชื่อวัสดุ</label> <input type="text" class="form-control" name="mat_name" value="<?= $item_detail->material->material_name ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label>ราคาต่อหน่วย/บาท</label> <input type="text" class="form-control" name="mat_price_per_unit" value="<?= $item_detail->bill_detail_price_per_unit ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <label>รายละเอียด</label> <textarea class="form-control" rows="4" style="resize: none" name="mat_detail" ><?= $item_detail->material->material_detail ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--<div class="col-md-3">
                                            <label>จำนวนวัสดุคงเหลือ</label> <input type="number" class="form-control" name="mat_use" min="<?/*= $item_detail->material->material_amount_check */?>" value="<?/*= $item_detail->bill_detail_use_amount */?>">
                                        </div>-->
                                        <div class="col-md-3">
                                            <label>จำนวนขั้นต่ำ</label> <input type="number" class="form-control" name="mat_min" value="<?= $item_detail->material->material_amount_check ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>หน่วยนับ</label> <input type="text" class="form-control" name="mat_name_price" value="<?= $item_detail->material->material_unit_name ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>รูปภาพ</label> <input type="file" name="mat_image" accept="image/x-png,image/gif,image/jpeg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="pull-left">
                                    <input type="submit" class="btn btn-mini btn-success btn-3d" value="บันทึก">
                                    <a href="#" class="btn btn-mini btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                 </div>
            </div>
            <?php } ?>
            <!-- ============================= edit modal ====================================-->