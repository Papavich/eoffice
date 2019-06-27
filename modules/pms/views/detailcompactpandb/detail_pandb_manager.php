<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 6/3/2561
 * Time: 21:14
 */
use app\modules\pms\models\BudgetSub;
use app\modules\pms\models\GroupPlan;
use app\modules\pms\models\GroupSubsidizedStrategy;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasExecute;
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
                <div class="col-md-2 pull-right">
                    <p class="p_word">แผน-104-1/3</p>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <p class="p_word">
                        <img src="<?= Yii::$app->homeUrl ?>web_pms\images\test.jpg" width="100"
                             height="100" >
                        <font size="6" style="margin-left: 25%;  text-align: center;padding-top: 30.23622px"><b>บันทึกข้อความ</b></font>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span><span
                                style="margin-left: 10px"><?=$modelprosub->prosub_deparment?></span><span
                                style="margin-left: 450px">โทร <?=$modelcompacthasprosub->phone_no?></span></p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ที่ ศธ 0514</b><span style="margin-left: 600px">วันที่ <?=YearThai($modelcompacthasprosub->save_date)?></span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรื่อง</b><span class="p_word" style="margin-left: 10px">ขออนุมัติจัดโครงการที่บรรจุในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> และขออนุมัติใช้เงิน</span>
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรียน</b><span style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">ด้วย<?=$modelprosub->prosub_deparment?></span>
                        <span>ใคร่ขออนุมัติจัดโครงการที่บรรจุไว้ในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> และขออนุมัติใช้เงินงบประมาณ <?=$budget?> โดยมีรายละเอียดประกอบการพิจารณา ดังนี้</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b style="margin-left: 100px">ก.
                            ขออนุมัติจัดโครงการ</b></p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">1. ชื่อโครงการย่อย <?=$modelprosub->prosub_name?></span>
                    </p>
                    <div class="col-md-12">
                        <div class="col-md-10">
                            <table style="margin-left: 90px">
                                <tbody style="border: hidden">
                                <?php
                                $i=1;
                                foreach ($execute as $key => $row){
                                    $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row->execute_id,'pms_compact_has_prosub_id'=>$compact])->one();

                                    if($data){
                                        echo "<tr style=\"border: hidden; text-align: left\">
                                    <td style=\"width: 3%;border: hidden;\">
                                        <p>1.".$i."</p>
                                    </td>
                                    <td style=\"width: 10%;border: hidden;\">
                                        <p>กิจกรรมที่ ".$row->execute_no."</p>
                                    </td>
                                    <td style=\"width: auto;border: hidden;\">
                                        <p>$row->execute_name</p>
                                    </td>
                                </tr>";
                                        $i++;
                                    }

                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">2. ชื่อโครงการย่อย <?=$modelprosub->prosub_code?></span>
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
                        $i =1;
                        foreach ($probudget as $key => $row){
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 1){
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(".$i.") ".$BudgetSub->budget_name."</span></td><td style=\"border: hidden\">จำนวน ".number_format($row->budget_limit)." บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td style="border: hidden"><span class="pull-left">3.2 งบประมาณ(งบรายได้)</span></td>
                            <td style="border: hidden"></td>
                        </tr>
                        <?php
                        $i =1;
                        foreach ($probudget as $key => $row){
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 2){
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(".$i.") ".$BudgetSub->budget_name."</span></td><td style=\"border: hidden\">จำนวน ".number_format($row->budget_limit)." บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>
                        <tr style="border: hidden">
                            <td style="border: hidden"><span class="pull-left">3.3 งบอื่นๆ</span></td>
                            <td style="border: hidden"></td>
                        </tr>
                        <?php
                        $i =1;
                        foreach ($probudget as $key => $row){
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 3){
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(".$i.") ".$row->budget_other."</span></td><td style=\"border: hidden\">จำนวน ".number_format($row->budget_limit)." บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">4. กำหนดจัดโครงการ ระหว่างวันที่ </span><?=YearThai($modelcompacthasprosub->start_date)?>
                        ถึง <?=YearThai($modelcompacthasprosub->end_date)?></p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">รายละเอียดโครงการตามเอกสารที่แนบมาพร้อมนี้
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b style="margin-left: 100px">ข.
                            ขออนุมัติใช้เงินงบประมาณ <?=$budget?></b></p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">ขออนุมัติใช้เงินงบประมาณ <?=$budget?></span>
                        ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> เพื่อเป็นค่าใช้จ่ายในการดำเนินงานกิจกรรมที่ <?=$countComhasexecute?> จำนวน <?=number_format($costplaneEng)?> บาท (<?=$costplaneTh?>)  จากแผนงาน <?php $data=GroupPlan::findOne($modelcompacthasprosub->group_plan);if($data){echo $data->name;}else{echo"<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";}?> จัดการเรียนการสอนสาขาวิชา <?=$modelprosub->prosub_deparment?>
                        <?php $data=GroupSubsidizedStrategy::findOne($modelcompacthasprosub->group_subsidized_strategy);if($data){echo $data->name;}else{echo"<span class=\"not-set\">(ไม่ได้ตั้ง)</span>";}?> งบเงินอุดหนุน  เงินอุดหนุนทั่วไป ค่าใช้จ่าย <?=$budget?> โดยมีรายการรายจ่าย ดังต่อไปนี้</p>

                    <?php
                    foreach ($comhasexecute as $key => $row){
                        $i = $key +1;
                        $data=PmsExecute::findOne($row->pms_execute_execute_id);
                        ?>
                        <p class="p_word" style="margin-bottom: 0px;"><b style="margin-left: 100px">กิจกรรมที่ <?=$data->execute_no?> <?php
                                echo $data->execute_name;
                                ?></b></p>

                        <div class="col-md-12">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table>
                                    <tbody style="border: hidden;">
                                    <?php

                                    $datas = PmsExecuteHasCost::find()->where(['pms_execute_execute_id'=>$row->pms_execute_execute_id,'pms_compact_has_prosub_id'=>$modelcompacthasprosub->id])->all();
                                    //echo $row->pms_execute_execute_id."<br>";
                                    ?>

                                    <?php
                                    foreach ($datas as $keys => $rows){
                                        $i = $keys+1;
                                        ?>
                                        <tr style="border: hidden; text-align: left">
                                            <td style="width: 40%;border: hidden;">
                                                <p><?=$i.". ".$rows->detail?></p>
                                            </td>
                                            <td style="width: 5%;border: hidden;">
                                                <p>เป็นเงิน</p>
                                            </td>
                                            <td style="width: 5%;border: hidden;">
                                                <p><?=number_format($rows->cost)?></p>
                                            </td>
                                            <td style="width: 5%;border: hidden;">
                                                <p>บาท</p>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php }?>
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
                                        <p>ลงชื่อ .....................................</p>
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


                    <p class="p_word" ><b style="margin-left: 30px">ก. ขออนุมัติจัดโครงการ</b></p>
                    <p class="p_word" ><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">เลขส่งออกลำดับที่ ............</p>
                                        <p>ลงวันที่ <?=YearThai($modelcompacthasprosub->save_date)?></p>
                                    </td>
                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">เจ้าของเรื่อง</p>
                                        <p><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: 1px solid black;">
                                        <p class="p_word">(2) สำหรับงานนโยบายและแผน</p>
                                        <p>(     ) โครงการ รหัสโครงการ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>(     ) งบประมาณ สอดคล้องกับแผนปฏิบัติการ</p>
                                        <p>(     ) มีการใช้จ่ายแล้ว  จำนวน................................บาท</p>
                                        <p>(     ) คงเหลือ จำนวน...............................บาท                        </p>
                                        <p style="text-align: center">ลงชื่อ......................................................</p>
                                        <p style="text-align: center">(......................................................)
                                        </p>
                                    </td>
                                    <td style="border: 1px solid black;">
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

                    <p class="p_word" ><b style="margin-left: 30px">ข. ขออนุมัติใช้เงิน</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>

                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">คุมยอดหลักการลำดับที่</p>
                                        <p>.................................</p>
                                    </td>
                                    <td style="text-align: center;border: 1px solid black;">
                                        <p class="p_word">เจ้าของเรื่อง</p>
                                        <p><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;border: 1px solid black;">
                                        <p class="p_word">(4) เรียน คณบดี</p>
                                        <p style="margin-left: 50px">ตรวจสอบแล้วเห็นควรอนุมัติ</p>
                                        <p style="text-align: center" >........................................................</p>
                                        <p style="text-align: center" >ตำแหน่ง .........................................................</p>
                                        <p style="text-align: center">วันที่ ........................................................</p>
                                    </td>
                                    <td style="border: 1px solid black;">
                                        <p class="p_word">(5) อนุมัติตามเสนอ</p>
                                        <p style="text-align: center">..........................................................</p>
                                        <p style="text-align: center">(.......................................................)</p>
                                        <p style="text-align: center">ตำแหน่ง .........................................................</p>
                                        <p style="text-align: center">วันที่ ........................................................</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="border: 1px solid black;">
                                        <p class="p_word">ที่ ศธ 0514.2. ......../.............<span
                                                    style="margin-left: 300px">วันที่.......................................................................</span></p>
                                        <p>(6) เรียน คณบดี</p>
                                        <p><span style="margin-left: 100px">พร้อมนี้ได้แนบหลักฐานการเบิกจ่ายเงินค่า………………………………………………………….…….. จำนวนเงินรวมทั้งสิ้น .........................................บาท
                                                (..................................................................................................) </span>
                                        </p>
                                        <p><span style="margin-left: 100px">จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</p>
                                        <p><span style="margin-left: 500px">(................................................................)</span></p>
                                        <p><span style="margin-left: 500px">ตำแหน่ง .............................................................</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;border: 1px solid black;">
                                        (7) เรียน  คณบดี
                                        <p style="margin-left: 100px">ตรวจสอบหลักฐานการจ่ายเงินถูกต้องแล้ว เห็นควรอนุมัติเบิกจ่ายตามเสนอ</p>
                                        <div class="col-md-4" style="border-style:groove">
                                            <p>คุมยอดเบิกจ่ายลำดับที่</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><span>.........................................................</p>
                                            <p><span>วันที่ ........................................................</p>
                                        </div>
                                    </td>
                                    <td style="border: 1px solid black;">
                                        <p>(8) อนุมัติตามเสนอ</p>
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
            <p><a href="#" data-toggle="modal" class="get_status_pandb" data="<?=$modelprosub->prosub_code."_".$compact?>" data-target="#showstatus">
                    สถานะขออนุมัติจัดโครงการพร้อมใช้งบประมาณ </a>:
                <?php
                echo $modelcompacthasprosub->status_pandf;
                ?>
                <?php
                if($modelcompacthasprosub->status_pandf =="รอหัวหน้าภาคอนุมัติ" ){
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" href=\"../permissionpandb/permis-manager?id=".$modelprosub->prosub_code."&compact=".$compact."\"><i class=\"fa fa-check\"> อนุมัติ</i></a> ";
                    echo " <a class=\"btn btn-sm btn-3d btn-warning\" data-toggle=\"modal\" data-target=\"#notconfirmed\"><i class=\"glyphicon glyphicon-arrow-left\"></i> ส่งกลับแก้ไข</a>";
                }
                else if($modelcompacthasprosub->status_pandf =="อนุมัติสำเร็จ"){
                    echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-check\"></i> ขออนุมัติ</a>";
                }
                else{
                    echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-hourglass-2\"></i> ขออนุมัติ</a>";
                }
                ?>
            </p>

            <div class="text-right">
                 <a class="btn btn-blue" href="../tablepro/permis-manager"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
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
            <form method="post" action="../commentpandb/comment-manager">
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

