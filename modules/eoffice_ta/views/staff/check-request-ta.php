<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 29/11/2560
 * Time: 1:32
 */


use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use yii\helpers\Url;
use app\modules\eoffice_ta\components\NextPage;
use app\modules\kku30\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_kku30\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClassinstructor;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegOfficer;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClass;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Term;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\data\Pagination;
?>

<?php
$this->title = 'ตรวจสอบการร้องขอผู้ช่วยสอน';
?>

<div class="panel-body">
    <div class="navbar navbar-default">
        <div class="navbar-header">

            <?= Menu::widget([
                'items' => [
                    ['label' => 'ตรวจสอบการร้องขอTA', 'url' => ['check-request']],
                    ['label' => 'ตรวจสอบชั่วโมงปฏิบัติงาน','url'=>['staff/check-working']],
                    ['label' => 'กรอบค่าตอบแทนผู้ช่วยสอน', 'url' => ['check-max-payment']],
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
								<strong>รายวิชาที่เปิดสอน</strong><strong class="text-blue">
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
                                    ])->distinct()->all(), 'COURSECODE', 'COURSECODE' ),
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
            <th width="12%"><center>วิชา</center></th>
            <th width="2%"><center>หน่วยกิต</center></th>
            <th width="10%"><center>อาจารย์ประจำวิชา</center></th>
            <th width="2%"><center>จำนวนร้องขอ</center></th>
            <th width="5%"><center>จำนวนสมัคร</center></th>
            <th width="5%"><center>จำนวนผู้ช่วยสอน</center></th>
            <th width="9%"><center>สถานะ</center></th>
            <th width="7%"><center>จัดการ</center></th>
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
                $req = TaRequest::findOne(['subject_id'=>$subj_id,'term_id'=>$term,'year'=>$year]);
                $workload = TaWorkloadTeacher::findOne(['subject_id'=>$subj_id,'term'=>$term,'year'=>$year]);
                ?>
            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td><a><strong><?=$subj_id?>&nbsp;<?=$subj_name?></strong></a></td>
                <td><strong><?=$credit?></strong></td>
                <td><strong><?=$teacher?></strong></td>
                <?php
                if (!empty($req)){?>
                <td class="text-center">
                    <strong style="color: tomato" class="size-13">
                        <i class="fa fa-user"></i>
                        <?=$req->amount_ta_all?></strong>
                </td>
                <?php
                $Regis = TaRegister::find()->where(['subject_id'=>$subj_id,
                    'term'=>$term,'year'=>$year])->all();
                $Regis2 = TaRegister::find()->where(['subject_id'=>$subj_id,
                    'term'=>$term,'year'=>$year,'ta_status_id'=>TaStatus::CHOOSE_TA])->all();
                ?>
                <td class="text-center">
                    <strong style="color:deepskyblue" class="size-13">
                        <i class="fa fa-user"></i>
                        <?=count($Regis)?></strong>
                </td>
                <td class="text-center"> <strong style="color:#67b021" class="size-13">
                        <i class="fa fa-user"></i>
                        <?=count($Regis2)?></strong>
                </td>
                <td class="text-center">
                    <strong style="color: limegreen" class="size-13">
                        <i class="glyphicon glyphicon-ok"></i>
                        REQUEST</strong>
                </td>
                    <td class="text-center">
                        <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-pencil']),
                            ['ta-request/update2',
                                's'=>$subj_id,
                                 'ver'=>$ver,
                                't'=>$term,
                                'y'=>$year,
                            ],
                            [
                                'class' => 'btn btn-sm btn-warning',
                            ])?>
                        <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-eye-open']),
                            ['ta-request/view2',
                                's'=>$subj_id,
                                'ver'=>$ver,
                                't'=>$term,
                                'y'=>$year,
                            ],
                            [
                                'class' => 'btn btn-sm btn-blue',

                            ])?>
                        <?php
                        if (!empty($workload)){ ?>
                            <?= Html::a(Html::tag('i', 'แก้ไขภาระงาน',
                                ['class' => 'glyphicon glyphicon-pencil']),
                                ['ta-workload-teacher/index2',
                                    's'=>$subj_id,
                                    'ver'=>$ver,
                                    't'=>$term,
                                    'y'=>$year,
                                ],
                                ['class' => 'btn btn-sm btn-warning',])?>
                            <?php  }else{?>
                        <?= Html::a(Html::tag('i', ' กำหนดภาระงาน',
                            ['class' => 'glyphicon glyphicon-plus']),
                            ['ta-workload-teacher/index2',
                                's'=>$subj_id,
                                'ver'=>$ver,
                                't'=>$term,
                                'y'=>$year,
                            ],
                            ['class' => 'btn btn-sm btn-success',])?>
                        <?php } ?>
                    </td>
                <?php }else{ ?>
                    <td class="text-center">
                        <strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>
                            NON-REQUEST
                        </strong>
                    </td>
                    <td class="text-center">
                        <strong  class="size-13">
                            -
                        </strong>
                    </td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        <strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>
                            NON-REQUEST</strong>
                    </td>
                    <td class="text-center">
                        <?= Html::a(Html::tag('i', ' ร้องขอ',
                            ['class' => 'glyphicon glyphicon-plus']),
                            ['ta-request/create2',
                                's'=>$subj_id,
                                'ver'=>$ver,
                                't'=>$term,
                                'y'=>$year,
                            ],
                            ['class' => 'btn btn-sm btn-success',])?>

                    </td>
                <?php } ?>
                <!-- *********************** Secที่สอน ****************** -->
                <!-- *********************************** จัดการ ******************************* -->
            </tr>
            </tbody>
        <?php  }?>
    </table>
</div>

    </div>
    <div id="custom-pagination" class="pull-right">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ])
            ?>
        </div>