<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
use app\models\Person;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaRegister;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\models\TaSchedule;
?>
<?php
$label_subj_pass = controllers::t( 'label', 'Subject Pass');
$label_subj_fail = controllers::t( 'label', 'Subject Fail');
$label_regis = controllers::t( 'label', 'Register');
$title = controllers::t( 'label', 'Register TA');
$edit = controllers::t( 'label', 'Edit');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;

$time = time();

?>

    ขณะนี้เวลา : <?= Yii::$app->formatter->asTime($time, 'medium');?><br>

    <?php
      /* Yii::$app->timeZone = 'Asia/Kolkata'; // change timezone on the fly
       echo Yii::$app->timeZone; // new timezone
*/
    $schedule = TaSchedule::findOne(['ta_schedule_url'=>$url_now,'active_status'=>TaSchedule::ACTIVE_ONE]);
    if(!empty($schedule)){
   /* echo $schedule->ta_schedule_url;
    echo $schedule->ta_schedule_type;
   */

    $date_now = date('Y-m-d H:i:s'); //date('d-m-Y H:i:s')
    // date_timezone_set($date_now,'UTC+07:00');//'UTC+07:00'
    $date_open = ( $date_now>=$schedule->time_start && $date_now<=$schedule->time_end );
    $date_close1 = ($date_now<$schedule->time_start && $date_now<$schedule->time_end);
    $date_close2 = ($date_now>$schedule->time_start && $date_now>$schedule->time_end);
    $date_close3 = ($date_now>$schedule->time_start);
    $date_close4 = ($date_now>$schedule->time_end);
    if($date_now==$date_open ){
    ?>
    ตั้งแต่วันที่ : <?=$schedule->time_start?> ถึง <?=$schedule->time_end?>

<!-- panel content -->
<div class="panel-body">
    <div class="panel-heading">

	<span class="title elipsis">

		<strong class="size-18"><i class="glyphicon glyphicon-filter"></i><?=$label_subj_pass?></strong> <!-- panel title -->
	</span>

    </div>

    <ul class="list-unstyled list-hover slimscroll height-250" data-slimscroll-visible="true">
        <?php foreach ($model as $row) { ?>

            <li>

            <span class="label label-success width-50 height-50"><center><i class="et-book-open size-30 "></i></center></span>
            <a href="#"><?= $row->subject_id ?>&nbsp;<?= $row->subject->subject_namethai ?>
            </a>

            <?php
            $u = Person::findOne(['user_id' => Yii::$app->user->id]);
            // echo $u->person_citizen_id;
            $regises = TaRegister::find()->where(['subject_id'=>$row->subject_id,'person_id' => $u->person_citizen_id])->all();
             ?>
            <?php if (!empty($regises)) { //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ ?>
                &nbsp;&nbsp;&nbsp;
            <span  class=" label label-success  size-14 " >
                <i class="glyphicon glyphicon-ok"></i>สมัครแล้ววววววว!!!!</span>
                <?= Html::a(Html::tag('i', '',
                        ['class' => 'glyphicon glyphicon-pencil']) . $edit,
                    ['ta-register/update', 's' => $row->subject_id, 'y' => $row->subopen_year, 't' => $row->subopen_semester,'u'=>$u->person_citizen_id],
                    ['class' => 'btn btn-reveal btn-warning pull-right']) ?>
            <?php   }else{?>
                <?= Html::a(Html::tag('i', '',
                        ['class' => 'glyphicon glyphicon-plus-sign']) . $label_regis,
                    ['ta-register/create', 'id' => $row->subject_id, 'y' => $row->subopen_year, 't' => $row->subopen_semester],
                    ['class' => 'btn btn-reveal btn-blue pull-right']) ?>
            <?php }?>

            </li>
       <?php }?>
    </ul>

</div>
<!-- /panel content -->






    <!-- panel content -->
    <div class="panel-body">

        <div class="panel-heading">

	<span class="title elipsis">

		<strong class="size-18"><i class="glyphicon glyphicon-info-sign"></i> <?=$label_subj_fail?></strong> <!-- panel title -->
	</span>

        </div>
        <ul class="list-unstyled list-hover slimscroll height-250" data-slimscroll-visible="true">
            <?php foreach ($model as $row){?>

                <li>
                    <span class="label label-warning width-50 height-50" ><center><i class="et-book-open size-30 "   ></i></center></span>
                    <a href="#"><?=$row->subject_id?>&nbsp;<?=$row->subject->subject_namethai?></a>

                    <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-plus-sign']) . $label_regis, ['ta-register/create'],
                        ['class' => 'btn btn-reveal btn-blue pull-right',
                         'data' => [
                            'confirm' => 'คุณยังไม่เคยผ่านการเรียนวิชานี้มาก่อน คุณแน่ใจหรือไม่ว่าต้องการสมัคร',
                            'method' => 'post',
                    ],
                                   ]) ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /panel content -->


    <?php }elseif($date_now==$date_close1||$date_now==$date_close2||$date_now==$date_close3||$date_now==$date_close4){ ?>
       <div align="center">
       <strong class="color-red">NOT OPEN!!!</strong>
       </div>
    <?php }}else{?>
        <div align="center">
            <strong class="color-red">ยังไม่กำหนด!!!</strong>
        </div>
    <?php }?>