<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ตารางการใช้ห้องเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li><a href="timetable">เลือกสาขาวิชาและชั้นปี</a></li>
        <li class="active">ตารางวิชาเรียน</li>
    </ol>
</header>
<!--header-->
<!--MAIN STUDY SCHEDULE-->
<div id="show_roomtable">
    <div id="main_table" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div id="section-to-print">
                <div class="panel-heading">
                    <span class="title elipsis">
                        <strong>ตารางเรียนของสาขา <b style="color: red"><?= $detail_programs[0]['program_name'] ?></b> ชั้นปีที่ <b
                                    style="color: red"><?= $student_year ?></b> ปีการศึกษา <b
                                    style="color: red"><?= $year ?></b> ภาคการศึกษาที่ <b
                                    style="color: red"><?= $semester ?></b>
                        </strong>
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
                                //หา max ของ col ก่อน
                                $max_row = 1; //เก็บค่า row span ของ
                                $array_set_timeslot = array();
                                for ($j = 0; $j < 24; $j++) {
                                    $count_row = 0;
                                    foreach ($Data_real_show_programs_table as $row) {
                                        $explode_timeslot = explode(",", $row['timeslot_id']);
                                        if ($explode_timeslot[0] == $i && $explode_timeslot[1] == $j) {
                                            $count_row++;
                                            if (empty($array_set_timeslot[$i][$j])) {
                                                $array_set_timeslot[$i][$j] = $row['group_no'];
                                            } else {
                                                $array_set_timeslot[$i][$j] = $array_set_timeslot[$i][$j] . "," . $row['group_no'];
                                            }
                                        }
                                    }
                                    if ($count_row > $max_row) {
                                        $max_row = $count_row;
                                    }
                                }

                                for ($r = 0; $r < $max_row; $r++) {
                                    if ($r == 0) {
                                        switch ($i) {
                                            case 0:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Monday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 1:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Tuesday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 2:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Wednesday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 3:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Thursday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 4:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Friday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 5:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Saturday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                            case 6:
                                                echo "<tr class=\"odd gradeX\">";
                                                echo "<td rowspan='" . $max_row . "' bgcolor=\"#D9F3FF\">Sunday</td>";
                                                for ($j = 0; $j < 24; $j++) {
                                                    if (empty($array_set_timeslot[$i][$j])) {
                                                        echo "<td></td>";
                                                    } else {
                                                        $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                        if (empty($array_explode[$r])) {
                                                            echo "<td></td>";
                                                        } else {
                                                            $time_length = 1;
                                                            $subject_id = 0;
                                                            $subject_name = 0;
                                                            $room_name = 0;
                                                            $section = 0;
                                                            foreach ($Data_real_show_programs_table as $row) {
                                                                if ($row['group_no'] == $array_explode[$r]) {
                                                                    $time_length = $row['timeslot_lenght'];
                                                                    $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                                    $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                                    foreach ($row['section_detail'] as $row1) {
                                                                        if (empty($section)) {
                                                                            $section = $row1['section_no'];
                                                                        } else {
                                                                            $section = $section . "," . $row1['section_no'];
                                                                        }
                                                                    }
                                                                    foreach ($Data_Room as $row1) {
                                                                        if ($row1['room_id'] == $row['room_id']) {
                                                                            $room_name = $row1['room_name'];
                                                                        }
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                            echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                            $j = $j + ($time_length - 1);
                                                        }
                                                    }
                                                }
                                                echo "</tr>";
                                                break;
                                        }
                                    } else {
                                        echo "<tr class=\"odd gradeX\">";
                                        for ($j = 0; $j < 24; $j++) {
                                            if (empty($array_set_timeslot[$i][$j])) {
                                                echo "<td></td>";
                                            } else {
                                                $array_explode = explode(",", $array_set_timeslot[$i][$j]);
                                                if (empty($array_explode[$r])) {
                                                    echo "<td></td>";
                                                } else {
                                                    $time_length = 1;
                                                    $subject_id = 0;
                                                    $subject_name = 0;
                                                    $room_name = 0;
                                                    $section = 0;
                                                    foreach ($Data_real_show_programs_table as $row) {
                                                        if ($row['group_no'] == $array_explode[$r]) {
                                                            $time_length = $row['timeslot_lenght'];
                                                            $subject_id = $row['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                                            $subject_name = $row['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                                                            foreach ($row['section_detail'] as $row1) {
                                                                if (empty($section)) {
                                                                    $section = $row1['section_no'];
                                                                } else {
                                                                    $section = $section . "," . $row1['section_no'];
                                                                }
                                                            }
                                                            foreach ($Data_Room as $row1) {
                                                                if ($row1['room_id'] == $row['room_id']) {
                                                                    $room_name = $row1['room_name'];
                                                                }
                                                            }
                                                            break;
                                                        }
                                                    }
                                                    echo "<td colspan='" . $time_length . "'>" . $subject_id . "<br>" . " (" . $subject_name . ")" . "<br>" . $room_name . " (" . $section . ")" . "</td>";
                                                    $j = $j + ($time_length - 1);
                                                }
                                            }
                                        }
                                        echo "</tr>";
                                    }
                                }
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
</div>
<!--MAIN STUDY SCHEDULE-->