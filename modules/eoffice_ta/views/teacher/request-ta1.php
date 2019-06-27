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
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest0;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$label_subj = controllers::t( 'label', 'Subject ');

$label_req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'Request TA');
$edit = controllers::t( 'label', 'Edit');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$request = Yii::$app->request;
$url_now = $request->url;
?>
ขณะนี้เวลา : <?=date('H:i:s');?><br>


<div id="panel-3" class="panel panel-default">
    <div class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18"><i class="glyphicon glyphicon-filter"></i><?=$label_subj?></strong> <!-- panel title -->
	</span>
    </div>
    <!-- panel content -->
    <div class="panel-body">
      <!--  ขณะนี้เวลา : <?php //date('H:i:s');?><br>   -->
        <?php
        $schedule = TaSchedule::findOne(['ta_schedule_url'=>$url_now,'active_status'=>TaSchedule::ACTIVE_ONE]);
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
           <!-- ตั้งแต่วันที่ : <?php //$schedule->time_start?> ถึง <?php //$schedule->time_end?>   -->
        <div class="table-responsive">
            <table class="table table-hover table-vertical-middle nomargin">
                <thead>
                <tr>
                    <th><?=$label_subj?></th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                <?php foreach ($model as $row) { ?>
                <tbody>
                <tr>
                    <td >
                  <i class="glyphicon glyphicon-book size-18" style="color: #0E2231"></i>&nbsp;
                    <a href="#"><?= $row->subject_id ?>&nbsp;<?= $row->subject->subject_namethai ?>
                    </a>
                    </td>
                    <?php
                    $u = Person::findOne(['user_id' => Yii::$app->user->id]);
                    // echo $u->person_citizen_id;
                    $requests = TaRequest0::find()->where(['subject_id'=>$row->subject_id])->all();
                    foreach ($requests as $req){
                    $term = Term::findOne(['term_id'=>$req->term_id]);
                        }
                    ?>
                    <?php if (!empty($requests)) { //ถ้ามีข้อมูล จะเข้าเงื่อนไขนี้ ?>
                        <td class="text-center">
                        <span  class=" label label-success  size-14 " >
                <i class="glyphicon glyphicon-ok"></i>ร้องขอแล้ววววววว!!!!</span>
                        </td><td class="text-center">
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-pencil']) . $edit,
                            ['ta-request/update','s' => $row->subject_id,'t'=>$term->term_id,'y'=>$term->year],
                            ['class' => 'btn btn-reveal btn-warning ']) ?>
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-briefcase']) . 'workload',
                            ['ta-workload-teacher/index','s' => $row->subject_id,'t'=>$term->term_id,'y'=>$term->year],
                            ['class' => 'btn btn-brown']) ?>
                        </td>
                    <?php   }else{?>
                        <td class="text-center">
                        <span  class=" label label-warning size-14 " >
                <i class="glyphicon glyphicon-ok"></i>ยังไม่ร้องขอ</span>
                        </td>
                    <td class="text-center">
                        <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-plus-sign']) . $label_req,
                            ['ta-request/create', 's' => $row->subject_id],
                            ['class' => 'btn btn-reveal btn-blue ']) ?>
                    </td>
                    <?php }?>

                </tr>
            <?php }?>
                </tbody>
            </table></div>
        <?php }elseif($date_now==$date_close1||$date_now==$date_close2||$date_now==$date_close3||$date_now==$date_close4){ ?>
            <div align="center">
                <strong class="color-red">NOT OPEN!!!</strong>
            </div>
        <?php }}else{?>
            <div align="center">
                <strong class="color-red">ยังไม่กำหนด!!!</strong>
            </div>
        <?php }?>
    </div>
    <!-- /panel content -->

</div>
