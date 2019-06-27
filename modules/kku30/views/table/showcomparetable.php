<?php

use yii\helpers\Json;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ผลการเปรียบเทียบตาราง</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li><a href="comparetable">เลือกตารางเปรียบเทียบ</a></li>
        <li class="active">ผลการเปรียบเทียบตาราง</li>
    </ol>
</header>
<!--header-->
<!--MAIN COMPARE SCHEDULE-->
<input type="hidden" name="set_value_row_table" id="set_value_row_table" value="2">
<div id="show_compare_table">
    <div id="main_table_comparetable" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div id="section-to-print">
                <div class="panel-heading">
                    <span class="title elipsis">
                        <strong>ผลการเปรียบเทียบตาราง : <b style="color: #0000aa"><?=$show_value?></b><i><span
                                        id="t_table_content"></span></i>&nbsp; &nbsp;<i><span
                                        id="t_year_content"></span></i>&nbsp;  &nbsp; <i><span
                                        id="t_term_content"></span></i>&nbsp;
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
                                        $size_array = 0;
                                        if (!empty($Data_compare[$i][$j])) {
                                            $size_array = explode("/", $Data_compare[$i][$j]);
                                            ?>
                                            <td>จำนวน : <a href="#"
                                                           onclick="detailcompare(<?= $i ?>,<?= $j ?>)"><?= sizeof($size_array) ?></a>
                                            </td>
                                            <?php
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
            <!--SHOW TEACH TABLE-->
            <div class="panel-heading">
                    <span class="title elipsis">
                        <strong>รายละเอียดการเปรียบเทียบตาราง<i><span
                                        id="t_table_content"></span></i>&nbsp; &nbsp;<i><span
                                        id="t_year_content"></span></i>&nbsp;  &nbsp; <i><span
                                        id="t_term_content"></span></i>&nbsp;
                        </strong>
                    </span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="detail_table_compare"
                           style="text-align: center !important;">
                        <thead>
                        <tr bgcolor="#BBEBFF">
                            <th class="text-center">ช่วงเวลา</th>
                            <th class="text-center">ผู้เรียน / ผู้สอน</th>
                            <th class="text-center" colspan="2">รายละเอียดวิชา / section</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr></tr>
                        <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--SHOW TEACH TABLE-->
        </div>
    </div>
</div>
<script>
    function detailcompare(valuei, valuej) {
        var id_table = document.getElementById('detail_table_compare');
        var value = <?php echo Json::encode($Data_compare)?>;
        var value_subject = <?php echo Json::encode($Data_compare_subject)?>;
        var value_section = <?php echo Json::encode($Data_compare_section)?>;
        var data_timeslot = <?php echo Json::encode($Data_tiomeslot)?>;
        deleterow();
        var spilt_value = value[valuei][valuej].split("/"); //value programs / teacher
        var spilt_value1 = value_subject[valuei][valuej].split("/"); //value subject
        var spilt_value2 = value_section[valuei][valuej].split("/"); //value section
        document.getElementById('set_value_row_table').value = spilt_value.length;
        for (var i = 0; i < spilt_value.length; i++) {
            var row = id_table.insertRow(i+1);
            for (var j = 0; j < 3; j++) {
                switch (j) {
                    case 0:
                        var time_set = 0;
                        var cell = row.insertCell(j);
                        for (var time = 0; time < data_timeslot.length; time++) {
                            var spile_timeslot = data_timeslot[time]['timeslot_id'].split(",");
                            if (parseInt(spile_timeslot[0]) === parseInt(valuei) && parseInt(spile_timeslot[1]) === parseInt(valuej)) {
                                time_set = data_timeslot[time]['timeslot_day'] + " " + data_timeslot[time]['timeslot_starttime'] + "-" + data_timeslot[time]['timeslot_endtime']
                            }
                        }
                        cell.innerHTML = time_set;
                        break;
                    case 1:
                        var cell = row.insertCell(j);
                        cell.innerHTML = spilt_value[i];
                        break;
                    case 2:
                        var cell = row.insertCell(j);
                        cell.innerHTML = spilt_value1[i] + " (" + spilt_value2[i] + ")";
                        break;
                }
            }
        }
    }
    function deleterow() {
        var value_row = document.getElementById('set_value_row_table').value;
        for (var i = 1; i <= value_row; i++) {
            document.getElementById("detail_table_compare").deleteRow(1);
        }
    }
</script>
<!--MAIN COMPARE SCHEDULE-->



