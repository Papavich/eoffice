<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
//use app\models\Person;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_kku30\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>
<?php
$label_subj = controllers::t( 'label', 'Subject');

$label_req = controllers::t( 'label', 'Choose TA');
$title = controllers::t( 'label', 'Choose TA');
$view = controllers::t( 'label', 'View');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;
$user = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
/*$per = Yii::$app->formatter->asNtext($u->person_id);
echo '<br>'.$per;*/
$per = $user->person_id;
$t_name = $user->person_name;
$t_surname = $user->person_surname;
?>
<!--  ขณะนี้เวลา : <?php  //date('H:i:s');?><br> -->


<div id="panel-3" class="panel panel-default">

    <!-- panel content -->
    <div class="panel-body">
        <!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->


        <!--   ขณะนี้เวลา : <?php  //date('H:i:s');?><br>    -->
        <?php
         $schedule = TaSchedule::findOne([//'ta_schedule_url'=>$url_now,
             'ta_schedule_type'=>TaSchedule::TYPE_CHO_TA,'active_status'=>TaSchedule::ACTIVE_ONE]);
        if(!empty($schedule)){

        $date_now = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')
        // date_timezone_set($date_now,'UTC+07:00');//'UTC+07:00'
        $date_open = ( $date_now>=$schedule->time_start && $date_now<=$schedule->time_end );
        $date_close1 = ($date_now<$schedule->time_start && $date_now<$schedule->time_end);
        $date_close2 = ($date_now>$schedule->time_start && $date_now>$schedule->time_end);
        $date_close3 = ($date_now>$schedule->time_start);
        $date_close4 = ($date_now>$schedule->time_end);
        if($date_now==$date_open ){

        ?>
            เลือกผู้ช่วยสอนได้ตั้งแต่วันที่ : <?php  echo $schedule->time_start?> ถึง <?php  echo $schedule->time_end?>

            <br> <br>
            <?php $form = ActiveForm::begin( [//\yii\helpers\Url::current(),
                'class' => 'horizontal',
                //'action' => ['test'],
                'method' => 'get', //['csrf' => false]
            ] ); ?>
            <fieldset>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2 col-sm-2">
                            <span class="title elipsis size-16"><!-- panel title -->
								<strong>ปีการศึกษา</strong><strong class="text-blue">
                                   </strong>
							</span>
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
                            $term3 =  substr($term_name2, 0, -5);
                            $year3 = substr($term_name2, 2, 6);
                            ?>
                        </div>
                        <div class="col-md-2 col-sm-2">
                         <span class="title elipsis size-16"><!-- panel title -->
								<strong>ค้นหารายวิชา</strong><strong class="text-blue">
                                   </strong>
							</span>
                            <?php
                            $subjects = ViewPisOfficerClass::find()->where(['SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)])->orderBy(['COURSECODE'=>SORT_ASC])->all();
                            foreach ($subjects as $subject){
                            }
                            echo Select2::widget( [
                                'name' => 'subject',
                                'value' => '',
                                'theme'=>Select2::THEME_DEFAULT,
                                'data' => ArrayHelper::map(ViewPisOfficerClass::find()->
                                addOrderBy(['COURSECODE'=>SORT_ASC])
                                    ->select(
                                        ['COURSECODE','COURSENAME','SEMESTER','ACADYEAR'
                                        ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname])->all(), 'COURSECODE', 'COURSECODE' ),
                                'options' => [
                                    'placeholder' => '-- ค้นหารายวิชา --',
                                    'multiple' => false ],
                            ] );
                            $subj = \Yii::$app->request->get('subject');
                            ?>
                        </div><br>
                        <div class="col-md-1 col-sm-1">
                            <?= Html::submitButton( '<i class="fa fa-search"></i>' . controllers::t( 'label', 'Search' ) , ['class' => 'btn btn-blue'] ) ?>
                        </div>
                        <div class="col-md-6 col-sm-6"></div>
                    </div>
            </fieldset>
            <br>
            <?php ActiveForm::end(); ?>
        <ul class="list-unstyled list-hover slimscroll height-350" data-slimscroll-visible="true">
            <?php
            $term3 =  substr($term_name2, 0, -5);
            $year3 = substr($term_name2, 2, 6);

            if (empty($term_name2)) {
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE', 'COURSENAME', 'REVISIONCODE', 'SEMESTER', 'ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname])->all();
                $model = $query;
            }elseif (!empty($subj)){
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,
                    'OFFICERSURNAME'=>$t_surname,'COURSECODE'=>$subj,'SEMESTER'=>intval($term3),
                    'ACADYEAR'=>intval($year3)])->all();
                $model = $query;
            }else{
                $query = ViewPisOfficerClass::find()->select(
                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,
                    'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)])->all();
                $model = $query;
            }


           /* $model = ViewPisOpenSubject::find()->where(['subject_id'=>$subj,
                'semester_id'=>intval($term3),'year_id'=> intval($year3)])->all();

            */

            foreach ($model as $row) {
               // $subject1 = Kku30Subject::findOne(['subject_id'=>$row->subject_id]);
                $subj_id = $row->COURSECODE;
                $t = $row->SEMESTER;
                $y = $row->ACADYEAR;
                ?>
                <li>
                    <div class="row">
                    <div class="col-md-9">
                    <span class="label label-success width-50 height-50"><center>
                            <i class="glyphicon glyphicon-tasks size-30 "></i></center></span>
                    <a href="#"><?= $subj_id ?>&nbsp;<?= $row->COURSENAME ?>
                    </a>
                    </div>
                    <?php
                    $requests = TaRequest::find()->where(['subject_id'=>$subj_id,
                        'term_id'=>$term3,'year'=>$year3])->all();
                    foreach ($requests as $req){
                    $term = Term::findOne(['term_id'=>$req->term_id]);
                    $TA_registers = TaRegister::find()->where(['subject_id'=>$subj_id,'term'=>$req->term_id,
                        'ta_status_id'=>[
                        TaStatus::START_REGISTER_TA ,
                      //  TaStatus::CHOOSE_TA,
                       // TaStatus::FAIL_CHOOSE_TA
                    ]])->all();
                        $TA_rg_ches = TaRegister::find()->where(['subject_id'=>$subj_id,'term'=>$req->term_id,
                            'ta_status_id'=>[
                                TaStatus::CHOOSE_TA,
                                 TaStatus::FAIL_CHOOSE_TA,
                                TaStatus::REGISTER_TA_READ
                            ]])->all();
                    $amount_regis = count($TA_registers);
                        }
                        if(empty($requests)){ ?>
                            <span  class=" label label-danger  size-14 " >
                        <i class="fa fa-exclamation-triangle"></i>ยังไม่ได้ทำการร้องขอผู้ช่วยสอน</span>
                            <?php }else{?>
                    <div class="col-md-3">

                    <?php if (!empty($TA_registers)) { //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ //fa fa-bolt?>
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                    <strong class="badge size-14 " style="background-color: #ffb733;">
                <i class="glyphicon glyphicon-user"></i>  <?=$amount_regis?> คน</strong>
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-user']) . $view,
                            ['read','s' => $subj_id,'t'=>$t,'y'=>$y],
                            ['class' => 'btn  btn-blue pull-right']) ?>
                     <?php }elseif(!empty($TA_rg_ches)) { //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ //fa fa-bolt?>
                            <?= Html::a(Html::tag('i', '',
                                    ['class' => 'glyphicon glyphicon-user']) . $view,
                                ['read','s' => $subj_id,'t'=>$t,'y'=>$y],
                                ['class' => 'btn  btn-blue pull-right']) ?>
                    <?php  }else {?>
                        &nbsp;&nbsp;&nbsp;
                        <span  class=" label label-warning  size-14 " >
                        <i class="et-sad"></i>ยังไม่มีใครมาสมัคร</span>
                    <?php }?>
                    </div>
                    </div>
                </li>
            <?php }}?>

        </ul>
        <?php }elseif ($date_now!=$date_open){
        //}elseif($date_now==$date_close1||$date_now==$date_close2||$date_now==$date_close3||$date_now==$date_close4){ ?>
          <div align="center">
                <strong class="color-red">NOT OPEN!!!</strong>
            </div>
        <?php  }}else{?>
           <div align="center">
                <strong class="color-red">ยังไม่กำหนด!!!</strong>
            </div>
        <?php  }?>
    </div>
    <!-- /panel content -->

</div>
