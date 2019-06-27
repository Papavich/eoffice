<?php

use app\modules\pms\models\BudgetSub;
use app\modules\pms\models\Governance;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\model_main\EofficeCentralViewPisPerson;
use app\modules\pms\models\PmsBudgetSub;

?>

<?php
function YearThai($strDate)
{
    $result = validateDate($strDate);
    if ($result == true) {
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4, 4);
        $year = $date + 543;
        $reDate = str_replace($date, $year, $dateTh);
        return $reDate;
    } else {
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
    /*body {*/
        /*font-family: 'THSarabunNew', sans-serif !important;*/
    /*}*/
    body {
        font-size: 20px!important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border-collapse: collapse;
        border: 2px solid black;
        text-align: center;
    }

    .add_pro .p_word, .a_word {
        margin: 0px;
        margin-top: 4px;
        margin-bottom: 4px;
        padding: 0px;
    }

    .pull-right {
        text-align: right;
    }
</style>
<div id="content" class="padding-20">

    <div id="page-content" class="panel panel-default">
        <div class="panel-body">

            <div class="row add_pro">
                <div class="col-md-2 pull-right">
                    <p class="p_word">แผน-103-1/5</p>
                </div>
                <div class="col-md-12" style="padding-left: 66.141732px;padding-right: 55.559055px;">
                    <p class="p_word" style="text-align: center;size: 16px;padding-top: 30.23622px">
                        <b>แบบเสนอโครงการ</b></p>
                    <p class="p_word" style="text-align: center;size: 16px"><b>ในแผนปฏิบัติการคณะวิทยาศาสตร์
                            มหาวิทยาลัยขอนแก่น</b></p>
                    <p class="p_word" style="text-align: center;size: 16px"><b>ประจำปีงบประมาณ
                            พ.ศ. <?= $project->project_year; ?></b></p>
                    <br>
                    <p class="p_word"><b>1. ชื่อโครงการย่อย </b><span
                                style="margin-left: 30px"><?= $prosub->prosub_name; ?></span></p>
                    <p class="p_word"><b>2. รหัสโครงการย่อย </b><span
                                style="margin-left: 25px"><?= $prosub->prosub_code; ?></span></p>
                    <p class="p_word"><b>3. ภายใต้โครงการหลัก</b><span style="margin-left: 5px">
                                <?= $project->project_name; ?>

                            </span>
                    </p>
                    <p class="p_word"><b>4. ลักษณะโครงการ</b><span style="padding-left: 25px">
                                <?php if ($prosub->prosub_type == "งานประจำ (Routine : R)") {
                                    echo "<img src=\"https://png.icons8.com/checked-checkbox/p1em/1600\"  width=\"23\" height=\"23\"> งานประจำ (Routine : R) <img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXhmLttGmQNdJcoRToOC998ZgNTH966ypFM6YG3ngpkRDzzYFAw\"  width=\"23\" height=\"23\"> งานเชิงกลยุทธ์ (Strategy : S)";
                                } else {
                                    echo "<img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXhmLttGmQNdJcoRToOC998ZgNTH966ypFM6YG3ngpkRDzzYFAw\"  width=\"23\" height=\"23\"> งานประจำ (Routine : R) <img src=\"https://png.icons8.com/checked-checkbox/p1em/1600\"  width=\"23\" height=\"23\"></i> งานเชิงกลยุทธ์ (Strategy : S)";
                                }

                                ?>


                            </span></p>
                    <p class="p_word"><b>5. หน่วยงาน </b><span
                                style="margin-left: 10px"><?= $prosub->prosub_deparment; ?></span></p>
                    <p class="p_word"><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์</b></p>
                    <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.1
                        ประเด็นยุทธศาสตร์ที่ <span><?php if ($strategicIs) {
                                echo $strategicIs->strategic_issues_id;
                            } ?></span> :
                        <span><?php if ($strategicIs) {
                                echo $strategicIs->strategic_issues_name;
                            } ?></span></p>
                    <p class="p_word"><a class="a_word" style="padding: 0px;margin-right: 40px"></a>6.2 กลยุทธ์ที่
                        <span><?php if ($strategicIs) {
                                echo $strategicIs->strategic_issues_id . ".";
                            } ?><?php if ($strategicIs) {
                                echo $strategic->strategic_name;
                            } ?></span></p>
                    <p class="p_word"><b>7. ตอบสนองตามหลักธรรมภิบาล</b></p>
                    <div class="row" style="margin-left: 25px">
                        <?php

                        foreach ($governanceOfYear as $rows) {
                            $tmp = Governance::find()->where(['governance_id' => $rows->governance_id])->one();
                            $arrayg[$tmp->governance_id] = $tmp->governance_name;
                        }
                        $i = 1;
                        foreach ($governanceOfYear as $key => $rows) {
                            $j = 0;
                            foreach ($governancehaspro as $key => $rows2) {
                                if ($rows['governance_id'] == $rows2['governance_id']) {
                                    $j++;
                                }
                            }
                            if ($j == 1) {
                                $namegov = Governance::find()->where(['governance_id' => $rows['governance_id']])->one();
                                echo "<div class='col-md-3 col-sm-4'><img src=\"https://png.icons8.com/checked-checkbox/p1em/1600\"  width=\"23\" height=\"23\"> " . $i . ". " . $namegov['governance_name'] . "
                                </div>";
                            } else {
                                $namegov = Governance::find()->where(['governance_id' => $rows['governance_id']])->one();
                                echo "<div class='col-md-3 col-sm-4'><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIXhmLttGmQNdJcoRToOC998ZgNTH966ypFM6YG3ngpkRDzzYFAw\"  width=\"23\" height=\"23\"> " . $i . ". " . $namegov['governance_name'] . "
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
                    foreach ($purpose as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>9." . $i . " <span>" . $rows['purpose_detail'] . "</span>
                        </p>";
                        $i++;
                    }
                    ?>

                    <p class="p_word"><b>10. ตัวชี้วัดและค่าเป้าหมายของโครงการ</b></p>
                    <?php
                    $i = 1;
                    foreach ($indicator as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>10." . $i . "ตัวชี้วัด : <span>" . $rows['indicator_detail'] . "</span>
                            ค่าเป้าหมาย <span>" . $rows['indicator_goalValue'] . "</span></p>";
                        $i++;
                    }
                    ?>

                    <p class="p_word"><b>11. ระยะเวลาในการดำเนินงาน</b></p>
                    <p class="p_word">
                        <a class="a_word"
                           style="padding: 0px;margin-right: 40px"></a><span><?php echo YearThai($prosub->prosub_start_date) . " ถึง " . YearThai($prosub->prosub_end_date); ?></span>
                    </p>
                    <p class="p_word"><b>12. สถานที่</b></p>
                    <?php
                    $i = 1;
                    foreach ($place as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>12." . $i . " <span>" . $rows['place_name'] . "</span>
                        </p>";
                        $i++;
                    }
                    ?>
                    <p class="p_word"><b>13. การดำเนินงาน</b> (ให้ระบุโครงการ/กิจกรรม)</p>
                    <div class="panel-body">
                        <table class=""
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
                            foreach ($execute as $rows) {
                                echo "<tr>
                                    <td>
                                        " . $i . " 
                                    </td>
                                    <td>
                                        " . $rows['execute_name'] . " 
                                    </td>
                                    <td>
                                        " . YearThai($rows['execute_timestart']) . " ถึง <br>" . YearThai($rows['execute_timeend']) . "
                                    </td>
                                    <td>
                                        " . number_format($rows['execute_cost']) . " 
                                    </td>
                                    <td>
                                        " . $rows['execute_targetgroup'] . " 
                                    </td>
                                    <td>
                                        " . number_format($rows['execute_amount']) . " 
                                    </td>
                                    <td>
                                        " . $rows['execute_operationplan'] . " 
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
                            foreach ($probudget as $row) {
                                $BudgetSub = BudgetSub::findOne($row->budget_sub);
                                if ($row->budget_main == 1) {
                                    echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $BudgetSub->budget_name . "</span></td><td>" . number_format($row->budget_limit) . "</td></tr>";
                                }
                            }
                            ?>
                            <tr>
                                <td><span class="pull-left">งบประมาณ(งบรายได้)</span></td>
                                <td></td>
                            </tr>
                            <?php
                            foreach ($probudget as $row) {
                                $BudgetSub = BudgetSub::findOne($row->budget_sub);
                                if ($row->budget_main == 2) {
                                    echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $BudgetSub->budget_name . "</span></td><td>" . number_format($row->budget_limit) . "</td></tr>";
                                }
                            }
                            ?>
                            <tr>
                                <td><span class="pull-left">งบอื่นๆ</span></td>
                                <td></td>
                            </tr>
                            <?php
                            foreach ($probudget as $row) {
                                $BudgetSub = BudgetSub::findOne($row->budget_sub);
                                if ($row->budget_main == 3) {
                                    echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $row->budget_other . "</span></td><td>" . number_format($row->budget_limit) . "</td></tr>";
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                    <p class="p_word"><b> แจกแจงรายละเอียดค่าใช้จ่าย
                            (สำหรับใช้ประกอบขออนุมัติจัดโครงการหรือขออนุมัติใช้เงิน)</b></p>
                    <?php
                    $i = 1;
                    foreach ($costplane as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>" . $i . ". </a><span>" . $rows['cost_detail'] . "</span>
                                    <span class='pull-right'>เป็นเงิน " . number_format($rows['cost_price']) . "</span></p>";
                        $i++;

                    }
                    ?>
                    <p class="p_word pull-right">รวมเป็นเงินทั้งสิ้น <?php echo number_format($costplaneEng); ?> บาท</p>
                    <p class="p_word pull-right">(-<?= $costplaneTh ?>-)</p>
                    <p class="p_word"><b>15. ผลลัพธ์ที่คาดจะได้รับ</b></p>
                    <?php
                    $i = 1;
                    foreach ($resultexpect as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>15." . $i . " <span>" . $rows['result_detail'] . "</span></p>";
                        $i++;
                    }
                    ?>
                    <p class="p_word"><b>16.
                            ผลกระทบหรือความเสี่ยงอาจจะเกิดขึ้นถ้าไม่ได้สร้างความสัมพันธ์ระหว่างสาขาและรุ่นพี่</b></p>
                    <?php
                    $i = 1;
                    foreach ($effect as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>16." . $i . "<span> " . $rows['effect_detail'] . "</span>
                        </p>";
                        $i++;
                    }
                    ?>

                    <p class="p_word"><b>17. ปัญหาอุปสรรค และแนวทางปรับปรุงการดำเนินงานในรอบปีที่ผ่านมา</b></p>
                    <?php
                    $i = 1;
                    foreach ($problem as $rows) {
                        echo "<p><a class=\"a_word\" style='padding: 0px;margin-right: 40px'></a>17." . $i . "<span> " . $rows['problem_detail'] . "</span>
                        </p>";
                        $i++;
                    }
                    ?>
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
                                $datat = EofficeCentralViewPisPerson::find()->where(['person_id' => $prosub->prosub_operator])->one();
                                echo $datat->PREFIXABB . $datat->person_name . " " . $datat->person_surname;

                                ?>
                                )
                            </td>
                            <td style="border: hidden; text-align: center">
                                (
                                <?php
                                $datah = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id' => $prosub->prosub_manager])->one();
                                echo $datah->academic_positions_abb_thai . $datah->person_name . " " . $datah->person_surname;
                                ?>
                                )
                            </td>
                        </tr>
                        <tr style="border: hidden">
                            <td style="border: hidden; text-align: center">
                                ตำแหน่ง <?php
                                if ($datat->person_type == 1) {
                                    echo "อาจารย์สาขาประจำวิชา" . $datat->major_name;
                                } else if ($datat->person_type == 2) {
                                    echo $datat->person_position_staff;
                                }

                                ?>
                            </td>
                            <td style="border: hidden; text-align: center">
                                ตำแหน่ง <?php
                                echo $datah->position_name;
                                ?>
                            </td>
                        </tr>
                        <tr style="border: hidden">
                            <td style="border: hidden; text-align: center">
                                ผู้รับผิดชอบระดับปฏิบัติ
                            </td>
                            <td style="border: hidden; text-align: center">
                                ผู้รับผิดชอบระดับนโยบาย/บริหาร
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
