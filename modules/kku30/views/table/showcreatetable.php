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
    <input type="hidden" id="setvalue_model" name="setvalue_model" value="1">
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
                    <div id="t_cs_content" class="tab-pane active">
                        <div id="#" class="tab-pane active">
                            <div id="content" class="padding-20">
                                <div id="panel-1" class="panel panel-default">
                                    <div id="section-to-print">
                                        <!-- HEADER -->
                                        <div class="panel-heading">
							                <span class="title elipsis">
                                               <div align="left" style="display: inline-block !important;"><strong
                                                           id="head_table">สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ <?= $semester ?>
                                                       ประจำปีการศึกษาที่ <?= $year_of ?></strong>
                                               </div>
							                </span>
                                        </div>
                                        <select onchange="changeTimetable()" name="select_stdyear"
                                                id="select_stdyear"
                                                class="form-control pointer required valid inline-block"
                                                style="width: 30% !important;">
                                            <option value="1" selected="selected">ชั้นปีที่ 1</option>
                                            <option value="2">ชั้นปีที่ 2</option>
                                            <option value="3">ชั้นปีที่ 3</option>
                                            <option value="4">ชั้นปีที่ 4</option>
                                        </select>
                                        <!-- HEADER -->

                                        <?= $this->render('_formtable', [
                                            'Data_real_subject_group' => $Data_real_subject_group,
                                            'Data_room' => $Data_room
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
                                    <?= $this->render('_formdetailmodel', [
                                        'Data_room' => $Data_room
                                    ]) ?>
                                    <!-- bottom  -->
                                </div>
                                <div id="panel-1" class="panel panel-default">
                                    <!-- bottom  -->
                                    <?= $this->render('_formbottom', [
                                        'semester' => $semester,
                                        'year_of' => $year_of,
                                        'Data_room' => $Data_room
                                    ]) ?>
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
                <select onchange="changetableTeacher()" name="select_teacher" id="select_teacher"
                        class="form-control pointer required valid inline-block"
                        style="width: 30% !important;">
                        <option disabled="disabled" selected="selected">--- อาจารย์ผู้สอน ---</option>
                    <?php
                    foreach ($Data_teacher as $row) {
                        ?>
                        <option value="<?= $row['teacher_no'] ?>"><b><?= $row['teacher_prefix'] ?><?= $row['teacher_name'] ?> <?= $row['teacher_surname'] ?></b></option>
                        <?php
                    }
                    ?>
                </select>
            </span>
        </div>
        <div class="panel-body">
            <!-- TEACH TABLE  -->
            <?= $this->render('_formshowtableteacher', [
                'Data_real_subject_group' => $Data_real_subject_group,
                'Data_room' => $Data_room,
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
                <select onchange="changetableRoom()" name="select_room" id="select_room"
                        class="form-control pointer required valid inline-block"
                        style="width: 30% !important;">
                        <option disabled="disabled" selected="selected">--- ห้องเรียน ---</option>
                    <?php foreach ($Data_room as $row) {
                        ?>
                        <option value="<?= $row['room_id'] ?>"><b><?= $row['room_name'] ?> (<?= $row['room_seat'] ?>
                                )</b></option>
                        <?php
                    }
                    ?>
                </select>
            </span>
        </div>
        <div class="panel-body">
            <!-- ROOM TABLE  -->
            <?= $this->render('_formshowtableroom', [
                'Data_room' => $Data_room,
                'Data_real_subject_group' => $Data_real_subject_group,
            ]) ?>
            <!-- ROOM TABLE  -->
        </div>
    </div>
</div>
<!--ROOM SCHEDULE-->
<script>
    var save_room = <?php echo Json::encode($Room)?>;
    var save_room_1 = <?php echo Json::encode($Room_1)?>;
    var save_room_2 = <?php echo Json::encode($Room_2)?>;
    var save_room_3 = <?php echo Json::encode($Room_3)?>;
    var save_room_4 = <?php echo Json::encode($Room_4)?>;
    var save_room_5 = <?php echo Json::encode($Room_5)?>;

    var save_teacher = <?php echo Json::encode($Teacher)?>;
    var save_teacher_1 = <?php echo Json::encode($Teacher_1)?>;
    var save_teacher_2 = <?php echo Json::encode($Teacher_2)?>;
    var save_teacher_3 = <?php echo Json::encode($Teacher_3)?>;
    var save_teacher_4 = <?php echo Json::encode($Teacher_4)?>;
    var save_teacher_5 = <?php echo Json::encode($Teacher_5)?>;

    var save_programs_cs = <?php echo Json::encode($program_CS)?>;
    var save_programs_cs_1 = <?php echo Json::encode($program_CS_1)?>;
    var save_programs_cs_2 = <?php echo Json::encode($program_CS_2)?>;
    var save_programs_cs_3 = <?php echo Json::encode($program_CS_3)?>;
    var save_programs_cs_4 = <?php echo Json::encode($program_CS_4)?>;
    var save_programs_cs_5 = <?php echo Json::encode($program_CS_5)?>;

    var save_programs_cs2 = <?php echo Json::encode($program_CS2)?>;
    var save_programs_cs2_1 = <?php echo Json::encode($program_CS2_1)?>;
    var save_programs_cs2_2 = <?php echo Json::encode($program_CS2_2)?>;
    var save_programs_cs2_3 = <?php echo Json::encode($program_CS2_3)?>;
    var save_programs_cs2_4 = <?php echo Json::encode($program_CS2_4)?>;
    var save_programs_cs2_5 = <?php echo Json::encode($program_CS2_5)?>;

    var save_programs_it = <?php echo Json::encode($program_IT)?>;
    var save_programs_it_1 = <?php echo Json::encode($program_IT_1)?>;
    var save_programs_it_2 = <?php echo Json::encode($program_IT_2)?>;
    var save_programs_it_3 = <?php echo Json::encode($program_IT_3)?>;
    var save_programs_it_4 = <?php echo Json::encode($program_IT_4)?>;
    var save_programs_it_5 = <?php echo Json::encode($program_IT_5)?>;

    var save_programs_it2 = <?php echo Json::encode($program_IT2)?>;
    var save_programs_it2_1 = <?php echo Json::encode($program_IT2_1)?>;
    var save_programs_it2_2 = <?php echo Json::encode($program_IT2_2)?>;
    var save_programs_it2_3 = <?php echo Json::encode($program_IT2_3)?>;
    var save_programs_it2_4 = <?php echo Json::encode($program_IT2_4)?>;
    var save_programs_it2_5 = <?php echo Json::encode($program_IT2_5)?>;

    var save_programs_gis = <?php echo Json::encode($program_GIS)?>;
    var save_programs_gis_1 = <?php echo Json::encode($program_GIS_1)?>;
    var save_programs_gis_2 = <?php echo Json::encode($program_GIS_2)?>;
    var save_programs_gis_3 = <?php echo Json::encode($program_GIS_3)?>;
    var save_programs_gis_4 = <?php echo Json::encode($program_GIS_4)?>;
    var save_programs_gis_5 = <?php echo Json::encode($program_GIS_5)?>;

    var save_programs_gis2 = <?php echo Json::encode($program_GIS2)?>;
    var save_programs_gis2_1 = <?php echo Json::encode($program_GIS2_1)?>;
    var save_programs_gis2_2 = <?php echo Json::encode($program_GIS2_2)?>;
    var save_programs_gis2_3 = <?php echo Json::encode($program_GIS2_3)?>;
    var save_programs_gis2_4 = <?php echo Json::encode($program_GIS2_4)?>;
    var save_programs_gis2_5 = <?php echo Json::encode($program_GIS2_5)?>;

    var save_timeslot = <?php echo Json::encode($Data_timeslot)?>;

    function setvalueinputhidden(id) {
        var tag_hidden = document.getElementById('setvalue_togle');
        tag_hidden.value = id;
        var head_table = document.getElementById('head_table');
        switch (id) {
            case "CS":
                head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(ปกติ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            case "CS_VIP":
                head_table.innerHTML = "สาขาวิทยาการคอมพิวเตอร์(พิเศษ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            case "IT":
                head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(ปกติ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            case "IT_VIP":
                head_table.innerHTML = "สาขาเทคโนโลยีสารสนเทศ(พิเศษ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            case "GIS":
                head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(ปกติ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            case "GIS_VIP":
                head_table.innerHTML = "สาขาภูมิสารสนเทศศาสตร์(พิเศษ) เทอมที่ " + <?= $semester ?> +" ปีการศึกษา " + <?=$year_of?>;
                break;
            default:
                break;
        }

    }

    function setvaluetagmodel(value_tag) {
        var id_tag_set = document.getElementById("setvalue_model");
        var id_div_sumary = document.getElementById("div_sumary_model");
        var value_row = document.getElementById("setvalue_room_row").value;
        var id_table_suamry = document.getElementById("table_sumary_model");
        var id_checked_tag_sumary = document.getElementById("sumary_show");
        var count_row_table_sumary = id_table_suamry.rows.length;
        id_tag_set.value = value_tag;
        var summary_table = 0;
        alert("รูปแบบที่ " + document.getElementById("setvalue_model").value);
        changetableRoom();
        changetableTeacher();
        changeTimetable();
        var id_start_edit = document.getElementById('start_edit_time_table');
        id_start_edit.value = null;
        var id_end_edit = document.getElementById('end_edit_time_table');
        id_start_edit.value = null;
        var id_start_edit = document.getElementById('save_ij_start');
        id_start_edit.value = null;
        var id_end_edit = document.getElementById('save_ij_end');
        id_start_edit.value = null;
        document.getElementById("check_edit").value = 0;
        id_div_sumary.style.display = "none";
        id_checked_tag_sumary.checked = false;
        if (count_row_table_sumary > 2) {
            for (var i = 0; i < count_row_table_sumary - 1; i++) {
                id_table_suamry.deleteRow(2);
            }
        }

    }
</script>
<!--ROOM SCHEDULE-->
