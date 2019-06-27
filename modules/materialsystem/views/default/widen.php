<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType */
/* @var $item \app\modules\materialsystem\models\MatsysMaterial */
/* @var $detail \app\modules\materialsystem\models\MatsysDetail */
?>
<div id="panel-1" class="panel panel-default ">
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
        <div class="row" align="center">
            <h3><b>ใบเบิกวัสดุ</b></h3>
        </div>
        <div class="col-md-12" align="center">
            <div class="pull-right">
                <p>วันที่ <?= date("d-m-Y") ?></p>
            </div>
        </div>
        <div class="padding-20">
            <div class="col-md-10">
                <div class="col-md-5">
                    <p>
                        ชื่อ-สกุล : <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                        <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>
                    </p>
                    <p>
                        โทรศัพท์ <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_mobile ?></p>

                </div>
                <div class="col-md-6" style="padding: 0px">
                    <p>
                        หน่วยงาน <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_current_work_place ?> </p>
                    <p>
                        อีเมล <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_email ?></p>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <div class="row cs-main">
                <!-- Page 1 -->
                <div class="col-lg-5 col-md-5">
                    <label>ค้นหาวัสดุ</label>

                    <?php $form = Activeform::begin(['action' => ['default/add']]) ?>
                    <select style="width: 100%" name="item_select" class="form-control select2" required>
                        <option value="" selected disabled></option>
                        <?php foreach ($mat as $item) { ?>
                            <option value="<?= $item->material_id ?>"><?= $item->material_id ?>
                                : <?= $item->material_name ?> :
                                คงเหลือ <?= $item->matsysBillDetails[0]->bill_detail_use_amount ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-5 col-md-5">
                    <label>จำนวน (*)</label>
                    <input type="number" name="num_select" value="" min="1" max="1000" class="form-control"
                           required>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="padding-20">
                        <button type="submit" style="margin-top: 4px" class="btn btn-success glyphicon glyphicon-plus cs-main-btn">
                            เพิ่มรายการ
                        </button>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
                <!-- End Page1 -->
        </div>
        <table class="table table-bordered">
            <tr bgcolor="#f5f5f5">
                <th class="col-lg-1">ลำดับ</th>
                <th class="col-lg-1">รหัสวัสดุ</th>
                <th class="col-lg-2">รูปภาพ</th>
                <th class="col-lg-2">รายการ</th>
                <th class="col-lg-1">หน่วยนับ</th>
                <th class="col-lg-1">จำนวน</th>
                <th class="col-lg-1">ราคาต่อหน่วย</th>
                <th class="col-lg-1">ราคารวม</th>
                <th class="col-lg-1"></th>
            </tr>
            <?php
            $count = 1;
            $sum = 0;
            $total = 0;
            $price = 0; ?>
            <?php foreach ($arr as $key => $value) { ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $value['mat_id'] ?></td>
                    <td><img src="<?= Yii::getAlias('@web') ?>/web_mat/images/<?= $value['mat_pic'] ?>" width="50"
                             height="50">
                    </td>
                    <td><?= $value['mat_name'] ?></td>
                    <td><?= $value['mat_name_unit'] ?></td>
                    <td><input type="number" id="mat_amount" name="mat_amount" min="1" max="<?= $value['mat_price'] ?>"
                               value="<?= $value['mat_amount'] ?>" onchange="CheckAmount(this.value)" required">
                    </td>
                    <td><?= $value['mat_per_unit'] ?></td>
                    <?php $sum = $value['mat_amount'] * $value['mat_per_unit'] ?>
                    <td><?= $sum ?></td>
                    <?php $price += $sum; ?>
                    <td>
                        <div align="center">
                            <a href="" class="btn btn-danger btn-sm glyphicon glyphicon-trash" data-toggle="modal"
                               data-target="#myDel<?= $key ?>">
                            </a>
                        </div>
                    </td>
                </tr>
                <?php $count++;
                $total += ((float)$value['mat_amount'] * (float)$value['mat_price']);
            } ?>
            <tr bgcolor="#f5f5f5">
                <th class="col-lg-9" colspan="4">รายการทั้งหมด <?= $count - 1 ?> รายการ</th>
                <th class="col-lg-3" colspan="5">
                    <div align="right">รวมเป็นเงิน <?= $price ?> บาท</div>
                </th>
            </tr>

        </table>
        <?php if (isset($_SESSION["cart"])) { ?>

        <div class="col-md-12">
            <div class="padding-20" align="center">
                <select name="list_detail" id="list_detail1" style="width: 50%"
                        onchange="CheckDetail(this.value);" required>
                    <option value="null" selected disabled>เลือกรายละเอียด</option>
                    <?php foreach ($mat_detail as $detail) { ?>
                        <option value="<?= $detail->detail_id ?>"><?= $detail->detail_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="padding-20" style="display: none" id="detail1">
                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" name="detail_id" value="">
                        รหัสโครงการ <input type="text" class="form-control" id="detail_code1" name="detail_code"
                                           required onchange="CheckId(this.value);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        ชื่อโครงการ <input type="text" class="form-control" id="detail_name1" name="detail_name"
                                           required onchange="CheckName(this.value);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        รายละเอียด <textarea class="form-control" id="detail_desc1" name="detail_desc"
                                             style="resize: none" required onchange="CheckDesc(this.value);"></textarea>
                    </div>
                </div>
            </div>
            <div class="padding-20" style="display: none" id="detail2">
                <div class="row">
                    <div class="col-md-10">
                        ชื่อกิจกรรม <input type="text" class="form-control" id="detail_name1" name="detail_name"
                                           required onchange="CheckName(this.value);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        รายละเอียด <textarea class="form-control" id="detail_desc1" name="detail_desc"
                                             style="resize: none" required onchange="CheckDesc(this.value);"></textarea>
                    </div>
                </div>
            </div>
            <div class="padding-20" style="display: none" id="detail3">
                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" name="detail_id" value="">
                        รหัสวิชา <input type="text" class="form-control" id="detail_code1" name="detail_code" required
                                        onchange="CheckId(this.value);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        ชื่อวิชา <input type="text" class="form-control" id="detail_name1" name="detail_name" required
                                        onchange="CheckName(this.value);">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        รายละเอียด <textarea class="form-control" name="detail_desc1" name="detail_desc"
                                             style="resize: none" required onchange="CheckDesc(this.value);"></textarea>
                    </div>
                </div>
            </div>
            <div class="padding-20" style="display: none" id="detail4">
                <div class="row">
                    <div class="col-md-10">
                        รายละเอียด <textarea class="form-control" name="detail_desc1" name="detail_desc"
                                             style="resize: none" required onchange="CheckDesc(this.value);"></textarea>
                    </div>
                </div>
            </div>
            <div class="padding-20" align="center" style="display: none" id="sub_detail">
            </div>

            <div id="sub_show" class="pull-right cs-footer" style="display: none">
                <a class="btn btn-success btn-3d" data-toggle="modal"
                   data-target="#mySubmit"><i class="glyphicon glyphicon-ok"> ยืนยันการเบิกวัสดุ</i>
                </a>
                <a class="btn btn-danger btn-3d" data-toggle="modal"
                   data-target="#cartDel"><i class="glyphicon glyphicon-remove"> ยกเลิกการเบิกวัสดุ</i>
                </a>
            </div>
            <?php } ?>
        </div>
        <!-- /panel content -->
    </div>
</div>

<?php $form = ActiveForm::begin(['action' => ['item/submit'],]) ?>
<!-- ============================= modal Submit ====================================-->
<div id="mySubmit" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันรายการเบิกวัสดุใช่หรือไม่</h4>
            </div>
            <input type="hidden" name="id_user"
                   value="<?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->id ?>">
            <input type="hidden" name="name_user"
                   value="<?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
            <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
            <!--                <input type="hidden" id="mat_amount" name="mat_amount">-->
            <input type="hidden" id="list_detail" name="list_detail">
            <input type="hidden" id="detail_code" name="detail_code">
            <input type="hidden" id="detail_name" name="detail_name">
            <input type="hidden" id="detail_desc" name="detail_desc">
            <div class="modal-body" align="center">
                <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal Submit ====================================-->
<?php ActiveForm::end() ?>

<?php foreach ($arr as $key => $value) { ?>
    <!-- ============================= modal Delete ====================================-->
    <div id="myDel<?= $key ?>" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">คุณต้องการลบวัสดุชิ้นนี้ออกจากรายการใช่หรือไม่</h4>
                </div>
                <?php $form1 = ActiveForm::begin(['action' => ['item/deletecart'],]) ?>
                <div class="modal-body" align="center">
                    <input type="hidden" name="id_del" value="<?= $key ?>">
                    <!--<a href="/cs-e-office/web/materialsystem/item/deletecart/<? /*= $key */ ?>" class="btn btn-success btn-3d">ยืนยัน</a>-->
                    <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                    <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- ============================= modal deleteCart ====================================-->
<div id="cartDel" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
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

<script type="text/javascript">

    function CheckDetail(val) {

        $('#list_detail').val(val);

        $('div[id^="detail"]').map(function (key, elm) { //$('div[id^="boxdetail"]') คือคำสั่ง ค้นหา DIV ที่ขึ้นต้นด้วย boxdetail //.map คือ foreach //key คือ ค้นหาที่ละตัว 0,1,2,3 //elm คือหาตาม element
            elm.style.display = 'none';
        });
        if (val == 'D001') {
            var element = document.getElementById('detail1');
            element.style.display = 'block';
        }
        if (val == 'D002') {
            var element = document.getElementById('detail2');
            element.style.display = 'block';
        }
        if (val == 'D003') {
            var element = document.getElementById('detail3');
            element.style.display = 'block';
        }
        if (val == 'D004') {
            var element = document.getElementById('detail4');
            element.style.display = 'block';
        }
        var element1 = document.getElementById('sub_show');
        element1.style.display = 'block';
        var element = document.getElementById('sub_detail');
        element.style.display = 'block';
    }
    function CheckId(val) {
        $('#detail_code').val(val);
    }
    function CheckName(val) {
        $('#detail_name').val(val);
    }
    function CheckDesc(val) {
        $('#detail_desc').val(val);
    }
    function CheckAmount(val) {
        $('#mat_amount').val(val);
    }
</script>

</section>
<!-- /MIDDLE -->