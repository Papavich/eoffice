<!-- page title -->
<?php
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $item app\modules\materialsystem\models\MatsysOrder */
/* @var $return_list app\modules\materialsystem\models\MatsysOrderReturn */

?>

<header id="page-header">
    <h1>รายการคืนวัสดุ</h1>
</header>

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการคืนวัสดุที่รอการตรวจสอบ</strong> <!-- panel title -->
							</span>
        </div>

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
                                    <a href="#search_page1" data-toggle="tab">ค้นหาจากรหัส หรือชื่อ </a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#search_page2" data-toggle="tab">ค้นหาจาก วันที่</a>
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
                                            <?php foreach ($order as $item) { ?>
                                                <option value="1">รหัส : <?= $item->order_id ?> ชื่อผู้คืน
                                                    : <?= Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $item->person_id)->queryOne()['person_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-white">
                                        <i class="fa fa-search"> ค้นหา</i>
                                    </button>

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
                            <!-- /tabs content -->

                        </div>
                        <!-- /panel content -->

                        <!-- Seacrch Page -->

                        <?php foreach ($order_return as $return_list) { ?>
                            <?php $code_order = $return_list->order->order_id;
                            $date_order = $return_list->order_return_date;
                            ?>
                        <?php } ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                            <tr>
<!--                                <th width="1%">ลำดับ</th>-->
                                <th width="10%">เลขที่ใบเบิก</th>
                                <th width="10%">วันที่คืน</th>
                                <th width="20%">ชื่อผู้คืน</th>
                                <!--<th width="10%">ตำแหน่ง</th>
                                <th width="15%">หน่วยงาน/ฝ่าย</th>-->
                                <th width="15%">รายการคืนวัสดุ</th>
                                <th width="10%">สถานะ</th>
                            </tr>
                            </thead>

                            <?php $count = 1;

                            foreach ($order as $item) {
                                ?>
                                <tbody>
                            <tr>
                                <?php if ($item->order_status_return == 2 || $item->order_status_return == 3) { ?>
<!--                                    <td>--><?//= $count ?><!--</td>-->
                                    <td><?= $item->order_id ?></td>
                                    <td><?= $date_order ?></td>
                                    <td><?= Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $item->person_id)->queryOne()['person_name'] ?>
                                        <?= Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $item->person_id)->queryOne()['person_surname'] ?></td>
                                    <td>
                                        <!-- Modal Ajax Lightbox >-->
                                        <a class="btn btn-leaf btn-xs btn-3d lightbox" data-toggle="modal"
                                           data-target="#myDetail<?= $item->order_id ?>">
                                            <i class="glyphicon glyphicon-zoom-in" aria-hidden="false"></i>แสดงรายการคืน</a>
                                        </a>
                                    </td>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <td><span class="label label-warning">รอการตรวจสอบ</span></td>
                                    <?php }
                                    if ($item->order_status_return == '3') { ?>
                                        <td><span class="label label-success">ตรวจสอบแล้ว</span></td>
                                    <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php $count++;
                                }
                            } ?>
                        </table>

                    </div>
                </div>
                <!-- ============================= modal ====================================-->
                <?php $count = 1;
                $sum = 0;
                $total = 0;
                foreach ($order as $item) {
                    $count = 1; ?>
                    <div id="myDetail<?= $item->order_id ?>" class="modal fade bs-example-modal-full" tabindex="-1"
                         role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">รายการคืนวัสดุ</h4>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="row" align="center">
                                        <h3><b>รายการคืนวัสดุ</b></h3>
                                    </div>
                                    <?php if ($item->order_status == null) { ?>
                                        <p><label>เลขที่ใบเบิก : <?= $return_list->order->order_id ?></label></p>
                                        <p><label>วันที่คืน : <?= $date_order ?></label></p>
                                    <?php } ?>
                                    <table class="table table-striped table-bordered table-hover">
                                        <?php if ($item->orderDetail->detail->detail_id == 'D001') { ?>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="col-md-6">
                                                        <p><b>ประเภท</b>
                                                            : <?= $item->orderDetail->detail->detail_name ?>
                                                        </p>
                                                        <p><b>ชื่อโครงการ</b>
                                                            : <?= $item->orderDetail->order_detail_name ?>
                                                        </p>
                                                        <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><b>รหัสโครงการ</b>
                                                            : <?= $item->orderDetail->order_detail_name_id ?></p>
                                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?>
                                                        </p>
                                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                    <?php if ($item->order_status == '2') { ?>
                                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                    <?php } elseif ($item->order_status == '3') { ?>
                                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } else if ($item->orderDetail->detail->detail_id == 'D002') { ?>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="col-md-6">
                                                        <p><b>ประเภท</b>
                                                            : <?= $item->orderDetail->detail->detail_name ?>
                                                        </p>
                                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?>
                                                        </p>
                                                        <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><b>ชื่อกิจกรรม</b>
                                                            : <?= $item->orderDetail->order_detail_name ?>
                                                        </p>
                                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                    <?php if ($item->order_status == '2') { ?>
                                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                    <?php } elseif ($item->order_status == '3') { ?>
                                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } else if ($item->orderDetail->detail->detail_id == 'D003') { ?>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="col-md-6">
                                                        <p><b>ประเภท</b>
                                                            : <?= $item->orderDetail->detail->detail_name ?>
                                                        </p>
                                                        <p><b>ชื่อวิชา</b>
                                                            : <?= $item->orderDetail->order_detail_name ?>
                                                        </p>
                                                        <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><b>รหัสวิชา</b>
                                                            : <?= $item->orderDetail->order_detail_name_id ?>
                                                        </p>
                                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?>
                                                        </p>
                                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                    <?php if ($item->order_status == '2') { ?>
                                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                    <?php } elseif ($item->order_status == '3') { ?>
                                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } else if ($item->orderDetail->detail->detail_id == 'D004') { ?>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="col-md-6">
                                                        <p><b>ประเภท</b> : การใช้งานประเภทอื่น ๆ</p>
                                                        <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?>
                                                        </p>
                                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                    <?php if ($item->order_status == '2') { ?>
                                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                    <?php } elseif ($item->order_status == '3') { ?>
                                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?>
                                                        </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <thead>
                                        <tr>
                                            <th width="7%">ลำดับ</th>
                                            <th width="30%">ชื่อรายการ</th>
                                            <th width="10%">จำนวนที่คืน</th>
                                            <th width="15%">จำนวนที่ใช้ได้จริง</th>
                                            <th width="10%">หน่วยนับ</th>
                                            <th width="10%">ราคาต่อหน่วย</th>
                                            <th width="10%">จำนวนเงิน</th>
                                        </tr>
                                        </thead>
                                        <?php foreach ($order_return as $return_list) { ?>
                                            <tbody>
                                            <?php if ($item->order_id == $return_list->order_id) { ?>
                                                <tr>
                                                    <td align="center"><?= $count ?></td>
                                                    <td><?= $return_list->material->material_name ?></td>
                                                    <td><?= $return_list->order_return_amount ?></td>
                                                    <?php if ($item->order_status_return == '3') { ?>
                                                        <td><input type="number"
                                                                   value="<?= $return_list->order_return_amount ?>"
                                                                   min="0"
                                                                   max="<?= $return_list->order_return_amount ?>"
                                                                   style="width: 5em" disabled></td>
                                                    <?php } else { ?>
                                                        <td><input type="number"
                                                                   value="<?= $return_list->order_return_amount ?>"
                                                                   min="0"
                                                                   max="<?= $return_list->order_return_amount ?>"
                                                                   style="width: 5em"></td>
                                                    <?php } ?>
                                                    <td><?= $return_list->material->material_unit_name ?></td>
                                                    <td><?= $return_list->material->matsysBillDetails[0]->bill_detail_price_per_unit ?></td>
                                                    <?php $sum = $return_list->order_return_amount * $return_list->material->matsysBillDetails[0]->bill_detail_price_per_unit ?>
                                                    <td><?= $sum ?></td>
                                                </tr>
                                                </tbody>
                                            <?php } ?>
                                            <?php $count++;
                                        } ?>
                                    </table>

                                    <div class="row">
                                        <div class="pull-right">
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                <?php if ($item->order_status_return == '2') { ?>
                                                    <a href="#" class="btn btn-3d btn-success btn-3d"
                                                       data-toggle="modal"
                                                       data-target="#mySubmit<?= $item->order_id ?>">
                                                        <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>รับคืน
                                                    </a>
                                                <?php } else if ($item->order_status_return == '3') { ?>
                                                    <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================= modal ====================================-->
                    <?php $count++;
                } ?>

                <!-- ============================= modal Submit ====================================-->
                <?php foreach ($order as $item) { ?>
                    <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" align="center">
                                    <h4 class="modal-title" id="myModalLabel">
                                        คุณตรวจสอบรายการคืนวัสดุทั้งหมดแล้วใช่หรือไม่</h4>
                                </div>
                                <?php $form = ActiveForm::begin(['action' => ['default/submit_return'],]) ?>
                                <div class="modal-body" align="center">
                                    <?php foreach ($order_return as $return_list) { ?>
                                        <input type="hidden" name="order_id_list[]" value="<?= $item->order_id ?>">
                                        <input type="hidden" name="material_id_list[]"
                                               value="<?= $return_list->material_id ?>">
                                        <input type="hidden" name="order_return_amount_use[]"
                                               value="<?= $return_list->order_return_amount ?>">
                                    <?php } ?>
                                    <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                                    <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- ============================= modal Submit ====================================-->

                <div class="col-md-12">
                    <div class="text-center">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>
                </div>