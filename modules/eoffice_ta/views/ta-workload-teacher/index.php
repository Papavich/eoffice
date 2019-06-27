<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\SubjectOpen;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaWorkloadTeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$label_subj = controllers::t('label','Subject');
$title = controllers::t('label','Manage Workload');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$subj = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);

?>
<div class="ta-workload-teacher-index">

    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
	<span class="title elipsis">
        <?php
        //$subject = SubjectOpen::findOne(['subject_id'=>$s,'subject_version'=>$ver]);
        // $subject = SubjectOpen::findOne(['subject_id'=>$s,'subject_version'=>$ver,'subopen_semester'=>$t,'subopen_year'=>$y]);

        if (!empty($subject)){
        ?>
        <strong class="size-15"><i class="fa fa-edit"></i> &nbsp;<?=$label_subj?>:
            <!-- panel title -->
        <?=$subj->COURSECODE.' '.$subj->COURSENAME?>&nbsp;&nbsp;
         ภาคเรียน: <?=$t?> ปีการศึกษา :<?=$y?> </strong>

	</span>
        </div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-hover table-vertical-middle nomargin">
            <thead>
            <tr>
                <th>section</th>
                <th class="text-center">เวลาสอนLecture</th>
                <th class="text-center">เวลาสอนLAB</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <?php foreach ($secs as $row) {
                $sec = $row->SECTION;
                $subj = $row->COURSECODE;
                $ver = $row->REVISIONCODE;
                $term = $row->SEMESTER;
                $year = $row->ACADYEAR;
                $wload = TaWorkloadTeacher::find()->where(
                        [
                          'subject_id' =>$subj,
                          'term'=>$term,
                          'year'=>$year,
                        ])->all();
                    ?>
            <tbody>
            <tr>
                <td>
                    <i class="glyphicon glyphicon-book size-18" style="color: #0E2231"></i>&nbsp;
                    <a href="#">Sec.<?='0'.$sec?>&nbsp;
                    </a>
                </td>
                <?php
                $id = 'W-S'.'0'.$sec.'-'.$subj.'-'.$term;
                $wload_Ts = TaWorkloadTeacher::find()->where([
                    'ta_wload_teacher_id'=>$id,'subject_version'=>$ver])->all();
                foreach ($wload_Ts as $wload_T){
                $C_time_start = $wload_T->time_start;
                $C_time_end = $wload_T->time_end;
                    $L_time_start = $wload_T->time_start_lab;
                    $L_time_end = $wload_T->time_end_lab;
                    $C_day = $wload_T->day_lect;
                    $L_day = $wload_T->day_lab;
                $wload_id = $wload_T->ta_wload_teacher_id;
                //echo $time_start.'-'.$time_end;
                ?>
                    <?php
                       if(!empty($wload_id)){
                        if(empty($C_time_start&&$C_time_end)){
                          echo '<td class="text-center">ยังไม่ระบุเวลา</td>';
                          }else{
                          echo  '<td class="text-center">'.$C_day.'<br>'.$C_time_start.'-'.$C_time_end.'</td>';
                        }}
                    ?>
                    <?php
                    if(!empty($wload_id)){
                        if(empty($L_time_start&&$L_time_end)){
                            echo '<td class="text-center">ยังไม่ระบุเวลา</td>';
                        }else{
                            echo  '<td class="text-center">'.$L_day.'<br>'.$L_time_start.'-'.$L_time_end.'</td>';
                        }}
                    ?>
                <?php
                if(!empty($wload_Ts)){?>
                <td class="text-center">
                    <span  class=" label label-success size-14">
                <i class="glyphicon glyphicon-ok"></i> กำหนดแล้ว</span>
                </td>
                <?php }?>
                    <td class="text-center">
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'fa fa-pencil']) . 'แก้ไข',
                            ['ta-workload-teacher/update', 'sec'=>$sec,'s' => $subj,'ver'=>$ver,'t'=>$term,'y'=>$year],
                            ['class' => 'btn  btn-warning ']) ?>
                    </td>
                <?php } ?>
                <?php
                if(empty($wload_Ts)) { ?>
                    <td class="text-center">ยังไม่ระบุเวลา</td>
                    <td class="text-center">ยังไม่ระบุเวลา</td>
                    <td class="text-center">
                    <span class=" label label-warning size-14">
                <i class="et-caution"></i> ยังไม่กำหนด</span>
                    </td>
                <td class="text-center">
                    <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-plus-sign']) . 'กำหนด',
                        ['ta-workload-teacher/create', 'sec'=>$sec,'s' => $subj,'ver'=>$ver,'t'=>$term,'y'=>$year],
                        ['class' => 'btn  btn-blue ']) ?>
                </td>
                <?php } ?>
            </tr>
            <?php }?>
            </tbody>
        </table>
        <?php }else{
            echo '<div align="center">
                <strong class="color-red">ข้อมูลรายวิชาผิดพลาด</strong>
             </div>';
        }?>
    </div></div>