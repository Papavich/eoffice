<?php
use app\modules\pms\models\PmsBudgetSub;
use app\modules\pms\models\BudgetLv1;
use app\modules\pms\models\BudgetLv2;
use app\modules\pms\models\BudgetLv3;
?>
    <div id="content" class="padding-20">

        <div id="page-content" class="panel panel-default">
            <div class="panel-body">
                <style>
                    table{
                        width: 100%;
                        border-collapse:collapse ;
                    }
                    th,td{
                        border: 3px solid black;
                        text-align: center;
                    }
                    .add_pro .p_word, .a_word {
                        margin: 0px;
                        margin-top: 5px;
                        margin-bottom: 5px;
                        padding: 0px;
                    }
                </style>
                <div class="row add_pro">
                    <div class="col-md-2 pull-right">
                        <p class="p_word">แผน-103-1/5</p>
                    </div>
                    <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                        <p class="p_word" style="text-align: center;size: 16px;padding-top: 30.23622px"><b>แบบเสนอโครงการ</b></p>
                        <p class="p_word" style="text-align: center;size: 16px"><b>ในแผนปฏิบัติการคณะวิทยาศาสตร์
                                มหาวิทยาลัยขอนแก่น</b></p>
                        <p class="p_word" style="text-align: center;size: 16px"><b>ประจำปีงบประมาณ พ.ศ. <?= $project->project_year; ?></b></p>
                        <br>
                        <p class="p_word"><b>1. ชื่อโครงการย่อย</b><span
                                    style="margin-left: 30px"><?= $prosub->prosub_name; ?></span></p>
                        <p class="p_word"><b>2. รหัสโครงการย่อย</b><span style="margin-left: 25px"><?= $prosub->prosub_code; ?></span></p>
                        <p class="p_word"><b>3. ภายใต้โครงการหลัก</b><span style="margin-left: 5px">
                                <?= $project->project_name;?>

                            </span>
                        </p>
                        <p class="p_word"><b>4. ลักษณะโครงการ</b><span style="padding-left: 25px">
                                  <?php if($prosub->prosub_type == "งานประจำ (Routine : R)"){
                                      echo "<img src='".Yii::$app->homeUrl."web_pms\images\checked-checkbox.png' width='23' height='23'> งานประจำ (Routine : R) &nbsp&nbsp&nbsp<img src='".Yii::$app->homeUrl."web_pms\images\unchecked-checkbox.png' width='23' height='23'> งานเชิงกลยุทธ์ (Strategy : S";
                                  }else{
                                      echo "<img src='".Yii::$app->homeUrl."web_pms\images\checked-uncheckbox.png' width='23' height='23'> งานประจำ (Routine : R) &nbsp&nbsp&nbsp<img src='".Yii::$app->homeUrl."web_pms\images\checked-checkbox.png' width='23' height='23'> งานเชิงกลยุทธ์ (Strategy : S";
                                  }

                                  ?>


                            </span>)</p>
                        <p class="p_word"><b>5. หน่วยงาน</b><span style="margin-left: 10px"><?= $prosub->prosub_deparment; ?></span></p>
                        <p class="p_word"><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์</b></p>
                        <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.1 ประเด็นยุทธศาสตร์ที่ <span><?php echo $strategicIs->strategic_issues_id." : ".$strategicIs->strategic_issues_name;?></span></p>
                        <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.2 กลยุทธ์ที่ <span><?php echo $strategic->strategic_id." : ".$strategic->strategic_name;?></span></p>
                        <p class="p_word"><b>7. ตอบสนองตามหลักธรรมภิบาล</b></p>
                        <div class="row" style="margin-left: 25px">
                            <?php

                            foreach ($governanceOfYear as $rows){
                                $tmp = \app\modules\pms\models\Governance::find()->where(['governance_id'=>$rows->governance_id])->one();
                                $arrayg[$tmp->governance_id]=$tmp->governance_name;
                            }
                            $i = 1;
                            foreach ($governanceOfYear as $key => $rows){
                                $j = 0;
                                foreach ($governancehaspro as $key => $rows2) {
                                    if($rows['governance_id'] == $rows2['governance_id']){
                                        $j++;
                                    }
                                }
                                if($j == 1){
                                    $namegov = \app\modules\pms\models\Governance::find()->where(['governance_id'=>$rows['governance_id']])->one();
                                    echo "<div class='col-md-3 col-sm-4'><img src='".Yii::$app->homeUrl."web_pms\images\checked-checkbox.png' width='23' height='23'> " . $i . ". " . $namegov['governance_name'] . "
                                </div>";
                                }else {
                                    $namegov = \app\modules\pms\models\Governance::find()->where(['governance_id'=>$rows['governance_id']])->one();
                                    echo "<div class='col-md-3 col-sm-4'><img src='".Yii::$app->homeUrl."web_pms\images\unchecked-checkbox.png' width='23' height='23'> " . $i . ". " . $namegov['governance_name'] . "
                                </div>";
                                }
                                $i++;
                            }
                            ?>
                        </div>
                        <p class="p_word"><b>8. หลักการและเหตุผล</b></p>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="width: 100%;height: 100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?= $prosub->prosub_principle; ?>
                                </p>
                            </div>
                        </div>
                        <p class="p_word"><b>9. วัตถุประสงค์</b></p>
                        <?php
                        $i = 1;
                            foreach ($purpose as $rows){
                                echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>9.".$i." <span>".$rows['purpose_detail']."</span>
                        </p>";
                                $i++;
                            }
                        ?>

                        <p class="p_word"><b>10. ตัวชี้วัดและค่าเป้าหมายของโครงการ</b></p>
                        <?php
                        $i = 1;
                        foreach ($indicator as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>10.".$i."ตัวชี้วัด : <span>".$rows['indicator_detail']."</span>
                            ค่าเป้าหมาย <span>".$rows['indicator_goalValue']."</span></p>";
                            $i++;
                        }
                        ?>

                        <p class="p_word"><b>11. ระยะเวลาในการดำเนินงาน</b></p>
                        <p class="p_word">
                            <a class="a_word" style="padding: 0px;margin-right: 40px"></a><span><?php echo $prosub->prosub_timestart." ถึง ".$prosub->prosub_timeend; ?></span>
                        </p>
                        <p class="p_word"><b>12. สถานที่</b></p>
                        <?php
                        $i = 1;
                        foreach ($place as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>12.".$i." <span>".$rows['place_name']."</span>
                        </p>";
                            $i++;
                        }
                        ?>
                        <p class="p_word"><b>13. การดำเนินงาน</b> (ให้ระบุโครงการ/กิจกรรม)</p>
                        <div class="panel-body">
                            <table style="text-align: center;border-collapse: collapse;" class="table table-striped table-hover table-bordered"
                                   id="">
                                <thead>
                                <tr>
                                    <th width="5%" rowspan="2">ลำดับ</th>
                                    <th width="17%" rowspan="2">โครงการ/กิจกรรม</th>
                                    <th width="18%" rowspan="2">ระยะเวลาดำเนินงาน</th>
                                    <th width="10%" rowspan="2">งบประมาณ(บาท)</th>
                                    <th  colspan="2">กลุ่มเป้าหมาย</th>
                                    <th  rowspan="2">รูปแบบการดำเนินงาน(โดยสรุป)</th>
                                </tr>
                                <tr>
                                    <td>กลุ่มเป้าหมาย</td>
                                    <td>จำนวน (คน)</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($execute as $rows){
                                    if($rows['execute_timestart'] == null && $rows['execute_timeend'] == null){
                                        $datePro = "";
                                    }else{
                                        $datePro = $rows['execute_timestart']." ถึง <br>".$rows['execute_timeend'];
                                    }
                                    echo "<tr>
                                    <td>
                                        ".$i." 
                                    </td>
                                    <td>
                                        ".$rows['execute_name']." 
                                    </td>
                                    <td>
                                        ".$datePro."
                                    </td>
                                    <td>
                                        ".$rows['execute_cost']." 
                                    </td>
                                    <td>
                                        ".$rows['execute_targetgroup']." 
                                    </td>
                                    <td>
                                        ".$rows['execute_amount']." 
                                    </td>
                                    <td>
                                        ".$rows['execute_operationplan']." 
                                    </td>
                                </tr>";
                                    $i++;
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>
                        <p class="p_word"><b>14. งบประมาณ</b></p>
                        <div class="panel-body">
                            <table class="table table-striped table-hover table-bordered"
                                   id="">
                                <thead style="text-align: center">
                                <tr>
                                    <td>แหล่งงบประมาณ / ประเภทงบรายจ่าย</td>
                                    <td>จำนวนเงิน(บาท)</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span class="pull-left">งบประมาณ(งบจากรัฐ)</span></td>
                                    <td></td>
                                </tr>
                                <?php
                                foreach ($probudget as $row){
                                    $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                                    if($row->budget_main == 1){
                                        echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$BudgetSub->budget_name."</span></td><td>".$row->budget_limit."</td></tr>";
                                    }
                                }
                                ?>
                                <tr>
                                    <td><span class="pull-left">งบประมาณ(งบรายได้)</span></td>
                                    <td></td>
                                </tr>
                                <?php
                                foreach ($probudget as $row){
                                    $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                                    if($row->budget_main == 2){
                                        echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$BudgetSub->budget_name."</span></td><td>".$row->budget_limit."</td></tr>";
                                    }
                                }
                                ?>
                                <tr>
                                    <td><span class="pull-left">งบอื่นๆ</span></td>
                                    <td></td>
                                </tr>
                                <?php
                                foreach ($probudget as $row){
                                    $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                                    if($row->budget_main == 3){
                                        echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$row->budget_other."</span></td><td>".$row->budget_limit."</td></tr>";
                                    }
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                        <p class="p_word"><b> แจกแจงรายละเอียดค่าใช้จ่าย (สำหรับใช้ประกอบขออนุมัติจัดโครงการหรือขออนุมัติใช้เงิน)</b></p>
                        <?php
                        $i = 1;
                        foreach ($costplane as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>".$i.". </a><span>".$rows['cost_detail']."</span>
                                    <span style='float: right;margin-right: 20px;'>เป็นเงิน ".$rows['cost_price']." บาท</span></p>";
                            $i++;

                        }
                        ?>
                        <p class="text-right margin-right-20">รวมเป็นเงินทั้งสิ้น <?=$costplaneEng?> บาท</p>
                        <p class="text-right margin-right-20">(-<?=$costplaneTh?>-)</p>

                        <p class="p_word"><b>15. ผลลัพธ์ที่คาดจะได้รับ</b></p>
                        <?php
                        $i = 1;
                        foreach ($resultexpect as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>15.".$i." <span>".$rows['result_detail']."</span></p>";
                            $i++;
                        }
                        ?>
                        <p class="p_word"><b>16. ผลกระทบหรือความเสี่ยงอาจจะเกิดขึ้นถ้าไม่ได้สร้างความสัมพันธ์ระหว่างสาขาและรุ่นพี่</b></p>
                        <?php
                        $i = 1;
                        foreach ($effect as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>16.".$i."<span> ".$rows['effect_detail']."</span>
                        </p>";
                            $i++;
                        }
                        ?>

                        <p class="p_word"><b>17. ปัญหาอุปสรรค และแนวทางปรับปรุงการดำเนินงานในรอบปีที่ผ่านมา</b></p>
                        <?php
                        $i = 1;
                        foreach ($problem as $rows){
                            echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>17.".$i."<span> ".$rows['problem_detail']."</span>
                        </p>";
                            $i++;
                        }
                        ?>

                        <br>
                        <br>
                        <br>
                        <br>

                        <div class="row">
                            <table>
                                <tbody style="border: hidden">
                                <tr style="border: hidden">
                                    <td style="border: hidden; text-align: center">
                                        ........................................
                                    </td>
                                    <td style="border: hidden;  text-align:center">
                                        ........................................
                                    </td>
                                </tr>
                                <tr style="border: hidden">
                                    <td style="border: hidden; text-align: center">
                                        (
                                        <?php
                                        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$prosub->prosub_code])->one();
                                        $data->prosub_operator;
                                        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_operator])->distinct()->one();
                                        if($datas){
                                            echo " ".$datas->name_title.$datas->first_name."  ".$datas->last_name." ";
                                        }

                                        ?>
                                        )
                                    </td>
                                    <td style="border: hidden; text-align: center">
                                        (
                                        <?php
                                        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$prosub->prosub_code])->one();
                                        $data->prosub_manager;
                                        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_manager])->distinct()->one();
                                        if($datas){
                                            echo " ".$datas->name_title.$datas->first_name."  ".$datas->last_name." ";
                                        }

                                        ?>
                                        )
                                    </td >
                                </tr>
                                <tr style="border: hidden">
                                    <td style="border: hidden; text-align: center">
                                        ตำแหน่ง <?php
                                        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$prosub->prosub_code])->one();
                                        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_positiono])->distinct()->one();
if($datas){
    echo " ".$datas->position." ";
}

                                        ?>
                                    </td>
                                    <td style="border: hidden; text-align: center">
                                        ตำแหน่ง <?php
                                        $data = \app\modules\pms\models\PmsProjectSub::find()->where(['prosub_code'=>$prosub->prosub_code])->one();
                                        $datas = \app\modules\pms\models\Person::find()->where(['id'=>$data->prosub_positionm])->distinct()->one();
if($datas){
    echo " ".$datas->position." ";
}

                                        ?>
                                    </td >
                                </tr>
                                <tr style="border: hidden">
                                    <td style="border: hidden; text-align: center">
                                        ผู้รับผิดชอบระดับปฏิบัติ
                                    </td>
                                    <td style="border: hidden; text-align: center">
                                        ผู้รับผิดชอบระดับนโยบาย/บริหาร
                                    </td >
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="text-right">


                    <a class="btn btn-success" href="../pdf/pdfrespon?id=<?= $prosub->prosub_code;?>"><i class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร</a>
<!--                    <a class="btn btn-success word-export" href="javascript:void(0)" target="_blank"><i-->
<!--                                class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร</a>-->


                    <a class="btn btn-blue" href="../tablepro/table-responsible"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                </div>
            </div>
        </div>

    </div>
