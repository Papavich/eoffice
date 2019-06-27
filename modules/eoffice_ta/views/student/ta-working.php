<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 6/11/2560
 * Time: 20:15
 */
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSubject;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\TaWorkLoad;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php
$per = new Person();
$per->Person_id = Yii::$app->user->id;;
$regises = TaRegister::find()->where(['person_id'=>$per])->all();
?>
<div id="panel-1" class="panel panel-info">
    <div class="panel-heading">
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>รายวิชาที่สอน ของ</strong><strong class="text-blue">
                                  <?php  foreach ($regises as $regis ) {
                                  }?>

                                      <?=$regis->person->fname_th.
                                      "&nbsp;&nbsp;".$regis->person->lname_th;?>

                                   </strong>
							</span>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-vertical-middle nomargin">
        <thead>
        <tr class="btn-blue">
            <th width="10%"><center>วิชา</center></th>
            <th width="15%"><center>อาจารย์ประจำวิชา</center></th>
            <th width="5%"><center>หน่วยกิต</center></th>
            <th width="15%"><center>ลงเวลาปฏิบัติงาน</center></th>
        </tr>
        </thead>
        <?php
        foreach ($regises as $subj ){
            ?>
            <tbody>
            <tr>
                <!-- *********************** วิชา ****************** -->
                <td><?php
                    $register_id=$subj->ta_register_id;
                    $s=$subj->subject_id;
                    $t = $subj->subject->teacher;?>
                    <?= $subj->subject_id?>&nbsp;&nbsp; <?= $subj->subject->subject_name?>
                </td>
                <!-- *********************** อสจารย์ประจำวิชา ****************** -->
                <td align="center">
                    <?php
                    $teacher = Person::findOne($subj->subject->teacher);
                    echo $teacher->prefix."&nbsp;&nbsp;".$teacher->fname_th."&nbsp;&nbsp;".$teacher->lname_th;
                    ?>

                </td>
                <!-- *********************** หน่วยกิต ****************** -->
                <td align="center"><?= $subj->subject->credit?></td>
                <!-- *********************** Secที่สอน ****************** -->
                <td align="center">

                    <?php
                    // *********************** ตรวจสอบว่าแจ้งภาระงานหรือยัง ******************
                    $Wloads = TaWorkLoad::find()->where(['ta_register_id'=>$register_id])->all();
                    foreach ($Wloads as $Wload) {
                    }
                    if (empty($Wloads)){ // เช็คว่าวิชานี้ได้แจ้งภาระงานหรือยัง กรณีถ้าแสดงเงื่อนไขนี้แสดงว่ายังไม่แจ้งภาระงาน?>
                        <!-- *********************** กรณีวิชานี้ยังไม่ได้แจ้งภาระงาน ****************** -->
                        <?= "<em><strong class='text-red'>ยังไม่ได้แจ้งภาระงาน !!</strong></em>";?>
                    <?php }else{
                        $workload_id = $Wload->ta_work_load_id;
                        ?>
                        <!-- *********************** เช็คว่าทำแผนการสอนยัง ****************** -->
                        <?php
                        $Wplans = \app\modules\eoffice_ta\models\TaWorkPlan::find()
                            ->where(['ta_work_load_id'=>$workload_id])->all();
                            if(empty($Wplans)){
                                // ************************** กรณียังไม่ได้วางแผนปฏิบัติงาน **************
                                echo "<em><strong class='text-red'>-- ยังไม่ได้ทำแผนปฏิบัติงาน!! --</strong></em>";
                            }else{
                                $row_wplan = count($Wplans); //ค่าจำนวนแถวในการทำแผน เพื่อเอสไปเช็คต่อว่าสร้างแผนครบยัง
                                if($row_wplan<10){
                                    echo "<em><strong class='text-red'>-- กรุณาวางแผนการสอนให้ครบทุกสัปดาห์ --</strong></em>";
                                }elseif ($row_wplan>15){
                                    echo "<em><strong class='text-red'>-- คุณวางแผนการสอนเกินจริง!!--<br>-- กรุณาวางแผนการสอนให้ครบทุกสัปดาห์ --</strong></em>";
                                }else{
                        ?>
                  <!-- *********************** กรณีผ่านทุกเงื่อนไข ให้แสดงSecที่สอน เพื่อทำการลงเวลาเข้างาน ****************** -->
                    <?php $secs_teach = TaRegisterSection::find()->where(['ta_register_id'=>$register_id])->all();
                                    foreach ($secs_teach as $sec_teach ) {?>

                                        <a href="<?= Url::to(['ta-work-plan/view-working','id'=>$workload_id,'subj'=>$subj->subject_id,'sec'=>$sec_teach->sec->ta_sec_id]) //ส่ง id แผนปฏิบัติงานไป?>"
                                           class='btn btn-3d btn-sm btn-reveal btn-warning'>
                                            <i class='glyphicon glyphicon-time'></i><span><?="sec".$sec_teach->sec->ta_sec_name?></span></a>

                    <?php }?>
                    <?php }?>
                    <?php }?>
                    <?php }?>
                </td>
                <!-- *********************** สถานะ ****************** -->

            </tr>
            </tbody>
        <?php }?>
    </table>

</div>

