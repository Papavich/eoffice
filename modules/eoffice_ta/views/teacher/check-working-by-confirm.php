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
use app\modules\eoffice_ta\models\TaWorking;
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
$student1 = ViewStudentFull::findOne(['STUDENTID'=>$ta]);
$title = 'ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน';//controllers::t( 'label', 'Request TA');//ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน
$sub_title = 'รายชื่อผู้ช่วยสอน';
$check_std = 'ตรวจสอบชั่วโมงปฏิบัติงาน:'.$student1->STUDENTCODE;
$edit = controllers::t( 'label', 'Edit');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $sub_title, 'url' => ['check-working-ta2',
    's'=>$s,'ver'=>$ver
    ,'t'=>$t,'y'=>$y,]];

$this->params['breadcrumbs'][] = $check_std;
$label_std_name = 'รายชื่อผู้ช่วยสอน';
$label_std_sec = 'จำนวนกลุ่มที่สอน';
$label_sec_working = 'ดูบันทึกการปฏิบัติงาน';
$label_evidence = controllers::t('label','Working Evidence');
$label_date = controllers::t('label','Working Date');
$label_time = controllers::t('label','Time Start').'-'.controllers::t('label','Time End');
$label_title_working = controllers::t('label','Work Title');
$label_role = controllers::t('label','Work Role');
$label_hr = controllers::t('label','Hours Working');
$label_type_work = controllers::t('label','Type Work Ta');
$label_process= 'ดำเนินการ';
$confirm = 'ยืนยัน';
$non_confirm = 'ไม่ยืนยัน';
$label_teacher = controllers::t( 'label', 'Teaching');
$label_credit = controllers::t( 'label', 'Credit');
$label_req = controllers::t( 'label', 'Request');

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
<div class="panel-body">
<div class="navbar navbar-default">
    <div class="navbar-header">

        <?= Menu::widget([
            'items' => [
                ['label' => 'รายการชั่วโมงปฏิบัติงานที่ยังไม่ตรวจสอบ', 'url' => ['check-working-by-ta','ta'=>$ta,'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y]],
                ['label' => 'ชั่วโมงปฏิบัติงานที่ยืนยันแล้ว','url'=>['check-working-by-confirm','ta'=>$ta,'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y]],
                ['label' => 'ชั่วโมงปฏิบัติงานที่ไม่ยืนยัน','url'=>['check-working-by-nonconfirm','ta'=>$ta,'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y]],
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

        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
                <?php
                $subject = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);
                //$subject->REVISIONCODE
                ?>
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>ชั่วโมงปฏิบัติงานที่ยืนยันแล้ว</strong> วิชา <strong class="text-blue">
                                    <?=$subject->COURSECODE?>&nbsp;<?=$subject->COURSENAME?>
                                   </strong>
							</span>
            </div>
            <div class="panel-body">
                <?php //echo date('d-m-Y H:i:s')?>

                    <div class="table-responsive">
                        <table class="table table-hover table-vertical-middle nomargin">
                            <thead >
                            <tr class="info">

                                <th width="8%" class="text-center"><?=$label_date?></th>
                                <th width="8%" class="text-center"><?=$label_time?></th>
                                <th width="8%" class="text-center"><?=$label_evidence?></th>
                                <th width="5%" class="text-center"><?=$label_title_working?></th>
                                <th width="5%" class="text-center"><?=$label_role?></th>
                                <th width="5%" class="text-center"><?=$label_hr?></th>
                                <th width="5%" class="text-center"><?=$label_type_work?></th>
                                <th width="5%" class="text-center">Status</th>
                                <th width="9%" class="text-center"><?=$label_process?></th>
                            </tr>
                            </thead>
                            <?php
                            $Registers = TaRegister::find()->where(['subject_id'=>$s,'subject_version'=>$ver,'term'=>$t,'year'=>$y])->all();

                            foreach ($model as $item){
                                $ta = $item->person_id;
                                $id = $item->ta_work_plan_id;
                                $sec= $item->section;
                                $type_work = $item->ta_type_work_id;
                                $working_date = $item->working_date;
                                $time_start = $item->time_start;
                                $time_end = $item->time_end;
                                $hr_working = $item->hr_working;
                                $ta_work_role = $item->ta_work_role;
                                $ta_work_title = $item->ta_work_title;
                                $student = ViewStudentFull::findOne(['STUDENTID'=>$item->person_id]);
                                $student->STUDENTNAME;
                                $RegisSection = \app\modules\eoffice_ta\models\TaRegisterSection::find()->where([
                                    'subject_id'=>$s,'person_id'=>$item->person_id,
                                    'subject_version'=>$ver,
                                    'term'=>$t,'year'=>$y])->all();

                            ?>
                                <tbody>
                                <tr>

                                    <td class="text-center">
                                        <i class="fa fa-calendar size-18" style="color: #0E2231"></i>&nbsp;
                                        <?php echo $working_date?>&nbsp;&nbsp;
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        echo $time_start.'-'.$time_end;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="well text-center">
                                            <a  data-toggle="modal"
                                                data-target=".bs-example<?=$item->ta_work_plan_id?>-modal-lg">
                                                <?=Html::img($item->getPhotoViewer(),
                                                    ['style'=>'width:150px;','class'=>'img-rounded'])?>
                                            </a>
                                        </div>

                                    </td>
                                    <td class="text-center"><?=$ta_work_title?></td>
                                    <td class="text-center"><?=$ta_work_role?></td>
                                    <td class="text-center"><?=$hr_working?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($type_work == 'C'){
                                                ?>
                                                <span class="label label-warning size-12">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                            <?php }elseif($type_work == 'L'){?>
                                                <span class="label label-success size-12">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                            <?php  }?>

                                    </td>
                                    <?php
                                  //   $register = TaRegister::find()->where(['subject_id'=>$subj_id,'subject_version'=>$ver,'term'=>$term,'year'=>$year])->all();
                                    ?>
                                    <td class="text-center">
                                        <?php
                                        if(!empty($item->active_status)){?>
                                            <?php
                                            if ($item->active_status==TaWorking::STATUS_CONFIRM_Hr){
                                            ?>
                                        <strong style="color: limegreen" class="size-13">
                                            <i class="glyphicon glyphicon-ok"></i>
                                            ยืนยันแล้ว</strong>

                                            <?php  } elseif($item->active_status==TaWorking::STATUS_NON_CONFIRM_Hr){?>
                                            <strong style="color: red" class="size-13">
                                                <i class="glyphicon glyphicon-remove"></i>
                                                ไม่ยืนยัน</strong>

                                        <?php  }}else{?>
                                        <span  class="   size-14 " >--ไม่มี--
                                            <?php  }?>
                                   </span>
                                    </td>

                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">

                                                    <?php /*echo  Html::a(Html::tag('i', ''
                                                       , ['class' => 'glyphicon glyphicon-ok size-15']
                                                    )
                                                        .'<span >'.$confirm.'</span>',
                                                        ['confirm-hr','id'=>$id,'ta'=>$ta,'s'=>$item->subject_id,
                                                            'sec'=>$item->section,
                                                            'ver'=>$item->subject_version,
                                                            't'=>$item->term_id,'y'=>$item->year_id],
                                                        [
                                                            'class' => 'btn btn-sm btn-success',
                                                            'data' => [
                                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ ว่าคุณต้องการยืนยันชั่วโมงปฏิบัติงาน ของTAของคุณ?',
                                                                'method' => 'post',
                                                            ],
                                                        ])*/ ?>

                                            <?=  Html::a(Html::tag('i', ''
                                                    , ['class' => 'glyphicon glyphicon-remove size-15']
                                                )
                                                .'<span >'.$non_confirm.'</span>',
                                                ['non-confirm-hr','id'=>$id,'ta'=>$ta,'s'=>$item->subject_id,
                                                    'sec'=>$item->section,
                                                    'ver'=>$item->subject_version,
                                                    't'=>$item->term_id,'y'=>$item->year_id],
                                                        [
                                                            'class' => 'btn btn-sm btn-danger',
                                                            'data' => [
                                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการไม่ยืนยันชั่วโมงปฏิบัติงาน ของTAของคุณ?',
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>
                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->

                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                </tr>
                                </tbody>
                                <div class="modal fade bs-example<?=$item->ta_work_plan_id?>-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal " aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title text-center" id="myLargeModalLabel"><?=$label_evidence?></h4>
                                            </div>
                                            <!-- body modal -->
                                            <center>
                                                <div class="modal-body">
                                                    <?=Html::img($item->getPhotoViewer(),
                                                        ['style'=>'width:700px;','height => 700px','class'=>'img-rounded'])?>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            <?php  }?>

                        </table></div>
                <div id="custom-pagination" class="pull-right">
                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ])
                    ?>
                </div>



