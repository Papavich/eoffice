<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\timeago\TimeAgo;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\ViewPisEnroll;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisSubjectSectionTeacher;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$comment = controllers::t( 'label', 'Comments');
$label_subj = controllers::t( 'label', 'Subject Enroll');
$label_subj_TA = controllers::t( 'label', 'Subject for TA');
$title = controllers::t( 'label', 'Ta Comments');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

//$person = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);


//$modelSecTeacher = SectionTeacher::find()->where(['teacher_id'=>$person->person_id])->all();

?>
<div class="ta-comment-index">

    <!-- panel content -->
<div class="row">
    <div class="col-md-8">

            <div class="panel panel-default">
                <header class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <span class="label label-warning width-30 height-40">
                <i class="glyphicon glyphicon-comment size-18">
                </i></span>
            <?php
            $std =  ViewStudentFull::findOne(['STUDENTID'=>$ta]);
            $std_id = $std->STUDENTCODE;
            $prefix = $std->PREFIXNAME;
            $std_name = $std->STUDENTNAME;
            $std_surname = $std->STUDENTSURNAME;
            $nickname = $std->student_nickname;
            ?>
            <?=$comment?>  ของ : <?=$prefix?> <?=$std_name?> <?=$std_surname?> &nbsp;(<?=$nickname?>)   </strong> <!-- panel title -->
	</span>
                </header>
                <div class="panel-body">

            <ul class="comment list-unstyled height-300">
                <li class="comment">
                <?php
                if (!empty($Comment)){
                foreach ($Comment as $item){

                $sec = $item->section;
                $feeling = $item->ta_comment_feeling;
                ?>
                <li class="comment comment-reply ">
                    <!-- comment body -->
                    <a href="#" class="comment-author">
                        <small class="text-muted pull-right">
                            <?php echo TimeAgo::widget(['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language]) ?>
                        </small>
                        <span>วิชา<?= $item->subject_id ?></span>
                    </a>
                    <p>
                        <?= $item->ta_comment_text ?>
                        <i class="fa fa-commenting-o"></i>
                    </p>
                    <!-- options -->
                    <ul class="list-inline size-11 ">
                        <li>
                            <?php if ($feeling == '1') {
                                // ดีมาก มีความสุข  สนุกสนาน   ได้ความรู้  อยากงอแง  งง?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/elysium.png"
                                         height="20"/>
                                    รู้สึกสดใส</a>
                            <?php } elseif ($feeling == '2') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/shy.png" height="20"/>
                                    รู้สึกเขิน</a>
                            <?php } elseif ($feeling == '3') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/happy.png"
                                         height="20"/>
                                    รู้สึกสนุกสนาน</a>
                            <?php } elseif ($feeling == '4') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/smart.png"
                                         height="20"/>
                                    รู้สึกได้ความรู้</a>
                            <?php } elseif ($feeling == '5') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/cry.png" height="20"/>
                                    รู้สึกอยากงอแง</a>

                            <?php } elseif ($feeling == '6') { ?>
                                <a href="#" class="text-success">
                                    <img src="<?= Yii::getAlias('@web') ?>/web_ta/images/feeling/numb2.png"
                                         height="20"/>
                                    รู้สึกงง</a>
                            <?php } ?>
                        </li>

                        <li>
                        <li class="pull-right">
                         <strong> by : </strong>
                            <strong class="label label-info size-11"> Sec.<?=$sec?></strong>

                        </li>

                        </li>
                    </ul><!-- /options -->

                </li>
                <?php } ?>
            </ul>
                    </ul>

                    <!-- /COMMENT -->
                    <div id="custom-pagination" class="pull-right">
                        <?php

                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ])
                        ?>
                    </div>
                    <?php
                    }else {

                        echo "SORRY is ERROR!!!!!";
                       // echo Yii::$app->user->id;
                       // echo $person->;
                    } ?>
                </div>

            </div>

    </div>
    <!-- /panel content -->

    <!-- ***********************************  list Subject for Teacher  **************************** -->

    <?php
    //if (!empty($modelSecTeacher)){ //ถ้าลงทะเบียนเรียน จะแสดง  ?>
    <!-- panel content -->
    <div class="col-md-4">
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
                    $person = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
                    $per = Yii::$app->formatter->asNtext($person->person_id);

                    $modelSecTeacher = ViewPisOfficerClass::find()->select(
                        ['COURSECODE', 'COURSENAME', 'REVISIONCODE', 'SEMESTER', 'ACADYEAR'
                        ])->distinct()->where(
                            ['OFFICERNAME'=>$person->person_fname_th,'OFFICERSURNAME'=>$person->person_lname_th
                            ,'SEMESTER'=>$t,'ACADYEAR'=>$y]
                    )->all();
                    $modelTeacher2 = ViewPisOfficerClass::findOne(
                            ['OFFICERNAME'=>$person->person_fname_th,'OFFICERSURNAME'=>$person->person_lname_th
                                ,'SEMESTER'=>$t,'ACADYEAR'=>$y]
                    );  //$modelTeacher2->OFFICERNAME;$modelTeacher2->COURSENAMEENG;$modelTeacher2->COURSECODE;
                    foreach ( $modelSecTeacher as $row_teacher){
                     /*   $subj[] =  $row_teacher->COURSECODE;
                        $modelSubjects = Kku30Subject::find()->where(['subject_id'=>$subj])->all();
                    }
                    foreach ($modelSubjects as $modelSubject){*/

                        ?>
                        <li>
                    <span class="label label-success width-40 height-40"><center>

                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                            <?= Html::a($row_teacher->COURSECODE.' '.$row_teacher->COURSENAME,
                                ['teacher/comment-ta2','s'=>$row_teacher->COURSECODE,
                                    'ver'=>$row_teacher->REVISIONCODE,'t'=>$row_teacher->SEMESTER,
                                    'y'=>$row_teacher->ACADYEAR]
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
    <!-- /panel content -->

