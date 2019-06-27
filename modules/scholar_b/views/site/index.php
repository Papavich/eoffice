<?php

use app\modules\scholar_b\controllers;
use app\modules\scholar_b\models\ScbProject;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use yii\helpers\Url;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\modules\scholar_b\components\AuthHelper;

$this->registerJsFile('@web/plugins/jquery/jquery.cookie.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/jquery/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/jquery/jquery.ui.touch-punch.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/moment.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/plugins/bootstrap.dialog/dist/js/bootstrap-dialog.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// calendar
$this->registerJsFile('@web/plugins/fullcalendar/fullcalendar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/view/demo.calendar.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// alert
$this->registerJsFile('@web/web_scb/js/alert.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile("@web/web_scb/css/alert.css");
?>

<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Home') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>

    </ol>
</header>
<!-- /page title -->

<div class="scb-news-index">
    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">
                <?php if (AuthHelper::getUserType() == AuthHelper::TYPE_Student) { ?>
                    <?php if ($student) {

                    } else { ?>
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none'">×</span>
                            <a href="../project/index#jtab2_nobg">
                                <?= controllers::t('menu', 'คุณยังไม่ได้อัปโหลดโปรเจค') ?>
                            </a>
                        </div>
                    <?php } ?>

                    <div class="panel-group" id="teacher">
                        <!-- Advisor -->
                        <div id="panel-1" class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    อาจารย์ที่ปรึกษา คือ
                                    <?php
                                    if ($student_teacher->status_advisor) {
                                        $data = ScbStudentHasTeacher::find()->where(['student_id' => $student_teacher->student_id])->one();
                                        if ($data) {
                                            $nameteacher = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $data->teacher_id_card])->one();
                                            echo $nameteacher->PREFIXNAME . ' ' . $nameteacher->person_name . ' ' . $nameteacher->person_surname;
                                        }
                                    } else {
                                        echo "คุณยังไม่มีอาจารย์ที่ปรึกษา";
                                    }
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                <?php } ?>


                <div class="panel-group" id="accordion">
                    <!-- news -->
                    <div id="panel-1" class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne">
                                    <i class="fa fa-newspaper-o"></i>
                                    <?= controllers::t('label', 'News') ?>
                                </a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="accordion-body collapse in">
                            <ul class="panel-body">
                                <?php
                                foreach ($model as $item) { ?>
                                    <a href="<?php echo Url::toRoute(['news/view', 'id' => $item->news_id]); ?>">
                                        <ul class="list-unstyled list-icons margin-bottom-10">
                                            <li class="margin-top-6"><i class="fa fa-angle-right"></i>
                                                <strong> <?php echo $item->news_name; ?> </strong>
                                                <span style="color: black">- <?= controllers::t('label', 'By') ?>
                                                    <?php $data = EofficeCentralViewPisPerson::find()->where(['person_card_id' => $item->staff_id_card])->one();
                                                    if ($data) {
                                                        echo $data->PREFIXABB . '' . $data->person_name . ' ' . $data->person_surname;
                                                    } ?>
                                                    ( <i><?php echo TimeAgo::widget(['timestamp' => $item->crtime . "GMT+7",]) ?></i> )</span>
                                        </ul>
                                    </a>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- end news -->


                        <!-- pagination -->
                        <div class="text-center">
                            <?php
                            echo LinkPager::widget(['pagination' => $pages,]);
                            ?>
                        </div>
                        <!-- end pagination -->

                    </div>
                </div>


                <!-- CALENDAR -->
                <div id="content" class="padding-20 panel-group">
                    <div class="row">
                        <!-- Panel -->
                        <div id="panel-calendar" class="panel panel-default">
                            <div class="panel-heading">

                                        <span class="title elipsis">
                                            <strong>MY EVENTS</strong> <!-- panel title -->
                                        </span>

                                <div class="panel-options pull-right"><!-- panel options -->
                                    <ul class="options list-unstyled">
                                        <li>
                                            <a href="#" class="opt dropdown-toggle" data-toggle="dropdown"><span
                                                        class="label label-disabled"><span
                                                            id="agenda_btn">Month</span> <span
                                                            class="caret"></span></span></a>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a data-widget="calendar-view" href="#month"><i
                                                                class="fa fa-calendar-o color-green"></i>
                                                        <span>Month</span></a>
                                                </li>
                                                <li><a data-widget="calendar-view" href="#agendaWeek"><i
                                                                class="fa fa-calendar-o color-red"></i>
                                                        <span>Agenda</span></a></li>
                                                <li><a data-widget="calendar-view" href="#agendaDay"><i
                                                                class="fa fa-calendar-o color-yellow"></i>
                                                        <span>Today</span></a>
                                                </li>
                                                <li><a data-widget="calendar-view" href="#basicWeek"><i
                                                                class="fa fa-calendar-o color-gray"></i>
                                                        <span>Week</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- /panel options -->
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
            <!-- END CALENDAR -->

        </div>
    </div>
</div>

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/'</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">

    /* Calendar Data */
    var date = new Date()
    var d = date.getDate()
    var m = date.getMonth()
    var y = date.getFullYear()

    var _calendarEvents = <?= $calendars ?>


</script>

