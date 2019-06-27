<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $item app\modules\materialsystem\models\MatsysOrder */
/* @var $item_mat app\modules\materialsystem\models\MatsysOrderHasMaterial */
/* @var $form yii\widgets\ActiveForm */
/* @var $form1 yii\widgets\ActiveForm */
?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>รายการคำร้องขอเบิกวัสดุ</h4></strong> <!-- panel title -->
							</span>
        </div>
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><!-- TAB 1 -->
                                <a href="#" data-toggle="tab">ค้นหา จาก ข้อมูลในตาราง</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->
                    </div>


                    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>

                    <!-- เรียก view _search.php -->
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    <br>
                    <div class="panel-body">
                        <?= GridView::widget([
                            'id' => 'grid-user',
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'tableOptions' => [
                                'class' => 'table table-striped table-bordered table-hover',
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'order_id',
                                'order_date',
                                'order_budget_per_year',
                                [
                                    'attribute' => 'ชื่อผู้เบิกวัสดุ',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        /* @var $model \app\modules\materialsystem\models\MatsysOrder */
                                        return Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $model->person_id)->queryOne()['person_name'] . " " .
                                            Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_person WHERE id=' . $model->person_id)->queryOne()['person_surname'];
                                    }
                                ],
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{custom_view}',
                                    'options' => ['style' => 'width:295px'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model) {
                                            /* @var $model \app\modules\materialsystem\models\MatsysOrder */
                                            // Html::a args: title, href, tag properties.
                                            if ($model->order_status == '0' && $model->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">           
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail1' . $model->order_id . '"> แสดงรายการเบิก</a></span>
                                                        <span class="label label-warning">รอการอนุมัติ</span>                      
                                                    </span>';
                                            } else if ($model->order_status == '1' && $model->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">           
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail1' . $model->order_id . '"> แสดงรายการเบิก</a></span>
                                                        <span class="label label-success">อนุมัติแล้ว</span>                      
                                                    </span>';
                                            } else if ($model->order_status == '2' && $model->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">           
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail1' . $model->order_id . '"> แสดงรายการเบิก</a></span>
                                                        <span class="label label-danger">ปฏิเสธอนุมัติ</span>                      
                                                    </span>';
                                            }
                                        }
                                        ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <?php yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($models as $item) { ?>
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
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                    <?php if ($item->order_status == '1') { ?>
                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } elseif ($item->order_status == '2') { ?>
                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else if ($item->orderDetail->detail->detail_id == 'D002') { ?>
                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                    <?php if ($item->order_status == '1') { ?>
                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } elseif ($item->order_status == '2') { ?>
                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else if ($item->orderDetail->detail->detail_id == 'D003') { ?>
                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                    <?php if ($item->order_status == '1') { ?>
                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } elseif ($item->order_status == '2') { ?>
                                        <p><b>วันที่ปฏิเสธอนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else if ($item->orderDetail->detail->detail_id == 'D004') { ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <p><b>ประเภท</b> : การใช้งานประเภทอื่น ๆ</p>
                                        <p><b>เลขที่ใบเบิก</b> : <?= $item->order_id ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?></p>
                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p><b>วันที่เบิก</b> : <?= $item->order_date ?></p>
                                    <?php if ($item->order_status == '1') { ?>
                                        <p><b>วันที่อนุมัติ</b> : <?= $item->order_date_accept ?></p>
                                    <?php } elseif ($item->order_status == '2') { ?>
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
                            <?php if ($item->order_status == '1' || $item->order_status == '0') { ?>
                                <th width="12%">จำนวนจ่ายจริง</th>
                            <?php } ?>
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
                        <?php foreach ($order_mat as $key => $item_mat) { ?>
                            <tr>
                                <?php if ($item->order_id == $item_mat->order_id) { ?>
                                    <td align="center"><?= $num ?></td>
                                    <td><?= $item_mat->material_id ?></td>
                                    <td><?= $item_mat->material->material->material_name ?></td>
                                    <td><?= $item_mat->material_amount ?></td>
                                    <?php /*$_SESSION['amount[]'] = $temp; */ ?>
                                    <?php if ($item->order_status == '1') { ?>
                                        <td><?= $item_mat->material_amount_receive ?></td>
                                    <?php } else if ($item->order_status == '0') { ?>
                                        <td><input id="order_amount[]" name="order_amount[]" type="number"
                                                   onchange="CheckAmount(this.value,'<?= $key ?>')"
                                                   value="<?= $item_mat->material_amount ?>" min="0"
                                                   max="<?= $item_mat->material_amount ?>" style="width: 4em">
                                            / คงเหลือ <?= $item_mat->material->bill_detail_use_amount ?>
                                        </td>
                                    <?php } ?>
                                    <td> <?= $item_mat->material->billMaster->materials[0]->material_unit_name ?></td>
                                    <td><?= $item_mat->material->bill_detail_price_per_unit ?></td>
                                    <td><?= ($item_mat->material_amount * $item_mat->material->bill_detail_price_per_unit) ?></td>
                                <?php } ?>
                            </tr>
                            <?php $num++;
                            $total += ($item_mat->material_amount * $item_mat->material->bill_detail_price_per_unit);
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
                            <?php if ($item->order_status != '0') { ?>
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
                        <?php if ($item->order_status != '0') { ?>
                            <tr>
                                <td colspan="8">
                                    <div class="col-md-2">
                                        <b>รายละเอียด</b>
                                    </div>
                                    <div class="col-md-10">
                                        <textarea maxlength="200" rows="4" class="form-control" style="resize: none" disabled><?= $item->order_cancel_description ?>
                                        </textarea>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($item->order_status == '0') { ?>

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
                <?php } else { ?>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- ========================================= modal =========================================== -->

<!-- ============================= modal Submit ====================================-->
<?php foreach ($models as $item) { ?>
    <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันการอนุมัติใช่หรือไม่</h4>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <?php $form = Activeform::begin(['action' => ['saveitem']]) ?>
                        <?php foreach ($order_mat as $key => $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id) { ?>
                                <input type="hidden" name="order_id_list[]" value="<?= $item_mat->order_id ?>">
                                <input type="hidden" name="material_id_list[]" value="<?= $item_mat->material_id ?>">
                                <input type="hidden" id="order_amount<?= $key ?>" name="order_amount[]">
                                <input type="hidden" name="material_amount[]" value="<?= $item_mat->material_amount ?>">
                                <input type="hidden" name="bill_id_list[]" value="<?= $item_mat->bill_master_id ?>">
                            <?php } ?>
                        <?php } ?>
                        <div class="row">
                            <h5><label>แบบฟอร์มรายละเอียดการเบิก</label></h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                                <textarea name="order_desc" maxlength="200" rows="4"
                                                          class="form-control" style="resize: none"
                                                          placeholder="กรอกข้อมูลรายละเอียดต่าง ๆ เช่น สถานที่นัดรับวัสดุ หรือวันที่รับ หรือหมายเหตุอื่น ๆ "
                                                          required></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="name_admin"
                               value="<?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                                        <?= \app\modules\materialsystem\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
                        <div class="panel-footer" align="center">
                            <input type="submit" class="btn btn-ngb btn-success btn-3d" value="ยืนยัน">
                            <a href="#" class="btn btn-ngb btn-danger btn-3d"
                               data-dismiss="modal">ยกเลิก</a>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- ============================= modal Submit ====================================-->


<!-- ============================= modal Cancel ====================================-->
<?php foreach ($models as $item) { ?>
    <div id="myCancel<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">กรอกรายละเอียดการปฏิเสธการเบิกวัสดุ</h4>
                </div>
                <?php $form1 = ActiveForm::begin(['action' => ['cancelwiden']]) ?>
                <div class="modal-body">
                    <?php foreach ($order_mat as $key => $item_mat) { ?>
                        <?php if ($item->order_id == $item_mat->order_id) { ?>
                            <input type="hidden" name="order_id_list[]" value="<?= $item_mat->order_id ?>">
                            <input type="hidden" name="material_id_list[]"
                                   value="<?= $item_mat->material_id ?>">
                            <input type="hidden" id="order_amount<?= $key ?>" name="order_amount[]">
                            <input type="hidden" name="material_amount[]"
                                   value="<?= $item_mat->material_amount ?>">
                            <input type="hidden" name="bill_id_list[]" value="<?= $item_mat->bill_master_id ?>">
                            <input type="hidden" name="bill_amount[]"
                                   value="<?= $item_mat->material->bill_detail_use_amount ?>">
                        <?php } ?>
                    <?php } ?>
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
<!-- ============================= modal Cancel ====================================-->


<script>
    function CheckAmount(val, key) {
        $('#order_amount' + key).val(val);
    }
</script>