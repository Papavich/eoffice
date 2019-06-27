<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\Kku30Subject;
//use app\models\Person;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use app\modules\eoffice_ta\controllers\StaffController;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaProperty;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\TaRequest;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>
<?php
$label_subj_pass = controllers::t( 'label', 'Subject Pass');
$label_subj_Register = controllers::t( 'label', 'Subject Register');
$label_subj_Request = controllers::t( 'label', 'Subject Request');
$label_subj_fail = controllers::t( 'label', 'Subject Fail');
$label_regis = controllers::t( 'label', 'Register');
$title = controllers::t( 'label', 'Register TA');
$edit = controllers::t( 'label', 'Edit');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;
Yii::$app->formatter->locale = 'th-TH';
$time = time();

?>

    <!-- ขณะนี้เวลา : <?php  // Yii::$app->formatter->asTime($time, 'medium');?><br>  -->

<?php
/* Yii::$app->timeZone = 'Asia/Kolkata'; // change timezone on the fly
 echo Yii::$app->timeZone; // new timezone
*/
/*$schedule = TaSchedule::findOne(['ta_schedule_url'=>$url_now,'active_status'=>TaSchedule::ACTIVE_ONE]);
if(!empty($schedule)){ */
    /* echo $schedule->ta_schedule_url;
     echo $schedule->ta_schedule_type;
    */

 /*   $date_now = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')
    // date_timezone_set($date_now,'UTC+07:00');//'UTC+07:00'
    $date_open = ( $date_now>=$schedule->time_start && $date_now<=$schedule->time_end );
    $date_close1 = ($date_now<$schedule->time_start && $date_now<$schedule->time_end);
    $date_close2 = ($date_now>$schedule->time_start && $date_now>$schedule->time_end);
    $date_close3 = ($date_now>$schedule->time_start);
    $date_close4 = ($date_now>$schedule->time_end);
    if($date_now==$date_open ){
        $t_start = Yii::$app->formatter->asDate($schedule->time_start);
        $t_end = Yii::$app->formatter->asDate($schedule->time_end);
 */

        ?>
    <!-- panel content -->

<!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->
<?php $form = ActiveForm::begin( [//\yii\helpers\Url::current(),
    'class' => 'horizontal',
    //'action' => ['test'],
    'method' => 'get', //['csrf' => false]
] ); ?>
<div class="panel-body">
<fieldset>
    <div class="row">
        <div class="form-group">
            <div class="col-md-2 col-sm-2">
                       <span class="title elipsis ">
		<strong class="size-18"><i class="glyphicon glyphicon-filter"></i>ปีการศึกษา</strong> <!-- panel title -->
      	</span><span> &nbsp;&nbsp;&nbsp; </span>
                <?php
            $terms = Term::find()->orderBy(['year'=>SORT_ASC])->all();
            foreach ($terms as $term){

            }
            echo Select2::widget( [
                'name' => 'term_name',
                'value' => '',
                'theme'=>Select2::THEME_DEFAULT,
                'data' => ArrayHelper::map(Term::find()->
                addOrderBy(['term_name'=>SORT_ASC])->
                addOrderBy(['year'=>SORT_ASC])->all(), 'term_name', 'term_name' ),
                'options' => [
                    'placeholder' => '-- เลือกปีการศึกษา --',
                    'multiple' => false ],
            ] );

            $term_name2 = \Yii::$app->request->get('term_name');

            ?>
        </div><br>
            <div class="col-md-1 col-sm-1">
                <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) , ['class' => 'btn btn-blue'] ) ?>
            </div>
            <div class="col-md-8 col-sm-8"></div>
        </div>
</fieldset>
<?php ActiveForm::end(); ?>
</div>

<!-- ////////////////////////////////////////////// [ วิชาที่สมัครแล้ว ]////////////////////////////////////////////////////// -->

<div class="panel panel-default">
<header class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <span class="label label-success width-30 height-40">
                <i class="glyphicon glyphicon-book size-18">
                </i></span> <?=$label_subj_Register?></strong> <!-- panel title -->
	</span>
</header>
	     <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-vertical-middle nomargin">
                    <thead>
                    <tr >
                        <th class="text-center" width="8%">Subject</th>
                        <th class="text-center" width="5%">จำนวนผู้ช่วยสอนที่ต้องการ</th>
                        <th class="text-center" width="5%">คุณสมบัติ</th>
                        <th class="text-center" width="5%">สถานะ</th>
                        <th class="text-center" width="2%">Action</th>
                    </tr>
                    </thead>

<?php
         $term3 =  substr($term_name2, 0, -5);
         $year3 = substr($term_name2, 2, 6);
        $courses = EofficeCentralRegCourse::find()->where(
            [
                'FACULTYID'=>StaffController::FACT_SIENCE,
                'DEPARTMENTID'=>StaffController::DEPT_CS
            ])->all();
      //  foreach ($courses as $course) {

            //$c = Yii::$app->formatter->asNtext($course->COURSECODE);

            $query = TaRequest::find()
                ->where(['term_id'=>intval($term3),'year'=>intval($year3)])
                ->orderBy('subject_id');//->where(['subject_id' => $c]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
            $model = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
            ?>

            <?php
                if (!empty($model)){
                foreach ($model as $row) {
                    $subj_full = Kku30Subject::findOne(['subject_id'=>$row->subject_id]);
                    $bachelor = $row->degree_bachelor;
                    $master = $row->degree_master;
                    $row->degree_doctorate;
                    ?>
                    <?php
                    $u = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
                    $student = ViewStudentFull::findOne(['STUDENTID'=>$u->person_id]);
                    $regises = TaRegister::find()->where(['subject_id'=>$row->subject_id,
                        'person_id' => $u->person_id])->all();

                    $course2 = EofficeCentralRegCourse::findOne(['COURSECODE'=>$row->subject_id]);
                    $Enroll = ViewPisEnroll::findOne([
                            'STUDENTID'=>$u->person_id,'COURSEID'=>$course2->COURSEID]);
                    //$Enroll->COURSEID;

                    ?>
                    <tbody>
                    <tr>
                        <?php
                        if (!empty($regises)){
                        if (!empty($subj_full)) {
                            ?>  <td >
                            <?= $row->subject_id ?>&nbsp;<?php echo $subj_full->subject_namethai ?>

                            </td>
                            <?php  } ?>

                    <td class="text-center">
                        <strong style="color: #00bfff" class="size-13">
                             <i class="fa fa-user"></i>
                            <?php echo $row->amount_ta_all; ?>
                        </strong>
                    </td>

                            <td class="text-center">
                                <?php
                                $property = TaProperty::findOne(['level_degree'=>'ปริญญาตรี','active_status'=>'1']);
                                if (empty($Enroll)){
                                    echo ' <span  class=" size-14" style="color: red" >
                <i class="fa fa-warning"></i> ยังไม่เคยเรียนวิชานี้';
                                }else{
                                    if ($Enroll->GRADE <= $property->ta_property_name) {
                                        echo ' <span  class=" label label-success  size-14 " >
                <i class="glyphicon glyphicon-ok"></i> คุณสมบัติผ่าน</span>';
                                    }else{
                                        echo ' <span  class=" label label-warning  size-14 " >
                <i class="fa fa-warning"></i> คุณสมบัติไม่ผ่าน';
                                    }

                                }
                                ?>
                        </td>
                            &nbsp;&nbsp;&nbsp;
                        <td class="text-center">
                            <span  class=" label label-success  size-14 " >
                <i class="glyphicon glyphicon-ok"></i> สมัครแล้ว</span>
                        </td>
                        <td class="text-center">
                            <?= Html::a(Html::tag('i', '',
                                    ['class' => 'glyphicon glyphicon-pencil']) . $edit,
                                ['ta-register-section/update',
                                    'id' => $row->subject_id,
                                    'ver'=>$row->subject_version ,
                                    'y' => $row->year,
                                    't' => $row->term_id
                                ],
                                ['class' => 'btn btn-reveal btn-warning']) ?>
                        </td>
                        <?php   //}else{?>

                        <?php } ?>
                        </tr>
                        </tbody>
                <?php  }
                } ?>
        <?php //}?>
                </table>
            </div>
             <div id="custom-pagination" class="pull-right">
                 <?php
                 echo LinkPager::widget([
                     'pagination' => $pages,
                 ])
                 ?>

             </div>
         </div>
        <!-- /panel content -->

</div>
<!-- ////////////////////////////////////////////// [ วิชาที่รับสมัคร ]////////////////////////////////////////////////////// -->

<div class="panel panel-default">
    <header class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <span class="label label-warning width-30 height-40">
                <i class="glyphicon glyphicon-book size-18">
                </i></span> <?=$label_subj_Request?></strong> <!-- panel title -->
	</span>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-vertical-middle nomargin">
                <thead>
                <tr >
                    <th class="text-center" width="8%">Subject</th>
                    <th class="text-center" width="5%">จำนวนผู้ช่วยสอนที่ต้องการ</th>
                    <th class="text-center" width="5%">คุณสมบัติ</th>
                    <th class="text-center" width="5%">สถานะ</th>
                    <th class="text-center" width="2%">Action</th>
                </tr>
                </thead>

                <?php
                $term3 =  substr($term_name2, 0, -5);
                $year3 = substr($term_name2, 2, 6);
                $courses = EofficeCentralRegCourse::find()->where(
                    [
                        'FACULTYID'=>StaffController::FACT_SIENCE,
                        'DEPARTMENTID'=>StaffController::DEPT_CS
                    ])->all();
                //  foreach ($courses as $course) {

                //$c = Yii::$app->formatter->asNtext($course->COURSECODE);
                $query = TaRequest::find()
                    ->where(['term_id'=>intval($term3),'year'=>intval($year3)])
                    ->orderBy('subject_id');//->where(['subject_id' => $c]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6]);
                $model = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                ?>
                <?php
                if (!empty($model)){
                    foreach ($model as $row) {
                        $subj_full = Kku30Subject::findOne(['subject_id'=>$row->subject_id]);
                        $bachelor = $row->degree_bachelor;
                        $master = $row->degree_master;
                        $row->degree_doctorate;
                        ?>
                        <?php
                        $u = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
                        $student = ViewStudentFull::findOne(['STUDENTID'=>$u->person_id]);
                        $regises = TaRegister::find()->where(['subject_id'=>$row->subject_id,
                            'person_id' => $u->person_id])->all();

                        $course2 = EofficeCentralRegCourse::findOne(['COURSECODE'=>$row->subject_id]);
                        $Enroll = ViewPisEnroll::findOne([
                            'STUDENTID'=>$u->person_id,'COURSEID'=>$course2->COURSEID]);
                        ?>
                        <tbody>
                        <tr>

                                <?php
                        if (empty($regises)){
                                if (!empty($subj_full)) {
                                    ?> <td >
                                    <?= $row->subject_id ?>&nbsp;<?php echo $subj_full->subject_namethai ?>
                                    </td>
                                <?php  } ?>

                            <td class="text-center">
                                <strong style="color: #00bfff" class="size-13">
                                    <i class="fa fa-user"></i>
                                    <?php echo $row->amount_ta_all; ?>
                                </strong>
                            </td>
                            <td class="text-center">
                                <?php
                                $property = TaProperty::findOne(['level_degree'=>'ปริญญาตรี','active_status'=>'1']);

                                if (empty($Enroll)){
                                    echo ' <span  class=" size-14" style="color: red" >
                <i class="fa fa-warning"></i> ยังไม่เคยเรียนวิชานี้';
                                }else{
                                    if ($Enroll->GRADE <= $property->ta_property_name) {
                                        echo ' <span  class=" label label-success  size-14 " >
                <i class="glyphicon glyphicon-ok"></i> คุณสมบัติผ่าน</span>';
                                    }else{
                                        echo ' <span  class=" label label-warning  size-14 " >
                <i class="fa fa-warning"></i> คุณสมบัติไม่ผ่าน';
                                    }
                                    // }elseif ($Enroll->GRADE == 'C')
                                }
                                ?>
                            </td>
                            <?php  //if (!empty($regises)) { //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ ?>

                            <?php   //}else{?>
                            <td class="text-center">
                            <span  class=" label label-primary  size-14 " >
                             <i class="glyphicon glyphicon-exclamation-sign"></i> ยังไม่สมัคร</span>
                            </td>
                                <td class="text-center">
                                    <?= Html::a(Html::tag('i', '',
                                            ['class' => 'glyphicon glyphicon-plus-sign']) . $label_regis,
                                        ['ta-register-section/create',
                                            'id' => $row->subject_id,
                                            'ver'=>$row->subject_version ,
                                            'y' => $row->year,
                                            't' => $row->term_id
                                        ],
                                        ['class' => 'btn btn-reveal btn-blue']) ?>
                                </td>
                            <?php }
                            ?>
                        </tr>
                        </tbody>
                    <?php  }
                } ?>
                <?php //}?>
            </table>
        </div>
        <div id="custom-pagination" class="pull-right">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,

            ])
            ?>

        </div>
    </div>
    <!-- /panel content -->

</div>
