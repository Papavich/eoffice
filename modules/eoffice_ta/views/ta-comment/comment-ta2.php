<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
use app\models\Person;
use app\modules\eoffice_ta\models\model_main\Studentreg;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\ViewStudentFull;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\model_main\RegStudentmaster;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\SectionTeacher;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\model_main\Level;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<?php

$comment = controllers::t( 'label', 'Comments');
$label_subj = controllers::t( 'label', 'List of register');
$label_ta_fail = 'รายชื่อผู้สมัครที่คัดออก';
$label_req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'View comment TA');
$view = controllers::t( 'label', 'View');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;


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
<div class="ta-comment2">
<div class="row">
    <div class="col-md-9">

        <div class="panel panel-default">
            <header class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <span class="label label-warning width-30 height-40">
                <i class="glyphicon glyphicon-comment size-18">
                </i></span> <?=$comment?></strong> <!-- panel title -->
	</span>
            </header>

    <!-- panel content -->
    <div class="panel-body">
                <div class="table-responsive height-300">
                    <table class="table table-hover table-vertical-middle nomargin ">
                        <thead>
                        <tr>
                            <th width="1%""></th>
                            <th width="2%">Student ID</th>
                            <th width="12%" class="text-center">Student Name</th>
                            <th width="1%" class="text-center">Nickname</th>
                            <th width="8%" class="text-center">Level</th>
                            <th width="5%" class="text-center">Section Amount</th>
                            <th width="2%" class="text-center">Comment</th>
                        </tr>
                        </thead>
            <?php
               foreach  ($model as $item) {
                   $u = EofficeMainUser::findOne(['person_id' => $item->person_id]);
                   $uid = $u->id;
                   $ta = $item->person_id;
                   $std =  ViewStudentFull::findOne(['STUDENTID'=>$item->person_id]);

                   $std_id = $std->STUDENTCODE;
                    $prefix = $std->PREFIXNAME;
                   $std_name = $std->STUDENTNAME;
                   $std_surname = $std->STUDENTSURNAME;
                   $nickname = $std->student_nickname;
                   $level = $std->LEVELNAME;
                   $status = $item->ta_status_id;
                   $regis_secs = TaRegisterSection::find()
                       ->where(['person_id'=>$item->person_id,'term'=>$item->term,'year'=>$item->year
                           ,'subject_id'=>$item->subject_id,'subject_version'=>$item->subject_version,'ta_status'=>TaStatus::CHOOSE_TA])->orderBy(['ta_type_work_id'=>SORT_ASC])->all();
                   $rs_count = count($regis_secs);

                   $comments = TaComment::find()->where(['subject_id'=>$item->subject_id,
                       'term'=>$item->term,'year'=>$item->year])->all();
                   $sum_comment = count($comments);
          ?>

                        <tbody>
                        <tr>
                            <?php if (!empty($item->ta_image)){ ?>
                                <td class="text-center">
                                    <img class="circle" src="<?= Yii::getAlias('@web/web_ta/images/register/' . $item->ta_image) ?>" alt=""
                                         width="40" height="40">
                                </td>
                            <?php }else{?>
                                <td class="text-center">
                                    <img class="circle" src="<?= Yii::getAlias('@web') ?>/web_ta/images/register/ta_user.jpg" alt="" width="40" height="40">
                                </td>
                            <?php }?>
                            <td><?=$std_id?></td>
                            <td class="text-center"><?=$prefix?>&nbsp;<?=$std_name?>&nbsp;&nbsp;<?=$std_surname?></td>
                            <td class="text-center"><?=$nickname?></td>
                            <td class="text-center"><?=$level?></td>

                            <td class="text-center">
                                <?php
                                   foreach ($regis_secs as $regis_sec) {
                                       $sec = $regis_sec->section;
                                       $type_work = $regis_sec->ta_type_work_id;
                                       if ($type_work == 'C'){
                                    ?>
                                       <span class="label label-warning">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                <?php }elseif($type_work == 'L'){?>
                                             <span class="label label-success">Sec.<?=$sec?> (<?=$type_work?>)&nbsp;</span>
                                <?php  }}?>
                                </td>
                            <td class="text-center">

                                <?=  Html::a(Html::tag('i', '',
                                        ['class' => 'glyphicon glyphicon-comment size-15'])
                                    .'<strong class="size-15">'. $sum_comment.'</strong>',
                                    ['comment-ta3','ta'=>$ta,'s'=>$item->subject_id,'ver'=>$item->subject_version,
                                        't'=>$item->term],
                                    ['class' => 'btn btn-sm btn-info ']) ?>
                            </td>

                        </tr>
                        </tbody>

                   <?php  }?>
                    </table>
                    <div id="custom-pagination" class="pull-right">
                        <?php

                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                    </div>
                </div>
        <div></div>
                <!-- /panel content -->
    </div>

        </div>

    </div>

    <?php
    //if (!empty($modelSecTeacher)){ //ถ้าลงทะเบียนเรียน จะแสดง  ?>
        <!-- panel content -->
        <div class="col-md-3">
            <section class="panel panel-default">
                <header class="panel-heading">
	<span class="title elipsis">
        <span class="label label-warning width-40 height-40"><i class="glyphicon glyphicon-tasks size-15"></i></span>
		<strong class=" size-18">
            รายวิชาที่สอน</strong> <!-- panel title -->
	</span>
                </header>

                <div class="panel-body">
                    <ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">

                    <?php
                    $person = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
                    $per = Yii::$app->formatter->asNtext($person->person_id);


                    $modelSecTeacher = SectionTeacher::find()->where(['teacher_id'=>$per])->all();
                    $modelTeacher2 = SectionTeacher::findOne(['teacher_id'=>$per]);
                    foreach ( $modelSecTeacher as $row_teacher){
                        $subj[] =  $row_teacher->subject_id;
                        //  $count_hrp =array_sum($hr_p);
                        $modelSubjects = Subject::find()->where(['subject_id'=>$subj])->all();
                    }
                    foreach ($modelSubjects as $modelSubject){

                        ?>
                        <li>
                    <span class="label label-success width-40 height-40"><center>

                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                            <?= Html::a($modelSubject->subject_id.' '.$modelSubject->subject_nameeng,
                                ['teacher/comment-ta2','s'=>$modelSubject->subject_id,
                                    'ver'=>$modelSubject->subject_version,'t'=>$row_teacher->term_id]
                            ) ?>

                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </section>
        </div>
    <?php  //}?>
    </div>
    </div>

