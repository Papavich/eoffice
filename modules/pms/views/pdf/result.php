<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 3/5/2561
 * Time: 23:20
 */

use app\modules\pms\models\Governance;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsBudgetSub;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use yii\helpers\Html;
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
        margin-top: 5px;
        margin-bottom: 5px;
        padding: 0px;
    }
</style>
<div id="content" class="padding-20">
    <div id="page-content" class="panel panel-default">
        <div class="panel-body">
            <div class="row add_pro">
                <div class="col-md-2 pull-right">
                    <p class="p_head">แผน-106-1/2</p>
                </div>
                <h3 class="p_word" style="text-align: center;">
                    <b>สรุปผลการดำเนินงานโครงการ</b></h3>
                <h4 class="p_word" style="text-align: center;size: 16px">ตามแผนปฎิบัติการคณะวิทยาศาสตร์ ประจำปีงบประมาณ
                    พ.ศ. <?= $modelprosub->prosub_year; ?></h4>
                <br>
                <p class="p_word"><b>1. ชื่อโครงการ<span style="color:white">__</span>:<span
                            style="color:white">_</span></b><span
                        style="margin-left: 10px"><?= $modelprosub->prosub_name?></span></p>
                <p class="p_word"><b>2. รหัสโครงการ<span style="color:white">_</span>:<span style="color:white">_</span></b><?= $modelprosub->prosub_code; ?></span>
                </p>


                <p class="p_word"><b>3. ผู้รับผิดชอบ <span style="color:white">_</span>:</b></p>
                <p class="p_word"><span style="color:white">________</span>ชื่อหน่วยงานที่รับผิดชอบ
                    <?= $modelprosub->prosub_deparment?></p>
                <p class="p_word"><span style="color:white">________</span>ชื่อผู้รับผิดชอบโครงการ
                    <?php
                    $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                    echo " ".$datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;

                    ?></p>
                <p class="p_word"><b>4. ระยะเวลาดำเนินงาน<span style="color:white">_</span>:<span
                            style="color:white">_</span></b>วันที่ <?=YearThai($modelprosub->prosub_start_date)?> ถึง <?=YearThai($modelprosub->prosub_end_date)?></p>
                <p class="p_word"><b>5. สถานที่ดำเนินงานโครงการ<span style="color:white">_</span>:<span
                            style="color:white">_____</span></b><span
                        style="margin-left: 10px"></p><?php
                foreach ($modelsPlace as $key => $row){
                    $i = $key + 1;
                    echo "<span style=\"color:white\">________</span>".$i.". ".$row->place_name."<br>";
                }
                ?>
                <p class="p_word"><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์</b></p>
                <p class="p_word"><span style="color:white">________</span>6.1
                    ประเด็นยุทธศาสตร์ที่<span style="color:white">_</span>:<span style="color:white">_</span></span>
                    <span><?php echo $modelprosub->strategic_issues_id?></span></p>
                <p class="p_word"><span style="color:white">________</span>6.2 กลยุทธ์ที่<span
                        style="color:white">_</span>:<span style="color:white">_</span></span><?php echo $modelprosub->strategic_issues_id.".".$modelprosub->strategic_id?></span>
                </p>
                <p class="p_word"><span style="color:white">________</span>6.3 ตัวชี้วัด<span
                        style="color:white">_</span>:<span style="color:white">_</span></span><?php echo $modelcomhasprosub->indicator;?></span></p>
                <p class="p_word"><b>7. ผลการดำเนินงานตอบสนองตามหลักธรรมาภิบาล </b>(
                    ตามที่ได้ระบุไว้ในแบบเสนอโครงการ_แผน 103 )</p>
                <div class="row" style="margin-left: 70px; margin-right: 70px;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="text-align: center">
                        <tr>
                            <td><b>หลักธรรมาภิบาล</b></td>
                            <td><b>การดำเนินงาน</b>
                                <p>( ให้ระบุวิธีการ / กระบวนการดำเนินงานอย่างสังเขป )</p></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all();
                        $i = 1;
                        foreach ($governanceOfYear as $key => $rows){
                            $data = Governance::find()->where(['governance_id'=>$rows->governance_id])->one();
                            $j = 0;
                            foreach ($modelcompacthasmethod as $rows2) {
                                if($rows['governance_id'] == $rows2['pms_governance_has_project_sub_governance_id']){
                                    $j++;
                                }
                            }
                            if($j == 1){
                                $data2 = \app\modules\pms\models\PmsCompactHasMethod::find()->where(['pms_governance_has_project_sub_governance_id'=>$rows['governance_id'],'pms_compact_has_prosub_id'=>$modelcomhasprosub->id])->one();
                                echo "<tr><td>".$i.". ".$data->governance_name."</td><td align='center'>".$data2->method_detail."</td></tr>";
                            }else{
                                echo "<tr><td>".$i.". ".$data->governance_name."</td><td> </td></tr>";
                            }

                            $i++;
                        }

                        ?>
                        </tbody>
                    </table>
                </div>

                <p class="p_word"><b>8. ผลการดำเนินงาน </b>( ตามวัถตุประสงค์ของโครงการ )</p>
                <p class="p_word"><span style="color:white">________</span><b>8.1
                        เชิงปริมาณ</b></p>
                <div class="row" style="margin-left: 70px; margin-right: 70px;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="text-align: center">
                        <tr>
                            <td>ผู้เข้าร่วมโครงการ ( ตามกลุ่มเป้าหมาย )</td>
                            <td>จำนวนคน ( คน )</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            foreach ($modeltarget as $key => $row){
                                $i = $key + 1;
                                echo "<tr><td>".$i.") ".$row->targetgroup."</td><td>".$row->result_amount."</td></tr>";
                            }
                            ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_word"><span style="color:white">________</span><b>8.2
                        เชิงคุณภาพ </b>( ผลที่ได้รับจากโครงการ )</p>
                <div class="row" style="margin-left: 120px;">
                    <?php
                    foreach ($modelresult as $key => $row){
                        $i = $key + 1;
                        echo "<p class=\"p_word\">".$i.") ".$row->quality_detail."</p>";
                    }
                    ?>
                </div>
                <p class="p_word"><b>9. ผลการประเมินโครงการ <span style="margin-left: 10px">:</b></p>
                <div class="row" style="margin-left: 70px;">
                    <table>
                        <tbody style="border: hidden">
                        <tr style="border: hidden">
                            <td style="border: hidden; text-align: left; width:40%">
                                <p class="p_word">ผลการประเมินโครงการ ( โดยสรุป )</p>
                            </td>
                            <td style="border: hidden;  text-align:left;width: 6px;0%">
                                <p class="p_word"><?= $modelcomhasprosub->result_evaluate?></p>
                            </td>
                        </tr>
                        <tr style="border: hidden">
                            <td style="border: hidden; text-align: left;width:40%">
                                <p class="p_word">ระดับความพึงพอใจ</p>
                            </td>
                            <td style="border: hidden; text-align: left;width:60%">

                                <p class="p_word"><?= $modelcomhasprosub->rate?></p>
                            </td >
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p class="p_word"><b>10. งบประมาณ </b></p>
                <div class="row" style="margin-left: 70px; margin-right: 70px;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead style="text-align: center">
                        <tr>
                            <th>งบประมาณ</th>
                            <th>จำวนวเงิน ( บาท )</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>งบประมาณที่ได้รับจัดสรร</td>
                            <td style="text-align: center"><?php echo number_format($sumCost).".-";?></td>
                        </tr>
                        <tr>
                            <td>งบประมาณที่ใช้จ่ายจริง</td>
                            <td style="text-align: center"><?= number_format($modelcomhasprosub->sum_payment).".-" ?></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <p class="p_word"><b>11. ปัญหาอุปสรรค </b></p>
                <?php
                foreach ($modelproblem as $key => $row){
                    $i = $key + 1;
                    echo "<p class=\"p_word\"><span style=\"color:white\">________</span>11.".$i." <span class=\"a_word\" style=\"padding: 0px;margin-right: 10px\"></span>".$row->problem_detail."</p>";
                }
                ?>
                <p class="p_word"><b>12. ข้อเสนอแนะ / แนวทางในการปรับปรุงของปีถัดไป </b></p>
                <?php
                foreach ($modelsuggest as $key => $row){
                    $i = $key + 1;
                    echo "<p class=\"p_word\"><span style=\"color:white\">________</span>12.".$i." <span class=\"a_word\" style=\"padding: 0px;margin-right: 10px\"></span>".$row->suggest_detail."</p>";
                }
                ?>
                <p class="p_word"><b>13. แนบเอกสารรายงานผลการประเมินโครงการ</b></p>
                <?php
                foreach ($modeldocument as $key => $row){
                    echo "<a href='../../web_pms/uploads/".$row->document_name."'>".$row->document_name."</a><br>";
                }
                ?>
                <p class="p_word"><b>14. แนบไฟล์รูปภาพการจัดโครงการ / กิจกรรม อย่างน้อย 3-5 ภาพ</b></p>
                <p class="p_word" align="center">******************************** </p>
            </div>
        </div>
    </div>
</div>

