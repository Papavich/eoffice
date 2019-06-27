<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysMaterial;


//CSS Page
$this->registerCssFile('@mat_assets/material/css/material.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

//JS Page
$this->registerJsFile('@mat_assets/material/js/view-script.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//Pick TH
$this->registerCssFile('@mat_components/datepick/jquery.datetimepicker.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/datepick/jquery.datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterial */

$this->title = $model->material_id;
$this->params['breadcrumbs'][] = ['label' => 'Matsys Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-material-index">
    <!-- Head -->
    <header id="page-header" style="margin-bottom: 20px">
        <h1>จัดการวัสดุ</h1>
        <ol class="breadcrumb">
            <li><a href="../material">จัดการวัสดุ</a></li>
            <li><a href="#">รายละเอียดวัสดุ</a></li>
        </ol>
    </header>
</div>
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto panel-heading-height">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="title col-md-8 ">
                        <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>
                        <strong class="topic-import">รายละเอียดวัสดุ : <?= $model->material_name ?></strong>
                    </div>
                    <div class="col-md-5 title-detail">
                        <div>
                            <span>รหัสวัสดุ </span>:<span> <?= $model->material_id ?></span>
                        </div>
                        <div>
                            <span>ชื่อวัสดุ </span>:<span> <?= $model->material_name ?></span>
                        </div>
                        <div>
                            <span>รายละเอียด </span>:<span> <?= $model->material_detail ?></span>
                        </div>
                        <div>
                            <span>การแจ้งเตือน </span>:<span> <?= $model->material_amount_check ?></span>
                        </div>
                    </div>
                    <div class="col-md-7 title-detail">
                        <div>
                            <span>ชื่อหน่วยนับ </span>:<span> <?= $model->material_unit_name ?></span>
                        </div>
                        <div>
                            <span>สถานที่จัดเก็บ </span>:<span> <?= $model->location->location_name ?></span>
                        </div>
                        <div>
                            <span>ประเภทวัสดุ </span>:<span> <?= $model->materialType->material_type_name ?></span>
                        </div>
                        <div>
                            <span>ดูรูปภาพ</span>:<a href="#" data-toggle="modal" data-target="#Image"> ดูรูปภาพ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class=" pull-right">
                    <div class="pull-right" style="margin-left: 10px ">
                        <?= Html::a('แก้ไขข้อมูลวัสดุ', ['update', 'id' => $model->material_id], ['class' => 'btn btn-info btn-sm']) ?>

                        <a name='btn-delete' data-id='<?= $model->material_id ?>' class='btn btn-sm btn-danger'><span class=\"glyphicon glyphicon-trash\"></span> ลบวัสดุ</a>
                    </div>
                    <div class="pull-right">
                        <div class="title-amount">
                            <strong>คงเหลือ
                                : <?= MatsysMaterial::amountAll($model->material_id) ?> <?= $model->material_unit_name ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Panel content -->
    <?php
    $url_param = Yii::$app->request->queryParams;
    $dateSort = 'date';
    $all_price = 'price';
    if (isset($url_param['sort'])) {
        if ($url_param['sort'] != null) {
            if ($url_param['sort'] == 'date') {
                $dateSort = '-date';
            } elseif ($url_param['sort'] == '-date') {
                $dateSort = 'date';
            } elseif ($url_param['sort'] == 'price') {
                $all_price = '-price';
            } elseif ($url_param['sort'] == '-price') {
                $all_price = 'price';
            }
        }
    }
    ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 pull-right margin-bottom-10">
                <form action="" style="margin-bottom: 0">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="search" id="datesearch" data-provide="datepicker" class="form-control input-lg" placeholder="ค้นหาวัสดุ" required/>
                        <input type="hidden" name="id" value="<?= $model->material_id ?>">
                        <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>

                    </div>
                </div> </form>
            </div>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => "<a href='" . Yii::$app->homeUrl . Yii::$app->controller->module->id . "/material/view?id=" . $model->material_id . "&sort=" . $dateSort . "'><div>วันที่นำเข้า<i class='fa fa-sort pull-right' aria-hidden='true'></i></div></a>",
                    'encodeLabel' => false,
                    'attribute' => 'date',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div>" . MatsysBillDetail::dateThai($dataProvider->billMaster->bill_master_date) . "</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>เลขที่ใบนำเข้า<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div><a href='../listbill/detailview?id=$dataProvider->bill_master_id'>" . $dataProvider->bill_master_id . "</a></div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>ราคาต่อหน่วย<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_detail_price_per_unit',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detail_price_per_unit . " บาท</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>จำนวนทั้งหมด<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_detaill_amount',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-1',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detaill_amount . "</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>จำนวนคงเหลือ<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_detail_use_amount',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-1',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detail_use_amount . "</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<a href='" . Yii::$app->homeUrl . Yii::$app->controller->module->id . "/material/view?id=" . $model->material_id . "&sort=" . $all_price . "'><div>ราคารวม<i class='fa fa-sort pull-right' aria-hidden='true'></i></div></a>",
                    'encodeLabel' => false,
                    'attribute' => 'all_price',
                    'format' => 'html',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . ($dataProvider->bill_detaill_amount * $dataProvider->bill_detail_price_per_unit) . " บาท</div>";
                        return $text;
                    }
                ],
            ],
        ]); ?>
    </div>
    <!-- Modal Image -->
    <div class="modal fade" id="Image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">รูปภาพ</h4>
                </div>
                <div class="modal-body modal-center">
                    <img src="<?= Yii::$app->homeUrl ?>/web_mat/images/<?= $model->material_image ?>" style="width: 570px;">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Error Delete -->
    <div class="modal fade" id="ErrorModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">ไม่สามารถลบวัสดุได้
                    </h4>
                </div>
                <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                    <i class="glyphicon glyphicon-warning-sign"></i><b> วัสดุถูกใช้งานหรือถูกอ้างอิง</b>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Success Delete -->
    <div class="modal fade" id="ConfirmModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">ยืนยันการลบวัสดุ</h4>
                </div>
                <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                    <a href="#" class="btn btn-danger" name="confirm-delete" data-dismiss="modal">ยืนยัน</a>
                    <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Success Delete -->
    <div class="modal fade" id="SuccessModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">สถานะ
                    </h4>
                </div>
                <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                    <b>ลบรายการสำเร็จ</b>
                </div>
            </div>
        </div>
    </div>
</div>
