<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 9/3/2561
 * Time: 7:04
 */
?>

<?php

use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use yii\helpers\Html;

$this->registerJsFile('@web/web_pms/js/table_status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= HTML::csrfMetaTags() ?>
<?php

function YearThai($strDate)
{
    $result = validateDate($strDate);
    if ($result == true) {
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4, 4);
        $year = $date + 543;
        $reDate = str_replace($date, $year, $dateTh);
        return $reDate;
    } else {
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
<header id="page-header">
    <h1>โครงการที่อยู่ที่ในแผนปีงบประมาณ</h1>

</header>
<style>
    nav.pagination-container {
        text-align: center;
        padding-top: 2px;
    }
</style>
<div id="content" class="padding-20">

    <div class="page-profile">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>โครงการทั้งหมด</strong>
                        <div class="pull-right"><span class="label label-success"> <i class="fa fa-file-text"
                                                                                      style="color: white"></i></span>
                            เอกสารสรุปโครงการ
                        </div>
                        <div class="pull-right" style="margin-right: 5px"><span class="label label-info"> <i
                                        class="fa fa-file-text-o" style="color: white"></i></span> เอกสารเสนอโครงการ
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_wait_in_system" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="11%">วันที่จัดโครงการ</th>
                                    <th width="40%">ชื่อโครงการ</th>
                                    <th width="13%">สถานะดำเนินการ</th>
                                    <th>ผู้รับผิดชอบโครงการ</th>
                                    <th width="12%">เอกสารโครงการ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($prosub as $rows) {
                                    $modelCompact = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code' => $rows])->all();
                                    foreach ($modelCompact as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($rows['compact_start_date']) {
                                                    echo YearThai($rows['compact_start_date']);
                                                } else {
                                                    echo YearThai($row['start_date']);
                                                }

                                                ?>
                                            </td>
                                            <td class="center">
                                                <?= $rows['prosub_name'] . " จัดครั้งที่ " . $row['round'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['status_result'] == "เสร็จสิ้น") {
                                                    echo "<span class=\"label label-success\"
                                                      style='width: 100px;display: inline-block;'>ดำเนินการเสร็จสิ้น</span>";
                                                }else{
                                                    echo "<span class=\"label label-info\"
                                                      style='width: 100px;display: inline-block;'>อยู่ระหว่างดำเนินการ</span>";
                                                }
                                                ?>


                                            </td>
                                            <td>
                                                <?php
                                                $datar = EofficeCentralViewPisUser::find()->where(['id' => $rows['prosub_responsible_id']])->one();
                                                echo $datar->PREFIXNAME . $datar->person_fname_th . " " . $datar->person_lname_th;
                                                ?>
                                            </td>
                                            <td>
                                                <span class="label label-info"><a
                                                            href="../tablepro/prosub?id=<?= $rows['prosub_code'] ?>"><i
                                                                class="fa fa-file-text-o" style="color: white"></i></a></span>
                                                <?php
                                                if ($row['status_result'] == "เสร็จสิ้น") {
                                                    echo " |
                                                <span class=\"label label-success\" ><a href=\"../tablepro/prosubresult?id=" . $rows['prosub_code'] . "&id_compact=" . $row['id'] . "\"><i
                                                            class=\"fa fa-file-text\" style=\"color: white\"></i></a></span>";
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="showdoc" role="dialog" hidden="">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 750px;">
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="25%">วันที่จัดโครงการ</th>
                                            <th width="25%">สรุปโครงการ</th>
                                        </tr>
                                        </thead>
                                        <tbody id="show_doc">


                                        </tbody>
                                    </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="showsavedate" role="dialog" hidden="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th width="40%">สถานะโครงการ</th>
                                        <th width="30%">วันที่อนุมัติ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ฝ่ายพัฒนานักศึกษาอนุมัติ</td>
                                        <td>10/10/2560</td>
                                    </tr>
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
</div>


<!--    <div class="row" style="border: solid 2px black;padding: 5px;position: fixed;width: 350px;bottom: 0;left: 20%;z-index: 99;border-color: #5a6667;background-color: #ffffff;border-top-left-radius: 2px;border-top-right-radius: 2px;">-->
<!--        <div class="col-md-12">-->
<!--            <span class="label label-info" ><i class="fa fa-file-text-o" style="color: white"></i></span> เอกสารเสนอโครงการ-->
<!--            <span class="label label-success" ><i class="fa fa-file-text" style="color: white"></i></span> เอกสารสรุปโครงการ-->
<!--        </div>-->
<!--    </div>-->




