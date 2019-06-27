<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 20/5/2561
 * Time: 13:23
 */
?>
<?php


use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use yii\helpers\Html;

?>
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
<?= HTML::csrfMetaTags() ?>
<header id="page-header">
    <h1>ติดตามสถานะโครงการ</h1>
</header>
<div id="content" class="padding-20">
    <div class="page-profile">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="title elipsis">
                            <strong>โครงการที่เสนอลงปีงบประมาณ</strong>
                        </span>
                        <ul class="options pull-right list-inline">
                            <li>
                                <a href="#" class="opt panel_colapse " data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_wait_in_system" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="9%">วันที่จัดโครงการ</th>
                                    <th width="30%">ชื่อโครงการ</th>
                                    <th width="13%">สถานะของโครงการ</th>
                                    <th width="10%">หมายเหตุ</th>
                                    <th width="17%">ผู้รับผิดชอบโครงการ</th>
                                    <th width="8%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($prosub as $rows) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo YearThai($rows['prosub_start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?= $rows['prosub_name'] ?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" class="get_status"
                                               data="<?= $rows['prosub_code'] ?>" data-target="#showstatus">
                                                <?php
                                                echo $rows['prosub_status_offer'];
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            <span>
                                                <?php
                                                $comment = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code' => $rows['prosub_code'], 'status_process' => 1])->orderBy(['id' => SORT_DESC])->one();
                                                if ($comment) {
                                                    echo $comment->comment;
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id' => $rows['prosub_responsible_id']])->one();
                                            echo $datar->PREFIXNAME . $datar->person_fname_th . " " . $datar->person_lname_th;
                                            ?>
                                        </td>
                                        <td>

                                            <?php

                                            if ($rows->prosub_status_offer == "ยังไม่ดำเนินการ" || $rows->prosub_status_offer == "รอปรับแก้ไขโครงการ") {
                                                echo "<a href=\"../detailpro/detailpro?id=" . $rows['prosub_code'] . "\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> |";
                                                echo " <a href=\"../addprosub/prosub-edit?id=" . $rows['prosub_code'] . "\"><i class=\"glyphicon glyphicon-pencil\"></i></a> |";
                                                echo " <a href=\"../addprosub/addprosub-delete?id=" . $rows['prosub_code'] . "\" class=\"delete\"><i class=\"glyphicon glyphicon-trash\"></i></a> ";
                                            } else {
                                                echo "<a href=\"../detailpro/detailpro?id=" . $rows['prosub_code'] . "\"><i class=\"glyphicon glyphicon-eye-open\"></i></a>";
                                            }
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="title elipsis">
                            <strong>โครงการที่ขออนุมัติจัดโครงการ</strong>
                        </span>
                        <ul class="options pull-right list-inline">
                            <li>
                                <a href="#" class="opt panel_colapse " data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_compact_place" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="13%">วันที่จัดโครงการ</th>
                                    <th width="33%">ชื่อโครงการ</th>
                                    <th width="15%">สถานะโครงการ</th>
                                    <th width="15%">หมายเหตุ</th>
                                    <th>ผู้รับผิดชอบโครงการ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($prosub_place as $key => $rows) {
                                    $i = $key + 1;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo YearThai($rows['compact_start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?= $rows['prosub_name'] ?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" class="get_status_place"
                                               data="<?= $rows['prosub_code'] ?>" data-target="#showstatus_place">
                                                <?php
                                                echo $rows['prosub_status_place'];
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                        <span>
                                            <?php
                                            $comment = \app\modules\pms\models\LogPermisInSystem::find()->where(['pms_project_sub_prosub_code' => $rows['prosub_code'], 'status_process' => 2])->orderBy(['id' => SORT_DESC])->one();
                                            if ($comment) {
                                                echo $comment->comment;
                                            }
                                            ?>
                                        </span>
                                        </td>
                                        <td>
                                            <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id' => $rows['prosub_responsible_id']])->one();
                                            echo $datar->PREFIXNAME . $datar->person_fname_th . " " . $datar->person_lname_th;
                                            ?>
                                        </td>

                                        <td>
                                            <a><i class=""></i></a>
                                            <?php
                                            echo "<a href=\"../detailcompactplace/detail?id=" . $rows['prosub_code'] . "\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> ";
                                            if ($rows['prosub_status_place'] == "ยังไม่ดำเนินการ" || $rows['prosub_status_place'] == "รอปรับแก้ไขโครงการ") {
                                                ?>
                                                | <a href="../compact/editcompactplan?id=<?= $rows['prosub_code']; ?>"><i
                                                            class="glyphicon glyphicon-pencil"></i></a>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="title elipsis">
                            <strong>โครงการที่ขออนุมัติใช้งบประมาณ</strong>
                        </span>
                        <ul class="options pull-right list-inline">
                            <li>
                                <a href="#" class="opt panel_colapse " data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_compact_budget" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="17%">วันที่จัดโครงการ</th>
                                    <th width="33%">ชื่อโครงการ</th>
                                    <th width="13%">สถานะโครงการ</th>
                                    <th width="13%">หมายเหตุ</th>
                                    <th>ผู้รับผิดชอบโครงการ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($prosub_budget as $key => $rows){
                                    $i = $key +1;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "จัดครั้งที่ ".$rows['round'].", ".YearThai($rows['compact_start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?=$rows['prosub_name']?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" class="get_status_budget" data="<?=$rows['prosub_code']."_".$rows['id']?>" data-target="#showstatus_budget">
                                                <?php
                                                echo $rows['status_finance'];
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                        <span>
                                            <?php
                                            $comment = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$rows['prosub_code'],'status_process'=>3,'pms_compact_has_prosub_id'=>$rows['id']])->orderBy(['id'=>SORT_DESC])->one();
                                            if($comment){
                                                echo $comment->comment;
                                            }
                                            ?>
                                        </span>
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
                                            echo "<a href='../detailcompactbudget/detail?id=".$rows['prosub_code']."&compact=".$rows['id']."'><i class=\"glyphicon glyphicon-eye-open\"></i></a> ";
                                            if($rows['status_finance'] == "ยังไม่ดำเนินการ" || $rows['status_finance'] == "รอปรับแก้ไขโครงการ"){
                                                ?>
                                                | <a href="../compact/editcompactbudget?id=<?= $rows['prosub_code'];?>&compact=<?=$rows['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="title elipsis">
                            <strong>โครงการที่รอจัดโครงการพร้อมใช้งบประมาณ</strong>
                        </span>
                        <ul class="options pull-right list-inline">
                            <li>
                                <a href="#" class="opt panel_colapse " data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_compact_pandb" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="17%">วันที่จัดโครงการ</th>
                                    <th width="33%">ชื่อโครงการ</th>
                                    <th width="13%">สถานะโครงการ</th>
                                    <th width="13%">หมายเหตุ</th>
                                    <th>ผู้รับผิดชอบโครงการ</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($prosub_pandb as $key => $rows){
                                    $i = $key +1;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "จัดครั้งที่ ".$rows['round'].", ".YearThai($rows['start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?=$rows['prosub_name']?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" class="get_status_pandb" data="<?=$rows['prosub_code']."_".$rows['id']?>" data-target="#showstatus_pandb">
                                                <?php
                                                echo $rows['status_pandf'];
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                        <span>
                                            <?php
                                            $comment = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$rows['prosub_code'],'status_process'=>4,'pms_compact_has_prosub_id'=>$rows['id']])->orderBy(['id'=>SORT_DESC])->one();
                                            if($comment){
                                                echo $comment->comment;
                                            }
                                            ?>
                                        </span>
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
                                            echo "<a href=\"../detailcompactpandb/detail?id=".$rows['prosub_code']."&compact=".$rows['id']."\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> ";
                                            if($rows['status_pandf'] == "ยังไม่ดำเนินการ" || $rows['status_pandf'] == "รอปรับแก้ไขโครงการ"){
                                                ?>
                                                | <a href="../compact/editcompactpandb?id=<?= $rows['prosub_code'];?>&compact=<?=$rows['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
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
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="showstatus" role="dialog" hidden="">
    <div class="modal-dialog">
        <div class="modal-content" style="width:850px;">
            <div class="modal-body">
                <table class="table table-striped">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="25%">สถานะ</th>
                            <th width="25%">วันที่</th>
                            <th width="30%">ผู้ดำเนินการ</th>
                            <th width="20%">หมายเหตุ</th>
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

<div class="modal fade" id="showstatus_place" role="dialog" hidden="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 850px;">
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
                        <tbody id="show_status_place">


                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showstatus_budget" role="dialog" hidden="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 850px;">
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
                        <tbody id="show_status_budget">


                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showstatus_pandb" role="dialog" hidden="">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 850px;">
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
                        <tbody id="show_status_pandb">


                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>