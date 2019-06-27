<?php

use yii\grid\GridView;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\FunDate;
use \app\modules\eoffice_materialsys\models\User;

//CSS Page
$this->registerCssFile('@mat_assets/listwiden/css/listwiden.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//CSS Page
$this->registerCssFile('@mat_assets/allmaterial/css/allmaterial.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//JS Page
$this->registerJsFile('@mat_assets/listwiden/js/script-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);


?>

<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto panel-heading-height">
        <span class="elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">อนุมัติการเบิกวัสดุ</strong> <!-- panel title -->
        </span>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <?php
        echo GridView::widget(['dataProvider' => $dataProvider,
            'columns' => [

                [ // Type
                    'label' => '<div>วัน/เดือน/ปี<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'order_date',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div>" . FunDate::dateThaisecTime($dataProvider->order_date) . "</div>";
                        return $detail;
                    }
                ],
                [ // Name && Detail
                    'label' => "<div>เลขที่ใบเบิก<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'order_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider) {
                        $detail = "<div>$dataProvider->order_id</div>";
                        return $detail;
                    }

                ],
                [ // Type
                    'label' => '<div>ผู้เบิกวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'person_id',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-4',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div>" . User::getFullname($dataProvider->person_id) . "</div>";
                        return $detail;
                    }
                ],
                [ // Type
                    'label' => '<div>รายละเอียดการเบิก<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'person_id',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div><button data-iduser='" . $dataProvider->person_id . "' data-id='" . $dataProvider->order_id . "' name='showdetail' style='width: 100%' class='btn btn-default btn-sm'>รายละเอียดการเบิก <i class=\"fa fa-plus-circle\" style='vertical-align: middle;color: #337ab7;padding-left: 5px;font-size: 20px' aria-hidden=\"true\"></i></button></div>";
                        return $detail;
                    }
                ],
            ],
        ]);
        ?>

    </div>
</div>
<!-- Modal Showdetail -->
<div class="modal fade" id="ModalShowDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">รายละเอียดการเบิกวัสดุ</h4>
            </div>
            <div class="modal-body">
                <div class="margin-bottom-10">
                    <div class="pull-right"><b>เลขที่ใบเบิก </b>: <span id="modal-order_id"></span></div>
                    <div><b>ชื่อ-นามสกุล </b>: <span id="modal-name"></span></div>
                    <div><b>รายละเอียดการนำไปใช้ : </b><span id="modal-detail"></span></div>
                    <div style="display: inline-block;vertical-align: top"><b style="vertical-align: top">E-mail : </b>
                        <span id="modal-email" style="display:inline-block;width: 200px;: "></span></div>
                    <div style="display: inline-block;vertical-align: top"><b
                                style="vertical-align: top">เบอร์โทรศัพท์ </b>: <span id="modal-phone"
                                                                                      style="display:inline-block;width: 200px;: "></span>
                    </div>
                </div>
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th class="col-md-2">รหัสวัสดุ</th>
                            <th class="col-md-4" style="text-align: center">ชื่อวัสดุ</th>
                            <th class="col-md-3" style="text-align: center">จำนวนที่เบิก</th>
                            <th class="col-md-3" style="text-align: center">จำนวนที่อนุมัติ</th>
                        </tr>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn-confirm" class="btn btn-primary btn-sm" data-dismiss="modal">
                    อนุมัติการเบิก
                </button>
                <button type="button" name="btn-cancel" class="btn btn-danger btn-sm" data-dismiss="modal">
                    ปฏิเสธการอนุมัติ
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirm -->
<div class="modal fade" id="ModalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ยืนยันการอนุมัติ</h4>
            </div>
            <div class="modal-body" style="text-align: center">
                <label>รายละเอียด - สถานที่รับสิงของ</label>
                <textarea name="detail" class="form-control" rows="3"></textarea>
                <div class="margin-top-10" style="height: 25px !important;">
                    <div class="pull-right">
                        <button type="button" name="confirm" class="btn btn-primary btn-sm">
                            ยืนยันการอนุมัติ
                        </button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิกการอนุมัติ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal cancel -->
<div class="modal fade" id="Modalcancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ปฏิเสธการอนุมัติ</h4>
            </div>
            <div class="modal-body">
                <label>รายละเอียดการปฏิเสธ</label>
                <textarea name="detail-cancel" class="form-control" rows="3"></textarea>
                <div class="margin-top-10" style="height: 25px !important;">
                    <div class="pull-right">
                        <button type="button" name="cancel" class="btn btn-danger btn-sm">ยืนยันการปฏิเสธ</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิกการปฏิเสธ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
