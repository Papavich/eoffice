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
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClass;
use app\modules\eoffice_ta\models\TaStatus;

use yii\widgets\Menu;

use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
//use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;



?>
<?php
$label_subj = controllers::t( 'label', 'Teaching Subject');
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

<?php //echo  'ขณะนี้เวลา : '.date('Y-m-d H:i:s') //date('H:i:s');?><br>

        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>รายวิชาที่สอน</strong><strong class="text-blue">
                                   </strong>
							</span>
            </div>
            <div class="panel-body">
                <!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->
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
                <?php ActiveForm::end(); ?>
                <br>

                <?php
        /*echo $term_name2.'!!!!!!!';
        echo  substr($term_name2, 0, -5);
        echo  substr($term_name2, 2, 6);
        */
        ?>
        <?php
     /*  $schedule = TaSchedule::findOne(['ta_schedule_url'=>$url_now,'active_status'=>TaSchedule::ACTIVE_ONE]);
        if(!empty($schedule)){

            $term = Term::findOne(['term_id'=>$schedule->term]);
            if (!empty($term)){
                $t = $term->term_id;
                $y = $term->year;

                $date_now = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')
                // date_timezone_set($date_now,'UTC+07:00');//'UTC+07:00'
                $date_open =  $date_now >= $schedule->time_start && $date_now <= $schedule->time_end ;
                $date_close1 = ($date_now<$schedule->time_start && $date_now<$schedule->time_end);
                $date_close2 = ($date_now>$schedule->time_start && $date_now>$schedule->time_end);
                $date_close3 = ($date_now>$schedule->time_start);
                $date_close4 = ($date_now>$schedule->time_end);
                if($date_now != $date_close3 ||$date_now != $date_close4){*/
                    ?>
                    <!-- ตั้งแต่วันที่ : <?php //$schedule->time_start?> ถึง <?php //$schedule->time_end?>   -->
                    <div class="table-responsive">
                        <table class="table table-hover table-vertical-middle nomargin">
                            <thead >
                            <tr class="info">
                                <th class="text-center"><?=$label_subj?></th>
                                <th class="text-center"><?=$label_credit?></th>
                                <th class="text-center">จำนวนผู้ช่วยสอน</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <?php


                            if (empty($term_name2)) {
                                $query = ViewPisOfficerClass::find()->select(
                                    ['COURSECODE', 'COURSENAME', 'REVISIONCODE', 'SEMESTER', 'ACADYEAR'
                                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname]);
                                $countQuery = clone $query;
                                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                                $model = $query->offset($pages->offset)
                                    ->distinct('COURSECODE')
                                    ->limit($pages->limit)
                                    ->all();
                            }elseif (!empty($subj)){
                                $query = ViewPisOfficerClass::find()->select(
                                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,'COURSECODE'=>$subj,'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                                $countQuery = clone $query;
                                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                                $model = $query->offset($pages->offset)
                                    ->distinct('COURSECODE')
                                    ->limit($pages->limit)
                                    ->all();
                            }else{
                                $query = ViewPisOfficerClass::find()->select(
                                    ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                                    ])->distinct()->where(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                                $countQuery = clone $query;
                                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                                $model = $query->offset($pages->offset)
                                    ->distinct('COURSECODE')
                                    ->limit($pages->limit)
                                    ->all();
                            }
                            foreach ($model as $item){
                                $item2 = ViewPisOfficerClass::findOne(['OFFICERNAME'=>$t_name,'OFFICERSURNAME'=>$t_surname,'COURSECODE'=>$item->COURSECODE,
                                    'REVISIONCODE'=>$item->REVISIONCODE,
                                    'SEMESTER'=>$item->SEMESTER,
                                    'ACADYEAR'=>$item->ACADYEAR]);
                                $subj_id =  $item->COURSECODE;
                                $subj_name = $item->COURSENAME;
                                $teacher = $item2->PREFIXABB.' '.$item2->OFFICERNAME.' '.$item2->OFFICERSURNAME;
                                $credit = $item2->COURSEUNIT;
                                $ver = $item->REVISIONCODE;
                                $term =  $item->SEMESTER; //$item->subopen_semester;
                                $year =  $item->ACADYEAR; //$item->subopen_year;
                                $requests = TaRequest::findOne(['subject_id'=>$subj_id,'term_id'=>$term,'year'=>$year]);
                                ?>
                                <tbody>
                                <tr>

                                    <td >
                                        <i class="glyphicon glyphicon-book size-18" style="color: #0E2231"></i>&nbsp;
                                        <a href="#"><?php echo $subj_id .' '.$subj_name?>&nbsp;

                                        </a>
                                    </td>
                                    <td><strong><?=$credit?></strong></td>
                                    <?php
                                     $register = TaRegister::find()->where(['subject_id'=>$subj_id,'subject_version'=>$ver,
                                         'term'=>$term,'year'=>$year,'ta_status_id'=>TaStatus::CHOOSE_TA])->all();

                                    ?>
                                    <td><strong><?=count($register)?></strong></td>
                                    <?php if (!empty($requests)) {
                                        //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ ?>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">
                                  <span  class=" label label-success  size-14 " >
                                   <i class="glyphicon glyphicon-ok"></i> ร้องขอผู้ช่วยสอนแล้ว</span>
                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">
                                            <?php echo Html::a(Html::tag('i', '',
                                                    ['class' => 'glyphicon glyphicon-time']) . 'ตรวจสอบ ชม.',
                                                ['check-working-ta2','s' => $subj_id,'ver'=>$ver,'t'=>$term,'y'=>$year],
                                                ['class' => 'btn  btn-blue ']) ?>
                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                    <?php   }else{?>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">
                                 <span  class=" label label-warning size-14 " >
                               <i class="fa fa-exclamation-triangle"></i> ไม่ได้ร้องขอผู้ช่วยสอน</span>
                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                        <td class="text-center">
                                            <span  class=" label label-warning size-14 " >
                               <i class="fa fa-exclamation-triangle"></i> ไม่ได้ร้องขอผู้ช่วยสอน</span>
                                        </td>
                                        <!--  ///////////////////////////////////////////////////////////////  -->
                                    <?php }?>

                                </tr>
                                </tbody>
                            <?php }?>

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

