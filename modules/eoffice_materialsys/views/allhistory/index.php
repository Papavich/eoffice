<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use app\modules\eoffice_materialsys\models\FunDate;
use app\modules\eoffice_materialsys\models\User;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;

/* @var $this yii\web\View */
/* @var $item app\modules\eoffice_materialsys\models\MatsysOrder */
/* @var $item_mat app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial */
/* @var $form yii\widgets\ActiveForm */
/* @var $form1 yii\widgets\ActiveForm */

//Export Excel
$this->registerJsFile('@mat_components/excelexport2/jquery.table2excel.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/FileSaver.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/Blob.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/xls.core.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/tableexport.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//My Export
$this->registerJSFile('@mat_assets/allhistory/js/myExport.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="padding-10">
    <div id="export" class="matsys-material-index">
        <!-- Head -->
        <header id="page-header" style="margin-bottom: 20px;height: 65px;">
            <div class="pull-left">
                <h4 style="margin: 0 !important;"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                    ประวัติการเบิกวัสดุ</h4>
                <ol style="margin: 0 !important;padding: 0px 20px;" class="breadcrumb">
                    <li><a href="#">ประวัติการเบิกวัสดุ</a></li>
                </ol>
            </div>
        </header>
        <div id="panel-misc-portlet-r2" class="panel panel-default margin-bottom-20">

            <div class="panel-heading">

                <!-- tabs nav -->
                <ul class="nav nav-tabs pull-left">
                    <li class="active"><!-- TAB 1 -->
                        <a href="#ttab1l_nobg" data-toggle="tab" aria-expanded="false">
                            สรุปงบประมาณจากการค้นหาระหว่างวันที่
                        </a>
                    </li>
                    <li class=""><!-- TAB 2 -->
                        <a href="#ttab2l_nobg" data-toggle="tab" aria-expanded="true">
                            สรุปงบประมาณจากการค้นหาปีงบประมาณ
                        </a>
                    </li>
                </ul>
                <!-- /tabs nav -->

                &nbsp; <!-- needed if title missing . avoid using .clearfix -->

                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom"
                           data-original-title="Colapse"></a></li>
                </ul>
                <!-- /right options -->

            </div>

            <!-- panel content -->
            <div class="panel-body">

                <!-- tabs content -->
                <div class="tab-content transparent">

                    <div id="ttab1l_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>จากวันที่ :</label>
                                    <input type="text" name="dateFirst" placeholder="ปี-เดือน-วัน"
                                           class="form-control datepicker"
                                           data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" required>
                                </div>
                                <div class="col-md-4">
                                    <label>ถึงวันที่ : </label>
                                    <input type="text" name="dateSecond" placeholder="ปี-เดือน-วัน"
                                           class="form-control datepicker"
                                           data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" required>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-default" id="dateSearch" data-id="ttab1l_nobg"
                                            style="margin-top:25px;width: 100% "><i
                                                class="glyphicon glyphicon-search"></i> ค้นหา
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /TAB 1 CONTENT -->

                    <div id="ttab2l_nobg" class="tab-pane "><!-- TAB 2 CONTENT -->
                        <form>
                            <div class="row">
                                <div class="col-md-8">
                                    <label>ปีงบประมาณ :</label>
                                    <input type="number" name="budget" placeholder="ปีงบประมาณ" class="form-control"
                                           required>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-default" type="submit" style="margin-top:25px;width: 100% ">
                                        <i class="glyphicon glyphicon-search"></i> ค้นหา
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /TAB 1 CONTENT -->

                </div>
                <!-- /tabs content -->

            </div>
            <!-- /panel content -->

        </div>
    </div>
    <div class="panel panel-default">
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div class="panel panel-default">


                    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>

                    <div class="panel-body">
                        <button name="export" class="btn btn-success btn-sm pull-right">ออกรายงาน</button>
                        <div id="table-report">
                            <table id="exportExcel" class="table table-bordered">
                                <tr>
                                    <th>ปีงบประมาณะ</th>
                                    <th>วันที่เบิกวัสดุ</th>
                                    <th>รหัสใบเบิกวัสดุ</th>
                                    <th>ผูเบิกวัสดุ</th>
                                    <th></th>
                                    <th colspan="3">รายการ</th>
                                    <th></th>
                                    <th>ราคารวม</th>
                                    <td>หมายเหตุ</td>
                                </tr>
                                <?php
                                $newQuery = clone $dataProvider->query;
                                $model_order = $newQuery->all();
                                foreach ($model_order as $key => $value) {
                                    $sum = 0;
                                    $item = MatsysOrderHasMaterial::find()
                                        ->where('order_id = :order_id', [':order_id' => $value->order_id])
                                        ->all();
                                    ?>
                                    <tr>
                                        <td>25<?= $value->order_budget_per_year ?></td>
                                        <td><?= FunDate::dateThaisecTime($value->order_date) ?></td>
                                        <td><?= $value->order_id ?></td>
                                        <td><?= User::getFullname($value->person_id) ?></td>
                                        <td>รายการ</td>
                                        <td>จำนวน/หน่วยนับ</td>
                                        <td>ราคาต่อหน่วย</td>
                                        <?php foreach ($item as $key2 => $value2) {
                                        $sum += ($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit);
                                        ?><?php } ?>
                                        <td><?= number_format($sum, 2) ?> บาท</td>
                                        <td>
                                            <?php
                                                if($value->order_status == '1'){
                                                    echo "อนุมัติ";
                                                }else{
                                                    echo "ปฏิเสธ";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php foreach ($item as $key2 => $value2) {
                                        ?>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?= $value2->materialdetail->material_name ?></td>
                                    <td><?= $value2->material_amount_receive ?> <?= $value2->materialdetail->material_unit_name ?></td>
                                    <td><?= number_format(($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit), 2) ?></td>
                                    <td></td>
                                    </tr>
                                    <?php } ?>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
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
                                [ // Type
                                    'label' => '<div>งบประมาณประจำปี<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                                    'attribute' => 'material_type_id',
                                    'encodeLabel' => false,
                                    'format' => 'raw',
                                    'value' => function ($dataProvider, $key, $index, $column) {
                                        $detail = "25" . $dataProvider->order_budget_per_year;
                                        return $detail;
                                    }
                                ],
                                [
                                    'attribute' => 'ชื่อผู้เบิกวัสดุ',
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
                                        <p><b>ปีงบประมาณ</b> : 25<?= $item->order_budget_per_year ?></p>
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
                                        <p><b>ปีงบประมาณ</b> : 25<?= $item->order_budget_per_year ?></p>
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
                                        <p><b>ปีงบประมาณ</b> : 25<?= $item->order_budget_per_year ?></p>
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
                                        <p><b>ปีงบประมาณ</b> : 25<?= $item->order_budget_per_year ?></p>
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
                                        <textarea maxlength="200" rows="4" class="form-control" style="resize: none"
                                                  disabled><?= $item->order_cancel_description ?>
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
                               value="<?= \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                                        <?= \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
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
                               value="<?= \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->person_name ?>
                                        <?= \app\modules\eoffice_materialsys\models\Person::findOne(Yii::$app->user->identity->getId())->person_surname ?>">
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
<!-- Modal Error repeatedly -->
<div class="modal fade" id="ModalErrorrdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <b style="font-size: 20px">ไม่สามารถค้นหาได้ เนื่องจากวันที่ไม่ถูกต้อง</b>
            </div>
        </div>
    </div>
</div>

<script>
    function CheckAmount(val, key) {
        $('#order_amount' + key).val(val);
    }
</script>