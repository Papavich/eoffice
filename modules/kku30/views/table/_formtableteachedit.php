<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table_teacher_edit"
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
            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Monday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Tuesday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Wednesday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Thursday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Friday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Saturday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr class="odd gradeX">
                <td bgcolor="#D9F3FF">
                    Sunday
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            </tbody>
        </table>
        <div id="panel-1" class="panel panel-default">
            <div class="form-group">
                <label class="control-label">เคลื่อนย้ายจากตำแหน่ง : </label>
                <input type="text" id="T_start_edit_time_table" class="form-control" name="T_start_edit_time_table" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">ไปยังตำแหน่ง : </label>
                <input type="text" id="T_end_edit_time_table" class="form-control" name="T_end_edit_time_table" readonly>
            </div>
            <button id="T_submit_button" type="button" class="btn btn-3d btn-green" onclick="T_AjaxUpdate();" disabled>
                บันทึกการแก้ไข
            </button>
            <input type="hidden" id="T_check_edit" name="T_check_edit" value="0">
            <input type="hidden" id="T_room_id" name="T_room_id" value="">

            <?php $form = ActiveForm::begin(['action' => ['checkedittable']]) ?>
            <input type="hidden" id="type_edit" name="type_edit" value="T_EDIT">
            <input type="hidden" id="subopen_year" name="subopen_year" value="<?= $subopen_year ?>">
            <input type="hidden" id="subopen_semester" name="subopen_semester" value="<?= $subopen_semester ?>">
            <input type="hidden" id="T_save_ij_start" name="T_save_ij_start" value="">
            <input type="hidden" id="T_save_ij_end" name="T_save_ij_end" value="">
            <input type="hidden" id="Teacher_id" name="Teacher_id" value="">
            <input type="hidden" id="T_hidden_start_edit_time_table" name="T_hidden_start_edit_time_table" value="">
            <input type="hidden" id="T_hidden_end_edit_time_table" name="T_hidden_end_edit_time_table" value="">
            <button type="submit" id="T_check_button" class="btn btn-3d btn-green" disabled>
                เช็คการเคลื่อนย้าย
            </button>
            <?php $form = ActiveForm::end(); ?>

            <button type="button" class="btn btn-3d btn-red" onclick="clear_Tdata()">ลบตำแหน่งการเคลื่อนย้าย</button>
            <!-- bottom  -->
        </div>
    </div>
</div>


<script>
    function changeteachtable() {
        var value_teacher = document.getElementById('select_teacher').value;
        clear_Tdata();
        deleterowtableteacher();
        for (var i = 6; i > -1; i--) { //Loop ตำแหน่ง i ตัวแรก
            switch (i) {
                case 6:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Sunday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 5:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Saturday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 4:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Friday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 3:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Thursday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 2:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Wednesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 1:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Tuesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 0:
                    var table = document.getElementById("table_teacher_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Monday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                default:
                    break;
            }
            var sum_col = 0;
            for (var j = 0; j < 24; j++) {
                var check = 0;
                for (var count_room = 0; count_room < Room.length; count_room++) {
                    var spilt_value = Room[count_room]['timeslot_id'].split(",");
                    for (var c1 = 0; c1 < Room[count_room]['teacher_detail'].length; c1++) {
                        for (var c2 = 0; c2 < Room[count_room]['teacher_detail'][c1]['subject_detail'].length; c2++) {
                            if (parseInt(spilt_value[0]) === i && parseInt(spilt_value[1]) === j && parseInt(Room[count_room]['teacher_detail'][c1]['subject_detail'][c2]['teacher_no']) === parseInt(value_teacher)) {
                                var cell = row.insertCell((j + 1) - sum_col);
                                var subject_id = Room[count_room]['subject_detail'][0]['subject_detail'][0]['subject_id'];
                                var section_sum = 0;
                                for (var secrion_r = 0; secrion_r < Room[count_room]['section_detail'].length; secrion_r++) {
                                    if (section_sum === 0) {
                                        section_sum = Room[count_room]['section_detail'][secrion_r]['section_no'];
                                    } else {
                                        section_sum = section_sum + "," + Room[count_room]['section_detail'][secrion_r]['section_no'];
                                    }
                                }
                                cell.innerHTML = subject_id + "<br>" + "(" + section_sum + ") " + Room[count_room]['room_detail'][0]['room_name'];
                                cell.colSpan = parseInt(Room[count_room]['timeslot_lenght']);
                                var id = i + "," + j + "," + Room[count_room]['group_no'] + "," + subject_id;
                                cell.setAttribute("id", id);
                                cell.setAttribute('onclick', 'checktableteacher(this.id);');
                                j = j + (parseInt(Room[count_room]['timeslot_lenght']) - 1);
                                sum_col = sum_col + (parseInt(Room[count_room]['timeslot_lenght']) - 1);
                                check = 1;
                            }
                        }
                    }
                }
                if (check === 0) {
                    var Position_j = ((j + 1) - sum_col);
                    var cell = row.insertCell(Position_j);
                    var id = i + "," + j;
                    cell.setAttribute("id", id);
                    cell.setAttribute('onclick', 'checktableteacher(this.id);');
                }
            }
        }
    }

    function deleterowtableteacher() {
        for (var i = 1; i <= 7; i++) {
            document.getElementById("table_teacher_edit").deleteRow(1);
        }
    }
    
    function checktableteacher(id) {
        var value_spilt = id.split(",");
        var id_tag_end = document.getElementById("T_end_edit_time_table");
        var id_tag_start = document.getElementById("T_start_edit_time_table");
        var id_hidden_tag_end = document.getElementById("T_hidden_end_edit_time_table");
        var id_hidden_tag_start = document.getElementById("T_hidden_start_edit_time_table");
        var id_tag_hidden_end = document.getElementById("T_save_ij_end");
        var id_tag_hidden_start = document.getElementById("T_save_ij_start");
        var id_hidden_check = document.getElementById("T_check_edit");
        var id_submit_button = document.getElementById("T_submit_button");
        var id_check_button = document.getElementById("T_check_button");
        var id_room_id = document.getElementById("T_room_id");
        var value_teacher_id = document.getElementById("select_teacher").value;
        document.getElementById("Teacher_id").value = value_teacher_id;
        if (value_spilt.length === 2) {
            id_hidden_check.value = 0;
            for (var i = 0; i < data_timeslot.length; i++) {
                var spilt_timeslot = data_timeslot[i]['timeslot_id'].split(",");
                if (spilt_timeslot[0] === value_spilt[0] && spilt_timeslot[1] === value_spilt[1]) {
                    id_tag_hidden_end.value = id;
                    var value_show = data_timeslot[i]['timeslot_day'] + " - " + data_timeslot[i]['timeslot_starttime'];
                    id_hidden_tag_end.value = value_show;
                    id_tag_end.value = value_show;
                    i = data_timeslot.length;
                }
            }
        } else if (value_spilt.length === 4) {
            id_hidden_check.value = 0;
            for (var i = 0; i < data_timeslot.length; i++) {
                var spilt_timeslot = data_timeslot[i]['timeslot_id'].split(",");
                if (spilt_timeslot[0] === value_spilt[0] && spilt_timeslot[1] === value_spilt[1]) {
                    id_tag_hidden_start.value = id;
                    var value_show = value_spilt[3] + " - " + data_timeslot[i]['timeslot_day'] + " - " + data_timeslot[i]['timeslot_starttime'];
                    id_hidden_tag_start.value = value_show;
                    id_tag_start.value = value_show;
                    i = data_timeslot.length;
                }
            }
        }
        id_room_id.value = "";
        if (id_tag_hidden_end.value.length !== 0 && id_tag_hidden_start.value.length !== 0) {
            id_check_button.disabled = false;
        } else {
            id_check_button.disabled = true;
        }
        id_submit_button.disabled = true;
    }

    function clear_Tdata() {
        var id_tag_end = document.getElementById("T_end_edit_time_table");
        var id_tag_start = document.getElementById("T_start_edit_time_table");
        var id_tag_hidden_end = document.getElementById("T_save_ij_end");
        var id_tag_hidden_start = document.getElementById("T_save_ij_start");
        var id_hidden_check = document.getElementById("T_check_edit");
        var id_submit_button = document.getElementById("T_submit_button");
        var id_check_button = document.getElementById("T_check_button");
        var id_room_id = document.getElementById("T_room_id");
        id_room_id.value = "";
        id_check_button.disabled = true;
        id_submit_button.disabled = true;
        id_tag_end.value = "";
        id_tag_start.value = "";
        id_tag_hidden_end.value = "";
        id_tag_hidden_start.value = "";
        id_hidden_check.value = "0";
    }
    
    function T_AjaxUpdate() {
        var value_room_id = document.getElementById("T_room_id").value;
        var value_tag_start = document.getElementById("T_save_ij_start").value;
        var value_tag_end = document.getElementById("T_save_ij_end").value;
        var value_teacher_id = document.getElementById("Teacher_id").value;
        var value_split = value_tag_start.split(",");
        var group_no = value_split[2];
        var start = value_split[0] + "," + value_split[1];

        $.ajax({
            url: 'ajax-update-timeslot',
            type: 'POST',
            data: {
                room_id: value_room_id,
                group_no: group_no,
                start: start,
                end: value_tag_end
            },
            success: function (data) {
                window.location.href = "showedittable?type_edit=CO_T_EDIT&subopen_year=<?=$subopen_year?>&subopen_semester=<?= $subopen_semester ?>&teacher_id=" + value_teacher_id + "&sucess=1";
            }
        })
    }
</script>
