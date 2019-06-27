<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\pfc\models\Project;
use app\modules\pfc\models\ProjectConnect;
use app\modules\pfc\models\process;
use app\modules\pfc\models\Subjects;
use app\modules\pfc\models\StudentDept;
use app\modules\pfc\models\Teacher;
use app\modules\pfc\models\Student;
use app\modules\pfc\models\ProcessProgress;
use app\modules\pfc\models\ProcessProgressConnect;
use app\modules\pfc\models\ProcessGantt;
use app\modules\pfc\models\ProcessGanttType;
use app\modules\pfc\models\ProcessAdd;
use app\modules\pfc\models\ProcessAddConnect;
use app\modules\pfc\models\ViewProject;
use app\modules\pfc\models\ViewPisOpenSubject;
use app\modules\pfc\models\ViewStudentFull;
use app\modules\pfc\models\ViewUser;
use app\modules\pfc\models\ViewStudentProject;
use app\modules\pfc\models\ViewAdvise;

$session = Yii::$app->session;
$session->remove('sesValue');

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$dept_check = 0;
$project_con_check = 0;
$project_check_n = 0;
$degree_check = 0;
?>

    <header id="page-header">
        <h1>รายชื่อโครงงาน</h1>
        <ol class="breadcrumb">
            <li class="active">รายชื่อโครงงาน</li>

        </ol>
    </header>

    <div class="panel-body">
    <div class="padding-20">
        <div class="row">
            <ul class="nav">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                    <tr>
                        <th style="width: 90%">Project Name</th>
                        <th>Progress</th>
                        <th style=" text-align:center;">Detail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <!-- ป.ตรี -->
                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->

                    <?php
                        $check_project_ss = null;
                        $check_progress = 0;
                        $process_progree_count = 0;
                        $check_progress_sum = 0;
                        $check_score_sum = 0;
                        $check_score_full = 0;
                        if($type_degree == 1){
                            foreach ($teacher as $teachers){
                                foreach($project as $projects){
                                    if($projects->id == $teachers->project_id && $projects->major_id == 1 && $check_project_ss != $teachers->project_id){?>
                                        <tr>
                                            <td> <?= $projects->name_th ?></td>
                                            <td>
                                                <?php
                                                    $process = Process::find()->where("project_id like :b", [":b" => $projects->id])->all();
                                                    if ($process != null) {
                                                        $process_progress = ProcessProgress::find()->where("process_id like :b ORDER BY process_progress_no", [":b" => $process[0]->process_id])->all();

                                                        foreach ($process_progress as $process_progressn) {
                                                            $process_progree_count++;
                                                            $check_score_sum = $check_score_sum + $process_progressn->process_progress_score;
                                                            $check_score_full = $check_score_full + $process_progressn->process_progress_score_full;
                                                            if ($process_progressn->process_progress_status_id == 1) {
                                                                $check_progress++;
                                                            }
                                                        }

                                                        if ($process_progress != null) {
                                                            $check_progress_sum = $check_progress / $process_progree_count * 100;
                                                        }
                                                    }
                                                ?>
                                                <span class="easyPieChart" data-percent="<?= $check_progress_sum ?>" data-easing="easeOutBounce"
                                                      data-barColor="
                                                                    <?php if($check_progress_sum <= 25 ){ ?>
                                                                            #ef1e25
                                                                    <?php }elseif($check_progress_sum <= 60 ){ ?>
                                                                            #FFD700
                                                                    <?php }else{ ?>
                                                                            #008000
                                                                    <?php } ?>"
                                                      data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="6">
                                                                <span class="percent"></span>
                                                </span>
                                            </td>
                                            <td style=" text-align:center;">
                                                <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_detail?project_id=<?= $projects->id ?>&id=<?= $session['pfc_id'] ?>&type_degree=<?= $type_degree ?>"
                                                   class="btn btn-3d btn-reveal btn-red">
                                                    <span>Detail</span>
                                                    <i class="et-browser"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php $check_project_ss = $teachers->project_id;
                                    }
                                }
                            }
                        }
                    ?>

                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <!--  ป.โท -->
                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->


                    <?php
                    $check_project_ss = null;
                    if($type_degree == 2){
                        foreach ($teacher as $teachers){
                            foreach($project as $projects){
                                if($projects->id == $teachers->project_id && $projects->major_id == 2 && $check_project_ss != $teachers->project_id){?>
                                    <tr>
                                        <td> <?= $projects->name_th ?></td>
                                        <td>
                                            <?php
                                            $process = Process::find()->where("project_id like :b", [":b" => $projects->id])->all();
                                            if ($process != null) {
                                                $process_progress = ProcessProgress::find()->where("process_id like :b ORDER BY process_progress_no", [":b" => $process[0]->process_id])->all();

                                                foreach ($process_progress as $process_progressn) {
                                                    $process_progree_count++;
                                                    $check_score_sum = $check_score_sum + $process_progressn->process_progress_score;
                                                    $check_score_full = $check_score_full + $process_progressn->process_progress_score_full;
                                                    if ($process_progressn->process_progress_status_id == 1) {
                                                        $check_progress++;
                                                    }
                                                }

                                                if ($process_progress != null) {
                                                    $check_progress_sum = $check_progress / $process_progree_count * 100;
                                                }
                                            }
                                            ?>
                                            <span class="easyPieChart" data-percent="<?= $check_progress_sum ?>" data-easing="easeOutBounce"
                                                  data-barColor="
                                                                    <?php if($check_progress_sum <= 25 ){ ?>
                                                                            #ef1e25
                                                                    <?php }elseif($check_progress_sum <= 60 ){ ?>
                                                                            #FFD700
                                                                    <?php }else{ ?>
                                                                            #008000
                                                                    <?php } ?>"
                                                  data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="6">
                                                                <span class="percent"></span>
                                                </span>
                                        </td>
                                        <td style=" text-align:center;">
                                            <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_detail?project_id=<?= $projects->id ?>&id=<?= $session['pfc_id'] ?>&type_degree=<?= $type_degree ?>"
                                               class="btn btn-3d btn-reveal btn-red">
                                                <span>Detail</span>
                                                <i class="et-browser"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $check_project_ss = $teachers->project_id;
                                }
                            }
                        }
                    }
                    ?>

                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <!--  ป.เอก --
                    <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->

                    <?php
                    $check_project_ss = null;
                    if($type_degree == 3){
                        foreach ($teacher as $teachers){
                            foreach($project as $projects){
                                if($projects->id == $teachers->project_id && $projects->major_id == 3 && $check_project_ss != $teachers->project_id){?>
                                    <tr>
                                        <td> <?= $projects->name_th ?></td>
                                        <td>
                                            <?php
                                            $process = Process::find()->where("project_id like :b", [":b" => $projects->id])->all();
                                            if ($process != null) {
                                                $process_progress = ProcessProgress::find()->where("process_id like :b ORDER BY process_progress_no", [":b" => $process[0]->process_id])->all();

                                                foreach ($process_progress as $process_progressn) {
                                                    $process_progree_count++;
                                                    $check_score_sum = $check_score_sum + $process_progressn->process_progress_score;
                                                    $check_score_full = $check_score_full + $process_progressn->process_progress_score_full;
                                                    if ($process_progressn->process_progress_status_id == 1) {
                                                        $check_progress++;
                                                    }
                                                }

                                                if ($process_progress != null) {
                                                    $check_progress_sum = $check_progress / $process_progree_count * 100;
                                                }
                                            }
                                            ?>
                                            <span class="easyPieChart" data-percent="<?= $check_progress_sum ?>" data-easing="easeOutBounce"
                                                  data-barColor="
                                                                    <?php if($check_progress_sum <= 25 ){ ?>
                                                                            #ef1e25
                                                                    <?php }elseif($check_progress_sum <= 60 ){ ?>
                                                                            #FFD700
                                                                    <?php }else{ ?>
                                                                            #008000
                                                                    <?php } ?>"
                                                  data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="6">
                                                                <span class="percent"></span>
                                                </span>
                                        </td>
                                        <td style=" text-align:center;">
                                            <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_detail?project_id=<?= $projects->id ?>&id=<?= $session['pfc_id'] ?>&type_degree=<?= $type_degree ?>"
                                               class="btn btn-3d btn-reveal btn-red">
                                                <span>Detail</span>
                                                <i class="et-browser"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $check_project_ss = $teachers->project_id;
                                }
                            }
                        }
                    }
                    ?>

                </table>
            </ul>

            <!-- ----------------------------------------------------------------------------------------------------------------- -->
            <!-- ----------------------------------------------------------------------------------------------------------------- -->
            <!-- ----------------------------------------------------------------------------------------------------------------- -->

        </div>
    </div>
</div>




