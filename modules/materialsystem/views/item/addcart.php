<?php

use yii\helpers\Html;
use app\modules\materialsystem\controllers;
use yii\widgets\ActiveForm;

?>
<?php
/* @var $this yii\web\View */
/* @var $detail app\modules\materialsystem\models\MatsysDetail */
/* @var $form yii\widgets\ActiveForm */
/* @var $form1 yii\widgets\ActiveForm */
?>

<div id="content" class="dashboard padding-20">
    <header id="page-header">
        <?php if(isset($_SESSION["cart"])) { ?>
        <h1>รายการเบิกวัสดุ</h1>
        <br>
        <div class="nav nav-tabs"></div>
        <div id="panel-1" class="panel panel-default ">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายการใบเบิก</strong> <!-- panel title -->
                    <?php
                        $time = time();
                        Yii::$app->formatter->locale = 'th_TH';
                    ?>
                    <small class="size-12 weight-300 text-mutted hidden-xs"> <?= Yii::$app->formatter->asDateTime($time, 'php: วันที่ d-m-Y') ?></small>
                </span>

            </div>
            <!-- panel content -->
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="1%">ลำดับ</th>
                        <th class="col-lg-1">รหัสวัสดุ</th>
                        <th class="col-lg-1">รูปภาพ</th>
                        <th class="col-lg-2">รายการ</th>
                        <th class="col-lg-1">หน่วยนับ</th>
                        <th width="10%">จำนวนที่เบิก</th>
                        <!--<th class="col-lg-1">ราคาต่อหน่วย</th>
                        <th class="col-lg-1">ราคารวม</th>-->
                        <th class="col-lg-3">รายละเอียดการนำไปใช้</th>
                        <th width="1%"></th>
                    </tr>
                    <?php
                    $count = 1;
                    $sum = 0;
                    $total = 0; ?>
                    <?php foreach ($arr as $key => $value) { ?>

                        <?php /*if ($count == 1) { */?><!--
                            <button type="button" class="btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myInsert">เพิ่มรายละเอียด</button>
                        --><?php /*} */?>

                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $value['mat_id'] ?></td>
                            <td><img src="/cs-e-office/web/web_mat/images/<?= $value['mat_pic'] ?>" width="80"
                                     height="80"></td>
                            <td><?= $value['mat_name'] ?></td>
                            <td><?= $value['mat_name_unit'] ?></td>
                            <td><input type="number" name="mat_amount" min="1" max="<?= $value['mat_price'] ?>" value="<?= $value['mat_amount'] ?>" required> <!--/ --><?/*= $value['mat_price'] */?></td>
                            <!--<td><?/*= $value['mat_per_unit'] */?></td>
                            <td><?/*= ((float)$value['mat_amount'] * (float)$value['mat_per_unit']) */?></td>-->
                            <td>
                                <select name="list_detail" id="list_detail" style="width: 100%">
                                        <option value="null" selected disabled>เลือกรายละเอียด</option>
                                    <?php foreach ($mat_detail as $detail) { ?>
                                        <option value="<?= $detail->detail_id ?>"><?= $detail->detail_name?></option>
                                    <?php } ?>
                                </select>
                                        <input type="text" class="form-control" name="detail_text" value="">
                            </td>
                            <!--<td><a data-toggle="modal" data-target="#myDetail">เพิ่มรายละเอียดการนำไปใช้งาน</a></td>-->
                            <td>
                                <div align="center">
                                    <a href="" class="btn btn-danger btn-sm glyphicon glyphicon-trash" data-toggle="modal"
                                       data-target="#myDel<?= $key ?>">
                                    </a>
                                </div>
                                <!--<div align="center">
                                    <a href="<?/*= Yii::getAlias("@web") */?>/materialsystem/item/deletecart/<?/*= $key */?>"
                                       class="btn btn-danger btn-sm glyphicon glyphicon-trash"></a>
                                </div>-->
                            </td>
                        </tr>
                        <?php $count++;
                        $total += ((float)$value['mat_amount'] * (float)$value['mat_price']);
                    } ?>
                </table>
                <!--<table class=" table cs-remargin">
                    <tr>
                        <th class="col-lg-9">รายการทั้งหมด <?/*= $count - 1 */?> รายการ</th>
                        <th class="col-lg-3">
                            <div align="right">รวมเป็นเงิน <?/*= $total */?> บาท</div>
                        </th>
                    </tr>
                </table>-->
                <div class="pull-right cs-footer">
                    <a class="btn btn-success btn-3d" data-toggle="modal"
                       data-target="#mySubmit"><i class="glyphicon glyphicon-ok"> ยืนยันการเบิกวัสดุ</i>
                    </a>
                    <a class="btn btn-danger btn-3d" data-toggle="modal"
                     data-target="#cartDel"><i class="glyphicon glyphicon-remove"> ยกเลิกการเบิกวัสดุ</i>
                     </a>
                </div>
            </div>
            <!-- /panel content -->
        </div>
</div>
<!-- ============================= modal Submit ====================================-->
<div id="mySubmit" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันรายการเบิกวัสดุใช่หรือไม่</h4>
            </div>
            <?php $form = ActiveForm::begin(['action'=>['item/submit'],]) ?>
            <div class="modal-body" align="center">
                <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <?php } else { ?>
    <h3> ไม่พบรายการเบิกวัสดุ</h3>
    <?php } ?>
</div>
<!-- ============================= modal Submit ====================================-->

<?php foreach ($arr as $key => $value) { ?>
<!-- ============================= modal Delete ====================================-->
<div id="myDel<?= $key ?>" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการลบวัสดุชิ้นนี้ออกจากรายการใช่หรือไม่</h4>
            </div>
            <?php $form1 = ActiveForm::begin(['action'=>['item/deletecart'],]) ?>
            <div class="modal-body" align="center">
                <input type="hidden" name="id_del" value="<?= $key ?>">
                <!--<a href="/cs-e-office/web/materialsystem/item/deletecart/<?/*= $key */?>" class="btn btn-success btn-3d">ยืนยัน</a>-->
                <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- ============================= modal Delete ====================================

<!-- ============================= modal ====================================-->
<div id="myInsert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog-full">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ฟอร์มการเพิ่มรายละเอียด</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="col-md-5 col-sm-3 col-xs-12">
                    <label>รหัสรายละเอียด</label>
                        <input type="text" class="form-control" name="order_detail_id" value="CS001" disabled>
                </div>

                <div class="col-md-5 col-sm-3 col-xs-12">
                    <label>รายละเอียด</label>
                        <input type="text" class="form-control" name="order_detail" value="">
                </div>

                <div class="col-md-5 col-sm-3 col-xs-12">
                    <label>ชื่อโครงการหรือชื่อวิชา</label>
                        <input type="text" class="form-control" name="order_detail_name" value="">
                </div>

                <div class="col-md-5 col-sm-3 col-xs-12">
                    <label>รหัสโครงการหรือระหัสวิชา</label>
                        <input type="text" class="form-control" name="order_detail_name_id" value="">
                </div>
            </div>
            <div class="modal-footer">
                <a href=#" class="btn btn-small btn-success btn-3d"
                   data-dismiss="modal">
                    <i class="glyphicon glyphicon-ok" aria-hidden="false"></i>บันทึก</a>
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal ====================================-->

<!-- ============================= modal ====================================-->
<div id="myDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">กรอกข้อมูลการนำไปใช้งาน</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <textarea type="text" class="form-control required" style="height: 250px"
                          placeholder="บอกเหตุผลของการนำไปใช้กับงาน หรือกิจกรรมใดๆ"></textarea>
            </div>
            <div class="modal-footer">
                <a href=#" class="btn btn-small btn-success btn-3d"
                   data-dismiss="modal">
                    <i class="glyphicon glyphicon-ok" aria-hidden="false"></i>บันทึก</a>
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal ====================================-->

<!-- ============================= modal deleteCart ====================================-->
<div id="cartDel" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการลบรายการเบิกวัสดุใช่หรือไม่</h4>
            </div>
            <div class="modal-body" align="center">
                <a href="/cs-e-office/web/materialsystem/item/resetcart" class="btn btn-success btn-3d">ยืนยัน</a>
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal deleteCart ====================================-->


</section>
<!-- /MIDDLE -->


