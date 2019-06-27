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
                    <p class="p_word">แผน-101-1/3</p>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <p class="p_word">
                        <img src="<?= Yii::$app->homeUrl ?>web_pms\images\test.jpg" width="100"
                             height="100" >
                        <font size="6" style="margin-left: 25%;  text-align: center;padding-top: 30.23622px"><b>บันทึกข้อความ</b></font>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ส่วนราชการ </b><span style="margin-left: 10px">คณะวิทยาศาสตร์</span><span
                            style="margin-left: 10px"><?=$modelprosub->prosub_deparment?></span><span
                            style="margin-left: 450px">โทร <?=$modelprosub->compact_phone?></span></p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>ที่ ศธ 0514</b><span style="margin-left: 600px">วันที่ <?=YearThai($modelprosub->compact_save_date)?></span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรื่อง</b><span class="p_word" style="margin-left: 10px">ขออนุมัติจัดโครงการที่บรรจุในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> </span>
                    </p>
                    <br/>
                    <p class="p_word" style="margin-bottom: 0px;"><b>เรียน</b><span style="margin-left: 10px">คณบดีคณะวิทยาศาสตร์</span>
                    </p>
                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">ด้วย<?=$modelprosub->prosub_deparment?></span>
                        <span>ใคร่ขออนุมัติจัดโครงการที่บรรจุไว้ในแผนปฏิบัติการ ประจำปีงบประมาณ พ.ศ.<?=$modelprosub->prosub_year?> และขออนุมัติใช้เงินงบประมาณ <?=$budget?> โดยมีรายละเอียดประกอบการพิจารณา ดังนี้</span>
                    </p>

                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">1. ชื่อโครงการย่อย <?=$modelprosub->prosub_name?></span>
                    </p>
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <table>
                                <tbody style="border: hidden">
                                <?php
                                $i=1;
                                    foreach ($execute as $key => $row){
//                                        $data = \app\modules\pms\models\PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row->execute_id,'pms_compact_has_prosub_id'=>$compact])->one();
//
//                                        if($data){
                                            echo "<tr style=\"border: hidden; text-align: left\">
                                    <td style=\"width: 5%;border: hidden;\">
                                        <p>1.".$i."</p>
                                    </td>
                                    <td style=\"width: 10%;border: hidden;\">
                                        <p>กิจกรรมที่ ".$i."</p>
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

                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">2. รหัสโครงการ <?=$modelprosub->prosub_code?></span>
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
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
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
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
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
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 3){
                                echo "<tr><td style=\"border: hidden\"><span class=\"pull-left\" style='padding-left: 20px;'>(".$i.") ".$row->budget_other."</span></td><td style=\"border: hidden\">จำนวน ".number_format($row->budget_limit)." บาท</td></tr>";
                                $i++;
                            }
                        }
                        ?>

                        </tbody>
                    </table>

                    <p class="p_word" style="margin-bottom: 0px;"><span style="margin-left: 100px">4. กำหนดจัดโครงการ ระหว่างวันที่ </span><?=YearThai($modelprosub->compact_start_date)?>
                        ถึง <?=YearThai($modelprosub->compact_end_date)?></p>
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



                    <p class="p_word" ><b style="margin-left: 10px">การพิจารณาอนุมัติ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="border: 1px solid black;text-align: center">
                                        <p class="p_word">เลขส่งออกลำดับที่ ......</p>
                                        <p>ลงวันที่ <?=YearThai($modelprosub->compact_save_date)?></p>
                                    </td>
                                    <td style="border: 1px solid black;text-align: center">
                                        <p class="p_word">เจ้าของเรื่อง<br></p>
                                        <p><?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black;" colspan="2">
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


                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <p><a href="#" data-toggle="modal" class="get_status_place" data="<?=$modelprosub->prosub_code?>" data-target="#showstatus">สถานะขออนุมัติจัดโครงการ</a> :
                <?php
                echo $modelprosub->prosub_status_place;
                ?>
                <?php
                if($modelprosub->prosub_status_place =="ยังไม่ดำเนินการ" ){
                    echo "<a class=\"btn-3d btn-sm btn btn-info\" href=\"../permissionplace/permis?id=".$modelprosub->prosub_code."\"><i class=\"fa fa-check\"></i> ขออนุมัติ</a>";
                }
                else if($modelprosub->prosub_status_place =="อนุมัติสำเร็จ"){
                    echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-check\"></i> ขออนุมัติ</a>";
                }
                else{
                    echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-hourglass-2\"></i> ขออนุมัติ</a>";
                }
                ?>
            </p>


            <div class="text-right">
                <?php
                if($modelprosub->prosub_status_place == "ยังไม่ดำเนินการ" || $modelprosub->prosub_status_place == "รอปรับแก้ไขโครงการ"){
                    echo "<a class=\"btn btn-warning\" href=\"../compact/editcompactplan?id=".$modelprosub->prosub_code."\"><i class=\"fa fa-pencil-square-o\"></i> แก้ไข</a>";
                }else{
                    echo "<a class=\"btn btn-warning\"  disabled='disabled' \"><i class=\"fa fa-pencil-square-o\"></i> แก้ไข</a>";
                }
                ?>


                <a class="btn btn-blue" href="../tablepro/track-project"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>
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
