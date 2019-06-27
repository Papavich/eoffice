<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 7/5/2561
 * Time: 11:17
 */
?>
<?php
$this->registerCssFile("@web/web_pms/css/word.css");
$this->registerJsFile('@web/web_pms/js/export_word_unborder.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

use app\modules\pms\models\GroupSubsidizedStrategy;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use yii\helpers\Html;
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
    p{
        margin-top: 3px !important;
        margin-bottom: 3px !important;
    }
</style>

<div id="content" class="padding-20">
    <div id="page-content" class="panel panel-default">
        <div class="panel-body">
            <div class="row">
<!--                <div class="col-md-2 pull-right">-->
<!--                    <p class="p_word">การเงิน-201-2</p>-->
<!--                </div>-->
                <div class="col-md-12 pull-right">
                    <table width="100%">
                        <tr>
                            <td width="83%"></td>
                            <td>การเงิน-201-2</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">

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
<!--                    <p class="p_word">-->
<!--                        <img src=" //= Yii::$app->homeUrl ?><!--web_pms\images\test.jpg" width="100"-->
<!--                             height="100" >-->
<!--                        <font size="6" style="margin-left: 25%;  text-align: center;padding-top: 30.23622px"><b>บันทึกข้อความ</b></font>-->
<!--                    </p>-->


<!--                    <table width="100%">-->
<!--                        <tr>-->
<!--                            <td width="75%"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span>-->
<!--                                <span style="margin-left: 10px">หน่วยงาน ภาควิชาวิทยาการคอมพิวเตอร์</span></td>-->
<!--                            <td><span >โทร //= $modelprosub->compact_phone ?><!--</span></td>-->
<!--                        </tr>-->
<!--                    </table>-->
                    <p class="p_word" style="margin-bottom: 0px;"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span><span
                            style="margin-left: 10px">หน่วยงาน ภาควิชาวิทยาการคอมพิวเตอร์ </span><span
                            style="margin-left: 350px"> โทร <?=$modelprosub->compact_phone?></span></p>


                    <table width="100%">
                        <tr>
                            <td width="70%"><b>ที่ ศธ 0514.2.1.  /</b></td>
                            <td><span>วันที่ <?= YearThai($modelcompacthasprosub->save_date) ?></span></td>
                        </tr>
                    </table>
<!--                    <p class="p_word" style="margin-bottom: 0px;"><b>ที่ ศธ 0514.2.1.  /</b><span style="margin-left: 600px">วันที่  //=YearThai($modelcompacthasprosub->save_date)?><!--</span>-->
<!--                    </p>-->
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรื่อง</b><span class="p_word" style="margin-left: 10px">ขออนุมัติใช้เงิน <?=$budget?> ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?>
                            ปีงบประมาณ <?=$modelprosub->prosub_year?></span>
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรียน</b><span style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">ตามที่ ภาควิชาวิทยาการคอมพิวเตอร์ <span>ได้กำหนดจัดโครงการ <?=$modelprosub->prosub_name?> จึงใครขออนุมัติใช้เงิน <?=$budget?>
                                เพื่อเป็นค่าใช้จ่ายในการจัดโครงการ/กิจกรรม จากแผนงานผู้สำเร็จการศึกษาคณะวิทยาศาสตร์ งบเงินอุดหนุน อุดหนุนทั่วไป <?php $data = GroupSubsidizedStrategy::findOne($modelcompacthasprosub->group_subsidized_strategy);if($data){echo $data->name;}else{echo"<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";}?> จำนวนเงิน <?=number_format($costplaneEng)?>.- บาท (<?=$costplaneTh?>) โดยมีรายละเอียดดังนี้</span>
                    </p>
                    <div class="col-md-12" style="margin-bottom: 20px;">

                        <table>
                            <tbody style="border: hidden;">
                            <?php
                            foreach ($comhasexecute as $row){
                                $data = PmsExecute::findOne($row->pms_execute_execute_id);
                                echo "<tr><td colspan='2' style='padding-left: 20px'>กิจกรรมลำดับที่ ".$data->execute_no.": ".$data->execute_name."</td></tr>";
                                $datas = PmsExecuteHasCost::find()->where(['pms_execute_execute_id'=>$row->pms_execute_execute_id,'pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id])->all();
                                $sumcost = 0;
                                foreach ($datas as $key => $rows){
                                    $i = $key+1;
                                    $sumcost = $sumcost +$rows->cost;
                                    echo "<tr><td style='padding-left: 20px'  width='30%'>".$i.". ".$rows->detail."</td><td><span style='display: inline-block;float: right;padding-right: 120px;'> จำนวนเงิน ".number_format($rows->cost).".-บาท</span></td></tr>";
                                }
//
                                echo "<tr><td style='padding-left: 20px' colspan='2' class='padding'><span style='display: inline-block;float: right;padding-right: 120px;'>รวมเป็นเงิน ".number_format($sumcost).".-บาท</span></td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <br/>
                    <br/>
                    <p class="p_word" ><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</span></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody style="border: hidden">
                                <tr>
                                    <td style="border: hidden;width:25%"></td>
                                    <td style="border: hidden;width:25%"></td>
                                    <td style="border: hidden;width:50% ;text-align: center;float: right">
                                        <p>ลงชื่อ ................................................</p>
                                        <p>(<?php
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
                    </div>



                    <p class="p_word" ><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table_border">
                                <tbody>
                                <tr>
                                    <td class="td_border" style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">คุมยอดหลักการลำดับที่ ......</p>
                                    </td>
                                    <td class="td_border" style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">เจ้าของเรื่อง <br><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_border" colspan="2" style="border: 1px solid black;">
                                        <p class="p_word">(2) สำหรับหน่วยงานการเงินและบัญชี</p>
                                        <p>เรียน คณบดี</p>
                                        <p style="margin-left: 30px">งบประมาณคงเหลือในโครงการ..............................บาท</p>
                                        <p>ตรวจสอบแล้วเห็นควรอนุมัติ</p>
                                        <br/>
                                        <p style="margin-left: 30px">ผู้ตรวจสอบ............................................ลงวันที่..............................                                  </p>

                                    </td>
                                    <td class="td_border" style="border: 1px solid black;">
                                        <p class="p_word">(3) ผลการพิจารณา</p>
                                        <p style="text-align:center">อนุมัติตามเสนอ</p>
                                        <br/>
                                        <p style="margin-left: 40px">ลงชื่อ......................................................</p>
                                        <p style="margin-left: 40px">(......................................................)</p>
                                        <p>ตำแหน่ง...................................................................</p>
                                        <p style="margin-left: 40px">วันที่......................................................</p>
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
                                    <td class="td_border" colspan="3" style="border: 1px solid black;">
                                        <p class="p_word">ที่ ศธ 0514.2.1. ......../.............<span
                                                style="margin-left: 300px">วันที่.......................................................................</span></p>
                                        <p>(4) เรียน คณบดี</p>
                                        <p><span style="margin-left: 100px">พร้อมนี้ได้แนบหลักฐานการเบิกจ่ายเงินค่า………………………………………………………….……..........จำนวนเงินรวมทั้งสิ้น .........................................บาท
                                                (............................................................................) </span> ดังหลักฐานที่แนบมา จำนวน..................ฉบับ
                                        </p>
                                        <?php
                                        foreach ($comhasexecute as $row){
                                            $data = PmsExecute::findOne($row->pms_execute_execute_id);
                                            echo "กิจกรรมลำดับที่ ".$data->execute_no." กิจกรรม ".$data->execute_name."<br>";
                                        }
                                        ?>
                                        <!--                                        <p>กิจกรรมลำดับที่ x กิจกรรม xxxxxxxxxxxxx</p>-->
                                        <p><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</p>
                                        <p><span style="margin-left: 500px">(................................................................)</span></p>
                                        <p><span style="margin-left: 500px">ตำแหน่ง .............................................................</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_border" colspan="2" style="text-align: left;border: 1px solid black;">
                                        (5) เรียน  คณบดี
                                        <p style="margin-left: 100px">ตรวจสอบหลักฐานการจ่ายเงินถูกต้องแล้ว เห็นควรอนุมัติเบิกจ่ายตามเสนอ</p>
                                        <div class="col-md-4" style="border-style:groove">
                                            <p>คุมยอดเบิกจ่ายลำดับที่</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><span>....................................................................</p>
                                            <p><span>วันที่ ........................................................</p>
                                        </div>
                                    </td>
                                    <td class="td_border" style="border: 1px solid black;">
                                        <p>(6) อนุมัติตามเสนอ</p>
                                        <p style="text-align: center">..........................................................</p>
                                        <p style="text-align: center">(.......................................................)</p>
                                        <p style="text-align: center">ตำแหน่ง .........................................................</p>
                                        <p style="text-align: center">วันที่ ........................................................</p>
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
                    <a class="btn btn-info btn-3d pull-left" href="../report/findreport"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                    <a class="btn btn-blue btn-3d pull-right jquery-word-export" href="javascript:void(0)"><i class="fa fa-file-word-o"></i>word</a>
                    <a class="btn btn-danger btn-3d pull-right" href="../pdf/compactbudget?id=<?=$modelprosub->prosub_code?>&compact=<?=$compact?>"><i class="fa fa-file-pdf-o"></i>pdf</a>
                </p>
            </div>
        </div>
    </div>
</div>
