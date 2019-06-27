<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 21:14
 */

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
                <div class="col-md-2 pull-right">
                    <p class="p_word">การเงิน-201-2</p>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <p class="p_word">
                        <img src="<?= Yii::$app->homeUrl ?>web_pms\images\test.jpg" width="100"
                             height="100" >
                        <font size="6" style="margin-left: 25%;  text-align: center;padding-top: 30.23622px"><b>บันทึกข้อความ</b></font>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span><span
                                style="margin-left: 10px">หน่วยงาน ภาควิชาวิทยาการคอมพิวเตอร์</span><span
                                style="margin-left: 350px">โทร <?=$modelprosub->compact_phone?></span></p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ที่ ศธ 0514.2.1.  /</b><span style="margin-left: 600px">วันที่ <?=YearThai($modelcompacthasprosub->save_date)?></span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรื่อง</b><span class="p_word" style="margin-left: 10px">ขออนุมัติใช้เงิน <?=$budget?> ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?>
                            ปีงบประมาณ <?=$modelprosub->prosub_year?></span>
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรียน</b><span style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">ตามที่ ภาควิชาวิทยาการคอมพิวเตอร์ <span>ได้กำหนดจัดโครงการ <?=$modelprosub->prosub_name?> จึงใครขออนุมัติใช้เงิน <?=$budget?>
                                เพื่อเป็นค่าใช้จ่ายในการจัดโครงการ/กิจกรรม จากแผนงานผู้สำเร็จการศึกษาคณะวิทยาศาสตร์ งบเงินอุดหนุน อุดหนุนทั่วไป <?php $data = GroupSubsidizedStrategy::findOne($modelcompacthasprosub->group_subsidized_strategy);if($data){echo $data->name;}else{echo"<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";}?> จำนวนเงิน <?=number_format($costplaneEng)?>.- บาท (<?=$costplaneTh?>) โดยมีรายละเอียดดังนี้</span>
                    </p>
                    <div class="col-md-12">
                        <?php
                        foreach ($comhasexecute as $row){
                            $data = PmsExecute::findOne($row->pms_execute_execute_id);
                            echo "<div class=\"col-md-12\">กิจกรรมลำดับที่ ".$data->execute_no." : ".$data->execute_name."</div><br>";
                            $datas = PmsExecuteHasCost::find()->where(['pms_execute_execute_id'=>$row->pms_execute_execute_id,'pms_compact_has_prosub_id'=>$row->pms_compact_has_prosub_id])->all();
                            $sumcost = 0;
                            foreach ($datas as $key => $rows){
                                $i = $key+1;
                                $sumcost = $sumcost +$rows->cost;
                                echo "<div class=\"col-md-7\">".$i.". ".$rows->detail."</div><div class='col-md-2'><span class='pull-left'>จำนวนเงิน</span></div><div class='col-md-2'><span class='pull-right'> ".number_format($rows->cost).".-บาท</span></div>";
                            }
                            echo "<div class='col-md-9'><span class='pull-right'>รวมเป็นเงิน</span></div><div class='col-md-2'><span class='pull-right'>".number_format($sumcost).".-บาท</span></div>";
                        }
                        ?>
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
                                    <td style="border: hidden;width:50% ;text-align: center">
                                        <p>ลงชื่อ ................................................</p>
                                        <p>(<?php
                                            $datah = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$modelprosub->prosub_manager])->one();
                                            echo $datah->academic_positions_abb_thai.$datah->person_name." ".$datah->person_surname;
                                            ?>)</p>
                                        <p>ตำแหน่ง <?php
                                            echo $datah->position_name;
                                            ?></p>
                                    </td>
                                    <td style="width:25%"></td>
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
                            <table>
                                <tbody>
                                <tr>
                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">คุมยอดหลักการลำดับที่ ......</p>
                                    </td>
                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">เจ้าของเรื่อง <br><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: 1px solid black;">
                                        <p class="p_word">(2) สำหรับหน่วยงานการเงินและบัญชี</p>
                                        <p>เรียน คณบดี</p>
                                        <p style="margin-left: 30px">งบประมาณคงเหลือในโครงการ..............................บาท</p>
                                        <p>ตรวจสอบแล้วเห็นควรอนุมัติ</p>
                                        <br/>
                                        <p style="margin-left: 30px">ผู้ตรวจสอบ............................................ลงวันที่..............................                                  </p>

                                    </td>
                                    <td style="border: 1px solid black;">
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
                            <table>
                                <tbody>
                                <tr>
                                    <td colspan="3" style="border: 1px solid black;">
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
                                    <td colspan="2" style="text-align: left;border: 1px solid black;">
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
                                    <td style="border: 1px solid black;">
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
            <p><a href="#" data-toggle="modal" class="get_status_budget" data="<?=$modelprosub->prosub_code."_".$compact?>" data-target="#showstatus">
                    สถานะขออนุมัติใช้งบประมาณ</a> :
                <?php
                echo $modelcompacthasprosub->status_finance;
                ?>
                <?php
                if($modelcompacthasprosub->status_finance =="รอฝ่ายพัฒนานักศึกษาตรวจสอบ"){
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" href=\"../permissionfinance/permis-staff?id=".$modelprosub->prosub_code."&compact=".$compact."\"><i class=\"fa fa-check\"> ตรวจสอบ</i></a> ";
                    echo " <a class=\"btn btn-sm btn-3d btn-warning\" data-toggle=\"modal\" data-target=\"#notconfirmed\"><i class=\"glyphicon glyphicon-arrow-left\"></i> ส่งกลับแก้ไข</a>";
                }
                else if($modelcompacthasprosub->status_finance =="อนุมัติระบบสำเร็จ"){
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-check\"> ตรวจสอบ</i></a>";
                }
                else {
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-hourglass-2\"> ตรวจสอบ</i></a>";
                }
                ?>
            </p>

            <div class="text-right">
                <a class="btn btn-blue" href="../tablepro/permis-staff"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="notconfirmed" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#5a6667">
                <i class="et-megaphone" style="color:#ffffff"></i>
                <span class="modal-title" style="color:#ffffff">หมายเหตุที่ไม่อนุมัติ</span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="../commentfinance/comment-staff">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $modelprosub->prosub_code; ?>"/>
                    <input type="hidden" name="compact" value="<?= $compact; ?>"/>
                    <textarea name="comment" rows="4" class="form-control required"
                              placeholder="กรอกข้อความ"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="confirm-message">
                        ยืนยัน
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="showstatus" role="dialog" hidden="">
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