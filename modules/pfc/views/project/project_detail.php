<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\pfc\models\StudentDept;
use app\modules\pfc\models\StudentDegree;
use app\modules\pfc\models\ProcessProgress;
use app\modules\pfc\models\ViewStudentFull;
use app\modules\pfc\models\ViewUser;

$session = Yii::$app->session;
$session->remove('sesValue');

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */

Yii::$app->view->params['title'] = 'Project List';

$count_no = 1;
$check_process_add = null;
?>



    <?php foreach ($project as $value): ?>
    <header id="page-header">
        <h1>รายละเอียดของโครงงาน</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:history.back(1)">รายชื่อโครงงาน</a></li>
            <li class="active">รายละเอียดของโครงงาน</li>
        </ol>
    </header>

    <div class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong class="size-1"><?= $value->name_th ?></strong>
                    <small class="size-12 weight-300 text-mutted hidden-xs"></small>
                </span>
            </div>

            <div class="panel-body">
                <ul class="easypiecharts list-unstyled">

                    <div id="panel-misc-portlet-l2" class="panel panel-default">

                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#jtab1_nobg" data-toggle="tab">
                                    <i class="glyphicon glyphicon-th-list"></i> ความคืบหน้าของโครงงาน
                                </a>
                            </li>
                            <li class="">
                                <a href="#jtab2_nobg" data-toggle="tab">
                                    <i class="fa fa-bar-chart"></i> คะแนนของโครงงาน
                                </a>
                            </li>
                        </ul>


                        <div class="panel-body">
                            <div class="tab-content transparent">

                                <div id="jtab1_nobg" class="tab-pane active">
                                    <li class="clearfix">
                                        <span class="easyPieChart" data-percent="<?= $check_progress_sum ?>" data-easing="easeOutBounce"
                                              data-barColor="#F86C6B" data-trackColor="#dddddd" data-scaleColor="#A9A9A9"
                                              data-size="300" data-lineWidth="50"
                                              style="margin-top: 15% ;margin-left: 15%">
                                            <span class="percent" style="font-size: 17px;"></span>
                                        </span>
                                    </li>
                                </div>

                                <div id="jtab2_nobg" class="tab-pane">
                                    <li class="clearfix">
                                        <span class="easyPieChart" data-percent="<?= $check_score_sum ?>" data-easing="easeOutBounce"
                                              data-barColor="#228B22" data-trackColor="#dddddd" data-scaleColor="#A9A9A9"
                                              data-size="300" data-lineWidth="50"
                                              style="margin-top: 15% ;margin-left: 15%">
                                            <span style="width:100%; top:50%;
                                                    position:absolute;
                                                    margin-top:-10px;
                                                    display: block;
                                                    text-align:center;
                                                    z-index: 5;
                                                    font-size: 17px"><?= $check_score_sum ?> / <?= $check_score_full ?> คะแนน</span>
                                        </span>
                                    </li>
                                </div>

                            </div>
                        </div>
                    </div>


                    <li class="clearfix">
                        <div class="table-responsive">
                            <table class="table table-hover nomargin">
                                <thead>
                                <tr>
                                    <th>กำหนดการ</th>
                                    <th>สถานะ</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($process_progress as $process_progressn){
                                            foreach ($process_add_con as $process_add_cons) {
                                                if ($process_add_cons->process_progress_id == $process_progressn->process_progress_id
                                                            and $process_add_cons->process_progress_id != $check_process_add) {
                                                            $check_process_add = $process_add_cons->process_progress_id;
                                                            foreach ($process_add as $process_adds) {
                                                                if ($process_adds->process_add_id == $process_add_cons->process_add_id) {

                                                                    $date_now = explode("-", date("Y-m-d"));
                                                                    $date_end = explode("-", $process_adds->process_add_date_end);
                                                                    $timStmp_now = mktime(0,0,0,$date_now[1],$date_now[2],$date_now[0]);
                                                                    $timStmp_end = mktime(0,0,0,$date_end[1],$date_end[2],$date_end[0]);

                                                                    if ($timStmp_now > $timStmp_end AND $process_progressn->process_progress_score == 0 AND $process_progressn->process_progress_status_id != 1){
                                                                        $process_progress_c = ProcessProgress::findOne($process_progressn->process_progress_id);
                                                                        $process_progress_c->process_progress_status_id = 3;
                                                                        $process_progress_c->update();
                                                                    }elseif ($process_progressn->process_progress_score == 0 AND $timStmp_now < $timStmp_end) {
                                                                        $process_progress_c = ProcessProgress::findOne($process_progressn->process_progress_id);
                                                                        $process_progress_c->process_progress_status_id = 2;
                                                                        $process_progress_c->update();
                                                                    }else{
                                                                        $process_progress_c = ProcessProgress::findOne($process_progressn->process_progress_id);
                                                                        $process_progress_c->process_progress_status_id = 1;
                                                                        $process_progress_c->update();
                                                                    }

                                                                    ?>
                                                                    <tr>
                                                                        <td><?=  $process_adds->process_add_topic ?></td>
                                                                        <td>
                                                                            <?php if($process_progressn->process_progress_status_id == 1){ ?>
                                                                                <span class="label label-success">เสร็จสิ้น<span>
                                                                            <?php }elseif ($process_progressn->process_progress_status_id == 2){ ?>
                                                                                <span class="label label-info">ดำเนินการ<span>
                                                                            <?php }elseif($process_progressn->process_progress_status_id == 3){ ?>
                                                                                <span class="label label-danger">เกินระยะเวลา<span>
                                                                            <?php } ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="panel-footer">
                <div class="table-responsive nomargin"><table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th style="width:5%; text-align:center;"> Img</th>
                                <th style="width:12%;"> ID</th>
                                <th style="width:35%;"> ชื่อ - สกุล</th>
                                <th style=" text-align:center;"> สาขา</th>
                                <th style=" text-align:center;"> ระดับการศึกษา</th>
                                <th style=" text-align:center;"> ระดับชั้นปี</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $check_student_ss = null;
                        foreach ($student as $student_s){
                            $user = ViewUser::find()->where("id like :b", [":b" => $student_s->student_id])->all();
                            $student_full = ViewStudentFull::find()->where("STUDENTCODE like :b", [":b" => $user[0]->username])->all();
                                if($user[0]->username == $student_full[0]->STUDENTCODE && $check_student_ss != $user[0]->username){?>
                                    <tr class="size-14">
                                        <?php if ($student_full[0]->STUDENTSEX == 'M'){ ?>
                                            <td style=" text-align:center;">
                                                <img src="<?= Yii::$app->homeUrl ?>web_pfc/images/male.png" alt width="25">
                                            </td>
                                        <?php }else{ ?>
                                            <td style=" text-align:center;">
                                                <img src="<?= Yii::$app->homeUrl ?>web_pfc/images/female.png" alt width="25">
                                            </td>
                                        <?php } ?>

                                        <td><?= $student_full[0]->STUDENTCODE ?></td>

                                        <td>
                                            <?= $student_full[0]->PREFIXNAME ."\t". $student_full[0]->STUDENTNAME
                                            ."\t". $student_full[0]->STUDENTSURNAME  ?>
                                        </td>
                                        <td style=" text-align:center;">
                                            <?= $student_full[0]->DEPARTMENTNAME; ?>
                                        </td>

                                        <td style=" text-align:center;">
                                            <?= $student_full[0]->LEVELNAME; ?>
                                        </td>

                                        <td style=" text-align:center;">ชั้นปีที่ <?= $student_full[0]->STUDENTYEAR ?></td>
                                    </tr>
                                    <?php $check_student_ss =  $user[0]->username ;?>
                                <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-------------------------------------------------------- Button ------------------------------------------------------------------>

        <div class="row">
        <!-------------------------------------------------------- BOX ------------------------------------------------------------------>
            <div class="col-md-3 col-sm-6">
                <div class="box info">
                    <div class="box-title">
                        <h4>Chat</h4>
                        <small class="block">พูดคุยปรึกษากับนักศึษา</small>
                        <i class="fa fa-comments"></i>
                    </div>

                    <a href="<?= Yii::$app->homeUrl ?>pfc/chat/chat?project_id=<?= $value->id ?>"
                       class="btn btn-featured btn-blue">
                        <span>CHAT</span>
                        <i class="et-chat"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="box warning">
                    <div class="box-title">
                        <h4>Process Gantt Chart</h4>
                        <small class="block">กำหนดการของโครงงาน</small>
                        <i class="fa fa-bar-chart-o"></i>
                    </div>

                    <a href="<?= Yii::$app->homeUrl ?>pfc/process/process?project_id=<?= $value->id ?>&type=1&id=<?= $session['pfc_id'] ?>&type_degree=<?= $type_degree ?>&process_gantt_type_code=<?= $process_gantt_type_code ?>"
                       class="btn btn-featured btn-warning">
                        <span>GANTT CHART</span>
                        <i class="et-bargraph"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="box success">
                    <div class="box-title">
                        <h4>Calendar</h4>
                        <small class="block">ปฎิทินการนัดหมาย</small>
                        <i class="fa fa fa-calendar"></i>
                    </div>

                    <a href="<?= Yii::$app->homeUrl ?>pfc/calendar/calendar"
                       class="btn btn-featured btn-success">
                        <span>CALENDAR</span>
                        <i class="et-calendar"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="box danger">
                    <div class="box-title">
                        <h4>Project Summary</h4>
                        <small class="block">สรุปผลโครงงาน</small>
                        <i class="fa fa et-presentation"></i>
                    </div>

                    <a href="<?= Yii::$app->homeUrl ?>pfc/summary/project_summary?project_id=<?= $value->id ?>"
                       class="btn btn-featured btn-red">
                        <span>PROJECT SUMMARY</span>
                        <i class="glyphicon glyphicon-indent-right"></i>
                    </a>
                </div>
            </div>


            <!-------------------------------------------------------- BOX ------------------------------------------------------------------>
        <!-------------------------------------------------------- Button ------------------------------------------------------------------>
        <?php endforeach; ?>
        </div>
    </div>



