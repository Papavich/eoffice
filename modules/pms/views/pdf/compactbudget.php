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

$this->registerCssFile("@web/web_pms/css/word.css");
$this->registerJsFile('@web/web_pms/js/export_word_unborder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
                    <p class="p_head">การเงิน-201-2</p>
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
                                            style="margin-left: 10px"> ภาควิชาวิทยาการคอมพิวเตอร์</span></p>
                            </td>
                            <td style="border:hidden; width:20%;">โทร <?=$modelprosub->compact_phone?></td>
                        </tr>
                        <tr>
                            <td style="border:hidden; width:40%">
                                <p class="p_word"><b>ที่ ศธ 0514.2.1 / </b></p>
                            </td>
                            <td style="border:hidden; text-align: right; width:40%">
                                วันที่ <?=YearThai($modelprosub->compact_save_date)?>
                            </td>
                            <td style="border:hidden; width:20%"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_word">
                    <b>เรื่อง </b><span>ขออนุมัติใช้เงิน <?=$budget?> ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> ปีงบประมาณ <?=$modelprosub->prosub_year?> </span>
                </p>
                <p class="p_word" style="margin-bottom: 0px;"><b>เรียน </b><span
                            style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                </p>
                <p class="p_word"><font color="WHITE">_______</font>
                    <span>ตามที่ ภาควิชาวิทยาการคอมพิวเตอร์ <span>ได้กำหนดจัดโครงการ <?=$modelprosub->prosub_name?> จึงใครขออนุมัติใช้เงิน <?=$budget?>
                             เพื่อเป็นค่าใช้จ่ายในการจัดโครงการ/กิจกรรม จากแผนงานผู้สำเร็จการศึกษาคณะวิทยาศาสตร์ งบเงินอุดหนุน อุดหนุนทั่วไป <?php $data = GroupSubsidizedStrategy::findOne($modelcompacthasprosub->group_subsidized_strategy);if($data){echo $data->name;}else{echo"<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";}?> จำนวนเงิน <?=number_format($costplaneEng)?>.- บาท (<?=$costplaneTh?>) โดยมีรายละเอียดดังนี้</span>
                </p>

                <div class="row" style="margin-left: 20px; margin-right: 70px;">
                    <table>
                        <tbody style="border: hidden;">
                        <?php
                        foreach ($comhasexecute as $row){
                            $data = PmsExecute::findOne($row->pms_execute_execute_id);
                            echo "<tr style=\"border: hidden; text-align: left\">";
                            echo "<td colspan='5'>กิจกรรมลำดับที่ ".$data->execute_no." : ".$data->execute_name."</td></tr>";
                            $datas = PmsExecuteHasCost::find()->where(['pms_execute_execute_id'=>$row->pms_execute_execute_id,'pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id])->all();
                            $sumcost = 0;
                            foreach ($datas as $key => $rows){
                                $i = $key+1;
                                $sumcost = $sumcost +$rows->cost;
                            ?>
                        <tr style="border: hidden; text-align: left">
                            <td style="width: 1%;border: hidden;">
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
                            <td style="width: 2%;border: hidden;">
                                <p>บาท</p>
                            </td>
                        </tr>

                        <?php }
                        }echo "<tr style='border: hidden;' class='text-align: left'><td colspan='3'>รวมเป็นเงิน</td><td style=\"width: 2%;border: hidden;\" colspan='2'>".number_format($sumcost).".-บาท</td></tr>"; ?>
                        </tbody>
                    </table>
                </div>


                <br/>

                <br/>
                <p class="p_word"><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</span></p>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody style="border: hidden">
                            <tr>
                                <td height="40" style="border: hidden;width:25%"></td>
                                <td height="40" style="border: hidden;width:25%"></td>
                                <td height="40" style="border: hidden;width:25% ;text-align: center" colspan="2">
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

                    <p class="p_word"><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table_border">
                                <tbody>
                                <tr>
                                    <td class="td_border" style="text-align: center">
                                        <p class="p_word">คุมยอดหลักการลำดับที่ ......</p>
                                    </td>
                                    <td class="td_border" style="text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง <br><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_border" colspan="2">
                                        <p class="p_word">(2) สำหรับหน่วยงานการเงินและบัญชี</p>
                                        <p>เรียน คณบดี</p>
                                        <p style="margin-left: 30px">
                                            งบประมาณคงเหลือในโครงการ..............................บาท</p>
                                        <p>ตรวจสอบแล้วเห็นควรอนุมัติ</p>
                                        <br/>
                                        <p style="margin-left: 30px">
                                            ผู้ตรวจสอบ............................................ลงวันที่.............................. </p>

                                    </td>
                                    <td class="td_border">
                                        <p class="p_word">(3) ผลการพิจารณา</p>
                                        <p style="text-align:center">อนุมัติตามเสนอ</p>
                                        <br/>
                                        <p style="margin-left: 40px">
                                            ลงชื่อ......................................................</p>
                                        <p style="margin-left: 40px">
                                            (......................................................)</p>
                                        <p>
                                            ตำแหน่ง...................................................................</p>
                                        <p style="margin-left: 40px">
                                            วันที่......................................................</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>

                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table_border">
                                <tbody>
                                <tr>
                                    <td class="td_border" colspan="3">
                                        <p class="p_word">ที่ ศธ 0514.2.1. ......../.............<span
                                                    style="margin-left: 300px">วันที่.......................................................................</span>
                                        </p>
                                        <p>(4) เรียน คณบดี</p>
                                        <p><span style="margin-left: 100px">พร้อมนี้ได้แนบหลักฐานการเบิกจ่ายเงินค่า………………………………………………………….……..........จำนวนเงินรวมทั้งสิ้น .........................................บาท
                                                (............................................................................) </span>
                                            ดังหลักฐานที่แนบมา จำนวน..................ฉบับ
                                        </p>
                                        <p>กิจกรรมลำดับที่ x กิจกรรม xxxxxxxxxxxxx</p>
                                        <p><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</p>
                                        <p><span style="margin-left: 500px">(................................................................)</span>
                                        </p>
                                        <p><span style="margin-left: 500px">ตำแหน่ง .............................................................</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr class="td_border">
                                    <td colspan="2" style="text-align: left">
                                        (5) เรียน คณบดี
                                        <p style="margin-left: 100px">ตรวจสอบหลักฐานการจ่ายเงินถูกต้องแล้ว
                                            เห็นควรอนุมัติเบิกจ่ายตามเสนอ</p>
                                        <div class="col-md-4" style="border-style:groove">
                                            <p>คุมยอดเบิกจ่ายลำดับที่</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><span>....................................................................
                                            </p>
                                            <p><span>วันที่ ........................................................</p>
                                        </div>
                                    </td>
                                    <td class="td_border">
                                        <p>(6) อนุมัติตามเสนอ</p>
                                        <p style="text-align: center">
                                            ..........................................................</p>
                                        <p style="text-align: center">
                                            (.......................................................)</p>
                                        <p style="text-align: center">ตำแหน่ง
                                            .........................................................</p>
                                        <p style="text-align: center">วันที่
                                            ........................................................</p>
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

