<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ตารางสอน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li><a href="teachtable">เลือกตารางสอน</a></li>
        <li class="active">แสดงตารางสอน</li>
    </ol>
</header>
<!--header-->
<!--MAIN STUDY SCHEDULE-->
<div id="main_table" class="padding-20">
    <div class="panel panel-default ">
        <div id="section-to-print">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>ตารางสอนของ <b style="color: #0000aa"><?= $Detail_teacher[0]['teacher_prefix'] ?><?= $Detail_teacher[0]['teacher_name'] ?> <?= $Detail_teacher[0]['teacher_surname'] ?>
                        </b> ประจำปีการศึกษา <b style="color: red"><?= $year ?></b> ภาคการศึกษา <b style="color: red"><?= $semester ?></b></strong>
                </span>
            </div>
            <!--SHOW TEACH TABLE-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datatable_sample"
                           style="text-align: center !important;">
                        <thead>
                        <tr bgcolor="#BBEBFF">

                            <th class="text-center">Date/Time</th>
                            <th class="text-center" colspan="2">08.00 - 09.00</th>
                            <th class="text-center" colspan="2">09.00 - 10.00</th>
                            <th class="text-center" colspan="2">10.00 - 11.00</th>
                            <th class="text-center" colspan="2">11.00 - 12.00</th>
                            <th class="text-center" colspan="2">12.00 - 13.00</th>
                            <th class="text-center" colspan="2">13.00 - 14.00</th>
                            <th class="text-center" colspan="2">14.00 - 15.00</th>
                            <th class="text-center" colspan="2">15.00 - 16.00</th>
                            <th class="text-center" colspan="2">16.00 - 17.00</th>
                            <th class="text-center" colspan="2">17.00 - 18.00</th>
                            <th class="text-center" colspan="2">18.00 - 19.00</th>
                            <th class="text-center" colspan="2">19.00 - 20.00</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        for ($i = 0; $i < 7; $i++) {
                            ?>
                            <tr class="odd gradeX">
                                <?php
                                switch ($i) {
                                    case 0:
                                        echo "<td bgcolor=\"#D9F3FF\">Monday</td>";
                                        break;
                                    case 1:
                                        echo "<td bgcolor=\"#D9F3FF\">Tuesday</td>";
                                        break;
                                    case 2:
                                        echo "<td bgcolor=\"#D9F3FF\">Wednesday</td>";
                                        break;
                                    case 3:
                                        echo "<td bgcolor=\"#D9F3FF\">Thursday</td>";
                                        break;
                                    case 4:
                                        echo "<td bgcolor=\"#D9F3FF\">Friday</td>";
                                        break;
                                    case 5:
                                        echo "<td bgcolor=\"#D9F3FF\">Saturday</td>";
                                        break;
                                    case 6:
                                        echo "<td bgcolor=\"#D9F3FF\">Sunday</td>";
                                        break;
                                }

                                for ($j = 0; $j < 24; $j++) {
                                    $save_row[0] = "";
                                    foreach ($Data_real_show_teacher_table as $row) {
                                        $explode = explode(",", $row['timeslot_id']);
                                        if ($explode[0] == $i && $explode[1] == $j) {
                                            $save_row[0] = $row;
                                        }
                                    }
                                    if ($save_row[0] != null) {
                                        $save_section = 0;
                                        foreach ($save_row[0]['section_detail'] as $row){
                                            if (empty($save_section)){
                                                $save_section = $row['section_no'];
                                            }else{
                                                $save_section = $save_section . "," . $row['section_no'];
                                            }
                                        }
                                        echo "<td id='" . $i . "$j" . "' colspan='" . $save_row[0]['timeslot_lenght'] . "'>" .
                                            $save_row[0]['subject_detail'][0]['subject_detail'][0]['subject_id'] . "<br/>" . " (" .
                                            $save_row[0]['subject_detail'][0]['subject_detail'][0]['subject_namethai'] . ")" ."<br/> ห้อง " . $save_row[0]['room_detail'][0]['room_name'] . " (" . $save_section . ")" . "</td>";
                                        $j = $j + intval($save_row[0]['timeslot_lenght']) - 1;
                                    } else {
                                        echo "<td></td>";
                                    }
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--SHOW TEACH TABLE-->
        </div>
        <?= $this->render('_formprintbutton') ?>
    </div>
</div>
<!--MAIN STUDY SCHEDULE-->










