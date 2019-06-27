<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\timeago\TimeAgo;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaComment;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\SectionTeacher;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$comment = controllers::t( 'label', 'Comments');
$label_subj = controllers::t( 'label', 'Subject Enroll');
$label_subj_TA = controllers::t( 'label', 'Subject for TA');
$title = controllers::t( 'label', 'Ta Comments');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$person = ViewPisUser::findOne(['id' => Yii::$app->user->id]);


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
                </i></span> <?=$comment?></strong> <!-- panel title -->
	</span>
                </header>
                <div class="panel-body">

            <ul class="comment list-unstyled height-400">
                <li class="comment">
                <?php
                if (!empty($Comment)){
                foreach ($Comment as $item){
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
                        <li class="pull-right">
                            <a href="#" class="text-danger">Delete</a>
                        </li>
                        <li class="pull-right">
                            <a href="#" class="text-primary">Edit</a>
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
                    }else if (empty($Comment)){

                        echo "<center><strong style='color: blue'> ยังไม่มีใครมาComment</strong></center>";

                    }else{
                        echo "<center><strong style='color: red'> SORRY is ERROR!!!!!</strong></center>";

                    }?>
                </div>

            </div>

    </div>
    <!-- /panel content -->

    <!-- ***********************************  list Subject for Teacher  **************************** -->
    <?php
    if (!empty($modelSecTeacher)){ //ถ้าลงทะเบียนเรียน จะแสดง  ?>
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

                            foreach ( $modelSecTeacher as $row_teacher){
                                $subj[] =  $row_teacher->COURSECODE;
                                //  $count_hrp =array_sum($hr_p);
                                $modelSubjects = EofficeCentralRegCourse::find()->where(
                                        ['COURSECODE'=>$subj])->all();
                            }
                            foreach ($modelSubjects as $modelSubject){
                            ?>
                            <li>
                    <span class="label label-success width-40 height-40"><center>

                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                                <?= Html::a($modelSubject->COURSECODE.' '.$modelSubject->COURSENAMEENG) ?>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </section>
        </div>
    <?php }?>

    <!-- ***********************************  list Subject for Student (Enroll)  **************************** -->
    <?php  if (!empty($modelTA)){ //ถ้าเป็นTA จะแสดง  ?>
    <!-- panel content -->
    <div class="col-md-4">
        <section class="panel panel-default">
            <header class="panel-heading">
	<span class="title elipsis">
        <span class="label label-warning width-40 height-40"><i class="glyphicon glyphicon-tasks size-15"></i></span>
		<strong class=" size-18">
            <?=$label_subj_TA?></strong> <!-- panel title -->
	</span>
            </header>

            <div class="panel-body">
        <ul class="list-unstyled list-hover slimscroll height-200" data-slimscroll-visible="true">
            <?php
            $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
            foreach ($modelTA as $rowTA) {
                     $s_ta = $rowTA->subject_id;
                     $ver_ta = $rowTA->subject_version;
                     $t_ta = $rowTA->term;
                     $y_ta = $rowTA->year;
                     /*$RegisSection = TaRegisterSection::find()->where(['subject_id'=>$s_ta,
                         'subject_version'=>$ver_ta,'person_id'=>$user->person_id,'term'=>$t_ta,
                         'year'=>$y_ta]);*/
                     //$sec = $rowTA->section;

                     $subj = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s_ta,'REVISIONCODE'=>$ver_ta]);
                ?>
                <li>
                    <span class="label label-success width-40 height-40"><center>
                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                        <?= Html::a($rowTA->subject_id.' '.$subj->COURSENAMEENG,
                            ['ta-comment/comment-ta' ,
                                's'=>$s_ta,
                                'ver'=>$ver_ta,
                                't'=>$t_ta,'y'=>$y_ta
                            ]
                        ) ?>

                </li>
            <?php }?>
        </ul>
        </div>
        </section>
    </div>
    <!-- /panel content -->
    <?php }?>

    <!-- ***********************************  list Subject for TA  **************************** -->
    <?php
    $model = ViewPisEnroll::find()->where(['STUDENTID'=>$person->person_id])->all();
    if (!empty($model)){ //ถ้าลงทะเบียนเรียน จะแสดง  ?>
    <!-- panel content -->
    <div class="col-md-4">
        <section class="panel panel-default">
            <header class="panel-heading">
	<span class="title elipsis">
        <span class="label label-warning width-40 height-40"><i class="glyphicon glyphicon-tasks size-15"></i></span>
		<strong class=" size-18">
            <?=$label_subj?></strong> <!-- panel title -->
	</span>
            </header>

            <div class="panel-body">
                <ul class="list-unstyled list-hover slimscroll height-200" data-slimscroll-visible="true">
                    <?php
                    foreach ($model as $row) {
                        $sec = $row->SECTION;
                        $row->COURSEID;

                        $t = $row->SEMESTER;
                        $y = $row->ACADYEAR;
                        $Course= EofficeCentralRegCourse::findOne(['COURSEID' => $row->COURSEID]);

                       // $ver = $class->REVISIONCODE;
                        if (!empty($Course)){
                        $COURSECODE = $Course->COURSECODE;
                        $subject = Kku30Subject::findOne(['subject_id'=>$COURSECODE]);
                            if (!empty($subject)){

                        $s = $Course->COURSECODE;

                        ?>
                        <li>
                    <span class="label label-success width-40 height-40"><center>
                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                            <?= Html::a($s.' '.$Course->COURSENAMEENG,
                                ['ta-comment/ta-list' ,
                            'sec'=>$sec, 's'=>$s,
                                    //'ver'=>$ver,
                           't'=>$t,'y'=>$y
                          ]
                            ) ?>
                            <span  class=" label label-info  " >
                Sec.<?=$sec?></span>

                        </li>
                    <?php }}}/*else{
                        echo 't';
                    }*/}?>
                    <?php //}?>
                </ul>
            </div>
        </section>
    </div>




</div>
</div>
    <!-- /panel content -->

