<?php

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $order_detail \app\modules\materialsystem\models\MatsysOrderDetail */
/* @var $det \app\modules\materialsystem\models\MatsysDetail */
?>

<header id="page-header">
    <h1>รายงานงบประมาณประจำปี</h1>
</header>

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการคืนวัสดุที่รอการตรวจสอบ</strong> <!-- panel title -->
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
                                <div class="col-md-3 col-sm-4">
                                    <?php $form = ActiveForm::begin(['action' => ['report/annual_budget_report'],]) ?>
<!--                                    <select name="mounth" style="width: 200px;">-->
<!--                                        <option value="0" selected disabled>เดือน</option>-->
<!--                                        <option value="1">มกราคม</option>-->
<!--                                        <option value="2">กุมภาพันธ์</option>-->
<!--                                        <option value="3">มีนาคม</option>-->
<!--                                        <option value="4">เมษายน</option>-->
<!--                                        <option value="5">พฤษภาคม</option>-->
<!--                                        <option value="6">มิถุนายน</option>-->
<!--                                        <option value="7">กรกฎาคม</option>-->
<!--                                        <option value="8">สิงหาคม</option>-->
<!--                                        <option value="9">กันยายน</option>-->
<!--                                        <option value="10">ตุลาคม</option>-->
<!--                                        <option value="11">พฤษจิกายน</option>-->
<!--                                        <option value="12">ธันวาคม</option>-->
<!--                                    </select>-->
                                    <select name="year" style="width: 200px;">
                                        <option value="0" selected disabled>ปีงบประมาณ</option>
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

            <table class="table table-striped table-hover table-bordered">
                <?php foreach ($detail as $det) { ?>
                    <?php if ($det->detail_id == 'D001') { ?>
                        <h4>
                            <b>โครงการ</b>
                        </h4>
                        <tr>
                            <th width="20%">รหัสโครงการ</th>
                            <th width="30%">ชื่อโครงการ</th>
                            <th width="30%">รายละเอียด</th>
                            <th width="20%">ค่าใช้จ่าย</th>
                        </tr>
                        <?php foreach ($models as $order_detail) {
                            if ($det->detail_id == $order_detail->detail_id) { ?>
                                <tr>
                                    <td><?= $order_detail->order_detail_name_id ?></td>
                                    <td colspan="1"><?= $order_detail->order_detail_name ?></td>
                                    <td><?= $order_detail->order_detail ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        } ?>
                <tr></tr>
            </table>
            <table class="table table-striped table-hover table-bordered">
                    <?php } elseif ($det->detail_id == 'D002') { ?>
                        <h4>
                            <b>กิจกรรม</b>
                        </h4>
                        <tr>
                            <th width="40%">ชื่อกิจกรรม</th>
                            <th width="40%" colspan="2">รายละเอียด</th>
                            <th width="20%">ค่าใช้จ่าย</th>
                        </tr>
                        <?php foreach ($models as $order_detail) {
                            if ($det->detail_id == $order_detail->detail_id) { ?>
                                <tr>
                                    <td><?= $order_detail->order_detail_name ?></td>
                                    <td colspan="2"><?= $order_detail->order_detail ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        } ?>
            </table>
            <table class="table table-striped table-hover table-bordered">
                    <?php } elseif ($det->detail_id == 'D003') { ?>
                        <h4>
                            <b>วิชาเรียน</b>
                        </h4>
                        <tr>
                            <th width="20%">รหัสวิชา</th>
                            <th width="30%">ชื่อวิชา</th>
                            <th width="30%">รายละเอียด</th>
                            <th width="20%">ค่าใช้จ่าย</th>
                        </tr>
                        <?php foreach ($models as $order_detail) {
                            if ($det->detail_id == $order_detail->detail_id) { ?>
                                <tr>
                                    <td><?= $order_detail->order_detail_name_id ?></td>
                                    <td colspan="1"><?= $order_detail->order_detail_name ?></td>
                                    <td><?= $order_detail->order_detail ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        } ?>
            </table>
            <table class="table table-striped table-hover table-bordered">
                    <?php } elseif ($det->detail_id == 'D004') { ?>
                        <h4>
                            <b>การใช้งานประเภทอื่น ๆ</b>
                        </h4>
                        <tr>
                            <th width="80%" colspan="3">รายละเอียด</th>
                            <th width="20%">ค่าใช้จ่าย</th>
                        </tr>
                        <?php foreach ($models as $order_detail) {
                            if ($det->detail_id == $order_detail->detail_id) { ?>
                                <tr>
                                    <td colspan="3"><?= $order_detail->order_detail ?></td>
                                    <td></td>
                                </tr>
                            <?php }
                        } ?>
            </table>
                    <?php } ?>
                <?php } ?>
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

