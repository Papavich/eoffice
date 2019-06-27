<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $item app\modules\eoffice_materialsys\models\MatsysOrder */
/* @var $item_mat app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial */
/* @var $item_return \app\modules\eoffice_materialsys\models\MatsysOrderReturn */
?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>การคืนวัสดุ</h4></strong> <!-- panel title -->
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
                                'order_budget_per_year',
                                'order_id',
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{custom_view}',
                                    'options' => ['style' => 'width:295px'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model1) {
                                            /* @var $model1 \app\modules\eoffice_materialsys\models\MatsysOrder */
                                            // Html::a args: title, href, tag properties.
                                            if ($model1->order_status == '1' && $model1->order_status_confirm == 'confirm') {
                                                if ($model1->order_status_return == '0' && $model1->order_status_confirm == 'confirm') {
                                                    return '<span class="btn-group btn-group-xs text-center" role="group">           
                                                        <span><a class="glyphicon glyphicon-zoom-in btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#order_detail' . $model1->order_id . '"> แสดงรายการเบิก</a></span>
                                                        <span><a class="glyphicon glyphicon-edit btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#order_return' . $model1->order_id . '"> คืนวัสดุ</a></span>
                                                        <span class="label label-danger">ยังไม่คืน</span>                      
                                                    </span>';
                                                } else if ($model1->order_status_return == '1' && $model1->order_status_confirm == 'confirm') {
                                                    return '<span class="btn-group btn-group-xs text-center" role="group">
                                                        <span><a class="glyphicon glyphicon-edit btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#order_return' . $model1->order_id . '"> แสดงรายการคืนวัสดุ</a></span>
                                                        <span class="label label-warning">รอการตรวจสอบ</span>                        
                                                    </span>';
                                                } else if ($model1->order_status_return == '2' && $model1->order_status_confirm == 'confirm') {
                                                    return '<span class="btn-group btn-group-xs text-center" role="group">
                                                        <span><a class="glyphicon glyphicon-edit btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#order_return' . $model1->order_id . '"> แสดงรายการคืนวัสดุ</a></span>
                                                        <span class="label label-success">คืนแล้ว</span>                       
                                                    </span>';
                                                }
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

<!-- Modal Detail-->
<?php foreach ($models as $item) { ?>
    <div class="modal fade" id="order_detail<?= $item->order_id ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-full" role="document">
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
                            <th class="col-lg-1">รูปภาพ</th>
                            <th class="col-lg-2">รายการ</th>
                            <th class="col-lg-1">จำนวนที่เบิก</th>
                            <th class="col-lg-1">หน่วยนับ</th>
                            <th class="col-lg-1">ราคาต่อหน่วย</th>
                            <th class="col-lg-1">ราคารวม</th>
                        </tr>
                        <tr>
                            <?php $count = 1; ?>
                            <?php foreach ($order_mat as $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id){ ?>
                            <td><?= $count ?></td>
                            <td><?= $item_mat->material_id ?></td>
                            <td>
                                <img src="/cs-e-office/web/web_mat/images/<?= $item_mat->material->material->material_image ?>"
                                     width="70" height="70">
                            </td>
                            <td><?= $item_mat->material->material->material_name ?></td>
                            <td><?= $item_mat->material_amount_receive ?></td>
                            <td><?= $item_mat->material->material->material_unit_name ?></td>
                            <?php
                            $price = $item_mat->material->bill_detail_price_per_unit;
                            $amount = $item_mat->material_amount_receive; ?>
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
                    <?php if ($item->order_status == '1') { ?>
                        <div class="padding-20">
                            <div class="col-md-2">
                                <label><b>รายละเอียดการเบิก</b></label>
                            </div>
                            <div class="col-md-10">
                                                    <textarea name="order_desc" maxlength="200" rows="4"
                                                              class="form-control" style="resize: none"
                                                              disabled><?= " " . $item->order_cancel_description ?>
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
                    <?php } else if ($item->order_status == '2') { ?>
                        <div class="padding-20">
                            <div class="col-md-2">
                                <label><b>รายละเอียดการปฏิเสธการเบิก</b></label>
                            </div>
                            <div class="col-md-10">
                                                    <textarea name="order_desc" maxlength="200" rows="4"
                                                              class="form-control" style="resize: none"
                                                              disabled><?= " " . $item->order_cancel_description ?>
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
<!-- Modal Detail-->

<?php $check = 0;
$loop = count($models);
?>


<!-- Modal Return-->
<?php foreach ($models as $item) { ?>
    <div class="modal fade" id="order_return<?= $item->order_id ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-full" role="document">
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
                            <?php if ($item->order_status_return == 0) { ?>
                            <?php $count = 1; ?>
                            <?php foreach ($order_mat as $key => $item_mat) { ?>
                            <?php if ($item->order_id == $item_mat->order_id) { ?>
                            <input type="hidden" name="material_id<?= $key ?>" value="<?= $item_mat->material_id ?>">
                            <input type="hidden" name="order_id<?= $key ?>" value="<?= $item_mat->order_id ?>">
                            <input type="hidden" name="stock_id<?= $key ?>"
                                   value="<?= $item_mat->material->bill_master_id ?>">
                            <td><?= $count ?></td>
                            <td><?= $item_mat->material_id ?></td>
                            <td>
                                <img src="<?= Yii::getAlias('@web') ?>/web_mat/images/<?= $item_mat->material->material->material_image ?>"
                                     width="70" height="70">
                            </td>
                            <td><?= $item_mat->material->material->material_name ?></td>
                            <?php if ($item->order_status_return == 0) { ?>
                                <td><input type="number" id="order_return_amount[]" name="order_return_amount[]"
                                           onchange="CheckAmount(this.value,'<?= $key ?>');"
                                           value="<?= $item_mat->material_amount_receive ?>" min="0"
                                           max="<?= $item_mat->material_amount_receive ?>" class="cs-amount-table">
                                    / <?= $item_mat->material_amount_receive ?></td>
                            <?php } ?>
                            <td><?= $item_mat->material->material->material_unit_name ?></td>
                            <?php $price = $item_mat->material->bill_detail_price_per_unit;
                            $amount = $item_mat->material_amount_receive;
                            ?>
                            <td><?= $price ?></td>
                            <td><?= $price * $amount ?></td>
                        </tr>
                        <?php
                        $count++;
                        } ?>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($item->order_status_return == 1 || $item->order_status_return == 2) { ?>
                            <?php foreach ($order_return as $key => $item_return) { ?>
                                <?php if ($item->order_id == $item_return->order_id && $item_return->order_return_amount != 0) { ?>
                                    <td><?= $count ?></td>
                                    <td><?= $item_return->material_id ?></td>
                                    <td>
                                        <img src="<?= Yii::getAlias('@web') ?>/web_mat/images/<?= $item_return->material->material->material_image ?>"
                                             width="70" height="70">
                                    </td>
                                    <td><?= $item_return->material->material->material_name ?></td>
                                    <td><?= $item_return->order_return_amount ?></td>
                                    <td><?= $item_return->material->material->material_unit_name ?></td>
                                    <?php $price = $item_return->material->bill_detail_price_per_unit;
                                    $amount = $item_return->order_return_amount;
                                    ?>
                                    <td><?= $price ?></td>
                                    <td><?= $price * $amount ?></td>
                                    </tr>
                                    <?php
                                    $count++;
                                } ?>
                            <?php } ?>
                        <?php } ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <?php if ($item->order_status_return == 0) { ?>
                        <a class="btn btn-success btn-3d" data-toggle="modal"
                           data-target="#mySubmit<?= $item->order_id ?>"><i class="glyphicon glyphicon-ok">
                                ยืนยันการคืนวัสดุ</i></a>
                        <a class="btn btn-danger btn-3d" data-toggle="modal" data-target="#myCancel"><i
                                    class="glyphicon glyphicon-remove"> ยกเลิกการคืนวัสดุ</i></a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- Modal Return-->
<?php foreach ($models as $item) { ?>
    <!-- ============================= modal Submit ====================================-->
    <div id="mySubmit<?= $item->order_id ?>" class="modal fadeIn" tabindex="-1" role="alertdialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <h4 class="modal-title" id="myModalLabel">คุณต้องการยืนยันรายการคืนใช่หรือไม่</h4>
                </div>
                <!--                --><?php //if($check == key($order)){ ?>
                <!--                    --><?php //echo 'รหัสที่อยากได้'.$item->order_id ?>
                <!--                --><?php //} ?>
                <?php $form = ActiveForm::begin(['action' => ['returnsubmit'],]) ?>
                <div class="modal-body" align="center">
                    <?php foreach ($order_mat as $key => $item_mat) { ?>
                        <?php if ($item->order_id == $item_mat->order_id) { ?>
                            <input type="hidden" name="bill_id[]" value="<?= $item_mat->bill_master_id ?>">
                            <input type="hidden" name="order_ai[]" value="<?= $item_mat->order_id_ai ?>">
                            <input type="hidden" name="order_id_check[]" value="<?= $item->order_id ?>">
                            <input type="hidden" name="mat_id_check[]" value="<?= $item_mat->material_id ?>">
                            <input type="hidden" name="stock_id_check[]"
                                   value="<?= $item_mat->material->bill_master_id ?>">
                            <input type="hidden" id="order_return_amount<?= $key ?>" name="order_return_amount[]">
                            <input type="hidden" name="order_return_amount_default[]"
                                   value="<?= $item_mat->material_amount_receive ?>">
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
<div id="myCancel" class="modal fadeIn" tabindex="-1" role="alertdialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title" id="myModalLabel">คุณต้องการยกเลิกรายการคืนใช่หรือไม่</h4>
            </div>
            <div class="modal-body" align="center">
                <a href="<?= Yii::getAlias('@web') ?>/eoffice_materialsys/orderreturnuser/index"
                   class="btn btn-success btn-3d">ยืนยัน</a>
                <a class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================= modal deleteCart ====================================-->

<script>
    function CheckAmount(val, key) {
        $('#order_return_amount' + key).val(val);
        $('#order_return_amount1' + key).val(val);
    }
</script>