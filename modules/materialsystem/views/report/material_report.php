<?php

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $bill \app\modules\materialsystem\models\MatsysBillDetail */
?>

<header id="page-header">
    <h1>รายงานวัสดุคงเหลือ</h1>
</header>

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>วัสดุคงเหลือ</strong> <!-- panel title -->
							</span>
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="padding-10">
                    <!-- tabs content -->
                    <div class="tab-content transparent">

                        <div id="search_page1" class="tab-pane active"><!-- TAB 1 CONTENT -->
                            <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                                <div class="col-md-4 col-sm-4">
                                    <?php $form = ActiveForm::begin(['action' => ['report/material_report'],]) ?>
                                    <select name="mounth" style="width: 200px;">
                                        <option value="0" selected disabled>เดือน</option>
                                        <option value="1">มกราคม</option>
                                        <option value="2">กุมภาพันธ์</option>
                                        <option value="3">มีนาคม</option>
                                        <option value="4">เมษายน</option>
                                        <option value="5">พฤษภาคม</option>
                                        <option value="6">มิถุนายน</option>
                                        <option value="7">กรกฎาคม</option>
                                        <option value="8">สิงหาคม</option>
                                        <option value="9">กันยายน</option>
                                        <option value="10">ตุลาคม</option>
                                        <option value="11">พฤษจิกายน</option>
                                        <option value="12">ธันวาคม</option>
                                    </select>
                                    <select name="year" style="width: 100px;">
                                        <option value="0" selected disabled>ปี</option>
                                        <option value="2560">2560</option>
                                        <option value="2561">2561</option>
                                        <option value="2562">2562</option>
                                        <option value="2563">2563</option>
                                        <option value="2564">2564</option>
                                        <option value="2565">2565</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-white">
                                    <i class="fa fa-search"> ค้นหา</i>
                                </button>
                                <?php ActiveForm::end() ?>

                            </div><!-- /TAB 1 CONTENT -->

                        </div><!-- /TAB 1 CONTENT -->

                        <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                            <div class="col-md-4 col-sm-4">
                                <select style="width: 200px;">
                                    <option value="" selected disabled>เดือน</option>
                                    >
                                    <option value="1">มกราคม</option>
                                    <option value="2">กุมภาพันธ์</option>
                                    <option value="3">มีนาคม</option>
                                    <option value="">เมษายน</option>
                                    <option value="">พฤษภาคม</option>
                                    <option value="">มิถุนายน</option>
                                    <option value="">กรกฎาคม</option>
                                    <option value="">สิงหาคม</option>
                                    <option value="">กันยายน</option>
                                    <option value="">ตุลาคม</option>
                                    <option value="">พฤษจิกายน</option>
                                    <option value="">ธันวาคม</option>
                                </select>
                                <select style="width: 100px;">
                                    <option value="" selected disabled>ปี</option>
                                    >
                                    <option value="1">2560</option>
                                    <option value="2">2561</option>
                                    <option value="3">2562</option>
                                    <option value="">2563</option>
                                    <option value="">2564</option>
                                    <option value="">2565</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-white">
                                <i class="fa fa-search"> ค้นหา</i>
                            </button>

                        </div><!-- /TAB 1 CONTENT -->
                    </div>
                </div>
            </div>
            <!-- Seacrch Page -->

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                <tr>
                    <!--                                <th width="1%">ลำดับ</th>-->
                    <th width="10%">รหัสใบสั่งซื้อ</th>
                    <th width="5%">รหัสวัสดุ</th>
                    <th width="20%">ชื่อวัสดุ</th>
                    <th width="10%">หน่วยนับ</th>
                    <th width="10%">ราคาต่อหน่วย</th>
                    <th width="10%">จำนวนรับเข้า</th>
                    <th width="10%">จำนวนคงเหลือ</th>
                </tr>
                </thead>
                <tr>
                    <td colspan="7">เดือนมกราคม</td>
                </tr>
                <tbody>
                <?php foreach ($models as $bill) { ?>
                    <tr>
                        <td><?= $bill->billMaster->bill_master_id ?></td>
                        <td><?= $bill->material_id ?></td>
                        <td><?= $bill->material->material_name ?></td>
                        <td><?= $bill->material->material_unit_name ?></td>
                        <td><?= $bill->bill_detail_price_per_unit ?></td>
                        <td><?= $bill->bill_detail_use_amount ?></td>
                        <td><?= $bill->bill_detaill_amount ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="pull-right">
                <button class="btn btn-success">
                    <i class="fa fa-file-excel-o"> ดาวโหลดเอกสาร</i>
                </button>
            </div>
        </div>
        <!-- /tabs content -->

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
</div>

