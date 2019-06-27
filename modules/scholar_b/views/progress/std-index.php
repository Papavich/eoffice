<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 8/5/2561
 * Time: 2:49
 */

use app\modules\scholar_b\models\ScbProgressReport;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;

?>
<?= Html::csrfMetaTags() ?>
    <!-- page title -->
    <header id="page-header">
        <h1><?= controllers::t('label', 'รายงานความก้าวหน้าหนักศึกษาทุน') ?></h1>
        <ol class="breadcrumb">
            <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
            <li class=""><a href="../progress/select"><?= controllers::t('label', 'ครั้งการรายงาน') ?></a></li>
            <li class="active"><?= controllers::t('label', 'รายงานความก้าวหน้าหนักศึกษาทุน') ?></li>
        </ol>
    </header>
<?php $form = ActiveForm::begin(); ?>
    <div class="scb-progress-report-select">
        <div id="content" class="padding-20">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <center><b>รายงานความก้าวหน้านักศึกษาทุน </b></center>
                                <br>
                                <center> ครั้งที่ <?= $seq ?> ภาคการศึกษาที่ <?= $sem ?>
                                    ประจำปีการศึกษา <?= $year_select ?></center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="panel panel-info" style="height: 220px !important" ;>
                                <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                    <b>ข้อมูลนักศึกษา</b>
                                </div>
                                <div class="panel-body">
                                    <label>ชื่อ-สกุล
                                        : <?= $student_central->PREFIXNAME ?>  <?= $student_central->STUDENTNAME ?>  <?= $student_central->STUDENTSURNAME ?></label>
                                    </br><label>เลขประจำตัว นศ. : <?php echo $student_id ?> / ชั้นปีที่
                                        : <?= $student_central->STUDENTYEAR ?></label>
                                    <?php $major = \app\modules\scholar_b\models\model_main\EofficeCentralViewPisMajor::find()->where(['id' => $student_central->major_id])->one(); ?>

                                    </br><label>สาขาวิชา : <?= $major->name_th ?></label>
                                    <?php $student_sc = \app\modules\scholar_b\models\ScbStudent::find()->where(['student_id' => $student_id])->one();
                                    ?>

                                    </br>  <label>เข้าศึกษาเมื่อ
                                        : <?php echo Yii::$app->thaiFormatter->asDate($student_central->ADMITDATE, 'long'); ?></label>
                                    </br><label>ประเภททุน
                                        : <?= $student_sc->scholarship->scname->scholarship_name . " พ.ศ. " . $student_sc->scholarship->scholarship_year; ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="panel panel-info" style="height: 220px !important;">
                                <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                    <b>ผลการเรียน</b>
                                </div>
                                <div class="panel-body">
                                    <label>รายงานผลการศึกษา ประจำปีการศึกษา <?= $year_select ?> </label>
                                    </br>
                                    <label>ภาคต้น เกรดเฉลี่ยประจำภาค <?php if ( $gpa1 != 0 || $gpa1 != "") {
                                            echo number_format($gpa1, 2);
                                        } else {
                                            echo "ยังไม่มีผลการศึกษา";
                                        } ?></label>
                                    </br>
                                    <label>ภาคปลาย เกรดเฉลี่ยประจำภาค <?php if ( $gpa2 != 0 || $gpa2 != "") {
                                            echo number_format($gpa2, 2);
                                        } else {
                                            echo "ยังไม่มีผลการศึกษา";
                                        } ?></label>
                                    </br>
                                    <label>เกรดเฉลี่ยสะสมปัจจุบัน
                                        <?php if ($student_central->GPA != 0 || $student_central->GPA != "") {
                                            echo number_format($student_central->GPA, 2);
                                        } else {
                                            echo "ยังไม่มีผลการศึกษา";
                                        } ?> </label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                <b>เงื่อนไขทุน</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                             data-railOpacity="1"
                                             data-height="200">
                                            <table class="table table-striped table-hover table-bordered"
                                                   id="sample_editable_1">
                                                <thead>
                                                <tr>
                                                    <th width="70%">
                                                        <center>เงื่อนไข</center>
                                                    </th>
                                                    <th width="10%">
                                                        <center>เกณฑ์ผ่าน</center>
                                                    </th>
                                                    <th width="10%">
                                                        <center>ผลลัพท์</center>
                                                    </th>
                                                    <th width="10%"></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php foreach ($condition_std as $items) { ?>
                                                    <tr>
                                                        <td> <?php if ($items->condi->condi_name == 1) {
                                                                echo "ผลการศึกษาแต่ละเทอมไม่ต่ำกว่า";
                                                            } else if ($items->condi->condi_name == 2) {
                                                                echo "ผลการศึกษาแต่ละปีการศึกษาไม่ต่ำกว่า";
                                                            } else if ($items->condi->condi_name == 3) {
                                                                echo "เข้าร่วมการประกวด-แข่งขันหรือบทความวิชาการระดับภูมิภาคอย่างน้อย";
                                                            } else if ($items->condi->condi_name == 4) {
                                                                echo "เข้าร่วมการประกวด-แข่งขันทุกระดับอย่างน้อย";
                                                            } else {
                                                                echo $items->condi->condi_name;
                                                            }
                                                            ?> </td>
                                                        <td><?= $items->condi->condi_value ?></td>
                                                        <td>
                                                            <?php
                                                            if ($items->condi->condi_name == 1) {
                                                                if($gpa2==0){
                                                                    echo (number_format($gpa1, 2) . ", เทอม2ยังไม่มีผลการศึกษา");
                                                                }else if($gpa2>1){
                                                                    echo (number_format($gpa1, 2) . ", " . number_format($gpa2, 2));
                                                                }
                                                            } else if ($items->condi->condi_name == 2) {
                                                                if($student_central->GPA==0||$student_central->GPA==""){
                                                                    echo "ยังไม่มีผลการศึกษา";
                                                                }else
                                                                    echo number_format($student_central->GPA, 2);
                                                            } else if ($items->condi->condi_name == 3) {
                                                                echo $port3_count;
                                                            } else if ($items->condi->condi_name == 4) {
                                                                echo $port4_count;
                                                            } else {
                                                                echo $items->condi->condi_value;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($items->condi->condi_name == 1) {
                                                                if(number_format($gpa1, 2)==0){
                                                                    echo "ไม่สามารถประเมินได้";
                                                                }else if(number_format($gpa1, 2)>0) {
                                                                    if (number_format($gpa1, 2) >= $items->condi->condi_value) {
                                                                        echo "ผ่าน";
                                                                    } else {
                                                                        echo "ไม่ผ่าน";
                                                                    }
                                                                }else if(number_format($gpa2, 2)>0){
                                                                    if (number_format($gpa1, 2) >= $items->condi->condi_value && number_format($gpa2, 2) >= $items->condi->condi_value) {
                                                                        echo "ผ่าน";
                                                                    } else {
                                                                        echo "ไม่ผ่าน";
                                                                    }
                                                                }
                                                            } else if ($items->condi->condi_name == 2) {
                                                                if ($student_central->GPA >= $items->condi->condi_value) {
                                                                    echo "ผ่าน";
                                                                } else {
                                                                    "ไม่ผ่าน";
                                                                }
                                                            } else if ($items->condi->condi_name == 3) {
                                                                if ($port3_count >= $items->condi->condi_value) {
                                                                    echo "ผ่าน";
                                                                } else {
                                                                    echo "ไม่ผ่าน";
                                                                }
                                                            } else if ($items->condi->condi_name == 4) {
                                                                if ($port4_count >= $items->condi->condi_value) {
                                                                    echo "ผ่าน";
                                                                } else {
                                                                    echo "ไม่ผ่าน";
                                                                }
                                                            }
                                                            ?>

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                                <b>ไฟล์นำเสนอ</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($progress_find != null) echo Html::a(' ' . \app\modules\scholar_b\controllers::t('label', 'Click for Download',
                                                ['class' => 'btn btn-primary']), '@web/web_scb/uploads/progress/' . $progress_find->progress_file,
                                            ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($progress_model, 'progress_file')->fileInput(); ?>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <?= Html::submitButton('<i class="	glyphicon glyphicon-upload"></i>' . 'Upload', ['class' => 'btn btn-success btn-sm']); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs nomargin">
                            <!-- tabs -->
                            <ul class="nav nav-tabs nav-justified tabmenu">
                                <li class="active">
                                    <a href="#jtab1_nobg" data-toggle="tab" aria-expanded="false">
                                        <i class="fa fa-trophy"></i> รายชื่อผลงาน
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#jtab2_nobg" data-toggle="tab" aria-expanded="false">
                                        <i class="fa fa-bars"></i> รายชื่อโครงงาน
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#jtab3_nobg" data-toggle="tab" aria-expanded="false">
                                        <i class="glyphicon glyphicon-tower"></i> รายชื่อกิจกรรม
                                    </a>
                                </li>
                            </ul>

                            <!-- tabs content -->
                            <div class="tab-content transparent">

                                <!-- Start TAB1 -->
                                <div id="jtab1_nobg" class="tab-pane active">
                                    <div class="panel-heading">
                                    <span class="title elipsis">
                                        <strong>รายชื่อผลงาน</strong> <!-- panel title -->
                                    </span>
                                    </div>

                                    <div class="form-group">
                                        <!-- Scorbar -->
                                        <div class="panel-body">
                                            <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                                 data-railOpacity="1"
                                                 data-height="300">
                                                <table class="table table-striped table-hover table-bordered"
                                                       id="sample_editable_1">
                                                    <thead>
                                                    <tr>
                                                        <th width="40%">
                                                            <center>ชื่อผลงาน</center>
                                                        </th>
                                                        <th width="15%">
                                                            <center>ระดับผลงาน</center>
                                                        </th>
                                                        <th width="30%">
                                                            <center>จากโครงงาน</center>
                                                        </th>
                                                        <th width="15%"></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                    foreach ($portfolio as $item) {

                                                        ?>

                                                        <tr>
                                                            <td><?= $item->port_name ?></td>
                                                            <td><?= $item->portType->type_name ?></td>
                                                            <td><?= $item->projectCode->project_name ?></td>
                                                            <td>
                                                                <a href="../portfolio/view?id=<?= $item->id_portfolio ?>"
                                                                   class="btn btn-info btn-xs">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a href="../project/view?project_code=<?= $item->project_code ?>"
                                                                   class="btn btn-warning btn-xs">
                                                                    <i class="glyphicon glyphicon-list-alt"></i>
                                                                </a></td>
                                                        </tr>

                                                    <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div align="right">
                                            <a class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"> รายละเอียดผลงาน</i>
                                            </a>
                                            <a class="btn btn-xs btn-warning white">
                                                <i class="glyphicon glyphicon-list-alt"> รายละเอียดโครงงาน</i>
                                            </a>
                                        </div>
                                        <!-- /panel content -->
                                    </div>
                                    <!-- Scorbar -->
                                </div>

                                <!-- Start TAB2 -->
                                <div id="jtab2_nobg" class="tab-pane">
                                    <div class="panel-heading">
                                    <span class="title elipsis">
                                        <strong>รายชื่อโครงงาน</strong> <!-- panel title -->
                                    </span>
                                    </div>

                                    <div class="form-group">
                                        <!-- Scorbar -->
                                        <div class="panel-body">
                                            <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                                 data-railOpacity="1"
                                                 data-height="300">
                                                <table class="table table-striped table-hover table-bordered"
                                                       id="sample_editable_1">
                                                    <thead>
                                                    <tr>
                                                        <th width="45%">
                                                            <center>ชื่อโครงงาน</center>
                                                        </th>
                                                        <th width="20%">อาจารย์ที่ปรึกษา</th>
                                                        <th width="10%">ปีการศึกษา</th>
                                                        <th width="10%">การดำเนินงาน</th>
                                                        <th width="15%"></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php

                                                    foreach ($project_student as $item) {
                                                        $find_progress = ScbProgressReport::find()->where(['progress_seq' => $seq, 'student_id' => $student_id,
                                                            'project_year' => $item->year, 'project_semester' => $item->semester, 'project_code' => $item->project_code])->one();
                                                        if ($item->projectCode->pro_status == 1) {
                                                            ?>

                                                            <tr>
                                                                <td><?php echo $item->projectCode->project_name; ?></td>
                                                                <td><?php
                                                                    $find_teacher_proj = \app\modules\scholar_b\models\model_main\ListProjFull::find()
                                                                        ->where(['project_code'=>$item->project_code])->one();
                                                                    $teacher_name = \app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson::find()
                                                                        ->where(['person_card_id'=>$find_teacher_proj->teacher_id_card])->one();
                                                                    echo $teacher_name->PREFIXABB.$teacher_name->person_name." ".$teacher_name->person_surname

                                                                    ?></td>
                                                                <td><?php echo $item->year; ?></td>
                                                                <td>
                                                                    <div class="progress" style="width: 100px">
                                                                        <div class="progress-bar progress-bar-striped active"
                                                                             role="progressbar"
                                                                             aria-valuenow="0" aria-valuemin="0"
                                                                             aria-valuemax="100"
                                                                             style="width:<?php echo $item->projectCode->project_status; ?>%"><?php echo $item->projectCode->project_status . "%"; ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="text-align:center;">
                                                                        <a href="../project/view?project_code=<?= $item->project_code ?>"
                                                                           class="btn btn-info btn-xs">
                                                                            <i class="fa fa-eye"></i>
                                                                        </a>

                                                                        <?php
                                                                        if ($find_progress) {
                                                                            ?>
                                                                            <a href="../progress/result-update?seq=<?php echo $seq ?>&proj_year=<?php echo $item->year ?>&proj_sem=<?php echo $item->semester ?>&proj_code=<?php echo $item->project_code ?>&year_select=<?php echo $year_select ?>&sem_select=<?php echo $sem ?>"
                                                                               class="btn btn-xs btn-warning white"><i
                                                                                        class="fa fa-edit"></i>
                                                                            </a>


                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="../progress/result?seq=<?php echo $seq ?>&proj_year=<?php echo $item->year ?>&proj_sem=<?php echo $item->semester ?>&proj_code=<?php echo $item->project_code ?>&year_select=<?php echo $year_select ?>&sem_select=<?php echo $sem ?>"
                                                                               class="btn btn-xs btn-success white"><i
                                                                                        class="	glyphicon glyphicon-list"></i>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        ?>


                                                                        <a href="../progress/std-view-advp?seq=<?= $seq ?>&proj_year=<?= $item->year ?>&proj_sem=<?php echo $item->semester ?>&proj_code=<?php echo $item->project_code ?>&year_select=<?php echo $year_select ?>&sem_select=<?php echo $sem ?>"
                                                                           class="btn btn-default btn-xs">
                                                                            <i class="glyphicon glyphicon-comment"></i>
                                                                        </a>
                                                                        <div>

                                                                </td>
                                                            </tr>

                                                        <?php }
                                                    } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div align="right">
                                            <a class="btn btn-info btn-xs">
                                                <i class="fa fa-eye"> ดูรายละเอียด</i>
                                            </a>
                                            <a class="btn btn-xs btn-warning white">
                                                <i class="fa fa-edit"> แก้ไขรายงานผล</i>
                                            </a>
                                            <a class="btn btn-xs btn-success white">
                                                <i class="glyphicon glyphicon-list"> รายงานผล</i>
                                            </a>
                                            <a class="btn btn-default btn-xs">
                                                <i class="glyphicon glyphicon-comment">
                                                    ความเห็นจากอาจารย์ที่ปรึกษาโครงงาน</i>
                                            </a>
                                        </div>
                                        <!-- /panel content -->
                                    </div>
                                    <!-- Scorbar -->
                                </div>


                                <!-- Start TAB3 -->
                                <div id="jtab3_nobg" class="tab-pane">
                                    <div class="panel-heading">
                                    <span class="title elipsis">
                                        <strong>รายชื่อกิจกรรม</strong> <!-- panel title -->
                                    </span>
                                    </div>

                                    <div class="form-group">
                                        <!-- Scorbar -->
                                        <div class="panel-body">
                                            <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                                 data-railOpacity="1"
                                                 data-height="300">
                                                <table class="table table-striped table-hover table-bordered"
                                                       id="sample_editable_1">
                                                    <thead>
                                                    <tr>
                                                        <th width="40%">
                                                            <center>ชื่อกิจกรรม</center>
                                                        </th>
                                                        <th width="30%">
                                                            <center>สถานที่</center>
                                                        </th>
                                                        <th width="15%">
                                                            <center>ประเภทกิจกรรม</center>
                                                        </th>
                                                        <th width="15%"></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php
                                                    foreach ($student_activity as $key => $list) {

                                                        ?>

                                                        <tr>
                                                            <td><?= $list->activityMain->act_main_name ?></td>
                                                            <td><?= $list->activityMain->act_main_location ?></td>
                                                            <td><?= $list->activityMain->actType->act_type_name ?></td>
                                                            <td>
                                                                <a href="#" data-toggle="modal"
                                                                   class="btn btn-info btn-xs"
                                                                   data-target="#showimg<?= $key ?>">
                                                                    <i class="fa fa-eye"> ดูภาพกิจกรรม</i>
                                                                </a>

                                                                <div class="modal fade" id="showimg<?= $key ?>"
                                                                     role="dialog" hidden="">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content"
                                                                             style="width: 850px;">

                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title"
                                                                                    id="myLargeModalLabel">
                                                                                    ภาพกิจกรรม<?= $list->activityMain->act_main_name ?></h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center><?php echo Html::img('@web/web_scb/uploads/activity/images/' . $list->activity_img, ['width' => 500]) ?></center>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-default"
                                                                                        data-dismiss="modal">ปิด
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>

                                                    <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- /panel content -->
                                    </div>
                                    <!-- Scorbar -->
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


<?php ActiveForm::end(); ?>