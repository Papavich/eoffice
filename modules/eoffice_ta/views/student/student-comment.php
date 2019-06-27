<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 27/11/2560
 * Time: 12:48
 */
use app\modules\eoffice_ta\models\Subject;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php
$Subjs = Subject::find()->all(); // ดึงข้อมูลวิชาทั้งหมดออกมาแสดง
?>

<div id="panel-1" class="panel panel-info">
    <div class="panel-heading">
							<span class="title elipsis size-20"><!-- panel title -->
								<strong>แสดงความคิดเห็นต่อผู้ช่วยสอน</strong><strong class="text-blue">



                                   </strong>
							</span>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-vertical-middle nomargin">
        <thead>
        <tr class="btn-aqua">

            <th width="15%"><center>วิชา</center></th>
            <th width="15%"><center>รหัสวิชา</center></th>
            <th width="5%"><center>หน่วยกิต</center></th>
            <th width="15%"><center>จัดการ</center></th>
        </tr>
        </thead>
    <?php
    foreach ($Subjs as  $subj){
         ?>
        <tbody>
        <tr>
            <!-- *********************** วิชา ****************** -->
            <td><?php
                $subj->subject_name;?>
                <?= $subj->subject_name?>
            </td>
            <!-- *********************** รหัสวิชา ****************** -->
            <td><?php
                $subid=$subj->subject_id;?>
                <?= $subj->subject_id?>
            </td>
            <!-- *********************** หน่วยกิต ****************** -->
            <td><?php
                $subj->credit;?>
                <?= $subj->credit?>
            </td>
            <!-- *********************************** จัดการ ******************************* -->
            <td align="center">
                <!-- *********************************** แก้ไข ******************************* -->
                <a href="<?= Url::to(['ta-comment/index','id'=>$subid]) ?>" class='btn btn-3d btn-warning'>
                    <i class='glyphicon glyphicon-pencil'></i>
                </a>
            </td>
        </tr>
        </tbody>



    <?php } ?>
</div>