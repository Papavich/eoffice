<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 13:33
 */

use app\modules\eoffice_eolm\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\BudgetSub;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;

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
<style>
    .tab_blank {
        width: 200px;
        float: left;
    }

    .p_head {
        text-align: right;
    }

    .b_head {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        border: 1px solid black;
        text-align: center;
    }

    td {
        border: 1px solid black;
    }

    .add_pro .p_word, .a_word {
        margin: 0px;
        margin-top: 3px;
        margin-bottom:3px;
        padding: 0px;
    }
</style>

<div id="content" class="padding-20">
    <div id="page-content" class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="p_head">แผน-101-1/3</p>
                </div>
                <div class="col-md-12">
                    <table>
                        <tbody style="border:hidden">
                        <tr>
                            <td style="border:hidden; width:40%">
                                <img align="left" src="<?= Yii::$app->homeUrl ?>web_pms\images\test.jpg" width="100"
                                     height="100">
                            </td>
                            <td style="border:hidden; text-align:left; width:40%">
                                <font size="6" class="b_head">บันทึกข้อความ</font>
                            </td>
                            <td style="border:hidden; width:20%"></td>
                        </tr>
                        <tr>
                            <td style="border:hidden; width:40%" colspan="2">
                                <p class="p_"><b>ส่วนราชการ </b><span
                                            style="margin-left: 10px">คณะวิทยาศาสตร์</span><span
                                            style="margin-left: 10px"><?= $modelprosub->prosub_deparment ?></span></p>
                            </td>
                            <td style="border:hidden; width:20%;">โทร <?= $modelprosub->compact_phone ?></td>
                        </tr>
                        <tr>
                            <td style="border:hidden; width:40%">
                                <p class="p_word"><b>ที่ ศธ 0514 </b></p>
                            </td>
                            <td style="border:hidden; text-align: right; width:40%">
                                วันที่ <?= YearThai($modelprosub->compact_save_date) ?>
                            </td>
                            <td style="border:hidden; width:20%"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_word">
                    <b>เรื่อง </b><span>ขออนุมัติจัดโครงการที่บรรจุในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?> </span>
                </p>
                <p class="p_word" style="margin-bottom: 0px;"><b>เรียน </b><span
                            style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                </p>
                <p class="p_word"><font color="WHITE">_____________</font>
                    <span>ด้วย<?= $modelprosub->prosub_deparment ?> ใคร่ขออนุมัติจัดโครงการที่บรรจุไว้ในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?>
                        และขออนุมัติใช้เงินงบประมาณ <?= $budget ?> โดยมีรายละเอียดประกอบการพิจารณา ดังนี้</span>
                </p>

                <p class="a_word">
                    <font color="WHITE">__________</font><span>1. ชื่อโครงการย่อย <?= $modelprosub->prosub_name ?></span>
                </p>
                <div class="row" style="margin-left: 120px; margin-right: 70px;">
                    <table>
                        <tbody style="border: hidden">
                        <?php
                        $i = 1;
                        foreach ($execute as $key => $row) {
                                echo "<tr style=\"border: hidden; text-align: center\">
                                    <td height='10' width='10%' style=\"border: hidden;\">
                                        <p>1." . $i . "</p>
                                    </td>
                                    <td height='10' width='20%' style=\"border: hidden;\">
                                        <p>กิจกรรมที่ " . $i . "</p>
                                    </td>
                                    <td height='10' width='70%' style=\"border: hidden;\">
                                        <p>$row->execute_name</p>
                                    </td>
                                </tr>";
                                $i++;

                        }
                        ?>
                    </table>
                </div>

                <p class="a_word"><font color="WHITE">__________</font><span>2. รหัสโครงการ <?= $modelprosub->prosub_code ?></span>
                </p>
                <p class="a_word"><font
                            color="WHITE">__________</font><span>3. งบประมาณของโครงการที่ระบุในแผนปฏิบัติการ</span>
                </p>
                <div class="row" style="margin-left: 120px; margin-right: 70px;">
                    <table>
                        <tbody style="border: hidden">
                        <tr style="border: hidden">
                            <td height='10' colspan="2" style="border: hidden"><span class="pull-left">3.1 งบจากรัฐ(งบแผ่นดิน)</span>
                            </td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 1) {
                                echo "<tr><td height='10' style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'><font color='white'>____</font>(" . $i . ") " . $BudgetSub->budget_name . "</span></td>
                                <td height='10' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td colspan="2" height='10' style="border: hidden"><span class="pull-left">3.2 งบประมาณ(งบรายได้)</span>
                            </td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 2) {
                                echo "<tr><td height='10' style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'><font color='white'>____</font> (" . $i . ") " . $BudgetSub->budget_name . "</span></td>
                            <td height='10' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td height='10' colspan="2" style="border: hidden"><span
                                        class="pull-left">3.3 งบอื่นๆ</span></td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($probudget as $key => $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 3) {
                                echo "<tr><td height='10' style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'><font color='white'>____</font>(" . $i . ") " . $row->budget_other . "</span></td>
                                    <td height='10' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <p>
                    <font color="WHITE">__________</font><span>4. กำหนดจัดโครงการ ระหว่างวันที่ </span><?=YearThai($modelprosub->compact_start_date)?>
                    ถึง <?=YearThai($modelprosub->compact_end_date)?></span>
                </p>

                <br/>

                <br/>
                <p class="p_word"><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</span></p>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody style="border: hidden">
                            <tr>
                                <td height="10" style="border: hidden;width:25%"></td>
                                <td height="10" style="border: hidden;width:25%"></td>
                                <td height="10" style="border: hidden;width:25% ;text-align: center" colspan="2">
                                    <p>ลงชื่อ .....................................</p>
                                    <p style="margin-left: 40px;">(<?php
                                        $datah = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$modelprosub->prosub_manager])->one();
                                        echo $datah->academic_positions_abb_thai.$datah->person_name." ".$datah->person_surname;
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

                    <p class="p_word" ><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">เลขส่งออกลำดับที่ ......</p>
                                        <p>ลงวันที่ <?=YearThai($modelprosub->compact_save_date)?></p>
                                    </td>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง</p>
                                        <p>
                                            <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?>
                                            </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="100" colspan="2">
                                        <p class="p_word">(2) สำหรับงานนโยบายและแผน</p>
                                        <p>(     ) โครงการ รหัสโครงการ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>(     ) งบประมาณ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>(     ) มีการใช้จ่ายแล้ว  จำนวน................................บาท</p>
                                        <p>(     ) คงเหลือ จำนวน...............................บาท                        </p>
                                        <p style="text-align: center">ลงชื่อ......................................................</p>
                                        <p style="text-align: center">(......................................................)
                                        </p>
                                    </td>
                                    <td height="100">
                                        <p class="p_word">(3) ผลการพิจารณา</p>
                                        <p>(     )  อนุมัติ หลักการ  </p>
                                        <p>(     )  ขอข้อมูลเพิ่มเติม เนื่องจาก.....................................</p>
                                        <p>(     )  อื่น..........................................................................</p>
                                        <p style="text-align: center">ลงชื่อ......................................................</p>
                                        <p style="text-align: center">(......................................................)</p>
                                        <p style="text-align: center">ตำแหน่ง...................................................................</p>
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
</div>

