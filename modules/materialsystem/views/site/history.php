<?php
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $order app\modules\materialsystem\models\MatsysOrder */
/* @var $order_mat app\modules\materialsystem\models\MatsysOrderHasMaterial */
/* @var $form yii\widgets\ActiveForm */
/* @var $form1 yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1>ประวัติการเบิกวัสดุ</h1>
</header>
<div id="content" class="dashboard padding-20">
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
                                            <option value="1">รหัส : </option>
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
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="col-lg-1">วัน/เดือน/ปี</th>
                    <th class="col-lg-1">ปีงบประมาณ</th>
                    <th class="col-lg-2">เลขที่ใบเบิก</th>
                    <th class="col-lg-4">รายละเอียด</th>
                    <th class="col-lg-3">สถานะ</th>
                </tr>
                <?php foreach ($model as $order){ ?>
                    <?php if($order->order_status == 2){ ?>
                    <tr>
                        <td><?= $order->order_date ?></td>
                        <td><?= $order->order_budget_per_year ?></td>
                        <td><?= $order->order_id ?></td>
                        <td><a class="" data-toggle="modal" data-target="#myDetail<?= $order->order_id ?>">ดูรายละเอียด</a></td>
                        <?php if($order->order_status == '1'){ ?>
                            <td><p class="label label-warning">รอการอนุมัติ</p></td>
                        <?php } else if ($order->order_status == '2'){ ?>
                            <td><p class="label label-success">อนุมัติแล้ว</p></td>
                        <?php } else if ($order->order_status == '3'){?>
                            <td><p class="label label-danger">ปฏิเสธการอนุมัติ</p></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
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

<?php
$price = 0;
$amount = 0;
$count = 1;
?>
<!-- =========================================== Modal Detail ===================================================== -->
<?php foreach ($model as $order){ $count = 1; ?>
    <div id="myDetail<?= $order->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">รายการเบิกวัสดุ
                        <small> (เลขที่ใบเบิก <?= $order->order_id ?>)</small>
                    </h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="col-lg-1">ลำดับ</th>
                            <th class="col-lg-1">รหัสวัสดุ</th>
                            <th class="col-lg-1">รูปภาพ</th>
                            <th class="col-lg-3">รายการ</th>
                            <th class="col-lg-2">จำนวนที่เบิก</th>
                            <th class="col-lg-1">หน่วยนับ</th>
                            <th class="col-lg-1">ราคาต่อหน่วย</th>
                            <th class="col-lg-1">ราคารวม</th>
                        </tr>
                        <?php foreach ($model_order as $order_mat){ ?>
                            <?php if($order->order_id == $order_mat->order_id){ ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $order_mat->order_id ?></td>
                                    <td>
                                        <img src="/cs-e-office/web/web_mat/images/<?= $order_mat->material->material_image ?>"
                                             width="70" height="70">
                                    </td>
                                    <td><?= $order_mat->material->material_name ?></td>
                                    <td><?= $order_mat->material_amount ?></td>
                                    <td><?= $order_mat->material->material_unit_name ?></td>
                                    <?php $price = $order_mat->material_amount;
                                    $amount = $order_mat->material->matsysBillDetails[0]->bill_detail_price_per_unit
                                    ?>
                                    <td><?= $amount ?></td>
                                    <td><?= $price * $amount ?></td>
                                </tr>
                                <?php   $count++; }
                        } ?>
                    </table>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- =========================================== Modal Detail ===================================================== -->
