<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $item \app\modules\eoffice_materialsys\models\MatsysOrder */
/* @var $return_list app\modules\eoffice_materialsys\models\MatsysOrderReturn */
?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>รายการคำร้องขอคืนวัสดุุ</h4></strong> <!-- panel title -->
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
                                'order_budget_per_year',
                                [
                                    'attribute' => 'ชื่อผู้คืนวัสดุ',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        /* @var $model \app\modules\eoffice_materialsys\models\MatsysOrder */
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
                                            /* @var $model \app\modules\eoffice_materialsys\models\MatsysOrder */
                                            if ($model->order_status_return == 1) {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail' . $model->order_id . '"> ตรวจสอบรายการคืน</a></span>
                                                        <span class="label label-warning">ยังไม่ครวจสอบ</span>
                                                        </span>';
                                            } else if ($model->order_status_return == 2) {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail' . $model->order_id . '"> ตรวจสอบรายการคืน</a></span>
                                                        <span class="label label-success">ตรวจสอบแล้ว</span>
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

<!-- ============================= modal ====================================-->
<?php $count = 1;
$sum = 0;
$total = 0;
foreach ($models as $item) {
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
                    <table class="table table-striped table-bordered table-hover">
                        <?php if ($item->orderDetail->detail->detail_id == 'D001') { ?>
                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่อนุมัติการเบิก</b> : <?= $item->order_date_accept ?></p>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <p><b>วันที่คืนวัสดุ</b> : <?= $item->matsysOrderReturns[0]->order_return_date ?></p>
                                        <p><b>วันที่อนุมัติการคืน</b>
                                            : <?= $item->matsysOrderReturns[0]->order_return_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else if ($item->orderDetail->detail->detail_id == 'D002') { ?>
                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่อนุมัติการเบิก</b> : <?= $item->order_date_accept ?></p>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <p><b>วันที่คืนวัสดุ</b> : <?= $item->matsysOrderReturns[0]->order_return_date ?></p>
                                        <p><b>วันที่อนุมัติการคืน</b>
                                            : <?= $item->matsysOrderReturns[0]->order_return_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } else if ($item->orderDetail->detail->detail_id == 'D003') { ?>
                            <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3">
                                    <p><b>วันที่อนุมัติการเบิก</b> : <?= $item->order_date_accept ?></p>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <p><b>วันที่คืนวัสดุ</b> : <?= $item->matsysOrderReturns[0]->order_return_date ?></p>
                                        <p><b>วันที่อนุมัติการคืน</b>
                                            : <?= $item->matsysOrderReturns[0]->order_return_date_accept ?></p>
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
                                        <p><b>รายละเอียด</b> : <?= $item->orderDetail->order_detail ?>
                                        </p>
                                        <p><b>ปีงบประมาณ</b> : <?= $item->order_budget_per_year ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p><b>วันที่อนุมัติการเบิก</b> : <?= $item->order_date_accept ?></p>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <p><b>วันที่คืนวัสดุ</b> : <?= $item->matsysOrderReturns[0]->order_return_date ?></p>
                                        <p><b>วันที่อนุมัติการคืน</b>
                                            : <?= $item->matsysOrderReturns[0]->order_return_date_accept ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <thead>
                        <tr>
                            <th width="1%">ลำดับ</th>
                            <th width="5%">รหัสวัสดุ</th>
                            <th width="30%">ชื่อวัสดุ</th>
                            <th width="10%">จำนวนที่คืน</th>
                            <th width="15%">จำนวนที่ใช้ได้จริง</th>
                            <th width="5%">หน่วยนับ</th>
                            <th width="5%">ราคาต่อหน่วย</th>
                            <th width="5%">จำนวนเงิน</th>
                        </tr>
                        </thead>
                        <?php foreach ($order_return as $key => $return_list) { ?>
                            <tbody>
                            <?php if ($item->order_id == $return_list->order_id) { ?>
                                <tr>
                                    <td align="center"><?= $count ?></td>
                                    <td><?= $return_list->material->material->material_id ?></td>
                                    <td><?= $return_list->material->material->material_name ?></td>
                                    <td><?= $return_list->order_return_amount ?></td>
                                    <?php if ($item->order_status_return == '2') { ?>
                                        <td><?= $return_list->order_return_amount_use ?></td>
                                    <?php } else { ?>
                                        <td><input id="return_amount[]" name="return_amount[]" type="number"
                                                   onchange="CheckReturn(this.value,'<?= $key ?>')"
                                                   value="<?= $return_list->order_return_amount ?>"
                                                   min="0"
                                                   max="<?= $return_list->order_return_amount ?>"
                                                   style="width: 5em"></td>
                                    <?php } ?>
                                    <td><?= $return_list->material->material->material_unit_name ?></td>
                                    <td><?= $return_list->material->bill_detail_price_per_unit ?></td>
                                    <?php $sum = $return_list->order_return_amount * $return_list->material->bill_detail_price_per_unit ?>
                                    <td><?= $sum ?></td>
                                </tr>
                                </tbody>
                            <?php } ?>
                            <?php $count++;
                        } ?>
                    </table>

                    <div class="row">
                        <div class="pull-right">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php if ($item->order_status_return == '1') { ?>
                                    <a href="#" class="btn btn-3d btn-success btn-3d"
                                       data-toggle="modal"
                                       data-target="#mySubmit<?= $item->order_id ?>">
                                        <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>รับคืน
                                    </a>
                                <?php } ?>
                                <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
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
<?php foreach ($models as $item) { ?>
    <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">
                        คุณตรวจสอบรายการคืนวัสดุทั้งหมดแล้วใช่หรือไม่</h4>
                </div>
                <?php $form = ActiveForm::begin(['action' => ['submit_return'],]) ?>
                <div class="modal-body" align="center">
                    <?php foreach ($order_return as $key => $return_list) { ?>
                        <?php if ($item->order_id == $return_list->order_id) { ?>
                            <input type="hidden" name="bill_id_list[]" value="<?= $return_list->bill_master_id ?>">
                            <input type="hidden" name="order_id_list[]" value="<?= $return_list->order_id ?>">
                            <input type="hidden" name="order_id_ai[]" value="<?= $return_list->order_id_ai ?>">
                            <input type="hidden" name="material_id_list[]" value="<?= $return_list->material_id ?>">
                            <input type="hidden" id="return_amount<?= $key ?>" name="return_amount[]">
                            <input type="hidden" name="return_amount_default[]"
                                   value="<?= $return_list->order_return_amount ?>">
                        <?php } ?>
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

<script>
    function CheckReturn(val, key) {
        $('#return_amount' + key).val(val);
    }
</script>