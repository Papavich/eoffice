<!-- page title -->
<?php
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $item app\modules\materialsystem\models\MatsysOrder */
/* @var $form yii\widgets\ActiveForm */
/* @var $form1 yii\widgets\ActiveForm */
?>

<header id="page-header">
    <h1>รายการเบิกวัสดุ</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการเบิกวัสดุที่รอการอนุมัติ</strong> <!-- panel title -->
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
                                                <option value="1">รหัส : <?= $item->order_id ?> ชื่อผู้เบิก
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
                                            <option value="0" selected disabled>เดือน</option>
                                            >
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
                                        <select style="width: 100px;">
                                            <option value="0" selected disabled>ปี</option>
                                            >
                                            <option value="1">2560</option>
                                            <option value="2">2561</option>
                                            <option value="3">2562</option>
                                            <option value="4">2563</option>
                                            <option value="5">2564</option>
                                            <option value="6">2565</option>
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

                        <table class="table table-striped table-bordered table-hover" id="table_material">
                            <thead>
                            <tr>
                                <!--<th width="1%">ลำดับ</th>-->
                                <th width="10%">เลขที่ใบเบิก</th>
                                <th width="15%">วันที่เบิก</th>
                                <th width="20%">ชื่อผู้เบิก</th>
                                <!--<th width="10%">ตำแหน่ง</th>
                                <th width="15%">หน่วยงาน/ฝ่าย</th>-->
                                <th width="15%">รายการเบิกวัสดุ</th>
                                <th width="15%">สถานะ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            ?>

                            <?php foreach ($order as $item) { ?>
                                <tr>
                                    <?php $sql = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $item->person_id)->queryOne() ?>
                                    <!-- คำสั่งเรียกวิว Person เพื่อนำมาแสดงเป็นข้อมูลที่ต้องการ -->
                                    <!--<td><?/*= $count */?></td>-->
                                    <td><?= $item->order_id ?></td>
                                    <td><?= $item->order_date ?></td>

                                    <td><?= $sql['person_name'] . " " . $sql['person_surname'] ?>
                                    </td>
                                    <td>
                                        <!-- Modal Ajax Lightbox >-->
                                        <a class="btn btn-leaf btn-xs btn-3d lightbox" data-toggle="modal"
                                           data-target="#myDetail1<?= $item->order_id ?>">
                                            <i class="glyphicon glyphicon-zoom-in" aria-hidden="false"></i>แสดงรายการเบิก</a>
                                        </a>                                    </td>
                                    <?php if ($item->order_status == '1') { ?>
                                        <td><span class="label label-warning">รอการอนุมัติ</span></td>
                                    <?php } else if ($item->order_status == '2') { ?>
                                        <td><span class="label label-success">อนุมัติแล้ว</span></td>
                                    <?php } else if ($item->order_status == '3') { ?>
                                        <td><span class="label label-danger">ปฏิเสธอนุมัติ</span></td>
                                    <?php } ?>
                                </tr>

                                <?php $count++;
                            } ?>
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
            <?php foreach ($order as $item) { ?>
                <!-- ================================ Modal ===============================================-->
                <div id="myDetail1<?= $item->order_id ?>" class="modal fade bs-example-modal-full" tabindex="-1"
                     role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <!-- header modal -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel">รายการเบิกวัสดุ</h4>
                            </div>

                            <!-- body modal -->
                            <div class="modal-body">
                                <div class="row" align="center">
                                    <h3><b>ใบเบิกวัสดุ</b></h3>
                                </div>
                                <table class="table table-striped table-bordered table-hover">
                                    <?php if ($item->orderDetail->detail->detail_id == 'D001') { ?>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="col-md-6">
                                                    <p><b>ประเภท</b> : <?= $item->orderDetail->detail->detail_name ?>
                                                    </p>
                                                    <p><b>ชื่อโครงการ</b> : <?= $item->orderDetail->order_detail_name ?>
                                                    </p>
                                                    <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><b>รหัสโครงการ</b>
                                                        : <?= $item->orderDetail->order_detail_name_id ?></p>
                                                    <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?></p>
                                                    <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                <?php if ($item->order_status == '2') { ?>
                                                    <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } elseif ($item->order_status == '3') { ?>
                                                    <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } else if ($item->orderDetail->detail->detail_id == 'D002') { ?>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="col-md-6">
                                                    <p><b>ประเภท</b> : <?= $item->orderDetail->detail->detail_name ?>
                                                    </p>
                                                    <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?></p>
                                                    <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><b>ชื่อกิจกรรม</b> : <?= $item->orderDetail->order_detail_name ?>
                                                    </p>
                                                    <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                <?php if ($item->order_status == '2') { ?>
                                                    <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } elseif ($item->order_status == '3') { ?>
                                                    <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } else if ($item->orderDetail->detail->detail_id == 'D003') { ?>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="col-md-6">
                                                    <p><b>ประเภท</b> : <?= $item->orderDetail->detail->detail_name ?>
                                                    </p>
                                                    <p><b>ชื่อวิชา</b> : <?= $item->orderDetail->order_detail_name ?>
                                                    </p>
                                                    <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><b>รหัสวิชา</b> : <?= $item->orderDetail->order_detail_name_id ?>
                                                    </p>
                                                    <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?></p>
                                                    <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                <?php if ($item->order_status == '2') { ?>
                                                    <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } elseif ($item->order_status == '3') { ?>
                                                    <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
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
                                                    <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?></p>
                                                    <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                                <?php if ($item->order_status == '2') { ?>
                                                    <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } elseif ($item->order_status == '3') { ?>
                                                    <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <thead>
                                    <tr>
                                        <th width="1%">ลำดับ</th>
                                        <th width="5%">รหัสวัสดุ</th>
                                        <th width="20%">ชื่อวัสดุ</th>
                                        <th width="10%">จำนวนขอเบิก</th>
                                        <th width="12%">จำนวนจ่ายจริง</th>
                                        <th width="10%">หน่วยนับ</th>
                                        <th width="10%">ราคาต่อหน่วย</th>
                                        <th width="10%">จำนวนเงิน</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $num = 1;
                                    $total = 0;
                                    $temp = [];
                                    ?>
                                    <?php foreach ($item->matsysOrderHasMaterials as $key => $item1) { ?>
                                        <tr>
                                            <td align="center"><?= $num ?></td>
                                            <td><?= $item1->material_id ?></td>
                                            <td><?= $item1->material->material_name ?></td>
                                            <td><?= $item1->material_amount ?></td>
                                            <input type="hidden" name="order_amount[]" id="order_amount"
                                                   value="<?= $item1->material_amount ?>">
                                            <?php $_SESSION['amount[]'] = $temp; ?>
                                            <?php if ($item->order_status == '2' || $item->order_status == '3') { ?>
                                            <td><input name="order_has_material_amount[]" type="number"
                                                       value="<?= $item1->material_amount ?>" min="0"
                                                       max="<?= $item1->material_amount ?>" style="width: 4em" disabled>
                                                / <?= $item1->material->matsysBillDetails[0]->bill_detail_use_amount ?>
                                                <?php } else { ?>
                                            <td><input name="order_has_material_amount[]" type="number"
                                                       value="<?= $item1->material_amount ?>" min="0"
                                                       max="<?= $item1->material_amount ?>" style="width: 4em">
                                                / <?= $item1->material->matsysBillDetails[0]->bill_detail_use_amount ?>
                                                <?php } ?>
                                            </td>
                                            <td> <?= $item1->material->material_unit_name ?></td>
                                            <td><?= $item1->material->matsysBillDetails[0]->bill_detail_price_per_unit ?></td>
                                            <td><?= ($item1->material_amount * $item1->material->matsysBillDetails[0]->bill_detail_price_per_unit) ?></td>

                                            <!--<input type="hidden" name="order_staff[]" value="<?= $item->order_staff ?>"> -->
                                        </tr>
                                        <?php $num++;
                                        $total += ($item1->material_amount * $item1->material->matsysBillDetails[0]->bill_detail_price_per_unit);
                                    } ?>
                                    <tr>
                                        <th colspan="3">รายการทั้งหมด <?= $num - 1 ?> รายการ</th>
                                        <th colspan="5">
                                            <div align="right">รวมเป็นเงิน <?= $total ?> บาท</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="col-md-4">
                                                <b>ผู้เบิกวัสดุ</b><br>
                                                วันที่
                                            </div>
                                            <div class="col-md-8">
                                                <?php $sql = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $item->person_id)->queryOne() ?>
                                                <?= $sql['person_name'] . " " . $sql['person_surname'] ?>
                                                <br><?= $item->order_date ?>
                                            </div>
                                        </td>
                                        <?php if ($item->order_status != '1') { ?>
                                            <td colspan="5">
                                                <div class="col-md-4">
                                                    <b>เจ้าหน้าที่ผู้ตรวจสอบ</b><br>
                                                    วันที่
                                                </div>
                                                <div class="col-md-8">
                                                    <?= $item->order_staff ?>
                                                    <br><?= $item->order_date_accept ?>
                                                </div>
                                            </td>
                                        <?php } else { ?>
                                            <td colspan="5"></td>
                                        <?php } ?>
                                    </tr>
                                    </tbody>
                                    <?php if ($item->order_status == '1') { ?>
                                    <div class="fa-pull-left">
                                        <a href="#" class="btn btn-ngb btn-aqua btn-3d" data-toggle="modal"
                                           data-target="#myDesc">เพิ่มรายละเอียด</a>
                                    </div>
                                    <?php } ?>
                                </table>
                            </div>
                            <?php if ($item->order_status == '1') { ?>

                                <div class="modal-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-ngb btn-default" data-dismiss="modal">ยกเลิก</a>
                                    </div>
                                    <a href="#" class="btn btn-ngb btn-success btn-3d" data-toggle="modal"
                                       data-target="#mySubmit<?= $item->order_id ?>"><i class="glyphicon glyphicon-ok">
                                            อนุมัติ</i></a>
                                    <a href="#" class="btn btn-ngb btn-danger btn-3d" data-toggle="modal"
                                       data-target="#myCancel<?= $item->order_id ?>"><i
                                                class="glyphicon glyphicon-remove"> ไม่อนุมัติ</i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- ========================================= modal =========================================== -->

            <!-- ============================= modal Submit ====================================-->
            <?php foreach ($order as $item) { ?>
                <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="center">
                                <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันการอนุมัติใช่หรือไม่</h4>
                            </div>

                            <?php $form = Activeform::begin(['action' => ['default/saveitem']]) ?>
                            <div class="modal-body" align="center">
                                <?php foreach ($item->matsysOrderHasMaterials as $item1) { ?>
                                    <input type="hidden" name="order_id[]" value="<?= $item1->order_id ?>">
                                    <input type="hidden" name="material_id[]" value="<?= $item1->material_id ?>">
                                    <input type="hidden" name="order_has_material_amount[]"
                                           value="<?= $item1->material_amount ?>">
                                <?php } ?>
                                <input type="hidden" id="order_desc" name="order_desc">
                                <input type="hidden" name="name_admin"
                                       value="<?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                                        <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
                                <input type="submit" class="btn btn-ngb btn-success btn-3d" value="ยืนยัน">
                                <a href="#" class="btn btn-ngb btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- ============================= modal Submit ====================================-->


            <!-- ============================= modal Cancel ====================================-->
            <?php foreach ($order as $item) { ?>
                <?php foreach ($item->matsysOrderHasMaterials as $item1) { ?>
                    <div id="myCancel<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" align="center">
                                    <h4 class="modal-title" id="myModalLabel">กรอกรายละเอียดการปฏิเสธการเบิกวัสดุ</h4>
                                </div>
                                <?php $form1 = ActiveForm::begin(['action' => ['default/cancelwiden']]) ?>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <h5><label>แบบฟอร์มรายละเอียดการปฏิเสธการเบิกวัสดุ</label></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea name="order_cancel_widen" maxlength="200" rows="4"
                                                          class="form-control" style="resize: none"
                                                          placeholder="กรุณากรอกรายละเอียด หรือเหตุผลที่ไม่สามารถให้เบิกวัสดุได้"
                                                          required></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="name_admin"
                                               value="<?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                                        <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
                                        <div class="panel-footer" align="center">
                                            <input type="hidden" name="order_id_list[]" value="<?= $item->order_id ?>">
                                            <input type="submit" class="btn btn-ngb btn-success btn-3d" value="ยืนยัน">
                                            <a href="#" class="btn btn-ngb btn-danger btn-3d"
                                               data-dismiss="modal">ยกเลิก</a>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- ============================= modal Cancel ====================================-->

            <!-- ============================= modal Desc ====================================-->

            <div id="myDesc" class="modal fadeIn" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" align="center">
                            <h4 class="modal-title" id="myModalLabel">กรอกรายละเอียดการเบิก</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <h5><label>แบบฟอร์มรายละเอียดการการเบิกวัสดุ</label></h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                                <textarea id="order_desc1" name="order_desc" maxlength="200" rows="4"
                                                          class="form-control" style="resize: none"
                                                          placeholder="" onchange="CheckformDesc(this.value);"
                                                          required></textarea>
                                    </div>
                                </div>
                                <div class="panel-footer" align="center">
                                    <a href="/cs-e-office/web/materialsystem/default/widen_admin" class="btn btn-ngb btn-success btn-3d" data-dismiss="modal">ยืนยัน</a>
                                    <a href="#" class="btn btn-ngb btn-danger btn-3d"
                                       data-dismiss="modal">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================= modal Desc ====================================-->

            <script>
                $(function ())
                {
                    var x = $('order_amount').val();
                }
                )
                function CheckformDesc(val) {
                    $('#order_desc').val(val);
                }
            </script>