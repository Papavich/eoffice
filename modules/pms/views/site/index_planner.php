
<?php

$this->registerJsFile('@web/plugins/jquery/jquery.cookie.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/jquery/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/jquery/jquery.ui.touch-punch.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/moment.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/bootstrap.dialog/dist/js/bootstrap-dialog.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/fullcalendar/fullcalendar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/view/demo.calendar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_pms/js/hover.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<header id="page-header">
    <h1><strong>ปฎิทินโครงการ</strong></h1>


</header>
<!-- /page title -->

<div id="content" class="padding-20">

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">

            <div class="well well-sm" style="padding: 6px !important;" id="event-container">
                <h4><i class="fa fa-bullhorn"></i> โครงการที่มีการขออนุมัติ</h4>
<!--                <span style="background-color: #d9534f" class="badge pull-right">0</span><span class="label label-success" style="width: 100px;display: inline-block">แจ้งเตือน</span>-->

                <ul class="nav nav-list">
                    <li class="el_primary menu-open" id="el_1">
                        <a href="../tablepro/permis-planner"><span>โครงการลงปีงบประมาณ</span><span style="background-color: #f4b04f" class="badge pull-right"><?=sizeof($prosub_offer)?></span>
                        </a>
                    </li>
                    <li class="el_primary menu-open" id="el_1">
                        <a href="../tablepro/permis-planner"> <span>จัดโครงการ</span><span style="background-color: #f4b04f" class="badge pull-right"><?=sizeof($prosub_place)?></span>
                        </a>
                    </li>
                    <li class="el_primary menu-open" id="el_1">
                        <a href="../tablepro/permis-planner"> <span>จัดโครงการพร้อมใช้งบประมาณ</span><span style="background-color: #f4b04f" class="badge pull-right"><?=sizeof($prosub_pandb)?></span>
                        </a>
                    </li>
                </ul>


            </div>



        </div>
        <div class="col-sm-12 col-md-12 col-lg-9">

            <!-- Panel -->
            <div id="panel-calendar" class="panel panel-default">

                <div class="panel-heading">

                                        <span class="title elipsis">
                                            <strong>กำหนดหารจัดโครงการ</strong> <!-- panel title -->
                                        </span>


                    <div class="panel-options pull-right"><!-- panel options -->
                        <ul class="options list-unstyled">
                            <li>
                                <a href="#" class="opt dropdown-toggle" data-toggle="dropdown"><span class="label label-disabled"><span id="agenda_btn">Month</span> <span class="caret"></span></span></a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a data-widget="calendar-view" href="#month"><i class="fa fa-calendar-o color-green"></i> <span>Month</span></a></li>
                                    <li><a data-widget="calendar-view" href="#agendaWeek"><i class="fa fa-calendar-o color-red"></i> <span>Agenda</span></a></li>
                                    <li><a data-widget="calendar-view" href="#agendaDay"><i class="fa fa-calendar-o color-yellow"></i> <span>Today</span></a></li>
                                    <li><a data-widget="calendar-view" href="#basicWeek"><i class="fa fa-calendar-o color-gray"></i> <span>Week</span></a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>
                        </ul>
                    </div><!-- /panel options -->
                    <div class="pull-right" style="margin-left: 2px;"><span class="label label-success" style="font-size: 12px;padding:5px !important;">ดำเนินการเสร็จสิ้น</span>  </div>
                    <div class="pull-right" style="margin-left: 2px;"><span class="label label-info" style="font-size: 12px;padding:5px !important;">อยู่ระหว่างดำเนินการ</span>  </div>
                    <div class="pull-right" style="margin-left: 2px;"><span class="label label-default" style="font-size: 12px;padding:5px !important;">ยังไม่ดำเนินการ</span>  </div>

                </div>

                <!-- panel content -->
                <div class="panel-body">

                    <div id="calendar" data-modal-create="true"><!-- CALENDAR CONTAINER --></div>

                </div>
                <!-- /panel content -->

            </div>
            <!-- /Panel -->

        </div>
    </div>
</div>


<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">

    /* Calendar Data */
    var date 	= new Date();
    var d 		= date.getDate();
    var m 		= date.getMonth();
    var y 		= date.getFullYear();


    var _calendarEvents = <?=$calendars?>;



</script>