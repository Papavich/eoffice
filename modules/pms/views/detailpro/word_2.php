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
                                      echo "<img src='".Yii::$app->homeUrl."web_pms\images\unchecked-checkbox.png' width='23' height='23'> งานประจำ (Routine : R) &nbsp&nbsp&nbsp<img src='".Yii::$app->homeUrl."web_pms\images\checked-checkbox.png' width='23' height='23'> งานเชิงกลยุทธ์ (Strategy : S";
                                  }

                                  ?>


                            </span>)</p>
                        <p class="p_word"><b>5. หน่วยงาน</b><span style="margin-left: 10px"><?= $prosub->prosub_deparment; ?></span></p>
                        <p class="p_word"><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์</b></p>
                        <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.1 ประเด็นยุทธศาสตร์ที่ <span><?php echo $strategichaspro->strategic_issues_id." : ".$strategicIs->strategic_issues_name;?></span></p>
                        <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.2 กลยุทธ์ที่ <span><?php echo $strategichaspro->strategic_issues_id.".".$strategichaspro->strategic_id;?></span></p>
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
                                    <th>ลำดับ</th>
                                    <th>โครงการ/กิจกรรม</th>
                                    <th>ระยะเวลาดำเนินงาน</th>
                                    <th>งบประมาณ(บาท)</th>
                                    <th colspan="2">กลุ่มเป้าหมาย</th>
                                    <th><p>รูปแบบการดำเนินงาน</p>(โดยสรุป)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($execute as $rows){
                                    echo "<tr>
                                    <td>
                                        ".$i." 
                                    </td>
                                    <td>
                                        ".$rows['execute_name']." 
                                    </td>
                                    <td>
                                        ".$rows['execute_timestart']." ถึง <br>".$rows['execute_timeend']."
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
                                    <td>แหล่งงบประมาณ/ประเภทงบรายจ่าย</td>
                                    <td>จำนวนเงิน(บาท)</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        14.1 งบประมาณ(งบจากรัฐ)
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                                <?php
                                $command = Yii::$app->get('db_pms')->createCommand('SELECT sum(budget_limit) FROM pms_projectsub_budget WHERE pms_project_sub_prosub_code ="'.$prosub->prosub_code.'"AND budget_id_lv1 = 1');
                                $sum = $command->queryScalar();
                                foreach ($prosubbudget as $key => $rows){

                                    $data = BudgetLv2::find()->where(['budget_id'=>$rows->budget_id_lv2 ,'budget_lv1_budget_id'=>1])->one();
                                    if($data){
                                        $i = $key+1;
                                        if($i == 1){
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.1." . $i . " " . $data->budget_name . "</span></td><td rowspan='".sizeof($prosubbudget)."'>". $sum."</td></tr>";
                                        }
                                        else{
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.1." . $i . " " . $data->budget_name . "</span></td></tr>";
                                        }
                                    }

                                }
                                ?>

                                <tr>
                                    <td>
                                        14.2 งบประมาณ(งบรายได้)
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <?php
                                $command = Yii::$app->get('db_pms')->createCommand('SELECT sum(budget_limit) FROM pms_projectsub_budget WHERE pms_project_sub_prosub_code ="'.$prosub->prosub_code.'"AND budget_id_lv1 = 2');
                                $sum = $command->queryScalar();
                                foreach ($prosubbudgets as $key => $rows){

                                    $data = BudgetLv2::find()->where(['budget_id'=>$rows->budget_id_lv2 ,'budget_lv1_budget_id'=>2])->one();
                                    if($data){
                                        $i = $key+1;
                                        if($i == 1){
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.2." . $i . " " . $data->budget_name . "</span></td><td rowspan='".sizeof($prosubbudgets)."'>".$sum ."</td></tr>";
                                        }
                                        else{
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.2." . $i . " " . $data->budget_name . "</span></td></tr>";
                                        }
                                    }

                                }
                                ?>

                                <tr>
                                    <td>
                                        14.3 งบอื่นๆ (เช่น เงิน 1% ระดับคณะ เงินสนับสนุนจากหน่วยงานอื่น เงินบำรุงกีฬา เงินบำรุงสโมสร เป็นต้น)
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <?php
                                $command = Yii::$app->get('db_pms')->createCommand('SELECT sum(budget_limit) FROM pms_projectsub_budget WHERE pms_project_sub_prosub_code ="'.$prosub->prosub_code.'"AND budget_id_lv1 = 3');
                                $sum = $command->queryScalar();
                                foreach ($prosubbudgetss as $key => $rows){

                                    if($data){
                                        $i = $key+1;
                                        if($i == 1){
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.3." . $i . " " . $rows->budget_other . "</span></td><td rowspan='".sizeof($prosubbudgetss)."'>". $sum."</td></tr>";
                                        }
                                        else{
                                            echo "<tr><td><span style=\"padding-left: 30px\">14.3." . $i . " " . $rows->budget_other . "</span></td></tr>";
                                        }
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
                                    เป็นเงิน <span>".$rows['cost_price']."</span></p>";
                            $i++;

                        }
                        ?>
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
                 <p>สถานะโครงการ :
                     <?php
                        echo $prosub->prosub_status_offer;
                     ?>
                     <?php

                     if($prosub->prosub_status_offer =="ยังไม่ขออนุมัติ"){
                         echo "<a class=\"btn-3d btn-sm btn btn-info\" href=\"../permission/permis-pronone-system?id=".$prosub->prosub_code."\"><i class=\"fa fa-check\"></i> ขออนุมัติ</a>";
                     }
                     else if($prosub->prosub_status_offer =="อนุมัติลงระบบสำเร็จ"){
                         echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-check\"></i> ขออนุมัติ</a>";
                     }
                     else{
                         echo "<a class=\"btn-3d btn-sm btn btn-info\" disabled='disabled'  id=\"submit\"><i class=\"fa fa-hourglass-2\"></i> ขออนุมัติ</a>";
                     }
                     ?>
                </p>
                <div class="text-right">
                    <a class="btn btn-warning" href="../addprosub/prosub-edit?id=<?= $prosub->prosub_code;?>"><i class="fa fa-pencil-square-o"></i> แก้ไข</a>
                    <a class="btn btn-success" href="../pdf/pdfrespon?id=<?= $prosub->prosub_code;?>"><i class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร</a>
<!--                    <a class="btn btn-success word-export" href="javascript:void(0)" target="_blank"><i-->
<!--                                class="glyphicon glyphicon-circle-arrow-down"></i> ดาวโหลดเอกสาร</a>-->


                    <a class="btn btn-blue" href="../tablepro/table-wait-in-system"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                </div>
            </div>
        </div>

    </div>
