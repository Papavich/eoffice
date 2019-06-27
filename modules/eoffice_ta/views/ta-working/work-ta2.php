<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 3/3/2561
 * Time: 16:23
 */
use yii\helpers\Html;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegCourse;
use app\modules\eoffice_ta\controllers;
use yii\widgets\LinkPager;

$title = controllers::t( 'label', 'Working Hours');
$view = controllers::t( 'label', 'View');
$back = controllers::t( 'label', 'Back');
$print = controllers::t( 'label', 'Print');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'รายวิชาที่เป็นTA', 'url' => ['index']];
?>

<?php
   $subject = EofficeCentralRegCourse::findOne(['COURSECODE'=>$s,'REVISIONCODE'=>$ver]);
   $credit = $subject->COURSEUNIT; //$subject->COURSECODE;$subject->REVISIONCODE;

   $wload = TaWorkloadTeacher::findOne(['section'=>$sec,'subject_id'=>$s,'term'=>$t,'year'=>$y]);
     $t_wload = $wload->ta_type_work_id ;
?>
<div id="panel-3" class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-10">
	<span class="title elipsis">
		<strong class="size-16"><i class="glyphicon glyphicon-time"></i>
            <span class="label label-primary size-16">Sec.<?=$sec?></span>&nbsp;
            วิชา: <?=$s?> &nbsp;&nbsp; หน่วยกิต: <?=$credit?>&nbsp;&nbsp;  ภาคเรียน : <?=$t?>/<?=$y?>

        </strong> <!-- panel title -->
	</span>
            </div>
            <div class="col-lg-2">

            <?php Html::a(Html::tag('i',  ' '.$print,
                ['class' => 'glyphicon glyphicon-print']),
                    ['ta-working/print',
                        'sec'=>$sec,
                        's'=>$s,
                        't'=>$t,
                        'y'=>$y,
                ],
                ['class' => 'btn btn-sm btn-blue']) ?>
        </div>

        </div>
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <!-- tabs content -->
        <div class="table-responsive">
            <table class="table table-bordered nomargin" >
                        <thead>

                        <tr >
                            <th class="text-center" width="3%">ว/ด/ป</th>
                            <th class="text-center" width="5%">เวลาปฏิบัติงาน</th>
                            <th class="text-center" width="3%">ประเภทงาน</th>
                            <th class="text-center" width="5%">ชั่วโมงภาระงาน</th>
                            <th class="text-center" width="5%">ชั่วโมงปฏิบัติงาน</th>
                            <th class="text-center" width="5%">หัวข้อ</th>
                            <th class="text-center" width="10%">งานที่ปฏิบัติ</th>
                            <th class="text-center" width="3%">

                                <?= Html::a(Html::tag('i', ' ลงเวลาทำงาน',
                                    ['class' => 'glyphicon glyphicon-plus']),
                                    ['ta-working/create','sec'=>$sec,
                                        's'=>$s,
                                        'ver'=>$ver,
                                        't'=>$t,'y'=>$y, 't_wload'=>$t_wload ],
                                    ['class' => 'btn btn-sm btn-green ']) ?>
                            </th>
                        </tr>
                        </thead>
                <?php  foreach ($Working as $item){
                    $type_work = $item->ta_type_work_id;
                    $id = $item->ta_work_plan_id;

                    ?>
                        <tbody>
                        <?php
                           if($type_work == 'C'){
                    //    $hr_lec[] = $item->hr_working;
                        ?>
                        <tr class="warning">
                         <?php   }elseif($type_work == 'L'){
                      //   $hr_lab[] = $item->hr_working;
                         ?>
                        <tr class="info">

                         <?php  } ?>

                            <td class="text-center"><?=Yii::$app->formatter->asDate($item->working_date)?></td>
                            <td class="text-center"><?=$item->time_start?> - <?=$item->time_end?></td>
                            <?php
                            if (!empty($wload)){?>
                                <?php  if ($type_work == 'C'){
                                    $wload_lec_all = (float)$wload->lec_inspect+(float)$wload->lect_check_list_std+(float)$wload->lec_other;
                                    ?>
                                    <td class="text-center">
                                <span class="label label-warning">
                                    <?=$item->ta_type_work_id?></span></td>

                                    <td class="text-center">
                                        <strong style="color: blue">
                                        <?=$wload_lec_all?>
                                        </strong>
                                    </td>

                                    <td class="text-center">
                                        <?php
                                           if ($wload_lec_all >= $item->hr_working ){
                                        ?>
                                        <strong style="color: limegreen"><?=$item->hr_working?></strong>
                                           <?php  }else{
                                            echo '<strong style="color: red">'.$item->hr_working.'</strong>';
                                           } ?>
                                    </td>

                                <?php  }elseif($type_work == 'L'){
                                    $wload_lab_all = $wload->lab_hr;
                                    ?>
                            <td class="text-center">
                                    <span class="label label-info">
                                    <?=$item->ta_type_work_id?>
                                </span></td>
                                    <td class="text-center">
                                        <strong style="color: blue">
                                        <?=$wload_lab_all?>
                                        </strong>
                                    </td>
                                    <td class="text-center" >
                                        <?php
                                        if ($wload_lab_all >= $item->hr_working ){
                                            ?>
                                            <strong style="color: limegreen"><?=$item->hr_working?></strong>
                                        <?php  }else{
                                            echo '<strong style="color: red">'.$item->hr_working.'</strong>';
                                        } ?>
                                    </td>

                                <?php  } ?>
                                <?php  }else{?>
                                <td class="text-center">
                                   อ้าววววววว!!
                                </td>
                                <td class="text-center" >
                                    <strong style="color: red">
                                        <?=$item->hr_working?>
                                    </strong>
                                </td>
                            <?php  } ?>

                            <td > <?=$item->ta_work_title?></td>
                            <td > <?=$item->ta_work_role?></td>
                            <td class="text-center">
                                <?= Html::a(Html::tag('i', ' ',
                                    ['class' => 'glyphicon glyphicon-pencil']),
                                    ['ta-working/update','id'=>$id,
                                        't_wload'=>$t_wload
                                        /*'sec'=>$sec,
                                        's'=>$s,
                                        'ver'=>$ver,
                                        't'=>$t,'y'=>$y */
                                        ],
                                    ['class' => 'btn btn-sm btn-warning']) ?>
                                <?= Html::a(Html::tag('i', ' ',
                                    ['class' => 'glyphicon glyphicon-trash']),
                                    ['ta-working/delete','id'=>$id,
                                         'sec'=>$sec,
                                         's'=>$s,
                                         'ver'=>$ver,
                                         't'=>$t,'y'=>$y,
                                        't_wload'=>$t_wload
                                    ],
                                    ['class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการลบข้อมูลนี้?',
                                            'method' => 'post',
                                        ]]) ?>
                            </td>
                        </tr>
                        </tbody>
                    <?php  } ?>
                    </table>
            <div id="custom-pagination" class="pull-right">
                <?php

                echo LinkPager::widget([
                    'pagination' => $pages
                ])
                ?>
            </div>
        </div>
            <div class="alert alert-success">
                <strong>ชั่วโมงบรรยายทั้งหมด <?= $sum_hr_C;?> ชม.</strong>&nbsp;&nbsp;
                <strong>ชั่วโมงปฏิบัติการทั้งหมด <?=$sum_hr_L?>&nbsp; ชม.</strong>

            </div>

            </div><!-- /TAB 1 CONTENT -->

