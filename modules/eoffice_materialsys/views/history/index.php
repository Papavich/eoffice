<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $order app\modules\eoffice_materialsys\models\MatsysOrder */
/* @var $order_mat app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial */
?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>ตารางประวัติการเบิก</h4></strong> <!-- panel title -->
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
                                'order_date',
                                [ // Type
                                    'label' => '<div>งบประมาณประจำปี</div>',
                                    'attribute' => 'material_type_id',
                                    'encodeLabel' => false,
                                    'format' => 'raw',
                                    'value' => function ($dataProvider, $key, $index, $column) {
                                        $detail = "25" . $dataProvider->order_budget_per_year;
                                        return $detail;
                                    }
                                ],
                                'order_id',
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{custom_view}',
                                    'options' => ['style' => 'width:220px'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model1) {
                                            /* @var $model1 \app\modules\eoffice_materialsys\models\MatsysOrder */
                                            // Html::a args: title, href, tag properties.
                                            if ($model1->order_status == '0' && $model1->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">                                   
                                                        <a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail' . $model1->order_id . '"> แสดงรายการเบิก</a>
                                                    </span>
                                                    <span class="label label-warning">รอการอนุมัติ</span>';
                                            } else if ($model1->order_status == '1' && $model1->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">                                   
                                                        <a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail' . $model1->order_id . '"> แสดงรายการเบิก</a>
                                                    </span>
                                                    <span class="label label-success">อนุมัติแล้ว</span>';
                                            } else if ($model1->order_status == '2' && $model1->order_status_confirm == 'confirm') {
                                                return '<span class="btn-group btn-group-xs text-center" role="group">                                   
                                                        <a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDetail' . $model1->order_id . '"> แสดงรายการเบิก</a>
                                                    </span>
                                                    <span class="label label-danger">ปฏิเสธการอนุมัติ</span>';
                                            } else if ($model1->order_status_confirm == 'unconfirm') {
                                                return '<span class="label label-default">รายการเบิกที่ไม่ได้ส่งคำร้องขอเบิกวัสดุ</span>';
                                            }
                                        }
                                        ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <?php yii\widgets\Pjax::end() ?>

                    <!-- =========================================== Modal Detail ===================================================== -->
                    <?php foreach ($model as $order) {
                        $count = 1; ?>
                        <div id="myDetail<?= $order->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-full" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">รายการเบิกวัสดุ
                                            <small> (เลขที่ใบเบิก <?= $order->order_id ?>)</small>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="padding-20"></div>
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
                                            <?php foreach ($model_order as $order_mat) { ?>
                                                <?php if ($order->order_id == $order_mat->order_id) { ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td><?= $order_mat->material_id ?></td>
                                                        <td>
                                                            <img src="/cs-e-office/web/web_mat/images/<?= $order_mat->material->material->material_image ?>"
                                                                 width="70" height="70">
                                                        </td>
                                                        <td><?= $order_mat->material->material->material_name ?></td>
                                                        <?php if ($order->order_status == '1' && $order->order_status_confirm == 'confirm') { ?>
                                                            <td><?= $order_mat->material_amount_receive ?></td>
                                                        <?php } else { ?>
                                                            <td><?= $order_mat->material_amount ?></td>
                                                        <?php } ?>
                                                        <td><?= $order_mat->material->material->material_unit_name ?></td>
                                                        <?php $price = $order_mat->material_amount ?>

                                                        <?php $amount = $order_mat->material->bill_detail_price_per_unit ?>
                                                        <td><?= $amount ?></td>
                                                        <td><?= $price * $amount ?></td>
                                                    </tr>
                                                    <?php $count++;
                                                }
                                            } ?>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if ($order->order_status == '1') { ?>
                                            <div class="padding-20">
                                                <div class="col-md-2">
                                                    <label><b>รายละเอียดการเบิก</b></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea name="order_desc" maxlength="200" rows="4"
                                                              class="form-control" style="resize: none"
                                                              disabled><?= " " . $order->order_cancel_description ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="padding-20">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        ยกเลิก
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } else if ($order->order_status == '2') { ?>
                                            <div class="padding-20">
                                                <div class="col-md-2">
                                                    <label><b>รายละเอียดการปฏิเสธการเบิก</b></label>
                                                </div>
                                                <div class="col-md-10">
                                                    <textarea name="order_desc" maxlength="200" rows="4"
                                                              class="form-control" style="resize: none"
                                                              disabled><?= " " . $order->order_cancel_description ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="padding-20">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        ยกเลิก
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- =========================================== Modal Detail ===================================================== -->
                </div>
            </div>
        </div>
    </div>
</div>