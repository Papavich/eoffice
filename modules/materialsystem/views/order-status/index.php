<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $order app\modules\materialsystem\models\MatsysOrder */
/* @var $order_mat app\modules\materialsystem\models\MatsysOrderHasMaterial */
?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>ตารางสถานะการเบิก</h4></strong> <!-- panel title -->
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
                            'rowOptions' => function ($model, $key, $index, $grid) {
                                /* @var $model app\modules\materialsystem\models\MatsysOrder */
                                if ($model->order_status_confirm == 'confirm') {
                                    return ['class' => 'yii\grid\ActionColumn'];
                                } else {
                                    return [];
                                }
                            },
                            'tableOptions' => [
                                'class' => 'table table-striped table-bordered table-hover',
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'order_date',
                                'order_budget_per_year',
                                'order_id',
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{custom_view}',
                                    'options' => ['style' => 'width:204px'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model1) {
                                            /* @var $model1 \app\modules\materialsystem\models\MatsysOrder */
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
                    <?php yii\widgets\Pjax::end() ?>/
                </div>
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
<?php foreach ($models as $order) {
    $count = 1; ?>
    <div id="myDetail<?= $order->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
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
                                    <td><?= $order_mat->material_amount ?></td>
                                    <td><?= $order_mat->material->material->material_unit_name ?></td>
                                    <?php $price = $order_mat->material_amount;
                                    $amount = $order_mat->material->bill_detail_price_per_unit
                                    ?>
                                    <td><?= $amount ?></td>
                                    <td><?= $price * $amount ?></td>
                                </tr>
                                <?php $count++;
                            }
                        } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- =========================================== Modal Detail ===================================================== -->