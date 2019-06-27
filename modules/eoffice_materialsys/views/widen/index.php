<?php

// Select2 Plugin
$this->registerCssFile('@mat_components/select2/css/select2.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/select2/js/select2.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//CSS Page
$this->registerCssFile('@mat_assets/widen/css/widen-index.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//JS Page
$this->registerJsFile('@mat_assets/widen/js/widen-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);


use app\modules\eoffice_materialsys\models\Person;
use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use yii\widgets\ActiveForm;
use app\modules\eoffice_materialsys\models\FunDate;

$date = new DateTime;
$date->setTimezone(new DateTimeZone("Asia/Bangkok"));
$time = $date->format('Y-m-d');
$bill_id = null;
?>
<div id="panel-info" class="panel panel-default cs-remargin" style="margin-top: 20px">
    <div class="panel-body">
        <div class="content-info">
            <!--            <h3><i class="glyphicon glyphicon-file"></i>ทำรายการเบิกวัสดุ<span class="pull-right widen_id"><b>รหัสใบเบิกวัสดุ : </b>6589/21</span>-->
            <!--            </h3>-->
            <h3>
                <i class="glyphicon glyphicon-file"></i>ทำรายการเบิกวัสดุ
                <?php
                if (MatsysOrder::searchConfirmbill($id) == 'false') {

                    ?>
                    <span id="widen_id" class="pull-right"><button class="btn btn-success btn-sm" data-toggle="modal"
                                                                   data-target="#ModalCreate">สร้างใบเบิกวัสดุ</button></span>
                    <?php
                } else {
                    $bill = MatsysOrder::searchConfirmbill($id);
                    $bill_id = $bill->order_id;
                    ?>
                    <span class="pull-right widen_id"><b>รหัสใบเบิกวัสดุ : </b><?= $bill->order_id ?></span>
                    <?php
                }
                ?>
            </h3>
            <span class="pull-right">
                <?php if (MatsysOrder::searchConfirmbill($id) == 'false') { ?>
                    <span>วันที่</span> : <span><?= MatsysBillDetail::dateThai($time) ?></span>
                <?php } else {
                    ?>
                    <span>วันที่</span> : <span><?= FunDate::dateThaisec($bill->order_date) ?></span>
                    <?php
                } ?>
            </span>
            <div>
                <span>ชื่อ-นามสกุล</span>: <span><?= Person::getFullname($person); ?></span>
            </div>
            <div>
                <span>หน่วยงาน</span>: <span><?= $person->DEPARTMENTNAME ?></span>
            </div>
            <div>
                <span>สาขา</span>: <span><?= $person->major_name ?></span>
            </div>
            <br/>
            <div>
                <span>เบอร์โทรศัพท์</span>: <span><?= $person->person_mobile ?></span>
            </div>
            <div>
                <span>E-mail Address</span>: <span><?= $person->person_email ?></span>
            </div>
        </div>
    </div>
</div>

<?php
if (MatsysOrder::searchConfirmbill($id) != 'false') {
    ?>
    <div id="panel-1" class="panel panel-default cs-remargin" style="margin-top: 20px">
        <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายละเอียดการนำไปใช้</strong> <!-- panel title -->
                </span>

            <!-- right options -->
            <ul class=" pull-right list-inline">
                <li><i id="type_header" class="glyphicon glyphicon-minus"></i></li>
            </ul>
            <!-- /right options -->
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <label>รายละเอียดการนำไปใช้(*)</label>
                    <script type="text/javascript">
                        var boxid_old2 = "<?= $bill->orderDetail->detail_id ?>";
                        var boxid_res = boxid_old2.split('D');
                        boxid_old2 = "D2" + boxid_res[1];
                    </script>
                    <select id="detail2" class="disabled" style="width: 100%">
                        <option value="D2001" <?php if ($bill->orderDetail->detail_id == 'D001') {
                            echo "selected";
                        } ?>>วิชาเรียน
                        </option>
                        <option value="D2002" <?php if ($bill->orderDetail->detail_id == 'D002') {
                            echo "selected";
                        } ?>>โครงการ
                        </option>
                        <option value="D2003" <?php if ($bill->orderDetail->detail_id == 'D003') {
                            echo "selected";
                        } ?>>กิจกรรม
                        </option>
                        <option value="D2004" <?php if ($bill->orderDetail->detail_id == 'D004') {
                            echo "selected";
                        } ?>>อื่น ๆ
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div <?php if ($bill->orderDetail->detail_id == 'D001') {
                        echo "style=\"display: block\"";
                    } else {
                        echo "style=\"display: none\"";
                    } ?> id="boxdetail1" name="D2001">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสวิชา</label>
                                <input name="order_detail_name_id" type="text"
                                       value="<?= $bill->orderDetail->order_detail_name_id ?>" class="form-control"
                                >
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อวิชา</label>
                                <input name="order_detail_name" value="<?= $bill->orderDetail->order_detail_name ?>"
                                       type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"
                                ><?= $bill->orderDetail->order_detail ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div <?php if ($bill->orderDetail->detail_id == 'D002') {
                        echo "style=\"display: block\"";
                    } else {
                        echo "style=\"display: none\"";
                    } ?> id="boxdetail2" name="D2002">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสโครงการ</label>
                                <input name="order_detail_name_id"
                                       value="<?= $bill->orderDetail->order_detail_name_id ?>" type="text"
                                       class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อโครงการ</label>
                                <input name="order_detail_name" value="<?= $bill->orderDetail->order_detail_name ?>"
                                       type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"
                                ><?= $bill->orderDetail->order_detail ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div <?php if ($bill->orderDetail->detail_id == 'D003') {
                        echo "style=\"display: block\"";
                    } else {
                        echo "style=\"display: none\"";
                    } ?> id="boxdetail3" name="D2003">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ชื่อกิจกรรม</label>
                                <input name="order_detail_name" value="<?= $bill->orderDetail->order_detail_name ?>"
                                       type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"
                                ><?= $bill->orderDetail->order_detail ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div <?php if ($bill->orderDetail->detail_id == 'D004') {
                        echo "style=\"display: block\"";
                    } else {
                        echo "style=\"display: none\"";
                    } ?> id="boxdetail4" name="D2004">
                        <div class="row">
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"
                                ><?= $bill->orderDetail->order_detail ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="panel-2" class="panel panel-default cs-remargin" style="margin-top: 20px">
        <div class="panel-body">
            <div class="row cs-main">
                <div class="tab-content">
                    <!-- Page 1 -->
                    <div id="select1" class="tab-pane fade in active">
                        <div class="col-md-6">
                            <label>ชื่อวัสดุ</label>
                            <select id="searchMaterial" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>จำนวน(*)</label>
                            <input name="amount-use" type="number" value="0" min="0" max="1000" class="form-control"
                                   disabled>
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="add-amount-use" class="btn btn-info btn-full-width"
                                    style="margin-top: 23px" disabled>
                                <i class="glyphicon glyphicon-plus"></i>
                                เพิ่มรายการ
                            </button>
                        </div>
                    </div>
                    <!-- End Page1 -->
                </div>
            </div>
        </div>
    </div>

    <div id="panel-3" class="panel panel-default ">
        <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายการใบเบิก</strong> <!-- panel title -->
                </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                       data-placement="bottom"><i class="fa fa-expand"></i></a></li>
            </ul>
            <!-- /right options -->
        </div>
        <!-- panel content -->
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th class="">ลำดับ</th>
                    <th class="col-md-1">รหัสวัสดุ</th>
                    <th class="col-md-1">รูปภาพ</th>
                    <th class="col-md-4">รายการ</th>
                    <th class="col-md-2">จำนวน</th>
                    <th class="col-md-3">ราคาต่อหน่วย</th>
                    <th class="col-md-1">ราคารวม</th>
                    <th class=""></th>
                </tr>
                <tbody id="tbody-items">
                <?php
                if ($items != null) {
                    $count = 1;
                    foreach ($items as $key => $value) {
                        $allAmount = MatsysMaterial::amountAll($value->materialdetail->material_id);
                        $amount = MatsysOrderHasMaterial::getAllamountorder($bill->order_id, $value->materialdetail->material_id);
                        echo "<tr id='mat-" . $value->materialdetail->material_id . "'>
                    <td>" . $count . "</td>
                    <td data-id='tb-material_id'>" . $value->materialdetail->material_id . "</td>
                    <td style='text-align: center'><img src=\"" . Yii::getAlias('@web') . "/web_mat/images/" . $value->materialdetail->material_image . "\" style='width: 50px' class=\"cs-image-table\"></td>
                    <td data-id='tb-material_name'>" . $value->materialdetail->material_name . "</td>
                    <td><input type=\"number\" data-id='" . $amount . "' value=\"" . $amount . "\" min=\"0\" max=\"" . ($allAmount + $amount) . "\" class=\"cs-amount-table\">/" . ($allAmount + $amount) . " <span>" . $value->materialdetail->material_unit_name . "</span></td>
                    <td>";
                        $allPrice = 0;
                        $items_detail = MatsysOrderHasMaterial::find()->where('order_id = :order_id', [':order_id' => $bill->order_id])
                            ->andWhere('material_id = :material_id', [':material_id' => $value->materialdetail->material_id])
                            ->all();
                        foreach ($items_detail as $key2 => $value2) {
                            $allPrice += ($value2->material->bill_detail_price_per_unit * $value2->material_amount);
                            echo "
                        <div><span style=\"display: inline-block;width: 50px\">" . number_format($value2->material->bill_detail_price_per_unit, 2) . "</span> บาท <span class=\"pull-right\">จำนวน " . $value2->material_amount . " " . $value->materialdetail->material_unit_name . "</span></div>";
                        }
                        echo "</td>
                    <td name='allprice-material'>" . number_format($allPrice, 2) . "</td>
                    <td>
                        <div align=\"center\">
                            <button type=\"button\"
                                    class=\"btn btn-danger btn-sm glyphicon glyphicon-trash\" data-toggle=\"modal\"
                                                                   data-target=\"#ModalConfrimdelete\"></button>
                        </div>
                    </td>
                </tr>";
                        $count++;
                    }
                }
                ?>
                </tbody>
            </table>
            <table class="table cs-remargin margin-bottom-0">
                <tr>
                    <th class="col-md-8">รายการทั้งหมด <span id="count-material">0</span> รายการ</th>
                    <th class="col-md-4">
                        <div align="right">รวมเป็นเงิน <span style="font-size: 30px"
                                                             id="allprice-allmaterial">0.00</span> บาท
                        </div>
                    </th>
                </tr>
            </table>
            <div class="pull-right cs-footer">
                <button id="btn-confirmOrder" type="button" class="btn btn-info btn-sm">ยืนยันรายการ</button>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                        data-target="#ModalConfirmCancel">ยกเลิกการทำรายการ
                </button>
            </div>
        </div>
        <!-- /panel content -->
    </div>
    <?php
}
?>
<?php
if (MatsysOrder::searchConfirmbill($id) == 'false') {

    ?>

    <!-- Modal Create Order -->
    <div class="modal fade" id="ModalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">สร้างใบเบิกวัสดุ</h4>
                </div>
                <div class="modal-body modal-center">
                    <div class="row">
                        <div class="col-md-6">
                            <label>รายละเอียดการนำไปใช้(*)</label>
                            <select id="detail" style="width: 100%">
                                <option value="D001">วิชาเรียน</option>
                                <option value="D002">โครงการ</option>
                                <option value="D003">กิจกรรม</option>
                                <option value="D004" selected>อื่น ๆ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div style="display: none" id="boxdetail1" name="D001">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>รหัสวิชา</label>
                                        <input name="order_detail_name_id" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <label>ชื่อวิชา</label>
                                        <input name="order_detail_name" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea name="order_detail" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" id="boxdetail2" name="D002">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>รหัสโครงการ</label>
                                        <input name="order_detail_name_id" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <label>ชื่อโครงการ</label>
                                        <input name="order_detail_name" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea name="order_detail" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" id="boxdetail3" name="D003">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>ชื่อกิจกรรม</label>
                                        <input name="order_detail_name" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea name="order_detail" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="display: block" id="boxdetail4" name="D004">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea name="order_detail" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 margin-top-20">
                            <div class="pull-right">
                                <button id="createOrdermasterview" class="btn btn-success btn-sm">ยืนยัน</button>
                                <button class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- Modal Success Create -->
<div class="modal fade" id="ModalSuccessCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-check fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #5cb85c"></i>
                <b style="font-size: 20px">สร้างใบเบิกวัสดุสำเร็จ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error no amount -->
<div class="modal fade" id="ModalErroramount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #b8ad5c"></i>
                <b style="font-size: 20px">ไม่สามารถเลือกวัสดุได้ เนื่องจากไม่มีวัสดุเหลือ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confrim Delete-->
<div class="modal fade" id="ModalConfrimdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ยืนยันการลบรายการ <span id="modal-confirmDelete-name"></span>
                </h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <form id="delte-list-material">
                    <input type="hidden" name="delete-material_id">
                    <input type="hidden" name="delete-bill_id" value="<?= $bill_id ?>">
                </form>
                <button id="confirm-delete-list" class="btn btn-danger btn-sm" data-dismiss="modal">ยืนยัน</button>
                <button class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error repeatedly -->
<div class="modal fade" id="ModalErrorrepeatedly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #b8ad5c"></i>
                <b style="font-size: 20px">ไม่สามารถเพิ่มวัสดุได้ เนื่องจากมีวัสดุอยู่ในรายการแล้ว</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Amount -->
<div class="modal fade" id="ModalEditamount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ยืนยันการแก้ไขจำนวน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <input type="hidden" name="c-oldAmount">
                <input type="hidden" name="c-newAmount">
                <input type="hidden" name="c-material_id">
                <input type="hidden" name="c-billId" value="<?= $bill_id ?>">
                <div style="text-align: center">
                    <button id="btn-confirmEdit" class="btn btn-info btn-sm" data-dismiss="modal">ยืนยัน</button>
                    <button id="btn-unconfirmEdit" class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Success Edit amount -->
<div class="modal fade" id="ModalSuccessEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-check fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #5cb85c"></i>
                <b style="font-size: 20px">แก้ไขจำนวนวัสดุสำเร็จ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirm Order -->
<div class="modal fade" id="ModalConfirmOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ยืนยันการทำรายการ</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <input type="hidden" name="con-billId" value="<?= $bill_id ?>">
                <div style="text-align: center">
                    <button id="btn-con-confirm" class="btn btn-info btn-sm" data-dismiss="modal">ยืนยัน</button>
                    <button class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Success Confirm Order -->
<div class="modal fade" id="ModalSuccessConfirmOrder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-check fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #5cb85c"></i>
                <b style="font-size: 20px">ยืนยันการทำรายการเบิกวัสดุสำเร็จ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirm Cancel -->
<div class="modal fade" id="ModalConfirmCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ยกเลิกการทำรายการ</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <input type="hidden" name="can-billId" value="<?= $bill_id ?>">
                <div style="text-align: center">
                    <button id="btn-can-confirm" class="btn btn-danger btn-sm" data-dismiss="modal">ยืนยัน</button>
                    <button class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Success Confirm Cancel -->
<div class="modal fade" id="ModalSuccessConfirmCancel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-check fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #5cb85c"></i>
                <b style="font-size: 20px">ยกเลิกการทำรายการเบิกวัสดุสำเร็จ</b>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error no Material -->
<div class="modal fade" id="ModalErrorNoMaterial">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #b8ad5c"></i>
                <b style="font-size: 20px">กรุณาเพิ่มวัสดุ</b>
            </div>
        </div>
    </div>
</div>