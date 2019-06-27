<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
//use app\models\Person;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
//use app\modules\eoffice_ta\models\Kku30SectionTeacher;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SectionTeacher;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_kku30\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use yii\widgets\Menu;
use app\modules\eoffice_ta\models\TaRegisterSection;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
//use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;



?>
<?php

$label_std_name = 'รายชื่อผู้ช่วยสอน';
$label_std_sec = 'จำนวนกลุ่มที่สอน';
$label_sec_working = 'ดูบันทึกการปฏิบัติงาน';
$label_teacher = controllers::t( 'label', 'Teaching');
$label_credit = controllers::t( 'label', 'Credit');
$label_req = controllers::t( 'label', 'Request');
$title = 'ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน';//controllers::t( 'label', 'Request TA');//ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน
$edit = controllers::t( 'label', 'Edit');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;
//echo Yii::$app->user->id;
$user = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
/*$per = Yii::$app->formatter->asNtext($u->person_id);
echo '<br>'.$per;*/
$per = $user->person_id;
$t_name = $user->person_name;
$t_surname = $user->person_surname;
?>
<?php
//$secTs = SectionTeacher::find()->where(['teacher_id'=>$per])->all();

?>
        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
                <?php
                $subject = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);
                //$subject->REVISIONCODE
                ?>
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>รายชื่อผู้ช่วยสอน</strong> วิชา <strong class="text-blue">
                                    <?=$subject->COURSECODE?>&nbsp;<?=$subject->COURSENAME?> </strong>
                                หน่วยกิต : <?=$subject->COURSEUNIT?>

							</span>
            </div>
            <div class="panel-body">
                <?php //echo date('d-m-Y H:i:s')?>

                    <div class="table-responsive">
                        <table class="table table-hover table-vertical-middle nomargin">
                            <thead >
                            <tr class="info">
                                <th width="8%" class="text-center"><?=$label_std_name?></th>
                                <th width="8%" class="text-center"><?=$label_std_sec?></th>
                                <th width="5%" class="text-center">Status</th>
                                <th width="4%" class="text-center"><?=$label_sec_working?></th>
                            </tr>
                            </thead>
                            <?php
                            $Registers = TaRegister::find()->where(['subject_id'=>$s,'subject_version'=>$ver,'term'=>$t,'year'=>$y
                            ,'ta_status_id'=>TaStatus::CHOOSE_TA])->all();

                            foreach ($model as $item){
                                $student = ViewStudentFull::findOne(['STUDENTID'=>$item->person_id]);
                                $student->STUDENTNAME;
                                $RegisSection = \app\modules\eoffice_ta\models\TaRegisterSection::find()->where([
                                    'subject_id'=>$s,'person_id'=>$item->person_id,
                                    'subject_version'=>$ver,
                                    'term'=>$t,'year'=>$y,'ta_status'=>TaStatus::CHOOSE_TA])->all();

                            ?>
                                <tbody>
                                <tr>
                                    <td >
                                        <i class="glyphicon glyphicon-user size-18" style="color: #0E2231"></i>&nbsp;
                                        <?php echo $student->STUDENTCODE?>&nbsp;&nbsp;
                                       <?php echo  $student->STUDENTNAME;?> &nbsp;
                                        <?php echo  $student->STUDENTSURNAME;?> &nbsp;
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        foreach ($RegisSection as $value){
                                            $sec = $value->section;
                                            $type_work = $value->ta_type_work_id;
                                            if ($type_work == 'C'){
                                                ?>
                                                <span class="label label-warning size-12">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                            <?php }elseif($type_work == 'L'){?>
                                                <span class="label label-success size-12">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                            <?php  }}?>

                                    </td>
                                    <?php
                                  //   $register = TaRegister::find()->where(['subject_id'=>$subj_id,'subject_version'=>$ver,'term'=>$term,'year'=>$year])->all();
                                    ?>
                                    <td class="text-center">
                                        <span  class="   size-14 " >--ไม่มี--
                                   </span>
                                    </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">
                                            <?php
                                            if (!empty($RegisSection)){
                                           /* foreach ($RegisSection as $value){*/
                                            //   $sec = $value->section;
                                                $ta = $item->person_id;
                                                //$type_work = $value->ta_type_work_id;
                                                  //  $sec_lec = 'Sec'.$sec ;//.'('.$type_work.')';
                                                    ?>
                                                    <?=  Html::a(Html::tag('i', ''
                                                       , ['class' => 'fa fa-briefcase size-15']
                                                    )
                                                        .'<span >Check</span>',
                                                        ['check-working-by-ta','ta'=>$ta,'s'=>$value->subject_id,/*'sec'=>$sec,*/'ver'=>$value->subject_version,
                                                            't'=>$value->term,'y'=>$value->year],
                                                        ['class' => 'btn btn-sm btn-info ']) ?>

                                                <?php  }?>

                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->

                                        <!--  ///////////////////////////////////////////////////////////////  -->

                                </tr>
                                </tbody>
                            <?php  }?>

                        </table></div>
                <div id="custom-pagination" class="pull-right">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ])
                    ?>
                </div>
    </div>
        </div>

    <!-- /panel content -->

