<?php

use app\modules\pms\models\Governance;
use app\modules\pms\models\PmsBudgetSub;
use app\modules\pms\models\PmsGovernanceHasProjectSub;

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
                        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$modelprosub->prosub_code])->one();
                        $data->prosub_operator;
                        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
                        echo " ".$datas->name_title.$datas->first_name."  ".$datas->last_name." ";
                        ?>
                    </p>
                    <p class="p_word"><b>4. ระยะเวลาดำเนินงาน <span style="margin-left: 10px">:</b><span
                                style="margin-left: 10px">วันที่ <?= $modelprosub->prosub_timestart?> ถึง <?= $modelprosub->prosub_timeend?></p>
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
                            <table class="table table-striped table-hover table-bordered">
                                <thead style="text-align: center">
                                <tr>
                                    <td><b>หลักธรรมาภิบาล</b></td>
                                    <td><b>การดำเนินงาน</b> ( ให้ระบุวิธีการ / กระบวนการดำเนินงานอย่างสังเขป )</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all();



//                                $i = 1;
//                                foreach ($governanceOfYear as $key => $rows){
//                                    $j = 0;
//                                    foreach ($governancehaspro as $key => $rows2) {
//                                        if($rows['governance_id'] == $rows2['governance_id']){
//                                            $j++;
//                                        }
//                                    }
//                                    $data = Governance::find()->where(['governance_id'=>$rows->governance_id])->one();
//                                    if($j == 1){
//                                        $data2 =PmsGovernanceHasProjectSub::find()->where(['governance_id'=>$data->governance_id,'pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->one();
//                                        if($data2 != null){
//                                            echo "<tr><td>".$i.". ".$data->governance_name."</td><td align='center'></td></tr>";
//                                        }else{
//                                            echo "<tr><td>".$i.". ".$data->governance_name."</td><td></td></tr>";
//                                        }
//
//
//                                    }else {
//                                        echo "<tr><td>".$i.". ".$data->governance_name."</td><td> </td></tr>";
//                                    }
//                                    $i++;
//                                }
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

                                //$modelcompacthasmethod
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
                                    <td style="text-align: center"><?php
echo $sumCost;
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>งบประมาณที่ใช้จ่ายจริง</td>
                                    <td style="text-align: center"><?= $modelcomhasprosub->sum_payment ?></td>
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
                                <a>szdfgh.word</a>
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
            <p>สถานะขออนุมัติจัดโครงการ :
                <?php
                echo $modelcomhasprosub->status_result;
                ?>
                <?php
                if($modelcomhasprosub->status_result =="รองานนโยบายและแผนอนุมัติ"){
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" href=\"../permissionsummary/permis-planner?id=".$modelprosub->prosub_code."&compact=".$id_compact."\"><i class=\"fa fa-check\"> อนุมัติ</i></a> ";
                    echo " <a class=\"btn btn-sm btn-3d btn-warning\" data-toggle=\"modal\" data-target=\"#notconfirmed\"><i class=\"glyphicon glyphicon-arrow-left\"></i> ส่งกลับแก้ไข</a>";
                }
                else if($modelcomhasprosub->status_result =="อนุมัติระบบสำเร็จ"){
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-check\"> อนุมัติ</i></a>";
                }
                else {
                    echo "<a class=\"btn btn-sm btn-3d btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-hourglass-2\"> อนุมัติ</i></a>";
                }
                ?>
            </p>
            <div class="text-right">

                <a class="btn btn-3d btn-success word-export" href="../detailprosubresult/pdfprosubresult?id=<?= $modelprosub->prosub_code; ?>" target="_blank"><i
                            class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร</a>
                <a class="btn btn-3d btn-blue" href="../tableprois/table-permissummary-planner"><i
                            class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
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
            <form method="post" action="../commentsummary/comment-planner">
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $modelprosub->prosub_code; ?>"/>
                    <input type="hidden" name="compact" value="<?= $id_compact; ?>"/>
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