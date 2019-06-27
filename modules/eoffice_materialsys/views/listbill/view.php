
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\FunDate;


//CSS Page
$this->registerCssFile('@mat_assets/material/css/material.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);

//JS Page
$this->registerJsFile('@mat_assets/material/js/view-script.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

//Pick TH
$this->registerCssFile('@mat_components/datepick/jquery.datetimepicker.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/datepick/jquery.datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterial */

?>
<div class="matsys-material-index">
    <!-- Head -->
    <header id="page-header" style="margin-bottom: 20px">
        <h1>ใบนำเข้าวัสดุ</h1>
        <ol class="breadcrumb">
            <li><a href="../listbill">ใบนำเข้าวัสดุ</a></li>
            <li><a href="#">รายละเอียด</a></li>
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
                        <strong class="topic-import">รายละเอียดใบนำเข้าวัสดุ</strong>
                    </div>
                    <div class="col-md-5 title-detail">
                        <div>
                            <span>วันที่ใบนำเข้าวัสดุ </span>:<span> <?= FunDate::dateThaisecTime($model->bill_master_date) ?></span>
                        </div>
                        <div>
                            <span>ใบสั่งซื้อวัสดุ </span>:<span> <?= $model->bill_master_id ?></span>
                        </div>
                        <div>
                            <span>เล่มใบสั่งซื้อวัสดุ </span>:<span> <?= $model->bill_master_id_no ?></span>
                        </div>
                    </div>
                    <div class="col-md-7 title-detail">
                        <div>
                            <span>ใบบันทึกข้อความ </span>:<span> <?= $model->bill_mater_record ?></span>
                        </div>
                        <div>
                            <span>สั่งซื้อจากบริษัท </span>:<span> <?= $model->company->company_name ?></span>
                        </div>
                        <div>
                            <span>ใบตรวจรับพัสดุ </span>:<span> <?= $model->bill_master_check ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => "<div>วัสดุ<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-5',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div><a href='../material/view?id=$dataProvider->material_id'>" . $dataProvider->material->material_name . "</a></div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>จำนวน<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detaill_amount . "</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>ราคาต่อหน่วย<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detail_price_per_unit . " บาท</div>";
                        return $text;
                    }
                ],
                [
                    'label' => "<div>ราคารวม<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $text = "<div class='pull-right'>" . $dataProvider->bill_detail_price_per_unit*$dataProvider->bill_detaill_amount . " บาท</div>";
                        return $text;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
