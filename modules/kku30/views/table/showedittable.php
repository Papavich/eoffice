<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>

<?= $this->render('_formjs') ?>
<!--HEADER-->
<header id="page-header">
    <h1>ผลการจัดการตารางเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li><a href="createtable">จัดตารางเรียน</a></li>
        <li class="active">ผลการจัดตารางเรียน</li>
    </ol>
</header>
<!--HEADER-->
<br>
<div id="content" class="panel panel-default">
    <input type="hidden" id="setvalue_togle" name="setvalue_togle" value="CS">
    <input type="hidden" id="setvalue_room_row" name="setvalue_room_row" value="28">
    <!--MAIN STUDY SCHEDULE-->
    <div class="page-profile panel panel-default">
        <div class="row">
            <div class="tabs white nomargin-top">
                <!-- MAJOR TABS-->
                <ul class="nav nav-tabs tabs-primary">
                    <li class="active"><a id="CS" data-toggle="tab"
                                          onclick="setvalueinputhidden(this.id)"><strong>วิทยาการคอมพิวเตอร์
                                (ภาคปกติ)</strong></a></li>
                    <li><a id="CS_VIP" data-toggle="tab"
                           onclick="setvalueinputhidden(this.id)"><strong>วิทยาการคอมพิวเตอร์
                                (ภาคพิเศษ)</strong></a></li>
                    <li><a id="IT" data-toggle="tab"
                           onclick="setvalueinputhidden(this.id)"><strong>เทคโนโลยีสารสนเทศ
                                (ภาคปกติ)</strong></a></li>
                    <li><a id="IT_VIP" data-toggle="tab"
                           onclick="setvalueinputhidden(this.id)"><strong>เทคโนโลยีสารสนเทศ
                                (ภาคพิเศษ)</strong></a></li>
                    <li><a id="GIS" data-toggle="tab"
                           onclick="setvalueinputhidden(this.id)"><strong>ภูมิสารสนเทศศาสตร์
                                (ภาคปกติ)</strong></a></li>
                    <li><a id="GIS_VIP" data-toggle="tab"
                           onclick="setvalueinputhidden(this.id)"><strong>ภูมิสารสนเทศศาสตร์
                                (ภาคพิเศษ)</strong></a></li>
                </ul>
                <!-- MAJOR TABS-->
                <!-- TABS CONTENT -->
                <div class="tab-content">
                    <!-- CS -->
                    <div id="t_cs_content" class="tab-pane active">
                        <div id="#" class="tab-pane active">
                            <div id="content" class="padding-20">
                                <div id="panel-1" class="panel panel-default">
                                    <div id="section-to-print">
                                        <!-- HEADER -->
                                        <div class="panel-heading">
							                <span class="title elipsis">
                                               <div align="left" style="display: inline-block !important;"><strong
                                                           id="head_table">สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ <?= $subopen_semester ?>
                                                       ประจำปีการศึกษาที่ <?= $subopen_year ?></strong>
                                               </div>
							                </span>
                                        </div>
                                        <select onchange="changetimetableprograms()" name="select_stdyear"
                                                id="select_stdyear"
                                                class="form-control pointer required valid inline-block"
                                                style="width: 30% !important;">
                                            <option value="1" selected="selected">ชั้นปีที่ 1</option>
                                            <option value="2">ชั้นปีที่ 2</option>
                                            <option value="3">ชั้นปีที่ 3</option>
                                            <option value="4">ชั้นปีที่ 4</option>
                                        </select>
                                        <!-- HEADER -->
                                        <?= $this->render('_formtimeedit', [
                                            'subopen_year' => $subopen_year,
                                            'subopen_semester' => $subopen_semester
                                        ]) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--  bottom -->
                <div class="tab-content">
                    <div id="t_cs_content" class="tab-pane active">
                        <div id="#" class="tab-pane active">
                            <div id="content" class="padding-20">
                                <div id="panel-1" class="panel panel-default">
                                    <!-- bottom  -->

                                    <!-- bottom  -->
                                </div>
                                <div id="panel-1" class="panel panel-default">
                                    <!-- bottom  -->

                                    <!-- bottom  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  bottom -->
                <!-- TABS CONTENT -->
            </div>
        </div>
    </div>
</div>
<!--MAIN STUDY SCHEDULE-->
<!--TEACHER TABLE-->
<div id="#" class="col-md-6 col-sm-6" style="display: block;">
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
            <span class="title elipsis">
                <strong>ตารางการสอนของ : </strong> <!-- panel title -->
                <select onchange="changeteachtable()" name="select_teacher" id="select_teacher"
                        class="form-control pointer required valid inline-block"
                        style="width: 30% !important;">
                        <option disabled="disabled" selected="selected">--- อาจารย์ผู้สอน ---</option>
                    <?php
                    foreach ($data_teacher as $row) {
                        ?>
                        <option value="<?= $row['teacher_no'] ?>"><?= $row['teacher_prefix'] ?><?= $row['teacher_name'] ?> <?= $row['teacher_surname'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </span>
        </div>
        <div class="panel-body">
            <!-- TEACH TABLE  -->
            <?= $this->render('_formtableteachedit', [
                'subopen_year' => $subopen_year,
                'subopen_semester' => $subopen_semester
            ]) ?>
            <!-- TEACH TABLE  -->
        </div>
    </div>
</div>
<!--TEACHER TABLE-->
<!--ROOM SCHEDULE-->
<div id="#" class="col-md-6 col-sm-6" style="display: block;">
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
            <span class="title elipsis">
                <strong>ตารางการใช้ห้องเรียน : </strong>
                <select onchange="changeTableRoomedit()" name="select_room" id="select_room"
                        class="form-control pointer required valid inline-block"
                        style="width: 30% !important;">
                        <option disabled="disabled" selected="selected">--- ห้องเรียน ---</option>
                    <?php
                    foreach ($data_room as $row) {
                        ?>
                        <option value="<?= $row['room_id'] ?>"><?= $row['room_name'] ?> (<?= $row['room_seat'] ?>
                            )</option>
                        <?php
                    }
                    ?>
                </select>
            </span>
        </div>
        <div class="panel-body">
            <!-- ROOM TABLE  -->
            <?= $this->render('_formtableroomedit', []) ?>
            <!-- ROOM TABLE  -->
        </div>
    </div>
</div>

<script>
    var Room = <?php echo Json::encode($Room)?>;
    var year = <?php echo Json::encode($subopen_year)?>;
    var semester = <?php echo Json::encode($subopen_semester)?>;

    var program_CS_1 = <?php echo Json::encode($program_CS_1)?>;
    var program_CS_2 = <?php echo Json::encode($program_CS_2)?>;
    var program_CS_3 = <?php echo Json::encode($program_CS_3)?>;
    var program_CS_4 = <?php echo Json::encode($program_CS_4)?>;

    var program_CS2_1 = <?php echo Json::encode($program_CS2_1)?>;
    var program_CS2_2 = <?php echo Json::encode($program_CS2_2)?>;
    var program_CS2_3 = <?php echo Json::encode($program_CS2_3)?>;
    var program_CS2_4 = <?php echo Json::encode($program_CS2_4)?>;

    var program_IT_1 = <?php echo Json::encode($program_IT_1)?>;
    var program_IT_2 = <?php echo Json::encode($program_IT_2)?>;
    var program_IT_3 = <?php echo Json::encode($program_IT_3)?>;
    var program_IT_4 = <?php echo Json::encode($program_IT_4)?>;

    var program_IT2_1 = <?php echo Json::encode($program_IT2_1)?>;
    var program_IT2_2 = <?php echo Json::encode($program_IT2_2)?>;
    var program_IT2_3 = <?php echo Json::encode($program_IT2_3)?>;
    var program_IT2_4 = <?php echo Json::encode($program_IT2_4)?>;

    var program_GIS_1 = <?php echo Json::encode($program_GIS_1)?>;
    var program_GIS_2 = <?php echo Json::encode($program_GIS_2)?>;
    var program_GIS_3 = <?php echo Json::encode($program_GIS_3)?>;
    var program_GIS_4 = <?php echo Json::encode($program_GIS_4)?>;

    var program_GIS2_1 = <?php echo Json::encode($program_GIS2_1)?>;
    var program_GIS2_2 = <?php echo Json::encode($program_GIS2_2)?>;
    var program_GIS2_3 = <?php echo Json::encode($program_GIS2_3)?>;
    var program_GIS2_4 = <?php echo Json::encode($program_GIS2_4)?>;
    var data_timeslot =<?php echo Json::encode($data_timeslot)?>;

    var success = <?php echo Json::encode($sucess)?>;
    if (success.length !== 0) {
        if (parseInt(success) === 1) {
            var type_edit = <?php echo Json::encode($type_edit)?>;
            if (type_edit === "S_EDIT") {
                alert("สามารถลงได้ในช่วงเวลานี้");
                var tag_hidden = document.getElementById('setvalue_togle');
                tag_hidden.value = <?php echo Json::encode($programs_id)?>;
                document.getElementById('select_stdyear').value = <?php echo Json::encode($student_year)?>;
                changetimetableprograms();
                document.getElementById('save_ij_start').value = <?php echo Json::encode($save_ij_start)?>;
                document.getElementById('save_ij_end').value = <?php echo Json::encode($save_ij_end)?>;
                document.getElementById('room_id').value = <?php echo Json::encode($Room_id)?>;
                document.getElementById('programs_id').value = <?php echo Json::encode($programs_id)?>;
                document.getElementById('student_year').value = <?php echo Json::encode($student_year)?>;
                document.getElementById('hidden_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('hidden_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('submit_button').disabled = false;
                var data_blank = <?php echo Json::encode($Data_blank)?>;
                for (var i = 0; i < 7; i++) {
                    if (typeof data_blank[i] !== 'undefined' && data_blank[i] !== null && data_blank[i].length !== 0) {
                        for (var j = 0; j < 24; j++) {
                            if (typeof data_blank[i][j] !== 'undefined' && data_blank[i][j] !== null && data_blank[i][j].length !== 0) {
                                var ID_tag = "S," + i + "," + j;
                                if (document.getElementById(ID_tag)) {
                                    document.getElementById(ID_tag).style.backgroundColor = "red";
                                }
                            } else {
                                var ID_tag = "S," + i + "," + j;
                                document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                            }
                        }
                    } else {
                        for (var j = 0; j < 24; j++) {
                            var ID_tag = "S," + i + "," + j;
                            document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                        }
                    }

                }
                var head_table = document.getElementById('head_table');
                var program_id = <?php echo Json::encode($programs_id)?>;
                switch (program_id) {
                    case "CS":
                        head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "CS_VIP":
                        head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "IT":
                        head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "IT_VIP":
                        head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "GIS":
                        head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "GIS_VIP":
                        head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    default:
                        break;
                }
            } else if (type_edit === "CO-EDIT-ST") {
                alert("บันทึกข้อมูลเสร็จสิ้น");
                var tag_hidden = document.getElementById('setvalue_togle');
                tag_hidden.value = <?php echo Json::encode($programs_id)?>;
                document.getElementById('select_stdyear').value = <?php echo Json::encode($student_year)?>;
                changetimetableprograms();
                document.getElementById('submit_button').disabled = true;
            } else if (type_edit === "T_EDIT") {
                alert("สามารถลงได้ในช่วงเวลานี้");
                document.getElementById('select_teacher').value = <?php echo Json::encode($Teacher_id)?>;
                document.getElementById('Teacher_id').value = <?php echo Json::encode($Teacher_id)?>;
                changeteachtable();
                document.getElementById('T_save_ij_start').value = <?php echo Json::encode($save_ij_start)?>;
                document.getElementById('T_save_ij_end').value = <?php echo Json::encode($save_ij_end)?>;
                document.getElementById('T_room_id').value = <?php echo Json::encode($Room_id)?>;
                document.getElementById('T_hidden_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('T_hidden_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('T_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('T_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('T_submit_button').disabled = false;
                document.getElementById('T_check_button').disabled = false;
                var data_blank = <?php echo Json::encode($Data_blank)?>;
                for (var i = 0; i < 7; i++) {
                    if (typeof data_blank[i] !== 'undefined' && data_blank[i] !== null && data_blank[i].length !== 0) {
                        for (var j = 0; j < 24; j++) {
                            if (typeof data_blank[i][j] !== 'undefined' && data_blank[i][j] !== null && data_blank[i][j].length !== 0) {
                                var ID_tag = i + "," + j;
                                if (document.getElementById(ID_tag)) {
                                    document.getElementById(ID_tag).style.backgroundColor = "red";
                                }
                            } else {
                                var ID_tag = i + "," + j;
                                document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                            }
                        }
                    } else {
                        for (var j = 0; j < 24; j++) {
                            var ID_tag = i + "," + j;
                            document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                        }
                    }

                }
            } else if (type_edit === "CO_T_EDIT") {
                alert("บันทึกข้อมูลเสร็จสิ้น");
                var tag_select_teacher = document.getElementById('select_teacher');
                tag_select_teacher.value = <?php echo Json::encode($Teacher_id)?>;
                changeteachtable();
                document.getElementById('submit_button').disabled = true;
            }
        } else {
            var type_edit = <?php echo Json::encode($type_edit)?>;
            if (type_edit === "S_EDIT") {
                alert("ไม่สามารถลงได้ในช่่วงเวลานี้");
                var tag_hidden = document.getElementById('setvalue_togle');
                tag_hidden.value = <?php echo Json::encode($programs_id)?>;
                document.getElementById('select_stdyear').value = <?php echo Json::encode($student_year)?>;
                changetimetableprograms();
                document.getElementById('save_ij_start').value = <?php echo Json::encode($save_ij_start)?>;
                document.getElementById('save_ij_end').value = <?php echo Json::encode($save_ij_end)?>;
                document.getElementById('room_id').value = <?php echo Json::encode($Room_id)?>;
                document.getElementById('programs_id').value = <?php echo Json::encode($programs_id)?>;
                document.getElementById('student_year').value = <?php echo Json::encode($student_year)?>;
                document.getElementById('hidden_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('hidden_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                var data_blank = <?php echo Json::encode($Data_blank)?>;
                for (var i = 0; i < 7; i++) {
                    if (typeof data_blank[i] !== 'undefined' && data_blank[i] !== null && data_blank[i].length !== 0) {
                        for (var j = 0; j < 24; j++) {
                            if (typeof data_blank[i][j] !== 'undefined' && data_blank[i][j] !== null && data_blank[i][j].length !== 0) {
                                var ID_tag = "S," + i + "," + j;
                                if (document.getElementById(ID_tag)) {
                                    document.getElementById(ID_tag).style.backgroundColor = "red";
                                }
                            } else {
                                var ID_tag = "S," + i + "," + j;
                                document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                            }
                        }
                    } else {
                        for (var j = 0; j < 24; j++) {
                            var ID_tag = "S," + i + "," + j;
                            document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                        }
                    }
                }
                var head_table = document.getElementById('head_table');
                var program_id = <?php echo Json::encode($programs_id)?>;
                switch (program_id) {
                    case "CS":
                        head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "CS_VIP":
                        head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "IT":
                        head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "IT_VIP":
                        head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "GIS":
                        head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    case "GIS_VIP":
                        head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                        break;
                    default:
                        break;
                }
            } else if (type_edit === "T_EDIT") {
                alert("ไม่สามารถลงได้ในช่่วงเวลานี้");
                document.getElementById('select_teacher').value = <?php echo Json::encode($Teacher_id)?>;
                document.getElementById('Teacher_id').value = <?php echo Json::encode($Teacher_id)?>;
                changeteachtable();
                document.getElementById('T_save_ij_start').value = <?php echo Json::encode($save_ij_start)?>;
                document.getElementById('T_save_ij_end').value = <?php echo Json::encode($save_ij_end)?>;
                document.getElementById('T_room_id').value = <?php echo Json::encode($Room_id)?>;
                document.getElementById('T_hidden_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('T_hidden_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('T_start_edit_time_table').value = <?php echo Json::encode($hidden_start_edit_time_table)?>;
                document.getElementById('T_end_edit_time_table').value = <?php echo Json::encode($hidden_end_edit_time_table)?>;
                document.getElementById('T_check_button').disabled = false;
                var data_blank = <?php echo Json::encode($Data_blank)?>;
                for (var i = 0; i < 7; i++) {
                    if (typeof data_blank[i] !== 'undefined' && data_blank[i] !== null && data_blank[i].length !== 0) {
                        for (var j = 0; j < 24; j++) {
                            if (typeof data_blank[i][j] !== 'undefined' && data_blank[i][j] !== null && data_blank[i][j].length !== 0) {
                                var ID_tag = i + "," + j;
                                if (document.getElementById(ID_tag)) {
                                    document.getElementById(ID_tag).style.backgroundColor = "red";
                                }
                            } else {
                                var ID_tag = i + "," + j;
                                document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                            }
                        }
                    } else {
                        for (var j = 0; j < 24; j++) {
                            var ID_tag = i + "," + j;
                            document.getElementById(ID_tag).style.backgroundColor = "#39e600";
                        }
                    }

                }
            }
        }
    }

    function setvalueinputhidden(id) {
        var tag_hidden = document.getElementById('setvalue_togle');
        var tag_hidden_program_id = document.getElementById('programs_id');
        document.getElementById('submit_button').disabled = true;
        tag_hidden.value = id;
        tag_hidden_program_id.value = id;
        var head_table = document.getElementById('head_table');
        switch (id) {
            case "CS":
                head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            case "CS_VIP":
                head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            case "IT":
                head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            case "IT_VIP":
                head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            case "GIS":
                head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(ปกติ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            case "GIS_VIP":
                head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(พิเศษ) เทอมที่ " + <?= $subopen_semester ?> +" ปีการศึกษา " + <?=$subopen_year?>;
                break;
            default:
                break;
        }

    }
</script>
<!--ROOM SCHEDULE-->
