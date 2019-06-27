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
$BN=0;
$BS=0;
?>

<?php
$this->title = 'ตรวจสอบค่าตอบแทนของผู้ช่วยสอน';


?>

<div class="panel-body">
<div class="navbar navbar-default">
    <div class="navbar-header">

        <?= Menu::widget([
            'items' => [
                ['label' => 'ตรวจสอบการร้องขอผู้ช่วยสอน', 'url' => ['staff/check-request']],
                ['label' => 'ตรวจสอบชั่วโมงปฏิบัติงาน','url'=>['staff/check-working']],
                ['label' => 'กรอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['staff/check-payment']],
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
            <th class="text-center" width="7%" >รายชื่อผู้ช่วยสอน</th>
            <th class="text-center" width="5%" >ระดับการศึกษา</th>
            <th width="3%" class="text-center info">ชม.ภาคปกติ</th>
            <th width="3%" class="text-center info">ชม.โครงการพิเศษ</th>
            <th class="text-center" width="3%" >สถานะ</th>
            <th class="text-center" width="5%" >ดูชั่วโมงปฏิบัติงาน</th>
        </tr>

        </thead>
                <?php
                foreach ($model as $item){
                    $u = ViewPisUser::findOne(['person_id' => $item->person_id]);
                    $std =  ViewStudentFull::findOne(['STUDENTID'=>$u->person_id]);
                    $stdLvBN=  ViewStudentFull::findOne(['STUDENTID'=>$u->person_id,'LEVELID'=>31]);
                    $stdLvBS=  ViewStudentFull::findOne(['STUDENTID'=>$u->person_id,'LEVELID'=>34]);

                    $std_id = $std->STUDENTCODE;
                    //   $PREfix = EofficeMainPrefix::findOne(['PREFIXID'=>$std->PREFIXID]);
                    //$prefix = $PREfix->PREFIXNAME;
                    $std_name = $std->STUDENTNAME;
                    $std_surname = $std->STUDENTSURNAME;
                    $gpa = $std->GPA;
                    $level = $std->LEVELNAME;
                    $level_id = $std->LEVELID;
                    $status = $item->ta_status_id;
                    $BN = $Calculate->getIs_h($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                    $BS = $Calculate->getIs_r($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                    ?>
            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td><?=$std_id?>&nbsp;&nbsp; <?php //$prefix?>&nbsp;<?=$std_name?>&nbsp;&nbsp;<?=$std_surname?>
                </td>
                <td class="text-center"><?=$level?></td>
                <!-- -----------------------  ภาคปกติ -----------------------  -->

                <?php
               if (!empty($stdLvBN)||!empty($stdLvBN)){
                if ($level_id==31||$level_id==34){
                ?>
                <td class="text-center">
                    <strong style="color: darkorange"><i class="glyphicon glyphicon-time"></i>
                    <?php
                     echo $Calculate->getPaymentBN($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                    ?>
                       </strong></td>
                <!-- ----------------------- โครงการพิเศษ -----------------------  -->
                <td class="text-center"><strong style="color: blue"><i class="glyphicon glyphicon-time"></i>
                            <?php
                            echo $Calculate->getPaymentBS($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                            ?>
                        </strong> ชม.</td>
                <?php }else{?>
                <td class="text-center">
                    <strong style="color: darkorange"><i class="glyphicon glyphicon-time"></i>
                        <?php
                        echo $Calculate->getPaymentGN($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                        ?>
                    <td class="text-center">
                        <strong style="color: blue"><i class="glyphicon glyphicon-time"></i>
                            <?php
                            echo $Calculate->getPaymentGS($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                            ?>
                        </strong> ชม.</td>

                <?php }}else{?>

                   <td class="text-center">
                       <strong style="color: darkorange"><i class="glyphicon glyphicon-time"></i>
                           <?php
                           echo $Calculate->getPaymentGN($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                           ?>
                   <td class="text-center">
                       <strong style="color: blue"><i class="glyphicon glyphicon-time"></i>
                           <?php
                           echo $Calculate->getPaymentGS($item->subject_id,$item->subject_version,$item->term,$item->year,$item->person_id);
                           ?>
                       </strong> ชม.</td>

                   <?php }?>
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

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-vertical-middle nomargin" >
            <thead>
            <tr>
                <th class="text-center" width="7%" >รายชื่อผู้ช่วยสอน</th>
                <th class="text-center" width="5%" >จำนวนsecปก</th>

            </tr>

            </thead>
            <tbody>
            <tr>

    <?php
    $ta_Lv[] = 0;
    $sum[] = 0;
    $k = 0;
    $Regis = TaRegister::find()->where(['subject_id'=>$s,'subject_version'=>$ver,'term'=>$t,'year'=>$y,
        'ta_status_id'=>TaStatus::CHOOSE_TA
    ])->all();
    foreach ($Regis as $regis) {
    $STDs =  ViewStudentFull::find()->where(['STUDENTID'=>$regis->person_id])
        //'<>LEVELID'=>[31,34]]);
            ->andWhere(['<>','LEVELID', 31])
            ->andWhere(['<>','LEVELID',34])
            ->all();
        foreach ($STDs as $STD) {

            echo '<td>' . $STD->STUDENTNAME . '</td>';//รายชื่อ TA ป.โท
            $Register = TaRegister::find()->where(['person_id' => $STD->STUDENTID, 'term' => $t, 'year' => $y,
                'ta_status_id' => TaStatus::CHOOSE_TA
            ])->all();
        }
            foreach ($Register as $regis2) {
                $Secs1 = ViewPisSubjectSection::find()->select(
                    ['COURSECODE'])->distinct()->where([
                    'COURSECODE' => $regis2->subject_id,
                    'REVISIONCODE' => $regis2->subject_version,
                    'SEMESTER' => $regis2->term,
                    'ACADYEAR' => $regis2->year,
                    'LEVELID' => 31])->all();
                foreach ($Secs1 as $value) {
                    $RegisSecs = TaRegisterSection::find()->select(
                        ['subject_id'])->distinct()->where([
                        'section' => '0' . $value->SECTION,
                        'person_id' => $regis2->person_id,
                        'subject_id' => $value->COURSECODE,
                        'subject_version' => $value->REVISIONCODE,
                        'term' => $value->SEMESTER,
                        'year' => $value->ACADYEAR,
                        'ta_status' => TaStatus::CHOOSE_TA
                    ])->all();
                }
                //$Calculate->getP
               echo '<td>'.$Calculate->getPaymentGN($s,$ver,$t,$y,$STD->STUDENTNAME).'</td>';
            }
     //   }
    $k = array_sum($ta_Lv);
    echo '<td>' .$k.'</td>';


    ?>
            </tr>
            </tbody>
            <?php  } ?>
        </table>

        <?php //array_sum($ta_Lv)?>
        <div id="custom-pagination" class="pull-right">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>
    </div>

