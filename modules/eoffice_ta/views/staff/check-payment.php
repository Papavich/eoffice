<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */


use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\controllers\StaffController;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use yii\helpers\Html;

use yii\widgets\Pjax;

use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
?>

<?php
$this->title = 'ตรวจสอบค่าตอบแทนผู้ช่วยสอน';


?>

<div class="panel-body">
<div class="navbar navbar-default">
    <div class="navbar-header">

        <?= Menu::widget([
            'items' => [
                ['label' => 'ตรวจสอบการร้องขอTA', 'url' => ['staff/check-request']],
                ['label' => 'ตรวจสอบชั่วโมงปฏิบัติงาน','url'=>['staff/check-working']],
                ['label' => 'ตรวจสอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['staff/check-payment']],
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
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>รายวิชาที่มีผู้ช่วยสอน</strong><strong class="text-blue">
                                   </strong>
							</span>
        </div>
        <div class="panel-body">
            <!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->
            <?php $form = ActiveForm::begin( [//\yii\helpers\Url::current(),
                'class' => 'horizontal',
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
                            $subjects = TaRequest::find()->where(['term_id'=>intval($term3),'year'=>intval($year3)])->orderBy(['subject_id'=>SORT_ASC])->all();
                            foreach ($subjects as $subject){
                            }
                            echo Select2::widget( [
                                'name' => 'subject',
                                'value' => '',
                                'theme'=>Select2::THEME_DEFAULT,
                                'data' => ArrayHelper::map(TaRequest::find()->
                                addOrderBy(['subject_id'=>SORT_ASC])
                                    ->select(
                                        ['subject_id','term_id','year'
                                        ])->distinct()->all(), 'subject_id', 'subject_id' ),
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
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-vertical-middle nomargin" >
                <thead>
        <tr>
            <th class="text-center" width="11%">วิชา</th>
            <th class="text-center" width="5%">อาจารย์ประจำวิชา</th>
            <th class="text-center" width="2%">หน่วยกิต</th>
            <th class="text-center" width="2%">จำนวนผู้ช่วยสอน</th>
            <th class="text-center" width="3%">สถานะ</th>
            <th class="text-center" width="7%">Action</th>
        </tr>
        </thead>
            <?php
        /*    $courses = EofficeCentralRegCourse::find()->where(
                [
                    'FACULTYID'=>StaffController::FACT_SIENCE,
                    'DEPARTMENTID'=>StaffController::DEPT_CS
                ])->all();
            foreach ($courses as $course) {
        */
            if (!empty($subj)){
               // $query = ViewPisOpenSubject::find()->where(['subject_id' => $course->COURSECODE]);
            $query = TaRequest::find()->where(['subject_id'=>$subj,'term_id'=>intval($term3),'year'=>intval($year3)]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                $model = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
         }else{
                $query = TaRequest::find()->where(['term_id'=>intval($term3),'year'=>intval($year3)]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                $model = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            }
            foreach ($model as $item){
                $subj_id =  $item->subject_id;

                $subject = \app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass::findOne(['COURSECODE'=>$subj_id,
                    'SEMESTER'=>$item->term_id,'ACADYEAR'=>$item->year,'REVISIONCODE'=>$item->subject_version]);
                //$subject->REVISIONCODE
                $subj_name = $subject->COURSENAMEENG;
                $subjID = $subject->COURSECODE;
                $ver = $item->subject_version;
                $term =  $item->term_id; //$item->subopen_semester;
                $year =  $item->year;  //$item->subopen_year;
                $credit = $subject->COURSEUNIT ;//subject_credit.'('.$subject->subject_time.')';
                $req = TaRequest::findOne(['subject_id'=>$subj_id,'term_id'=>$term,'year'=>$year]);

                ?>
            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td><a><strong><?php echo $subj_id?></strong></a> <?php echo $subj_name?></td>
                <td class="text-center">
                    <?php
                   $t_secs = ViewPisOfficerClass::findOne([
                       'COURSECODE'=>$subj_id,
                       'SEMESTER'=>$item->term_id,'ACADYEAR'=>$item->year,'REVISIONCODE'=>$item->subject_version]);
                    //$person = PersonView::findOne(['person_id' => $t_secs->teacher_id]);
                    if (!empty($t_secs)){

                        $per = ViewPisUser::findOne(['person_id'=>$t_secs->COURSECODE]);
                       // if (!empty($per)) {
                          //  echo $per->PREFIXNAME . ' ' . $per->person_fname_th . ' ' . $per->person_lname_th;
                        echo $t_secs->PREFIXABB . ' ' . $t_secs->OFFICERNAME . ' ' . $t_secs->OFFICERSURNAME;
                            // }
                        }else{
                        echo ' 
                            <strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>
                                ยังไม่ดึงข้อมูลเข้า</strong>
                       ';
                    }
                   ?>
                </td>
                <td class="text-center"><?php echo $credit?></td>
                <td class="text-center">
                    <?php
                       $Regis = TaRegister::find()->where(['subject_id'=>$subj_id,
                           //'subject_version'=>$ver,
                          'term'=>$term,'year'=>$year,
                           'ta_status_id'=>TaStatus::CHOOSE_TA])->all();
                       $ta_amount = count($Regis);

                    ?>
                    <strong style="color: limegreen" class="size-13">
                        <i class="fa fa-user"></i>
                        <?php echo $ta_amount?></strong>
                </td>
                <td class="text-center">-</td>
                <!-- *********************** หน่วยกิต ****************** -->
                <td align="center">
                    <?php echo Html::a(Html::tag('i', '',
                        ['class' => 'glyphicon glyphicon-list size-16']),
                        ['check-payment-ta-list',
                            's'=>$subj_id,
                            'ver'=>$ver,
                            't'=>$term,'y'=>$year,
                        ],
                        ['class' => 'btn btn-sm btn-warning',])
                    ?>
                </td>
                <!-- *********************** Secที่สอน ****************** -->
                <!-- *********************************** จัดการ ******************************* -->
            </tr>
            </tbody>
            <?php } ?>
    </table>
</div>
        <div id="custom-pagination" class="pull-right">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>
    </div>
