<?php

//JS Chart
$this->registerJsFile('@mat_plugin/chart.chartjs/Chart.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//JS Page
$this->registerJsFile('@mat_assets/report/js/script-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@mat_assets/report/js/chart-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//Export Excel
$this->registerJsFile('@mat_components/excelexport2/jquery.table2excel.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/FileSaver.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/Blob.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/xls.core.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@mat_components/excelexport/tableexport.js', ['depends' => [yii\web\JqueryAsset::className()]]);
//My Export
$this->registerJSFile('@mat_assets/report/js/myExport.js', ['depends' => [yii\web\JqueryAsset::className()]]);

use app\modules\eoffice_materialsys\models\FunDate;

?>
<div id="export" class="matsys-material-index">
    <!-- Head -->
    <header id="page-header" style="margin-bottom: 20px;height: 65px;">
        <div class="pull-left">
            <h4 style="margin: 0 !important;"><i class="fa fa-file-text-o" aria-hidden="true"></i> สรุปงบประมาณ</h4>
            <ol style="margin: 0 !important;padding: 0px 20px;" class="breadcrumb">
                <li><a href="#">สรุปงบประมาณ</a></li>
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
                    <div class="row">
                        <div class="col-md-4">
                            <label>จากวันที่ :</label>
                            <input type="text" name="dateFirst" placeholder="ปี-เดือน-วัน"
                                   class="form-control datepicker"
                                   data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                        </div>
                        <div class="col-md-4">
                            <label>ถึงวันที่ : </label>
                            <input type="text" name="dateSecond" placeholder="ปี-เดือน-วัน"
                                   class="form-control datepicker"
                                   data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" name="submit-date" data-id="ttab1l_nobg"
                                    style="margin-top:25px;width: 100% ">ยืนยัน
                            </button>
                        </div>
                    </div>
                </div><!-- /TAB 1 CONTENT -->

                <div id="ttab2l_nobg" class="tab-pane "><!-- TAB 2 CONTENT -->
                    <div class="row">
                        <div class="col-md-8">
                            <label>ปีงบประมาณ :</label>
                            <input type="number" name="budget" placeholder="ปีงบประมาณ" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" name="submit-budget" data-id="ttab2l_nobg"
                                    style="margin-top:25px;width: 100% ">ยืนยัน
                            </button>
                        </div>
                    </div>
                </div><!-- /TAB 1 CONTENT -->

            </div>
            <!-- /tabs content -->

        </div>
        <!-- /panel content -->

    </div>
    <div id="panel-graphs-morris-c1" class="panel panel-default">
        <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>สรุปงบประมาณการเบิกวัสดุ</strong>
                (ปีงบประมาณ<small id="budget"><?= FunDate::getFullBudgetperYear() ?></small>)
                **บาท**
            </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom"
                       data-original-title="Colapse"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                       data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
            </ul>
            <!-- /right options -->

        </div>
        <!-- panel content -->
        <div class="panel-body nopadding">
            <div class="row">
                <div class="col-md-12" id="DivlineChartCanvas">
                    <canvas class="chartjs fullwidth height-300" id="lineChartCanvas" width="547" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="panel-graphs-morris-c1" class="panel panel-default">
                <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>วัสดุที่ใช้บ่อย</strong>**ชื้น**
            </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom"
                               data-original-title="Colapse"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                               data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a>
                        </li>
                    </ul>
                    <!-- /right options -->
                </div>
                <!-- panel content -->
                <div class="panel-body nopadding">
                    <div class="row">
                        <div class="col-md-12" id="DivbarChartCanvas">
                            <canvas class="chartjs fullwidth height-400" id="barChartCanvas" width="547"
                                    height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="panel-graphs-morris-c1" class="panel panel-default">
                <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>งบประมาณที่ใช้ในแต่ละสาขา</strong>**บาท**
            </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom"
                               data-original-title="Colapse"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                               data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a>
                        </li>
                    </ul>
                    <!-- /right options -->
                </div>
                <!-- panel content -->
                <div class="panel-body nopadding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7" id="DivpieChartCanvas">
                                    <canvas class="chartjs height-400 padding-20" id="pieChartCanvas" width="547"
                                            height="400" style="width:100%;"></canvas>
                                </div>
                                <div class="col-md-5">
                                    <div class="margin-top-60">
                                        <label>สาขา</label>
                                        <ul id="major">
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div id="panel-graphs-morris-c1" class="panel panel-default">
                <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>ข้อมูลการเบิก</strong>
            </span>
                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom"
                               data-original-title="Colapse"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                               data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a>
                        </li>
                        <li>
                            <div class="pull-right" style="margin-right: 10px">
                                <button name="export" class="btn btn-success btn-sm">ออกรายงาน</button>
                            </div>
                        </li>
                    </ul>
                    <!-- /right options -->
                </div>
                <!-- panel content -->
                <div class="panel-body nopadding">
                    <table style="display: none" border="1" id="exportExcel" class="table table-bordered">
                        <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">รายการ</th>
                            <th></th>
                            <th colspan="3" class="text-center">วงเงินงบประมาณ(ราคากลาง)</th>
                            <th></th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">
                                ผู้เสนอราคา/ร้านค้าผู้ได้รับการคัดเลือก
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">ราคา/ต่อหน่วย</th>
                            <th class="text-center">จำนวนเงินรวม</th>
                        </tr>
                        </thead>
                        <tbody name="export-tbody"></tbody>
                    </table>
                    <table border="1" class="table table-bordered">
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">รายการ</th>
                            <th colspan="3" class="text-center">วงเงินงบประมาณ(ราคากลาง)</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">
                                ผู้เสนอราคา/ร้านค้าผู้ได้รับการคัดเลือก
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">จำนวน</th>
                            <th class="text-center">ราคา/ต่อหน่วย</th>
                            <th class="text-center">จำนวนเงินรวม</th>
                        </tr>
                        <tbody name="export-tbody"></tbody>
                    </table>
                    <div id="loading"></div>
                </div>
            </div>
        </div>
    </div>
</div>
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
<!-- Export Excel -->
<div class="modal fade" id="Modalload" style="background-color: #0000004a;" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

    </div>
</div>