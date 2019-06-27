<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\Kku30Subject;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ta = controllers::t( 'label', 'TA');
$title = controllers::t( 'label', 'Ta Comments');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;


$user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
$modelEnroll = ViewPisEnroll::find()->where(['STUDENTID'=>$user->person_id])->all();
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
                                <th width="10%" class="text-center">Student Name</th>
                                <th width="5%" class="text-center">Nickname</th>
                                <th width="9%" class="text-center">Comment</th>
                            </tr>
                            </thead>
                            <?php foreach ($RegisSec as $row) {
                                $per = $row->person_id;
                                $reg = \app\modules\eoffice_ta\models\TaRegister::findOne(['person_id'=>$row->person_id,'subject_id'=>$s]);
                                $ta_student = ViewStudentFull::findOne(['STUDENTID'=>$per]);
                                $ta_nickname = $ta_student->student_nickname;
                                $ta_fname = $ta_student->PREFIXNAME.' '.$ta_student->STUDENTNAME.' '.$ta_student->STUDENTSURNAME;
                                ?>
                            <tbody>
                            <tr>
                                <?php if (!empty($reg->ta_image)){ ?>
                                    <td class="text-center">
                                        <img class="circle" src="<?= Yii::getAlias('@web/web_ta/images/register/' . $reg->ta_image) ?>" alt=""
                                             width="40" height="40">
                                    </td>
                                <?php }else{?>
                                    <td class="text-center">
                                        <img class="circle" src="<?= Yii::getAlias('@web') ?>/web_ta/images/register/ta_user.jpg" alt="" width="40" height="40">
                                    </td>
                                <?php }?>
                                <td class="text-center"><?=$ta_fname?></td>
                                <td class="text-center"><?=$ta_nickname?></td>
                                <td class="text-center">
                                <?= Html::a(Html::tag('i', '',
                                        ['class' => 'glyphicon glyphicon-pencil']).'Comment' ,
                                    ['ta-comment/create','sec'=>'0'.$sec,'s'=>$s,'t'=>$t,'y'=>$y,'ta'=>$per],
                                    ['class' => 'btn btn-warning '])
                                ?>
                                </td>
                            </tr>
                            </tbody>

                            <?php  }?>
                        </table>
                        <div id="custom-pagination" class="pull-right">
                            <?php

                          /*  echo LinkPager::widget([
                            'pagination' => $pages,
                            ])*/
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
                        foreach ($modelEnroll as $row) {
                        $sec = $row->SECTION;
                        $row->COURSEID;
                        //$ver = $row->ACTION;
                        $t = $row->SEMESTER;
                        $y = $row->ACADYEAR;

                        $class = EofficeCentralRegCourse::findOne(['COURSEID' => $row->COURSEID]);
                        if (!empty($class)){
                        $COURSECODE = $class->COURSECODE;
                        $subject = Kku30Subject::findOne(['subject_id'=>$COURSECODE]);
                        if (!empty($subject)){
                            $s = $subject->subject_id;
                            ?>
                            <li>
                    <span class="label label-success width-40 height-40"><center>

                            <i class="glyphicon glyphicon-book size-15 "></i></center></span>
                                <?= Html::a($subject->subject_id.' '.$subject->subject_nameeng,
                                    ['teacher/comment-ta2','s'=>$subject->subject_id,
                                       't'=>$t]
                                ) ?>

                            </li>
                        <?php } }}?>
                    </ul>
                </div>
            </section>
        </div>
    <?php ?>
    </div>
</div>

