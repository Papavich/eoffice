<?php

use yii\grid\GridView;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\FunDate;
use \app\modules\eoffice_materialsys\models\User;

//CSS Page
$this->registerCssFile('@mat_assets/allmaterial/css/allmaterial.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//JS Page
$this->registerJsFile('@mat_assets/listbill/js/script-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);

$this->registerJsFile('@mat_plugin/bootstrap.daterangepicker/moment.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@mat_plugin/timepicki/timepicki.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);


?>

<header id="page-header" style="margin-bottom: 20px">
    <h1>ใบนำเข้าวัสดุ</h1>
    <ol class="breadcrumb">
        <li><a href="#">ใบนำเข้าวัสดุ</a></li>
    </ol>
</header>
<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto panel-heading-height">
        <form style="margin: 0;width: 100%">
        <span class="elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">ใบนำเข้าวัสดุ</strong> <!-- panel title -->
        </span>
            <div class="pull-right">
                <button class="btn btn-info" type="submit" style="height: 34px !important;">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
            <div class="pull-right margin-right-10" style="width: 250px">
                <input type="text" name="search" id="searchMaterial" class="form-control"
                       placeholder="ค้นหาใบนำเข้า"/>
            </div>
            <div class="pull-right" style="margin-right: 10px">
                <input type="hidden" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                <input type="text" name="date" class="form-control rangepicker" data-format="yyyy-mm-dd" >
            </div>
            <div class="pull-right">
                <label style="vertical-align: middle;margin-top: 5px;">วันเดือนปี : </label>
            </div>
        </form>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <?php
        echo GridView::widget(['dataProvider' => $dataProvider,
            'columns' => [

                [ // Type
                    'label' => '<div>วัน/เดือน/ปี<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'bill_master_date',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div>" . FunDate::dateThaisecTime($dataProvider->bill_master_date) . "</div>";
                        return $detail;
                    }
                ],
                [ //
                    'label' => "<div>รายละเอียด<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                    'encodeLabel' => false,
                    'attribute' => 'bill_master_id',
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-5',
                    ],
                    'value' => function ($dataProvider) {
                        $detail = "<div><b>ใบบันทึกข้อความ : </b>$dataProvider->bill_mater_record</div>";
                        $detail .= "<div><b>ใบสั่งซื้อวัสดุ : </b>$dataProvider->bill_master_id<b class='margin-left-20'>เล่มใบสั่งซื้อวัสดุ : $dataProvider->bill_master_id_no</b></div>";
                        $detail .= "<div><b>ใบตรวจรับพัสดุ : </b>$dataProvider->bill_master_check</div>";
                        return $detail;
                    }

                ],
                [ // Type
                    'label' => '<div>ไฟล์ข้อมูล<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'bill_master_pdf',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-3',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div><a target='_blank' href='" . Yii::$app->homeUrl . "web_mat/pdf/success/$dataProvider->bill_master_pdf.pdf'  style='width: 100%' class='btn btn-default btn-sm'>Download <i class=\"fa fa-download\" style='vertical-align: middle;color: #337ab7;padding-left: 5px;font-size: 20px' aria-hidden=\"true\"></i></a></div>";
                        return $detail;
                    }
                ],
                [ // Type
                    'label' => '<div>รายละเอียดวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                    'attribute' => 'person_id',
                    'encodeLabel' => false,
                    'format' => 'raw',
                    'headerOptions' => [
                        'class' => 'col-md-2',
                    ],
                    'value' => function ($dataProvider, $key, $index, $column) {
                        $detail = "<div><a href='detailview?id=$dataProvider->bill_master_id' style='width: 100%' class='btn btn-default btn-sm'>รายละเอียด <i class=\"fa fa-plus-circle\" style='vertical-align: middle;color: #337ab7;padding-left: 5px;font-size: 20px' aria-hidden=\"true\"></i></a></div>";
                        return $detail;
                    }
                ],
            ],
        ]);
        ?>

    </div>
</div>