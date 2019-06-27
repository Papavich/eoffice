<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\modules\eoffice_ta\models\model_main\EofficeMainPerson;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_central\ViewPisOpenSubject;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\TaRegister;

use app\modules\eoffice_ta\models\SectionTeacher;
use app\modules\eoffice_ta\controllers;
use yii\widgets\LinkPager;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaWorkingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$print = controllers::t( 'label', 'Print');
$Subject = controllers::t( 'label', 'Subject');
$Credit = controllers::t( 'label', 'Credit');
$Teacher = controllers::t( 'label', 'Teacher');
$Status = controllers::t( 'label', 'Status');
$working = controllers::t( 'label', 'Working');
$Report = controllers::t( 'label', 'Report');
$this->title = controllers::t( 'label', 'Working Hours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-working-index">

    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
	<span class="title elipsis">

		<strong class="size-18"><i class="glyphicon glyphicon-book"></i> วิชาที่เป็นTA</strong> <!-- panel title -->
	</span>
        </div>
        <!-- panel content -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-vertical-middle nomargin">
                    <thead>
                    <tr>
                        <th class="text-center" width="8%"><?=$Subject?></th>
                        <th class="text-center" width="2%"><?=$Credit?></th>
                        <th class="text-center" width="5%"><?=$Teacher?></th>
                        <th class="text-center" width="3%"><?=$Status?></th>
                        <th class="text-center" width="10%"><?=$working?></th>

                        <th class="text-center" width="2%"><?=$Report?></th>

                    </tr>
                    </thead>
                    <?php
                    foreach ($model as $regis){
                        $s = $regis->subject_id;
                        $subject = ViewPisOpenSubject::findOne(['subject_id'=>$s,
                           'REVISIONCODE'=>$regis->subject_version,
                            'semester_id'=>$regis->term,'year_id'=>$regis->year
                            ]);

                        $subj_id = $subject->subject_id;
                        $subj_name = $subject->COURSENAME;
                        $suj_credit = $subject->COURSEUNIT;
                        $sebj_teacher = ViewPisOfficerClass::findOne(['COURSECODE'=>$subj_id,
                            'SEMESTER'=>$subject->semester_id,'ACADYEAR'=>$subject->year_id,
                            'REVISIONCODE'=>$subject->REVISIONCODE]);
                        //$teacher = $sebj_teacher->teacher_id;
                       // $user = ViewPisUser::findOne(['person_id' => $sebj_teacher->teacher_no]);
                        //$user = EofficeMainPerson::findOne(['person_id'=>$sebj_teacher->teacher_id]);
                        $teacher =  $sebj_teacher->PREFIXABB.' '.$sebj_teacher->OFFICERNAME.' '.$sebj_teacher->OFFICERSURNAME;

                        $Works = TaWorking::find()->where(['person_id'=>$u,'subject_id'=>$subj_id,
                            'term_id'=>$regis->term])->all();
                        ?>
                        <tbody>
                        <tr>
                        <td><?=$subj_id?>  <?=$subj_name?></td>
                        <td class="text-center"><?=$suj_credit?></td>
                        <td class="text-center"><?=$teacher?></td>
                        <td class="text-center">
                            <?php
                               if (!empty($Works)){  //ถ้าเริ่มบันทึกการปฏิบัติงานแล้ว
                                   echo '<strong style="color: green" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>working...</strong>';
                               }else{
                                   echo '<strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i> ยังไม่เริ่มลงชม.เข้าสอน</strong>';
                               }
                            ?>
                        </td>
                            <td class="text-center">
                            <?php
                            $Regis = TaRegister::findOne(['person_id'=>$u,
                                'subject_id'=>$subj_id
                                ,'term'=>$regis->term,
                                'ta_status_id'=>\app\modules\eoffice_ta\models\TaStatus::CHOOSE_TA
                            ]);
                            if (!empty($Regis)) {
                                $RegisSec = TaRegisterSection::find()->select(['section','term','year'])
                                    ->distinct()
                                    ->where(['person_id' => $u, 'subject_id' => $subj_id
                                    , 'term' => $regis->term])->all();
                                if (!empty($RegisSec)) {
                                    foreach ($RegisSec as $Rsec) {
                                        $sec = $Rsec->section;

                                        if (!empty($Works)) {  //ถ้าเริ่มบันทึกการปฏิบัติงานแล้ว
                                            ?>
                                            <?= Html::a(Html::tag('i', ' sec' . $sec,
                                                ['class' => 'glyphicon glyphicon-briefcase ']),
                                                ['ta-working/work-ta2', 'sec' => $sec, 's' => $s, 't' => $regis->term, 'y' => $regis->year],
                                                ['class' => 'btn btn-sm btn-brown']) ?>
                                        <?php } else { ?>
                                            <?= Html::a(Html::tag('i', ' sec' . $sec,
                                                ['class' => 'glyphicon glyphicon-plus ']),
                                                ['ta-working/work-ta2', 'sec' => $sec, 's' => $s, 't' => $regis->term, 'y' => $regis->year],
                                                ['class' => 'btn btn-sm btn-green ']) ?>&nbsp;
                                        <?php }
                                    }
                                }else{
                                    echo '<strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>
                                 ยังไม่เลือกSection</strong>';
                                }
                            } /*else{
                                echo '<strong style="color: red" class="size-13">
                            <i class="fa fa-exclamation-triangle"></i>
                                 อาจารย์ยังไม่เลือกเป็นผู้ช่วยสอน</strong>';
                            }*/?>
                        </td>

                            <td class="text-center">
                                <?php
                                if (!empty($Works)) {
                                    ?>
                                <?= Html::a(Html::tag('i',  ' '.$print,
                                    ['class' => 'glyphicon glyphicon-print']),
                                    ['ta-working/excel',
                                       // 'sec'=>$sec,
                                        's'=>$s,
                                        't' => $regis->term, 'y' => $regis->year,
                                    ],
                                    ['class' => 'btn btn-sm btn-blue']) ?>
                                <?php }else{
                                    echo "<strong>-</strong>";
                                }?>
                            </td>
                    </tr>
                    </tbody>
                    <?php  } ?>
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
</div>
