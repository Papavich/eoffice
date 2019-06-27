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
use yii\helpers\Html;
$this->registerJsFile('@web/web_pms/js/table_status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?=HTML::csrfMetaTags()?>
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
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12" style="margin-top: 20px">
                            <table id="table_wait_in_system" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="11%">วันที่จัดโครงการ</th>
                                    <th width="30%">ชื่อโครงการ</th>
                                    <th width="13%">แบบเสนอโครงการ</th>
                                    <th width="13%">แบบสรุปโครงการ</th>
                                    <th width="17%">ผู้รับผิดชอบโครงการ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($prosub as $rows){

                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo YearThai($rows['prosub_start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?=$rows['prosub_name']?>
                                        </td>
                                        <td>
                                            <a href="../adasd/asdsad"><i class="fa fa-file-word-o"></i></a> |
                                            <a href="../pdf/pdfrespon?id=<?=$rows['prosub_code']?>" style="color: #F22424"><i class="fa fa-file-pdf-o"></i></a>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" class="get_doc_compact" data="<?=$rows['prosub_code']?>" data-target="#showdoc">
                                                เอกสารเพิ่มเติม
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$rows['prosub_responsible_id']])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
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



