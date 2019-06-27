<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 7/5/2561
 * Time: 11:17
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
$this->registerCssFile("@web/web_pms/css/word.css");
$this->registerJsFile('@web/web_pms/js/export_word.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('@web/web_pms/js/table_status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
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
                    <p class="p_word">แผน-106-1/2</p>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <h4 class="p_word" style="text-align: center;padding-top: 30.23622px">
                        <b>สรุปผลการดำเนินงานโครงการ</b></h4>
                    <h5 class="p_word" style="text-align: center;">ตามแผนปฎิบัติการคณะวิทยาศาสตร์ ประจำปีงบประมาณ
                        พ.ศ. <?= $modelprosub->prosub_year; ?></h5>
                    <br>
                    <p class="p_word"><b>1. ชื่อโครงการ<span
                                style="margin-left: 10px">:</b><span
                            style="margin-left: 10px"><?= $modelprosub->prosub_name?></span></p>
                    <p class="p_word"><b>2. รหัสโครงการ <span
                                style="margin-left: 10px">:</b><span
                            style="margin-left: 10px"><?= $modelprosub->prosub_code; ?></span></p>
                    <p class="p_word"><b>3. ผู้รับผิดชอบ <span style="margin-left: 10px">:</b></p>
                    <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span>ชื่อหน่วยงานที่รับผิดชอบ
                        <?= $modelprosub->prosub_deparment?></p>
                    <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span>ชื่อผู้รับผิดชอบโครงการ
                        <?php
                        $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                        echo " ".$datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;

                        ?>
                    </p>
                    <p class="p_word"><b>4. ระยะเวลาดำเนินงาน <span style="margin-left: 10px">:</b><span
                            style="margin-left: 10px">วันที่ <?=YearThai($modelprosub->prosub_start_date)?> ถึง <?=YearThai($modelprosub->prosub_end_date)?></p>
                    <p class="p_word"><b>5. สถานที่ดำเนินงานโครงการ <span style="margin-left: 10px">:</b></p>
                    <div style="padding-left: 40px">
                        <?php
                        foreach ($modelsPlace as $key => $row){
                            $i = $key + 1;
                            echo $i.". ".$row->place_name."<br>";
                        }
                        ?>
                    </div>
                    <p class="p_word"><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์</b></p>
                    <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.1
                        ประเด็นยุทธศาสตร์ที่ <span><span style="margin-left: 10px">:</span><span
                                style="margin-left: 10px"></span><?php echo $modelprosub->strategic_issues_id?></p>
                    <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.2 กลยุทธ์ที่
                        <span><span style="margin-left: 10px">:</span><span style="margin-left: 10px"></span>
                            <?php echo $modelprosub->strategic_issues_id.".".$modelprosub->strategic_id?></span>
                    </p>
                    <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.3 ตัวชี้วัด <span><span
                                style="margin-left: 10px">:</span><span
                                style="margin-left: 10px"></span><?php echo $modelcomhasprosub->indicator;?></span></p>
                    <p class="p_word"><b>7. ผลการดำเนินงานตอบสนองตามหลักธรรมาภิบาล </b>(
                        ตามที่ได้ระบุไว้ในแบบเสนอโครงการ_แผน 103 )</p>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table table-striped table-hover table-bordered table_border">
                                <thead style="text-align: center">
                                <tr>
                                    <td class="td_border"><b>หลักธรรมาภิบาล</b></td>
                                    <td class="td_border"><b>การดำเนินงาน</b> ( ให้ระบุวิธีการ / กระบวนการดำเนินงานอย่างสังเขป )</td>
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
                                        echo "<tr><td class=\"td_border\">".$i.". ".$data->governance_name."</td><td class=\"td_border\" align='center'>".$data2->method_detail."</td></tr>";
                                    }else{
                                        echo "<tr><td class=\"td_border\">".$i.". ".$data->governance_name."</td><td class=\"td_border\"> </td></tr>";
                                    }

                                    $i++;
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <p class="p_word"><b>8. ผลการดำเนินงาน </b>( ตามวัถตุประสงค์ของโครงการ )</p>
                    <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span><b>8.1
                            เชิงปริมาณ</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table class="table_border table table-striped table-hover table-bordered ">
                                    <thead style="text-align: center">
                                    <tr>
                                        <td class="td_border">ผู้เข้าร่วมโครงการ ( ตามกลุ่มเป้าหมาย )</td>
                                        <td class="td_border">จำนวนคน ( คน )</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($modeltarget as $key => $row){
                                            $i = $key + 1;
                                            echo "<tr><td class=\"td_border\">".$i.") ".$row->targetgroup."</td><td class=\"td_border\">".$row->result_amount."</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span><b>8.2
                            เชิงคุณภาพ </b>( ผลที่ได้รับจากโครงการ )</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <?php
                                foreach ($modelresult as $key => $row){
                                    $i = $key + 1;
                                    echo $i.") ".$row->quality_detail."<br>";
                                }
                                ?>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <p class="p_word"><b>9. ผลการประเมินโครงการ <span style="margin-left: 10px">:</b></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4" align="left">
                                <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span>
                                    ผลการประเมินโครงการ ( โดยสรุป )
                                </p>
                            </div>
                            <div class="col-md-8">
                                <?= $modelcomhasprosub->result_evaluate?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4" align="left">
                                <p class="p_word"><span class="a_word" style="padding: 0px;margin-right: 40px"></span>
                                    ระดับความพึงพอใจ
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class="p_word"><?= $modelcomhasprosub->rate?></p>
                            </div>
                        </div>
                    </div>
                    <p class="p_word"><b>10. งบประมาณ </b></p>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table table-striped table-hover table-bordered table_border">
                                <thead style="text-align: center">
                                <tr>
                                    <th class="th_border">งบประมาณ</th>
                                    <th class="th_border">จำวนวเงิน ( บาท )</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="td_border">งบประมาณที่ได้รับจัดสรร</td>
                                    <td class="td_border" style="text-align: center"><?php echo number_format($sumCost).".-";?></td>
                                </tr>
                                <tr>
                                    <td class="td_border">งบประมาณที่ใช้จ่ายจริง</td>
                                    <td class="td_border" style="text-align: center"><?= number_format($modelcomhasprosub->sum_payment).".-" ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <p class="p_word"><b>11. ปัญหาอุปสรรค </b></p>
                    <div style="padding-left: 40px">
                        <?php
                        foreach ($modelproblem as $key => $row){
                            $i = $key + 1;
                            echo " 11.".$i." ".$row->problem_detail."<br>";
                        }
                        ?>
                    </div>

                    <p class="p_word"><b>12. ข้อเสนอแนะ / แนวทางในการปรับปรุงของปีถัดไป </b></p>
                    <div style="padding-left: 40px">
                        <?php
                        foreach ($modelsuggest as $key => $row){
                            $i = $key + 1;
                            echo " 12.".$i." ".$row->suggest_detail."<br>";
                        }
                        ?>
                    </div>
                    <p class="p_word"><b>13. แนบเอกสารรายงานผลการประเมินโครงการ</b></p>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <?php
//                                foreach ($modeldocument as $row){
//                                    echo "<a href='../../web_pms/uploads/".$row->document_name."'>".$row->document_name."</a><br>";
//                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <p class="p_word" align="center">********************************   </p>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <p>
                    <a class="btn btn-info btn-3d pull-left" href="../tablepro/table-allproject"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                    <a class="btn btn-blue btn-3d pull-right jquery-word-export" href="javascript:void(0)"><i class="fa fa-file-word-o"></i>word</a>
                    <a class="btn btn-danger btn-3d pull-right" href="../pdf/result?id=<?=$modelprosub->prosub_code?>&compact=<?=$id_compact?>"><i class="fa fa-file-pdf-o"></i>pdf</a>
                </p>
            </div>
        </div>
    </div>
</div>