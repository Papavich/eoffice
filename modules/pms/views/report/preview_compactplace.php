<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 1:00
 */

use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use yii\helpers\Html;

$this->registerCssFile("@web/web_pms/css/word.css");
$this->registerJsFile('@web/web_pms/js/export_word_unborder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
<?= Html::csrfMetaTags() ?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    .add_pro .p_word, .a_word {
        margin: 0px;
        margin-top: 5px;
        margin-bottom: 5px;
        padding: 0px;
    }

    p {
        margin-top: 3px !important;
        margin-bottom: 3px !important;
    }
</style>

<div id="content" class="padding-20">
    <div id="page-content" class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 pull-right">
                    <table width="100%">
                        <tr>
                            <td width="83%"></td>
                            <td>แผน-101-1/3</td>
                        </tr>
                    </table>
<!--                    <p class="p_word" style="display: inline-block;float: right !important;">แผน-101-1/3</p>-->
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <div class="a_word" id="m-b-10" style="margin-bottom: 10px;">
                        <table width="100%">
                            <tr>
                                <td width="33%">
                                    <img style="display: inline-block;float: left"
                                         src="<?= Yii::$app->homeUrl ?>web_pms\images\test.jpg" width="100"
                                         height="100">
                                </td>
                                <td><span style="  text-align: center;font-size: 32px;"><b>บันทึกข้อความ</b></span>
                                </td>
                            </tr>
                        </table>
<!--                        <div style="width: 55%;height: 20px;float: left">-->
<!--                            <img style="display: inline-block;float: left"-->
<!--                                 src="= Yii::$app->homeUrl --web_pms\images\test.jpg" width="100"-->
<!--                                 height="100">-->
<!---->
<!--                            <span style="  text-align: center;font-size: 32px;display: inline-block;float: right"><b>บันทึกข้อความ</b></span>-->
<!--                        </div>-->
                    </div>
                    <!--                    <p class="p_word">-->
                    <!--                        <div style="width: 50%;display: inline">-->
                    <!---->
                    <!--                        <span style="  text-align: center;font-size: 32px;display: inline;float: none"><b>บันทึกข้อความ</b></span>-->
                    <!--                    </p>-->
                    <!--                    <p class="p_word" style="text-align: center;size: 16px;padding-top: 30.23622px;font-size: 32px;"><b>บันทึกข้อความ</b></p>-->
                    <table width="100%">
                        <tr>
                            <td width="75%"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span>
                                <span style="margin-left: 10px"><?= $modelprosub->prosub_deparment ?></span></td>
                            <td><span >โทร <?= $modelprosub->compact_phone ?></span></td>
                        </tr>
                    </table>

<!--                    <p class="p_word" style="margin-bottom: 0px;"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span>-->
<!--                        <span style="margin-left: 10px">//= $modelprosub->prosub_deparment </span>-->
<!--                        <span style="margin-left: 450px">โทร //= $modelprosub->compact_phone </span></p>-->

                    <table width="100%">
                        <tr>
                            <td width="70%"><b>ที่ ศธ 0514</b></td>
                            <td><span>วันที่ <?= YearThai($modelprosub->compact_save_date) ?></span></td>
                        </tr>
                    </table>
<!--                    <p class="p_word" style="margin-bottom: 0px;"><b>ที่ ศธ 0514</b><span-->
<!--                                style="margin-left: 600px">วันที่ //= YearThai($modelprosub->compact_save_date) ?><!--</span>-->
<!--                    </p>-->

                    <p class="p_word" style="margin-bottom: 0px;"><b>เรื่อง</b><span class="p_word"
                                                                                     style="margin-left: 10px">ขออนุมัติจัดโครงการที่บรรจุในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?> </span>
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรียน</b><span style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span
                                style="margin-left: 100px">ด้วย<?= $modelprosub->prosub_deparment ?></span>
                        <span>ใคร่ขออนุมัติจัดโครงการที่บรรจุไว้ในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?>
                            และขออนุมัติใช้เงินงบประมาณ <?= $budget ?> โดยมีรายละเอียดประกอบการพิจารณา ดังนี้</span>
                    </p>

                    <p class="p_word" style="margin-bottom: 0px;"><span
                                style="margin-left: 100px">1. ชื่อโครงการย่อย <?= $modelprosub->prosub_name ?></span>
                    </p>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <table>
                                <tbody style="border: hidden">
                                <?php
                                $i = 1;
                                foreach ($execute as $key => $row) {
//                                        $data = \app\modules\pms\models\PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row->execute_id,'pms_compact_has_prosub_id'=>$compact])->one();
//
//                                        if($data){
                                    echo "<tr style=\"border: hidden; text-align: left\">
                                    <td style=\"width: 5%;border: hidden;\">
                                        <p>1." . $i . "</p>
                                    </td>
                                    <td style=\"width: 20%;border: hidden;\">
                                        <p>กิจกรรมที่ " . $i . "</p>
                                    </td>
                                    <td style=\"width: auto;border: hidden;\">
                                        <p>$row->execute_name</p>
                                    </td>
                                </tr>";
                                    $i++;
                                    //}

                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <p class="p_word" style="margin-bottom: 0px;"><span
                                style="margin-left: 100px">2. รหัสโครงการ <?= $modelprosub->prosub_code ?></span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">3. งบประมาณของโครงการที่ระบุในแผนปฏิบัติการ</span>
                    </p>

                    <table style="width: 500px;margin-left: 120px;border: none !important;">
                        <tbody style="border: hidden">
                        <tr style="border: hidden">
                            <td style="border: hidden"><span class="pull-left">3.1 งบจากรัฐ(งบแผ่นดิน)</span></td>
                            <td style="border: hidden"></td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 1) {
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(" . $i . ") " . $BudgetSub->budget_name . "</span></td><td style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td style="border: hidden"><span class="pull-left">3.2 งบประมาณ(งบรายได้)</span></td>
                            <td style="border: hidden"></td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 2) {
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(" . $i . ") " . $BudgetSub->budget_name . "</span></td><td style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td style="border: hidden"><span class="pull-left">3.3 งบอื่นๆ</span></td>
                            <td style="border: hidden"></td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 3) {
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(" . $i . ") " . $row->budget_other . "</span></td><td style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>

                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">4. กำหนดจัดโครงการ ระหว่างวันที่ </span><?= YearThai($modelprosub->compact_start_date) ?>
                        ถึง <?= YearThai($modelprosub->compact_end_date) ?></p>
                    <br/>

                    <br/>
                    <p class="p_word"><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</span></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="" width="100%">
                                <tbody style="border: hidden">
                                <tr>
                                    <td class="" style="border: hidden;width:25%"></td>
                                    <td class="" style="border: hidden;width:25%"></td>
                                    <td class="" style="border: hidden;width:50% ;text-align: center;display: inline-block;float: right">
                                        <p>ลงชื่อ .....................................</p>
                                        <p>(<?php
                                            $datah = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id' => $modelprosub->prosub_manager])->one();
                                            echo $datah->academic_positions_abb_thai . $datah->person_name . " " . $datah->person_surname;
                                            ?>)</p>
                                        <p>ตำแหน่ง <?php
                                            echo $datah->position_name;
                                            ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>


                    <p class="p_word"><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table_border">
                                <tbody>
                                <tr>
                                    <td class="td_border" style="border: 1px solid black;text-align: center">
                                        <p class="p_word">เลขส่งออกลำดับที่ ......</p>
                                        <p>ลงวันที่ <?= YearThai($modelprosub->compact_save_date) ?></p>
                                    </td>
                                    <td class="td_border" style="border: 1px solid black;text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง<br></p>
                                        <p><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id' => $modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME . $datar->person_fname_th . " " . $datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_border" style="border: 1px solid black;" colspan="2">
                                        <p class="p_word">(2) สำหรับงานนโยบายและแผน</p>
                                        <p>( ) โครงการ รหัสโครงการ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>( ) งบประมาณ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>( ) มีการใช้จ่ายแล้ว จำนวน................................บาท</p>
                                        <p>( ) คงเหลือ จำนวน...............................บาท </p>
                                        <p style="text-align: center">
                                            ลงชื่อ......................................................</p>
                                        <p style="text-align: center">
                                            (......................................................)
                                        </p>
                                    </td>
                                    <td class="td_border" style="border: 1px solid black;">
                                        <p class="p_word">(3) ผลการพิจารณา</p>
                                        <p>( ) อนุมัติ หลักการ </p>
                                        <p>( ) ขอข้อมูลเพิ่มเติม เนื่องจาก.....................................</p>
                                        <p>( )
                                            อื่น..........................................................................</p>
                                        <p style="text-align: center">
                                            ลงชื่อ......................................................</p>
                                        <p style="text-align: center">
                                            (......................................................)</p>
                                        <p style="text-align: center">
                                            ตำแหน่ง...................................................................</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <p>
                    <a class="btn btn-info btn-3d pull-left" href="../report/findreport"><i
                                class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                    <a class="btn btn-blue btn-3d pull-right jquery-word-export" href="javascript:void(0)"><i
                                class="fa fa-file-word-o"></i>word</a>
                    <a class="btn btn-danger btn-3d pull-right"
                       href="../pdf/compactplace?id=<?= $modelprosub->prosub_code ?>"><i
                                class="fa fa-file-pdf-o"></i>pdf</a>
                </p>
            </div>
        </div>
    </div>
</div>