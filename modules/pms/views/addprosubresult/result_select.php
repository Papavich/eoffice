<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 21/4/2561
 * Time: 22:13
 */

use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<?php

function YearThai($strDate){
    $result = validateDate($strDate);
    if($result == true){
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4,4);
        $year = $date+543;
        $reDate = str_replace($date,$year,$dateTh);
        return $reDate;
    }else{
        $strDate = Yii::$app->formatter->asDate($strDate, 'medium');
        return $strDate;
    }
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>เพิ่มเอกสารสรุปโครงการ</strong>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['action'=>'../addprosubresult/resultadd','method'=>'get']);?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <label>โครงการย่อย</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label>ครั้งที่จัดโครงการ</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control select2" name="id" id="id" required>
                                <option value=""  selected>เลือกโครงการย่อย</option>
                                <?php
                                foreach ($listProsub as $row){
                                    echo "<option value='".$row['prosub_code']."'>".$row['prosub_name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control" name="id_compact" id="compact_show">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> เพิ่ม</i></button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>สรุปโครงการทั้งหมด</strong>
                </div>
                <div class="panel-body">
                    <div class="col-md-12" style="margin-top: 20px">
                        <table id="table_compact_summary" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="17%">วันที่จัดโครงการ</th>
                                <th width="33%">ชื่อโครงการ</th>
                                <th width="17%">สถานะสรุปโครงการ</th>
                                <th>ผู้รับผิดชอบโครงการ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($prosub as $key => $rows){
                                $i = $key +1;
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if($rows['start_date'] == null){
                                            echo "ครั้งที่ ".$rows['round']." ".YearThai($rows['prosub_start_date']);
                                        }else{
                                            echo "ครั้งที่ ".$rows['round']." ".YearThai($rows['start_date']);
                                        }
                                        ?>
                                    </td>
                                    <td class="center">
                                        <?=$rows['prosub_name']?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $rows['status_result'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $datar = EofficeCentralViewPisUser::find()->where(['id'=>$rows['prosub_responsible_id']])->one();
                                        echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                        ?>
                                    </td>

                                    <td>
                                        <a><i class=""></i></a>
                                        <?php
                                        echo "<a href=\"../detailprosubresult/detail?id=".$rows['prosub_code']."&id_compact=".$rows['id']."\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> ";
                                        if($rows['status_result'] == "ยังไม่ดำเนินการ" || $rows['status_result'] == "รอปรับแก้ไขโครงการ"){
                                            ?>
                                            | <a href="../addprosubresult/resultedit?id=<?= $rows['prosub_code'];?>&id_compact=<?=$rows['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <?php
                                        }

                                        ?>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="showstatus" role="dialog" hidden="">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 750px;">
                        <div class="modal-body">
                            <table class="table table-striped">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th width="25%">สถานะ</th>
                                        <th width="25%">วันที่</th>
                                        <th width="20%">ผู้ดำเนินการ</th>
                                        <th width="30%">หมายเหตุ</th>
                                    </tr>
                                    </thead>
                                    <tbody id="show_status">


                                    </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
