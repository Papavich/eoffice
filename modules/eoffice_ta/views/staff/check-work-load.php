<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */

use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\Kku30Section;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\ViewKku30SectionProgram;
use app\modules\eoffice_ta\models\Kku30SectionProgram;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\model_central\ViewPisEnrollTa;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClass;
use app\modules\eoffice_ta\models\TaStatus;

use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\grid\GridView;
use app\modules\eoffice_ta\components\Calculation as Calculation;





/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php

$Calculate = new Calculation();

$this->title = 'ประมาณการค่าภาระงานแต่ละรายวิชา';
?>
<div class="check-workload">
    <div class="panel-body">

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
                        <tr > <!-- class="btn-aqua"-->
                            <!-- <th class="table-checkbox" width="1%" rowspan = 2>
                                 <input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/>

                             </th>  -->
                            <th width="10%" rowspan = 2><center>วิชา</center></th>
                            <th width="7%" rowspan = 2><center>อาจารย์ประจำวิชา</center></th>
                            <th width="2%" rowspan = 2><center>หน่วยกิต</center></th>
                            <th width="3%" rowspan = 2><center>ประเภทงานที่ร้องขอ</center></th>  <!--  ประเภทงานที่ร้องขอ -->
                            <th width="9%" colspan = 2 class="info"><center>ภาคปกติ</center></th>
                            <th width="9%" colspan = 2 class="info"><center>โครงการพิเศษ</center></th>
                        </tr>
                        <tr>
                            <td class="text-center"> <strong>จำนวนนักศึกษา</strong></td>
                            <td  class="warning text-center" ><strong>ค่าภาระงาน</strong></td>
                            <td class="text-center"><strong>จำนวนนักศึกษา</strong></td>
                            <td class="warning text-center"><strong>ค่าภาระงาน</strong></td>
                        </tr>
                        </thead>
                        <?php
                        if (!empty($subj)){
                            $query = ViewPisOfficerClass::find()->select(
                                ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                                ])->distinct()->where(['COURSECODE'=>$subj,'SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                            $countQuery = clone $query;
                            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                            $model = $query->offset($pages->offset)
                                ->distinct('COURSECODE')
                                ->limit($pages->limit)
                                ->all();
                        }else{
                            $query = ViewPisOfficerClass::find()->select(
                                ['COURSECODE','COURSENAME','REVISIONCODE','SEMESTER','ACADYEAR'
                                ])->distinct()->where(['SEMESTER'=>intval($term3),'ACADYEAR'=>intval($year3)]);
                            $countQuery = clone $query;
                            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
                            $model = $query->offset($pages->offset)
                                ->distinct('COURSECODE')
                                ->limit($pages->limit)
                                ->all();
                        }
                        foreach ($model as $item){
                            $item2 = ViewPisOfficerClass::findOne(['COURSECODE'=>$item->COURSECODE,
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

                            $req = TaRequest::findOne(['subject_id'=>$subj_id,'subject_version'=>$ver,'term_id'=>$term,'year'=>$year]);
                            $enrolls_normal = ViewPisEnrollTa::find()->where(['COURSECODE'=>$subj_id,
                                'REVISIONCODE'=>$ver,'SEMESTER'=>$term,'ACADYEAR'=>$year,'LEVELID'=>31])->all();
                            $countEn_normal = count($enrolls_normal);
                            $enrolls_vip = ViewPisEnrollTa::find()->where(['COURSECODE'=>$subj_id,
                                'REVISIONCODE'=>$ver,'SEMESTER'=>$term,'ACADYEAR'=>$year,'LEVELID'=>34])->all();
                            $countEn_vip = count($enrolls_vip);
                            ?>
                            <tbody>
                            <tr class="odd gradeX">
                                <!--  <td><input type="checkbox" name="listmails[]"
                           value="<?php //echo $item['subject_id'] ?>"></td> -->
                                <!-- *********************** วิชา ****************** -->
                                <td><strong><?php echo  $subj_id?></strong> <?php echo  $subj_name?></td>
                                <td ><?php echo  $teacher?></td>
                                <td class="text-center"><?php echo $credit?></td>
                                <?php
                                if (!empty($req)){
                                    $type_work = $req->ta_type_work_id;
                                    ?>

                                    <?php
                                    if ($type_work == 'C'){ ?>
                                        <td class="text-center">
                                            <span class="label label-warning size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                                        </td>
                                    <?php   }elseif ($type_work == 'L'){ ?>
                                        <td class="text-center">
                                            <span class="label label-success size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                                        </td>
                                    <?php   }else{   //C&L ?>
                                        <td class="text-center">
                                            <span class="label label-info size-14"><?=$req->taTypeWork->ta_type_work_name?></span>
                                        </td>
                                    <?php  }}else {?>

                                    <td class="text-center">
                                        <strong style="color: darkorange" class="size-13">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            ยังไม่ได้ร้องขอผู้ช่วยสอน
                                        </strong>
                                    </td>
                                <?php  }?>

                                <td class="text-center">
                                    <!-- ********[จำนวนนักศึกษา ภาคปกติ ]******** -->
                                    <strong style="color: darkmagenta" class="size-13">
                                        <i class="fa fa-user"></i>
                                        <?php echo  $countEn_normal?>
                                    </strong>
                                </td>
                                <td class="warning text-center">
                                    <strong style="color:#FFCC00" class="size-13">
                                        <i class="glyphicon glyphicon-flash"></i>
                                    </strong>
                                    <strong style="color: 	#0099CC" class="size-13">
                                        <?php
                                        $A =  (int)substr($credit, 3, 1); //B
                                        $B =  (int)substr($credit, 5, 1); //B
                                        if(($A>0 )&& ($B>0)){
                                            $WLoad = $Calculate->getWorkLoadAll($subj_id,$ver,$term,$year,$countEn_normal);
                                            echo $WLoad;
                                        }elseif ($B==0) {
                                            $WLoad = $Calculate->getWorkLoadLec($subj_id, $ver, $term, $year, $countEn_normal);
                                            echo $WLoad;
                                        }elseif ($A==0) {
                                            $WLoad = $Calculate->getWorkLoadLab($subj_id, $ver, $term, $year, $countEn_normal);
                                            echo $WLoad;
                                        }else{
                                            echo 'ข้อมูลชั่วโมงหน่ายกิตจากระบบผิดพลาด';
                                        }
                                        ?>
                                    </strong>
                           </td>
                                <td class="text-center">
                                    <!-- ********[จำนวนนักศึกษา โครงการพิเศษ ]******** -->

                                    <strong style="color: darkmagenta" class="size-13">
                                        <i class="fa fa-user"></i>
                                        <?php echo  $countEn_vip?>
                                    </strong>

                                </td>
                                <td class="warning text-center">
                                    <strong style="color:#FFCC00" class="size-13">
                                    <i class="glyphicon glyphicon-flash"></i>
                                    </strong>
                                    <strong style="color: 	#0099CC" class="size-13">
                                        <?php
                                        $A =  (int)substr($credit, 3, 1); //B
                                        $B =  (int)substr($credit, 5, 1); //B
                                        if(($A>0 )&& ($B>0)){
                                            $WLoad = $Calculate->getWorkLoadAll($subj_id,$ver,$term,$year,$countEn_vip);
                                            echo $WLoad;
                                        }elseif ($B==0) {
                                            $WLoad = $Calculate->getWorkLoadLec($subj_id, $ver, $term, $year, $countEn_vip);
                                            echo $WLoad;
                                        }elseif ($A==0) {
                                            $WLoad = $Calculate->getWorkLoadLab($subj_id, $ver, $term, $year, $countEn_vip);
                                            echo $WLoad;
                                        }else{
                                            echo 'ข้อมูลชั่วโมงหน่ายกิตจากระบบผิดพลาด';
                                        }
                                        ?>
                                    </strong>

                                </td>

                                <!-- *********************** Secที่สอน ****************** -->
                                <!-- *********************************** จัดการ ******************************* -->
                            </tr>
                            </tbody>
                        <?php } ?>
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
            <?php //} ?>
        </div>