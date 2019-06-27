<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
//use app\modules\eoffice_ta\models\model_main\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaComparisonGrade;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaRegisterSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายละเอียดข้อมูลผู้สมัคร';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .circle{ /* ชื่อคลาสต้องตรงกับ <img class="circle"... */
        /* height: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
        /* width: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
        border: 3px solid #fff; /* เส้นขอบขนาด 3px solid: เส้น #fff:โค้ดสีขาว */
        border-radius: 50%; /* ปรับเป็น 50% คือความโค้งของเส้นขอบ*/
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* เงาของรูป */
    }
</style>
<div class="ta-register-section-detail-by-subj">



        <?php
        foreach ($model as $item){
           $subj_id =  $item->subject_id;
           $subj_ver = $item->subject_version;
           $term =  $item->term;
           $year = $item->year;
           $per =  $item->person_id;
           $subject = EofficeCentralRegCourse::findOne(['COURSECODE'=>$subj_id,'REVISIONCODE'=>$subj_ver]);

        //$subject->COURSECODE;$subject->REVISIONCODE

        /*$user = EofficeMainUser::findOne(['person_id' => $item->person_id]);
        $uid = $user->id;
        */
        //reg_studentmaster
        //$std_id = $user->username;
        //$prefix = $u->prefix_th;
        /* $std_name = $u->student_fname_th;
         $std_surname = $u->student_lname_th;
        */
        $std =  ViewStudentFull::findOne(['STUDENTID'=>$item->person_id]);
        $std_id = $std->STUDENTCODE;
        // $PREfix = EofficeMainPrefix::findOne(['PREFIXID'=>$std->PREFIXID]);
        $prefix = $std->PREFIXNAME;
        $std_name = $std->STUDENTNAME;
        $std_surname = $std->STUDENTSURNAME;
        $gpa = $std->GPA;
        $level = $std->LEVELID;
        $status = $item->ta_status_id;
        $regis_secs = TaRegisterSection::find()
            ->where(['person_id'=>$item->person_id,'term'=>$item->term,'year'=>$item->year
                ,'subject_id'=>$item->subject_id,'subject_version'=>$item->subject_version])->all();
        $rs_count = count($regis_secs);
       ?>

        <div class="row">

            <!-- COL 1 -->
            <div class="col-md-4 col-lg-3">
                <section class="panel">
                    <div class="panel-body ">
                        <?php if (!empty($item->ta_image)){ ?>
                        <figure class="margin-bottom-10" ><!-- image -->
                        <center>  <?php echo Html::img('@web/web_ta/images/register/' . $item->ta_image,
                                ['class'=>'circle','width' => 180, 'height' => 180]) ?></center>
                        </figure><!-- /image -->
                        <?php }else{?>
                        <figure class="margin-bottom-10" ><!-- image -->
                            <center>    <img class="circle" src="<?= Yii::getAlias('@web') ?>
                                /web_ta/images/register/ta_user.jpg" alt="" width="180" height="180"><center>
                        </figure><!-- /image -->
                        <?php }?>
                    </div>
                </section>
                <!-- activity -->
                <section class="panel panel-default">
                    <header class="panel-heading">
                        <h2 class="panel-title elipsis">
                            <strong><i class="glyphicon glyphicon-globe"></i></strong> หลักฐานการสมัคร
                        </h2>
                    </header>

                    <div class="panel-body noradius padding-10">

                        <!-- activity list -->
                        <div class="row profile-activity">

                            <!-- activity item -->

                            <div class="col-xs-10 col-sm-11">
                                <h6><a href="#">ไฟล์เอกสาร</a></h6>
                                <?php
                                $compar = TaComparisonGrade::findOne(['person_id'=>$item->person_id,'subject_id'=>$item->subject_id]);
                                 if(!empty($compar)){
                                ?>
                                     <strong>วิชาขอเทียบ : </strong><?=$compar->subject_id_compar .' '.$compar->subject_name_compar?>
                                <strong class="col-md-8 control-label">หลักฐานการขอเทียบรายวิชา</strong> <span class="label label-success"> Download </span><br>
                                <?php   }else{
                                    echo 'ไม่ได้ขอเทียบรายวิชา';
                                }?>
                            </div>
                            <!-- /activity item -->
                        </div>
                        <!-- /activity list -->
                        <hr class="half-margins" />
                    </div>
                </section>
                <!-- /activity -->

            </div>
            <div class="col-md-3 col-lg-9">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                <h4 style="color: #0f74a8">ข้อมูลรายวิชา</h4>
                    </div></div>
            <?php
              if (!empty($subject)){
            ?>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <strong> วิชา : </strong>
                  <strong style="color: mediumseagreen"><?=$subject->COURSECODE?>&nbsp;<?=$subject->COURSENAMEENG?></strong>
                  &nbsp;&nbsp; <strong> หน่วยกิต : </strong><?=$subject->COURSEUNIT?>
                  &nbsp;&nbsp; <strong>  ภาคเรียนที่ : </strong> <?=$term?><br> <strong> ปีการศึกษา : </strong><?=$year?>
                        &nbsp;&nbsp;
                         <strong> อาจารย์ผู้สอน : </strong> <strong style="color: #0f74a8">
                  <?php
                  $t_secs = ViewPisOfficerClass::findOne(['COURSECODE'=>$subj_id]);
                  $person = ViewPisUser::findOne(['person_fname_th' => $t_secs->OFFICERNAME,'person_lname_th'=>$t_secs->OFFICERSURNAME]);
                  $per = ViewPisPerson::findOne(['person_id'=>$person->person_id]);
                  echo /*$prefix->PREFIXNAME .*/ ' ' . $per->person_name . ' ' . $per->person_surname; ?>
                  </strong>
                    </div></div>
                  <hr/>
                  <div class="row">
                      <div class="col-lg-1"></div>
                      <div class="col-lg-10">
                          <h4  style="color: #0f74a8">ข้อมูลผู้สมัคร</h4>
                      </div></div>

                  <div class="row">
                      <div class="col-lg-1"></div>

                      <div class="col-lg-5">

                  <strong>ชื่อ-สกุล : </strong><?=$prefix?>&nbsp;<?=$std_name?>&nbsp;<?=$std_surname?>
                          <hr/>
                          <strong>ระดับการศึกษา : </strong> <?=$std->LEVELNAME?><hr/>
                          <strong>สาขา : </strong> <?=$std->PROGRAMNAME?>
                      </div>
                      <div class="col-lg-6">

                          <strong>รหัสนักศึกษา : </strong> <?=$std_id?><hr/>
                          <strong>ชั้นปี : </strong> <?=$std->STUDENTYEAR?><hr/>
                          <strong>GPA : </strong> <?=$gpa?>
                      </div>
                  </div>

                  <hr/>

                <div class="table-responsive">
                    <table class="table table-hover table-vertical-middle nomargin">
                        <thead>
                        <tr class="info">
                            <th class="text-center">Section</th>
                            <th class="text-center">Type Work</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <?php
                        foreach ($regis_secs as $regis_sec){
                            $section = $regis_sec->section;
                            $w_type = $regis_sec->ta_type_work_id;
                            $status = $regis_sec->ta_status;
                        ?>
                        <tbody>
                        <tr>
                            <td class="text-center">Sec.<?=$section?></td>
                            <td class="text-center"><?=$w_type?></td>
                            <td class="text-center"><?=$status?></td>
                            <td class="text-center">
                            <?php
                            if(($status == TaStatus::START_REGISTER_TA)OR(empty($status))OR($status==TaStatus::FAIL_CHOOSE_TA)){ ?>
                                <?= Html::a(Html::tag('i', '  Choose',
                                    ['class' => 'glyphicon glyphicon-ok']),
                                    ['ta-register-section/choose-active','sec'=>$section,
                                        'type'=>$regis_sec->ta_type_work_id,
                                        's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y],
                                    [
                                        'class' => 'btn btn-sm btn-success',
                                        'data' => [
                                            'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                            'method' => 'post',
                                        ],
                                    ])?>
                            <?php  }elseif($status == TaStatus::CHOOSE_TA){?>
                                <?= Html::a(Html::tag('i', '  Cancel',
                                    ['class' => 'glyphicon glyphicon-ban-circle']),
                                    ['ta-register-section/cancel-active','sec'=>$section,
                                        'type'=>$regis_sec->ta_type_work_id,
                                        's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y],
                                    [
                                        'class' => 'btn btn-sm btn-warning',
                                        'data' => [
                                            'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                            'method' => 'post',
                                        ],  /*,'disabled' => 'disabled'*/
                                    ])?>
                            <?php  }
                              /* if($status == TaStatus::FAIL_CHOOSE_TA){?>
                            <?= Html::a(Html::tag('i', ' ',
                                ['class' => 'glyphicon glyphicon-remove']),
                                [
                                    'class' => 'btn btn-sm btn-primary',
                                    'data' => [
                                        'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                        'method' => 'post',
                                    ],
                                ])*/
                              ?>
                               <?php // }else{?>
                            <?= Html::a(Html::tag('i', ' คัดออก',
                                ['class' => 'glyphicon glyphicon-remove']),
                                ['ta-register-section/non-active','sec'=>$section,
                                    'type'=>$regis_sec->ta_type_work_id,
                                    's'=>$s,'ver'=>$ver,'u'=>$u,'t'=>$t,'y'=>$y],
                                [
                                    'class' => 'btn btn-sm btn-danger',
                                    'data' => [
                                        'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                        'method' => 'post',
                                    ],
                                ])?>
                               <?php  //}?>
                            </td>
                        </tr>
                        </tbody>
                        <?php  }?>

                    </table>
                        </div>
                  <?php
                  if (!empty($regis_secs)){
                      ?>
                  <?php }else{
                      echo ' <div align="center">
                            <strong style="color: red">
                            -- ยังไม่ทำการสมัครเลือก Section --
                            </strong></div>';
                  }?>

            <?php }else{
                  echo '-- ไม่พบรายวิชานี้ --';
              } ?>

        </div>
     <?php  }?>

    </div>
</div>
