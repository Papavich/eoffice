<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */


use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaStatus;
//use app\modules\eoffice_ta\models\TaWorkLoad;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSection;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30Subject;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\components\Calculation as Calculation;



$Calculate = new Calculation();

$sum_N_hr_C = 0;
$sum_N_hr_L = 0;
$hr_N_C[] =0;
$hr_N_L[] =0;

$sum_S_hr_C = 0;
$sum_S_hr_L = 0;
$hr_S_C[] =0;
$hr_S_L[] =0;
?>

<?php
$this->title = 'ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน';


?>

<div class="panel-body">
<div class="navbar navbar-default">
    <div class="navbar-header">

        <?= Menu::widget([
            'items' => [
                ['label' => 'ตรวจสอบการร้องขอผู้ช่วยสอน', 'url' => ['check-request']],
                ['label' => 'ตรวจสอบชั่วโมงปฏิบัติงาน','url'=>['staff/check-working']],
                ['label' => 'กรอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['check-max-payment']],
            ],
            'options' => [
                'class' => 'navbar-nav nav',
                'id'=>'navbar-id',
                'style'=>'font-size: 14px;',
                'data-tag'=>'yii2-menu',
            ],
        ]);
        ?>
    </div>
</div>
    <?php
    //'COURSECODE'=>$subj_id,
    //'SEMESTER'=>$item->term_id,'ACADYEAR'=>$item->year,'REVISIONCODE'=>$item->subject_version
    $t_secs = ViewPisOfficerClass::findOne([
        'COURSECODE'=>$s,
        'REVISIONCODE'=>$ver,
        'SEMESTER'=>$t,
        'ACADYEAR'=>$y]);

    ?>

    <strong>วิชา : </strong>
    <strong style="color: green" class="size-13"><?=$t_secs->COURSECODE?>&nbsp;&nbsp;<?=$t_secs->COURSENAME?>
               </strong><br>
    <?php
    if (!empty($t_secs)) {

       // $per = ViewPisUser::findOne(['person_id' => $t_secs->teacher_no]);
       // $per = ViewPisUser::findOne(['person_id'=>$t_secs->teacher_no]);

        /* $t_secs = Kku30SectionTeacher::findOne([
             'subject_id'=>$subj_id]);
        */
        //$person = PersonView::findOne(['person_id' => $t_secs->teacher_id]);
        /*  $person = EofficeMainUser::findOne(['person_id' => $t_secs->teacher_no]);
          $per = EofficeMainPerson::findOne(['person_id'=>$person->person_id]);
        */
        // $prefix = EofficeMainPrefix::findOne(['PREFIXID'=>$per->prefix_id]);

        echo ' <strong>อาจารย์ประจำวิชา :</strong> <strong style="color: blue" class="size-13">
        '.$t_secs->PREFIXABB . ' ' . $t_secs->OFFICERNAME . ' ' . $t_secs->OFFICERSURNAME.'</strong><br>';
    }else { echo '  <strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>   ยังไม่ดึงข้อมูลเข้า</strong><br>';
    } ?>
    <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-vertical-middle nomargin" >
                <thead>
        <tr>
            <th class="text-center" width="7%" rowspan = 2>รายชื่อผู้ช่วยสอน</th>
            <th class="text-center" width="5%" rowspan = 2>ระดับการศึกษา</th>
            <th width="3%" colspan = 2 class="text-center info">ชม.ภาคปกติ</th>
            <th width="3%" colspan = 2 class="text-center info">ชม.โครงการพิเศษ</th>
            <th class="text-center" width="3%" rowspan = 2>สถานะ</th>
            <th class="text-center" width="5%" rowspan = 2>ดูชั่วโมงปฏิบัติงาน</th>
        </tr>
        <tr>
            <td class="warning text-center"><strong>บรรยาย</strong> </td>
            <td  class="success text-center" ><strong>ปฏิบัติการ</strong></td>
            <td class="warning text-center"><strong>บรรยาย</strong></td>
            <td class="success text-center"><strong>ปฏิบัติการ</strong></td>
        </tr>
        </thead>
                <?php
                foreach ($model as $item){
                    $u = ViewPisUser::findOne(['person_id' => $item->person_id]);
                    $std =  ViewStudentFull::findOne(['STUDENTID'=>$u->person_id]);
                    $std_id = $std->STUDENTCODE;
                    //   $PREfix = EofficeMainPrefix::findOne(['PREFIXID'=>$std->PREFIXID]);
                    //$prefix = $PREfix->PREFIXNAME;
                    $std_name = $std->STUDENTNAME;
                    $std_surname = $std->STUDENTSURNAME;
                    $gpa = $std->GPA;
                    $level = $std->LEVELNAME;
                    $status = $item->ta_status_id;
                    ?>
            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td><?=$std_id?>&nbsp;&nbsp; <?php //$prefix?>&nbsp;<?=$std_name?>&nbsp;&nbsp;<?=$std_surname?>
                </td>
                <td class="text-center"><?=$level?></td>
                <!-- -----------------------  ภาคปกติ -----------------------  -->

                     <?php

                        $Secs1 = ViewPisSubjectSection::find()->where([
                            'COURSECODE'=>$item->subject_id,
                            'REVISIONCODE'=>$item->subject_version,
                            'SEMESTER'=>$item->term,'ACADYEAR'=>$item->year,
                            'LEVELID'=>31])->all();
                        foreach ($Secs1 as $value) {
                            $TaWorking1 = TaWorking::find()->where([
                                'section' =>'0'.$value->SECTION,
                                'person_id' => $item->person_id, 'subject_id' => $item->subject_id,
                                'subject_version' => $item->subject_version,
                                'term_id' => $item->term, 'year_id' => $item->year,
                                'active_status'=>TaWorking::STATUS_CONFIRM_Hr
                            ])->all();
                            foreach ($TaWorking1 as $record1) {
                                $ta_sec1 = substr($record1->section, 1, 2);
                                $subject1 = $record1->subject_id;
                                $ta_ver1 = $record1->subject_version;
                                $ta_term1 = $record1->term_id;
                                $ta_year1 = $record1->year_id;
                                $ta_typework = $record1->ta_type_work_id;

                                if ($ta_typework == 'C') {
                                    $hr_N_C[] = $record1->hr_working;

                                } elseif ($ta_typework == 'L') {
                                    $hr_N_L[] = $record1->hr_working;
                                }
                            }
                        }
                            $sum_N_hr_C = array_sum($hr_N_C);
                            $sum_N_hr_L = array_sum($hr_N_L);

                        ?>

                <td class="text-center">
                    <?php
                    //echo $Calculate->getIs_j($item->term, $item->year,$item->person_id);
                    //$subject,$version,$term,$year,$ta
                  //  echo $Calculate->getPaymentGS($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                    ?>

                    <strong style="color: darkorange"><i class="glyphicon glyphicon-time"></i>
                        <?=$sum_N_hr_C?></strong> ชม.</td>
                <td class="text-center"><strong style="color: limegreen"><i class="glyphicon glyphicon-time"></i>
                        <?=$sum_N_hr_L?></strong> ชม.</td>
                <?php

                $Secs2 = ViewPisSubjectSection::find()->where([
                    'COURSECODE'=>$item->subject_id,
                    'REVISIONCODE'=>$item->subject_version,
                    'SEMESTER'=>$item->term,'ACADYEAR'=>$item->year,
                    'LEVELID'=>34])->all();
                foreach ($Secs2 as $value) {
                    $TaWorking2 = TaWorking::find()->where([
                        'section' =>'0'.$value->SECTION,
                        'person_id' => $item->person_id, 'subject_id' => $item->subject_id,
                        'subject_version' => $item->subject_version,
                        'term_id' => $item->term, 'year_id' => $item->year,
                        'active_status'=>TaWorking::STATUS_CONFIRM_Hr
                    ])->all();
                    foreach ($TaWorking2 as $record2) {
                        $ta_sec1 = substr($record2->section, 1, 2);
                        $subject1 = $record2->subject_id;
                        $ta_ver1 = $record2->subject_version;
                        $ta_term1 = $record2->term_id;
                        $ta_year1 = $record2->year_id;
                        $ta_typework = $record2->ta_type_work_id;

                        if ($ta_typework == 'C') {
                            $hr_S_C[] = $record2->hr_working;

                        } elseif ($ta_typework == 'L') {
                            $hr_S_L[] = $record2->hr_working;
                        }
                    }
                }
                $sum_S_hr_C = array_sum($hr_S_C);
                $sum_S_hr_L = array_sum($hr_S_L);

                ?>
                <!-- ----------------------- โครงการพิเศษ -----------------------  -->
                <td class="text-center"><strong style="color: darkorange"><i class="glyphicon glyphicon-time"></i>
                        <?=$sum_S_hr_C?></strong> ชม.</td>
                <td class="text-center"><strong style="color: limegreen"><i class="glyphicon glyphicon-time"></i>
                        <?=$sum_S_hr_L?></strong> ชม.</td>
                <!-- *********************** สถานะ ****************** -->
                <td class="text-center"><strong>-</strong></td>
                <!-- *********************** Action (ปุ่ม) ****************** -->
                <td align="center">
                    <?= Html::a(Html::tag('i', '',
                        ['class' => 'glyphicon glyphicon-briefcase size-16']),
                        ['check-max-payment-view',
                        ],
                        ['class' => 'btn btn-sm btn-brown',])
                    ?>
                </td>


            </tr>
            </tbody>
                <?php } ?>
    </table>
</div>
        <div id="custom-pagination" class="pull-right">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>
    </div>
    </div>
