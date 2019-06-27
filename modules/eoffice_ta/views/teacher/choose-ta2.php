<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 25/11/2560
 * Time: 16:04
 */

use app\modules\eoffice_ta\models\SubjectOpen;
//use app\models\Person;
use app\modules\eoffice_ta\models\model_main\Studentreg;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
//use app\modules\eoffice_ta\models\model_main\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewStudentFull;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaSchedule;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\model_main\RegStudentmaster;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainPrefix;
use app\modules\eoffice_ta\models\model_main\Level;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$label_subj = controllers::t( 'label', 'List of register');
$label_ta_fail = 'รายชื่อผู้สมัครที่คัดออก';
$label_req = controllers::t( 'label', 'Request');
$title = controllers::t( 'label', 'Choose TA');
$view = controllers::t( 'label', 'View');
$back = controllers::t( 'label', 'Back');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'รายวิชาที่สอน', 'url' => ['choose-ta','term_name'=>$t.'/'.$y]];
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
$url_now = $request->url;


?>
<style>
    .circle{ /* ชื่อคลาสต้องตรงกับ <img class="circle"... */
       /* height: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
       /* width: auto;*/  /* ความสูงปรับให้เป็นออโต้ */
        border: 3px solid #fff; /* เส้นขอบขนาด 3px solid: เส้น #fff:โค้ดสีขาว */
        border-radius: 50%; /* ปรับเป็น 50% คือความโค้งของเส้นขอบ*/
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* เงาของรูป */
    }
</style>
<div id="panel-3" class="panel panel-default">
    <div class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18"><i class="fa fa-users"></i> <?=$label_subj?></strong> <!-- panel title -->
	</span>
    </div>
    <!-- panel content -->
    <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-vertical-middle nomargin">
                        <thead>
                        <tr>
                            <th width="2%""></th>
                            <th width="3%">Student ID</th>
                            <th width="8%" class="text-center">Student Name</th>
                            <th width="10%" class="text-center">Level</th>
                            <th width="3%" class="text-center">GPA</th>
                            <th width="3%" class="text-center">Section Amount</th>
                            <th width="5%" class="text-center">Register Detail</th>
                            <th width="3%" class="text-center">Status</th>
                            <th width="8%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <?php
                        $model = TaRegister::find()->where([
                            'subject_id'=>$s,
                            'term'=>$t,'year'=>$y,
                            'ta_status_id'=>[
                                TaStatus::REGISTER_TA_READ ,
                                TaStatus::CHOOSE_TA,
                                TaStatus::START_REGISTER_TA
                            ]
                        ])->all();
                        foreach ($model as $item ){
                            //$person_id = $item->person_id;
                            $per = $item->person_id;
                            //$u = PersonView::findOne(['person_id' => $item->person_id]);
                            //$u = ViewPisUser::findOne(['person_id' => $per]);
                            //if (!empty($u)){
                            //$uid =  $u->id;
                            //reg_studentmaster
                           // $std_id = $u->username;
                            //$prefix = $u->prefix_th;
                           /* $std_name = $u->student_fname_th;
                            $std_surname = $u->student_lname_th;
                           */
                           // $std =  RegStudentmaster::findOne(['STUDENTID'=>$u->person_id]);

                           /* }else{
                                echo "<center>NOT FOUND USER</center>";
                            }*/
                            $std =  ViewStudentFull::findOne(['STUDENTID'=>$per]);
                           // if (!empty($std)){
                            $std_id = $std->STUDENTID;
                         // $PREfix = EofficeMainPrefix::findOne(['PREFIXID'=>$std->PREFIXID]);
                         // $prefix = $PREfix->PREFIXNAME;
                            $prefix = $std->PREFIXNAME;
                            $std_name = $std->STUDENTNAME;
                            $std_surname = $std->STUDENTSURNAME;

                            $gpa = $std->GPA;
                            $level = $std->LEVELNAME;
                            $status = $item->ta_status_id;
                            $regis_sec = TaRegisterSection::find()
                                ->where(['person_id'=>$item->person_id,'term'=>$item->term,'year'=>$item->year
                                    ,'subject_id'=>$item->subject_id,'subject_version'=>$item->subject_version])->all();
                            $rs_count = count($regis_sec);
                        ?>
                        <tbody>
                        <tr>
                            <?php if (!empty($item->ta_image)){ ?>
                                <td class="text-center">
                                    <img class="circle" src="<?= Yii::getAlias('@web/web_ta/images/register/' . $item->ta_image) ?>" alt=""
                                         width="40" height="40">
                                 </td>
                            <?php }else{?>
                            <td class="text-center">
                                <img class="circle" src="<?= Yii::getAlias('@web') ?>/web_ta/images/register/ta_user.jpg" alt="" width="40" height="40">
                            </td>
                            <?php }?>
                            <td><?php echo $std_id?></td>
                            <td class="text-center"><?php echo $prefix?>&nbsp;<?php echo $std_name?>&nbsp;&nbsp;<?php echo $std_surname?></td>
                             <td class="text-center"><?php echo $level?></td>
                            <td class="text-center"><?php echo $gpa?></td>
                            <td class="text-center"><?php echo $rs_count?></td>
                            <td class="text-center">

                            <?= Html::a(Html::img(Yii::getAlias('@web').'/web_ta/images/img/user-id-icon.png',
                                ['class' => 'img-responsive ', 'width' => 40,]), ['ta-register-section/detail-by-subj',
                                's'=>$s,'ver'=>$item->subject_version,'u'=>$item->person_id,'t'=>$t,'y'=>$item->year]
                                )?>
                            </td>
                            <?php    if($status == TaStatus::REGISTER_TA_READ){ ?>
                                <td class="text-center">

                            <span class="label label-warning">รอพิจารณา</span>
                            </td>

                                <td class="text-center">
                                    <?= Html::a(Html::tag('i', '  เลือก',
                                        ['class' => 'glyphicon glyphicon-ok']), ['teacher/choose-active',
                                        'id'=>$item->person_id,'t'=>$t,'s'=>$s,'y'=>$y],
                                        [
                                            'class' => 'btn btn-sm btn-success',
                                            'data' => [
                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการเลือกคนนี้เป็นTA ของคุณ?',
                                                'method' => 'post',
                                            ],
                                        ])?>
                                    <?= Html::a(Html::tag('i', ' คัดออก',
                                        ['class' => 'glyphicon glyphicon-remove']), ['teacher/non-choose',
                                        'id'=>$item->person_id,'t'=>$t,'s'=>$s,'y'=>$y],
                                        [
                                            'class' => 'btn btn-sm btn-danger',
                                            'data' => [
                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องการคัดออก?',
                                                'method' => 'post',
                                            ],
                                        ])?>
                                </td>
                            <?php  }elseif($status == TaStatus::CHOOSE_TA){?>
                                <td class="text-center">
                            <span class="label label-success">
                                เลือกเป็นTA</span>
                                </td>
                                <td class="text-center">
                                    <?= Html::a(Html::tag('i', '  ยกเลิก',
                                        ['class' => 'glyphicon glyphicon-ban-circle']),
                                        ['teacher/cancel-choose',
                                        'id'=>$item->person_id,'t'=>$t,'s'=>$s,'y'=>$y],
                                        [
                                            'class' => 'btn btn-sm btn-warning',
                                            'data' => [
                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องยกเลิกผู้ช่วยสอนคนนี้?)',
                                                'method' => 'post',
                                            ],  /*,'disabled' => 'disabled'*/
                                        ])?>

                                    <?= Html::a(Html::tag('i', ' คัดออก',
                                        ['class' => 'glyphicon glyphicon-remove']), ['teacher/non-choose',
                                        'id'=>$item->person_id,'t'=>$t,'s'=>$s,'y'=>$y],
                                        [
                                            'class' => 'btn btn-sm btn-danger',
                                            'data' => [
                                                'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                                'method' => 'post',
                                            ],
                                        ])?>
                                </td>
                            <?php  }?>
                        </tr>
                        </tbody>
                        <?php }
                        ?>
                    </table>
                </div>
        <div></div>
                <!-- /panel content -->
</div>
</div>
<!-- ************************* รายชื่อที่คัดออก ******************************* -->

<div id="panel-3" class="panel panel-default">
    <div class="panel-heading">
	<span class="title elipsis">
		<strong class="size-18">
            <i class="fa fa-user-times"></i>
            <?=$label_ta_fail?></strong> <!-- panel title -->
	</span>
    </div>
    <!-- panel content -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-vertical-middle nomargin">
                <thead>
                <tr>
                    <th class="width-30"></th>
                    <th >Student ID</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">GPA</th>
                    <th class="text-center">Section Amount</th>
                    <th class="text-center">Register Detail</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <?php
                foreach ($std_fail as $item ){
                    $per = $item->person_id;
                    $u = ViewPisUser::findOne(['person_id' => $per]);
                   // $u = PersonView::findOne(['person_id' => $item->person_id]);
                   // $u = EofficeMainUser::findOne(['person_id' => $item->person_id]);
                   // $uid = $u->id;
                    //reg_studentmaster
                   // $std_id = $u->username;
                   // $prefix = $u->prefix_th;
                    /* $std_name = $u->student_fname_th;
                     $std_surname = $u->student_lname_th;
                    */
                   // $std =  RegStudentmaster::findOne(['STUDENTID'=>$u->person_id]);
                    $std =  ViewStudentFull::findOne(['STUDENTID'=>$u->person_id]);
                    $std_id = $std->STUDENTCODE;
                  //  $PREfix = EofficeMainPrefix::findOne(['PREFIXID'=>$std->PREFIXID]);
                   $prefix = $std->PREFIXNAME;
                    $std_name = $std->STUDENTNAME;
                    $std_surname = $std->STUDENTSURNAME;
                    $gpa = $std->GPA;
                    $level = $std->LEVELNAME;
                    $status = $item->ta_status_id;
                    $regis_sec = TaRegisterSection::find()
                        ->where(['person_id'=>$item->person_id,'term'=>$item->term,'year'=>$item->year
                            ,'subject_id'=>$item->subject_id,'subject_version'=>$item->subject_version])->all();
                    $rs_count = count($regis_sec);

                    ?>
                    <tbody>
                    <tr>
                        <?php if (!empty($item->ta_image)){ ?>
                            <td class="text-center">
                                <img class="circle" src="<?= Yii::getAlias('@web/web_ta/images/register/' . $item->ta_image) ?>" alt=""
                                     width="40" height="40">
                            </td>
                        <?php }else{?>
                            <td class="text-center">
                                <img class="circle" src="<?= Yii::getAlias('@web') ?>/web_ta/images/register/ta_user.jpg" alt="" width="40" height="40">
                            </td>
                        <?php }?>
                        <td><?php echo $std_id?></td>
                        <td class="text-center"><?php echo $prefix?>&nbsp;<?php echo $std_name?>&nbsp;&nbsp;<?php echo $std_surname?></td>
                        <td class="text-center"><?php echo $level?></td>
                        <td class="text-center"><?php echo $gpa?></td>
                        <td class="text-center"><?php echo $rs_count?></td>
                        <td class="text-center">

                            <?= Html::a(Html::img(Yii::getAlias('@web').'/web_ta/images/img/user-id-icon.png',
                                ['class' => 'img-responsive ', 'width' => 40,]), ['ta-register-section/detail-by-subj',
                                    's'=>$s,'ver'=>$item->subject_version,'u'=>$item->person_id,'t'=>$t,'y'=>$item->year]
                            )?>
                        </td>
                        <td class="text-center">
                           <span class="label label-danger">คัดออก</span>
                        </td>
                        <td class="text-center">
                            <?= Html::a(Html::tag('i', '  Choose',
                                    ['class' => 'glyphicon glyphicon-share']),  ['teacher/choose-active',
                                    'id'=>$item->person_id,'t'=>$t,'s'=>$s,'y'=>$y],
                                    [
                                        'class' => 'btn btn-sm btn-success',
                                        'data' => [
                                            'confirm' => 'คุณแน่ใจแล้วหรือไม่ว่าคุณต้องเลือกคนนี้เป็นTA ของคุณ?',
                                            'method' => 'post',
                                        ],
                                    ])?>
                        </td>
                    </tr>
                    </tbody>
                <?php  }?>
            </table>
        </div>
        <div></div>
        <!-- /panel content -->

    </div>
</div>