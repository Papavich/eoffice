<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 13:33
 */

use app\modules\pms\models\BudgetSub;
use app\modules\pms\models\GroupPlan;
use app\modules\pms\models\GroupSubsidizedStrategy;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;

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

    .block1 {
        padding: 10px;
        margin-left: 50px;
        margin-bottom: 200px !important;
        width: 200px !important;
        height: 40px;
        border: 2px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */

    }

    .block2 {
        width: 50px;
        height: 30px;
        float: right;
    }

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

    .add_pro .p_word .a_word {
        margin: 0px;
        margin-top: 5px;
        margin-bottom: 5px;
        padding: 0px;
    }
</style>

<div id="content" class="padding-20">
    <div id="page-content" class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="p_head">แผน-104-1/3</p>
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
                            <td style="border:hidden; width:20%;">โทร <?= $modelcompacthasprosub->phone_no ?></td>
                        </tr>
                        <tr>
                            <td style="border:hidden; width:40%">
                                <p class="p_word"><b>ที่ ศธ 0514 </b></p>
                            </td>
                            <td style="border:hidden; text-align: right; width:40%">
                                วันที่ <?= YearThai($modelcompacthasprosub->save_date) ?>
                            </td>
                            <td style="border:hidden; width:20%"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_word">
                    <b>เรื่อง </b><span>ขออนุมัติจัดโครงการที่บรรจุในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?> </span>
                </p>
                <p class="p_word" style="margin-bottom: 0px !important;"><b>เรียน </b><span
                            style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                </p>
                <p class="p_word"><font color="WHITE">__________</font>
                    <span>ด้วย<?= $modelprosub->prosub_deparment ?> ใคร่ขออนุมัติจัดโครงการที่บรรจุไว้ในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?>
                        และขออนุมัติใช้เงินงบประมาณ <?= $budget ?> โดยมีรายละเอียดประกอบการพิจารณา ดังนี้</span>
                </p>
                <p class="p_word">
                    <font color="WHITE">__________</font><span><b>ก.
                            ขออนุมัติจัดโครงการ</b></span>
                </p>
                <p class="p_word">
                    <font color="WHITE">__________</font><span>1. ชื่อโครงการย่อย <?= $modelprosub->prosub_name ?></span>
                </p>
                <div class="row" style="margin-left: 120px; margin-right: 70px;">
                    <table>
                        <tbody style="border: hidden">
                        <?php
                        $i = 1;
                        foreach ($execute as $key => $row) {
                            $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id, 'pms_compact_has_prosub_id' => $compact])->one();
                            if ($data) {
                                echo "<tr style=\"border: hidden; text-align: center\">
                                    <td height='10' width='10%' style=\"border: hidden;\">
                                        <p>1." . $i . "</p>
                                    </td>
                                    <td height='10' width='20%' style=\"border: hidden;\">
                                        <p>กิจกรรมที่ " . $row->execute_no . "</p>
                                    </td>
                                    <td height='10' width='70%' style=\"border: hidden;\">
                                        <p>$row->execute_name</p>
                                    </td>
                                </tr>";
                                $i++;
                            }

                        }
                        ?>
                    </table>
                </div>

                <p class="p_word"><font color="WHITE">__________</font><span>2. รหัสโครงการ <?= $modelprosub->prosub_code ?></span>
                </p>
                <p class="p_word"><font
                            color="WHITE">__________</font><span>3. งบประมาณของโครงการที่ระบุในแผนปฏิบัติการ</span>
                </p>
                <div class="row" style="margin-left: 120px; margin-right: 70px;">
                    <table width="100%">
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
                                echo "<tr><td height='40' style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'><font color='white'>____</font>(" . $i . ") " . $BudgetSub->budget_name . "</span></td>
                                <td height='40' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
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
                            <td height='40' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
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
                                    <td height='40' style=\"border: hidden\">จำนวน " . number_format($row->budget_limit) . " บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <p>
                    <font color="WHITE">__________</font><span>4. กำหนดจัดโครงการ ระหว่างวันที่ <?= YearThai($modelcompacthasprosub->start_date) ?>
                        ถึง <?= YearThai($modelcompacthasprosub->end_date) ?></span>
                </p>

                <p>
                    <font color="WHITE">__________</font><span><b>ข. ขออนุมัติใช้เงินงบประมาณ <?= $budget ?></b></span>
                </p>
                <p class="p_word"><font color="WHITE">__________</font>
                    <span>ขออนุมัติใช้เงินงบประมาณ <?= $budget ?></span>
                    ประจำปีงบประมาณ พ.ศ.<?= $modelprosub->prosub_year ?>
                    เพื่อเป็นค่าใช้จ่ายในการดำเนินงานกิจกรรมที่ <?= $countComhasexecute ?> จำนวน <?=number_format($costplaneEng)?> บาท (<?=$costplaneTh?>)
                    จากแผนงาน<?php $data = GroupPlan::findOne($modelcompacthasprosub->group_plan);
                    if($data){echo $data->name;}else{echo "<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";} ?> จัดการเรียนการสอนสาขาวิชา <?= $modelprosub->prosub_deparment ?>
                    <?php $data = GroupSubsidizedStrategy::findOne($modelcompacthasprosub->group_subsidized_strategy);
                    if($data){echo $data->name;}else{echo "<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";} ?> งบเงินอุดหนุน เงินอุดหนุนทั่วไป ค่าใช้จ่าย <?= $budget ?> โดยมีรายการรายจ่าย
                    ดังต่อไปนี้</span>
                </p>

                <?php
                foreach ($comhasexecute as $key => $row) {
                    $i = $key + 1;
                    ?>
                    <p><font color="WHITE">__________</font>กิจกรรมที่ <?= $i ?> <?php
                        $data = PmsExecute::findOne($row->pms_execute_execute_id);
                        echo $data->execute_name;
                        ?></b></p>
                    <div class="row" style="margin-left: 120px; margin-right: 70px;">
                        <table>
                            <tbody style="border: hidden;">
                            <?php
                            $datas = PmsExecuteHasCost::find()->where(['pms_execute_execute_id' => $row->pms_execute_execute_id])->all();
                            foreach ($datas as $keys => $rows) {
                                $i = $keys + 1;
                                ?>
                                <tr style="border: hidden; text-align: left">
                                    <td style="width: 2%;border: hidden;">
                                        <p><?= $i . "." ?></p>
                                    </td>
                                    <td style="width: 40%;border: hidden;">
                                        <p><?= $rows->detail ?></p>
                                    </td>
                                    <td style="width: 5%;border: hidden;">
                                        <p>เป็นเงิน</p>
                                    </td>
                                    <td style="width: 5%;border: hidden;">
                                        <p><?= number_format($rows->cost) ?></p>
                                    </td>
                                    <td style="width: 5%;border: hidden;">
                                        <p>บาท</p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } ?>
                <p class="p_word"><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</span></p>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody style="border: hidden">
                            <tr>
                                <td height="40" style="border: hidden;width:25%"></td>
                                <td height="40" style="border: hidden;width:25%"></td>
                                <td height="40" style="border: hidden;width:25% ;text-align: center" colspan="2">
                                    <p>ลงชื่อ .................................................</p>
                                    <p style="margin-left: 80px;">
                                        (<?php
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
                    <p><font color="white">__</font><b>ก. ขออนุมัติจัดโครงการ</b></p>
                    <p>การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">เลขส่งออกลำดับที่ ......</p>
                                        <p>ลงวันที่ <?= YearThai($modelcompacthasprosub->save_date) ?></p>
                                    </td>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง</p>
                                        <p>  <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="120" colspan="2">
                                        <p class="p_word">(2) สำหรับงานนโยบายและแผน</p>
                                        <p>( ) โครงการ รหัสโครงการ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>( ) งบประมาณ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>( ) มีการใช้จ่ายแล้ว จำนวน................................บาท</p>
                                        <p>( ) คงเหลือ จำนวน...............................บาท </p>
                                        <p><font color="WHITE">____</font>ลงชื่อ......................................................
                                        </p>
                                        <p><font color="WHITE">______</font>(......................................................)
                                        </p>
                                    </td>
                                    <td height="120">
                                        <p class="p_word">(3) ผลการพิจารณา</p>
                                        <p>( ) อนุมัติ หลักการ </p>
                                        <p>( ) ขอข้อมูลเพิ่มเติม เนื่องจาก.....................................</p>
                                        <p>( ) อื่น...............................................................</p>
                                        <p><font color="WHITE">____</font>ลงชื่อ......................................................
                                        </p>
                                        <p><font color="WHITE">______</font>(......................................................)
                                        </p>
                                        <p>
                                            ตำแหน่ง...................................................................</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>

                    <p><font color="white">__</font><b>ข. ขอใช้งบประมาณ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">คุมยอดหลักการลำดับที่</p>
                                        <p>.................................</p>
                                    </td>
                                    <td height="50" style="text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง</p>
                                        <p> <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left">
                                        <p>(4) เรียน คณบดี</p>
                                        <p><font color="white">________</font>ตรวจสอบแล้วเห็นควรอนุมัติ</p>
                                        <p><font color="white">_________________</font>........................................................
                                        </p>
                                        <p><font color="white">___________</font>ตำแหน่ง
                                            .........................................................</p>
                                        <p><font color="white">___________</font>วันที่
                                            ........................................................</p>
                                    </td>
                                    <td>
                                        <p align="left">(5) อนุมัติตามเสนอ</p>
                                        <p align="center">
                                            ..........................................................</p>
                                        <p align="center">
                                            (.......................................................)</p>
                                        <p>ตำแหน่ง
                                            ..............................................</p>
                                        <p>วันที่
                                            ...................................................</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p class="p_word">ที่ ศธ 0514.2. ......../.............
                                            <font color="white">_________________</font>
                                            วันที่.......................................................................</span>
                                        </p>
                                        <p>(6) เรียน คณบดี</p>
                                        <p><font color="white">________</font>พร้อมนี้ได้แนบหลักฐานการเบิกจ่ายเงินค่า.........................................................จำนวนเงินรวมทั้งสิ้น
                                            .........................................บาท
                                            (..................................................................................................) </span>
                                        </p>
                                        <p><font color="white">________</font>จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</p>
                                        <p><font color="white">________________________</font>(................................................................)</span>
                                        </p>
                                        <p><font color="white">__________________</font>ตำแหน่ง
                                            .............................................................</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="70" colspan="2" style="text-align: left">
                                        (7) เรียน คณบดี
                                        <p><font color="white">________</font>ตรวจสอบหลักฐานการจ่ายเงินถูกต้องแล้ว
                                            เห็นควรอนุมัติเบิกจ่ายตามเสนอ</p>
                                        <br>
                                            <p class="block1">คุมยอดเบิกจ่ายลำดับที่</p>
                                    </td>
                                    <td height="70">
                                        <p>(8) อนุมัติตามเสนอ</p>
                                        <p style="text-align: center">
                                            .................................................................</p>
                                        <p style="text-align: center">
                                            (................................................................)</p>
                                        <p style="text-align: center">ตำแหน่ง
                                            ....................................................</p>
                                        <p style="text-align: center">วันที่
                                            ...........................................................</p>
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
