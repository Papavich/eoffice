<?php

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $item app\modules\materialsystem\models\MatsysOrder */
/* @var $item_mat app\modules\materialsystem\models\MatsysOrderHasMaterial */
/* @var $form yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1>ระบบคืนวัสดุ</h1>
</header>
<div id="content" class="dashboard padding-20">
    <div class="cs-main">
        <div id="panel-2" class="panel panel-default cs-remargin">
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
                                    <a href="#search_page1" data-toggle="tab">ค้นหาจากรหัส</a>
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
                                                <option value="1">รหัส : <?= $item->order_id ?></option>
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
            <div class="panel-body ">
                <div class="padding-20">
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th width="5%">วัน/เดือน/ปี</th>
                                <th width="5%">ปีงบประมาณ</th>
                                <th width="10%">เลขที่ใบเบิก</th>
                                <th width="10%">รายละเอียด</th>
                                <th width="10%">รายการคืนวัสดุ</th>
                                <th width="10%">สถานะการคืน</th>
                            </tr>
                            <?php foreach ($order as $item) { ?>
                                <tr>
                                    <?php if ($item->order_status == 2) { ?>
                                        <td><?= $item->order_date ?></td>
                                        <td><?= $item->order_budget_per_year ?></td>
                                        <td><?= $item->order_id ?></td>
                                        <td><a data-toggle="modal" data-target="#order_detail<?= $item->order_id ?>">ดูรายละเอียด</a></td>
                                        <td>
                                            <?php if ($item->order_status_return == 1) {?>
                                                <a class="btn btn-success btn-sm btn-3d" data-toggle="modal"
                                               data-target="#order_return<?= $item->order_id ?>"><i class="glyphicon glyphicon-list-alt"> คืนวัสดุ</i></a>
                                            <?php } ?>
                                        </td>
                                        <?php if ($item->order_status_return == 1 ) { ?>
                                            <td><p class="label label-danger">ยังไม่คืน</p></td>
                                        <?php } else if ($item->order_status_return == 2 ) { ?>
                                            <td><p class="label label-warning">รอการตรวจสอบ</p></td>
                                        <?php } else if ($item->order_status_return == 3 ) { ?>
                                            <td><p class="label label-success">ส่งคืนแล้ว</p></td>
                                        <?php } ?>
                                   <?php } ?>
                                </tr>
                            <?php } ?>

                        </table>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Detail-->
<?php foreach ($order as $item) { ?>
    <div class="modal fade" id="order_detail<?= $item->order_id ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">รายละเอียดใบเบิก
                        <small> (เลขที่ใบเบิก <?= $item->order_id ?>)</small>
                    </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="col-lg-1">ลำดับ</th>
                            <th class="col-lg-1">รหัสวัสดุ</th>
                            <th class="col-lg-2">รูปภาพ</th>
                            <th class="col-lg-2">รายการ</th>
                            <th class="col-lg-1">จำนวน</th>
                            <th class="col-lg-1">หน่วยนับ</th>
                            <th class="col-lg-1">ราคาต่อหน่วย</th>
                            <th class="col-lg-1">ราคารวม</th>
                        </tr>
                        <tr>
                            <?php $count = 1; ?>
                            <?php foreach ($order_mat

                            as $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id){ ?>
                            <td><?= $count ?></td>
                            <td><?= $item_mat->material_id ?></td>
                            <td>
                                <img src="/cs-e-office/web/web_mat/images/<?= $item_mat->material->material_image ?>"
                                     width="70" height="70">
                            </td>
                            <td><?= $item_mat->material->material_name ?></td>
                            <td><?= $item_mat->material_amount ?></td>
                            <td><?= $item_mat->material->material_unit_name ?></td>
                            <?php
                            $price = $item_mat->material->matsysBillDetails[0]->bill_detail_price_per_unit;
                            $amount = $item_mat->material_amount;
                            ?>
                            <td><?= $price ?></td>
                            <td><?= $price * $amount ?></td>
                        </tr>
                        <?php
                        $count++;
                        } ?>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal Detail-->

<?php $check = 0;
$loop = count($order);
?>


<!-- Modal Return-->
<?php foreach ($order as $item) { ?>
    <div class="modal fade" id="order_return<?= $item->order_id ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">รายการคืนวัสดุ
                        <small> (เลขที่ใบเบิก <?= $item->order_id ?>)</small>
                    </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="col-lg-1">ลำดับ</th>
                            <th class="col-lg-1">รหัสวัสดุ</th>
                            <th class="col-lg-1">รูปภาพ</th>
                            <th class="col-lg-3">รายการ</th>
                            <th class="col-lg-2">จำนวนที่คืน</th>
                            <th class="col-lg-1">หน่วยนับ</th>
                            <th class="col-lg-1">ราคาต่อหน่วย</th>
                            <th class="col-lg-1">ราคารวม</th>
                        </tr>
                        <tr>
                            <?php $count = 1; ?>
                            <?php foreach ($order_mat as $key => $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id){ ?>
                            <input type="hidden" name="material_id<?= $key ?>" value="<?= $item_mat->material_id ?>">
                            <input type="hidden" name="order_id<?= $key ?>" value="<?= $item_mat->order_id ?>">
                            <input type="hidden" name="stock_id<?= $key ?>" value="<?= $item_mat->material->billMasters[0]->bill_master_id ?>">
                            <td><?= $count ?></td>
                            <td><?= $item_mat->material_id ?></td>
                            <td>
                                <img src="<?= Yii::getAlias('@web') ?>/web_mat/images/<?= $item_mat->material->material_image ?>"
                                     width="70" height="70">
                            </td>
                            <td><?= $item_mat->material->material_name ?></td>
                            <?php if ($item->order_status_return == 1) { ?>
                            <td><input type="number" name="order_return_amount<?= $key ?>"
                                       value="<?= $item_mat->material_amount ?>" min="0"
                                       max="<?= $item_mat->material_amount ?>" class="cs-amount-table"> / <?= $item_mat->material_amount ?></td>
                            <?php }else{ ?>
                                <td><input type="number" name="order_return_amount<?= $key ?>"
                                           value="<?= $item_mat->material_amount ?>" min="0"
                                           max="<?= $item_mat->material_amount ?>" class="cs-amount-table" disabled> / <?= $item_mat->material_amount ?></td>
                            <?php } ?>
                            <td><?= $item_mat->material->material_unit_name ?></td>
                            <?php $price = $item_mat->material->matsysBillDetails[0]->bill_detail_price_per_unit;
                            $amount = $item_mat->material_amount;
                            ?>
                            <td><?= $price ?></td>
                            <td><?= $price * $amount ?></td>
                        </tr>
                        <?php
                        $count++;
                        } ?>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <?php if ($item->order_status_return == 1) { ?>
                        <a class="btn btn-success btn-3d" data-toggle="modal" data-target="#mySubmit<?= $item->order_id ?>"><i class="glyphicon glyphicon-ok"> ยืนยันการคืนวัสดุ</i></a>
                        <a class="btn btn-danger btn-3d" data-toggle="modal" data-target="#myCancel"><i class="glyphicon glyphicon-remove"> ยกเลิกการคืนวัสดุ</i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal Return-->
<?php foreach ($order as $item) { ?>
    <!-- ============================= modal Submit ====================================-->
    <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันรายการคืนใช่หรือไม่</h4>
                </div>
<!--                --><?php //if($check == key($order)){ ?>
<!--                    --><?php //echo 'รหัสที่อยากได้'.$item->order_id ?>
<!--                --><?php //} ?>
                <?php $form = ActiveForm::begin(['action' => ['site/returnsubmit'],]) ?>
                    <div class="modal-body" align="center">
                        <?php foreach ($order_mat as $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id){ ?>
                                <input type="hidden" name="order_id_check[]" value="<?= $item->order_id ?>">
                                <input type="hidden" name="mat_id_check[]" value="<?= $item_mat->material_id ?>">
                                <input type="hidden" name="stock_id_check[]" value="<?= $item_mat->material->billMasters[0]->bill_master_id ?>">
                                <input type="hidden" name="mat_amount[]" value="<?= $item_mat->material_amount ?>">
                            <?php } ?>
                        <?php } ?>
                <?php ActiveForm::end() ?>
                <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                    </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- ============================= modal Submit ====================================-->

<!-- ============================= modal deleteCart ====================================-->
<div id="myCancel" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการยกเลิกรายการคืนใช่หรือไม่</h4>
            </div>
            <div class="modal-body" align="center">
                <a href="<?= Yii::getAlias('@web') ?>/materialsystem/site/return_order" class="btn btn-success btn-3d">ยืนยัน</a>
                <a class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal deleteCart ====================================-->