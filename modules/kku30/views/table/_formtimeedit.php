<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;
use kartik\widgets\Select2;

?>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="timetable_edit"
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
                <td rowspan="4" bgcolor="#D9F3FF">
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
            <tr class="odd gradeX">
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
                <input type="text" id="start_edit_time_table" class="form-control" name="start_edit_time_table" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">ไปยังตำแหน่ง : </label>
                <input type="text" id="end_edit_time_table" class="form-control" name="end_edit_time_table" readonly>
            </div>
            <button id="submit_button" type="button" class="btn btn-3d btn-green" onclick="AjaxUpdate();" disabled>
                บันทึกการแก้ไข
            </button>
            <input type="hidden" id="check_edit" name="check_edit" value="0">
            <input type="hidden" id="room_id" name="room_id" value="">

            <?php $form = ActiveForm::begin(['action' => ['checkedittable']]) ?>
            <input type="hidden" id="type_edit" name="type_edit" value="S_EDIT">
            <input type="hidden" id="subopen_year" name="subopen_year" value="<?= $subopen_year ?>">
            <input type="hidden" id="subopen_semester" name="subopen_semester" value="<?= $subopen_semester ?>">
            <input type="hidden" id="save_ij_start" name="save_ij_start" value="">
            <input type="hidden" id="save_ij_end" name="save_ij_end" value="">
            <input type="hidden" id="programs_id" name="programs_id" value="CS">
            <input type="hidden" id="student_year" name="student_year" value="">
            <input type="hidden" id="hidden_start_edit_time_table" name="hidden_start_edit_time_table" value="">
            <input type="hidden" id="hidden_end_edit_time_table" name="hidden_end_edit_time_table" value="">
            <button id="check_button" type="submit" class="btn btn-3d btn-green" disabled>
                เช็คการเคลื่อนย้าย
            </button>
            <?php $form = ActiveForm::end(); ?>

            <button type="button" class="btn btn-3d btn-red" onclick="clear_data()">ลบตำแหน่งการเคลื่อนย้าย</button>
            <!-- bottom  -->
        </div>
    </div>
</div>

<script>
    function AjaxUpdate() {
        var value_room_id = document.getElementById("room_id").value;
        var value_tag_start = document.getElementById("save_ij_start").value;
        var value_tag_end = document.getElementById("save_ij_end").value;
        var value_student_year = document.getElementById("student_year").value;
        var value_program_id = document.getElementById("programs_id").value;
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
                window.location.href = "showedittable?type_edit=CO-EDIT-ST&subopen_year=<?=$subopen_year?>&subopen_semester=<?= $subopen_semester ?>&programs_id=" + value_program_id + "&student_year=" + value_student_year
                    + "&sucess=1";
            }
        })
    }

    function changetimetableprograms() {
        var value_row = document.getElementById('setvalue_room_row').value;
        var value_in_togel = document.getElementById('setvalue_togle').value;
        var value_std = document.getElementById('select_stdyear').value;
        document.getElementById('submit_button').disabled = true;
        clear_data();
        var program = 0;
        var cell_table = 0;
        switch (value_in_togel) {
            case "CS":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_CS_1;
                        break;
                    case 2:
                        program = program_CS_2;
                        break;
                    case 3:
                        program = program_CS_3;
                        break;
                    case 4:
                        program = program_CS_4;
                        break;
                }
                break;
            case "CS_VIP":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_CS2_1;
                        break;
                    case 2:
                        program = program_CS2_2;
                        break;
                    case 3:
                        program = program_CS2_3;
                        break;
                    case 4:
                        program = program_CS2_4;
                        break;
                }
                break;
            case "IT":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_IT_1;
                        break;
                    case 2:
                        program = program_IT_2;
                        break;
                    case 3:
                        program = program_IT_3;
                        break;
                    case 4:
                        program = program_IT_4;
                        break;
                }
                break;
            case "IT_VIP":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_IT2_1;
                        break;
                    case 2:
                        program = program_IT2_2;
                        break;
                    case 3:
                        program = program_IT2_3;
                        break;
                    case 4:
                        program = program_IT2_4;
                        break;
                }
                break;
            case "GIS":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_GIS_1;
                        break;
                    case 2:
                        program = program_GIS_2;
                        break;
                    case 3:
                        program = program_GIS_3;
                        break;
                    case 4:
                        program = program_GIS_4;
                        break;
                }
                break;
            case "GIS_VIP":
                switch (parseInt(value_std)) {
                    case 1:
                        program = program_GIS2_1;
                        break;
                    case 2:
                        program = program_GIS2_2;
                        break;
                    case 3:
                        program = program_GIS2_3;
                        break;
                    case 4:
                        program = program_GIS2_4;
                        break;
                }
                break;
        }
        for (var i = 1; i <= value_row; i++) {
            document.getElementById("timetable_edit").deleteRow(1);
        }

        var save_value_max_row = 0;
        var row_insert = 0;
        for (var i = 6; i > -1; i--) {
            var rowspan = 0;
            for (var j = 0; j < 24; j++) {
                var count_check = 0;
                for (var k = 0; k < program.length; k++) { //หาตัวซ้ำ
                    var spilt_timeslot = program[k]['timeslot_id'].split(',');
                    if (parseInt(spilt_timeslot[0]) === i && parseInt(spilt_timeslot[1]) === j) {
                        count_check++;
                    }
                }
                if (count_check > rowspan) {
                    rowspan = count_check;
                }
            }
            var row = [];
            switch (i) {
                case 0:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Monday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Monday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 1:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Tuesday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Tuesday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 2:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Wednesday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Wednesday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 3:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Thursday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Thursday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 4:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Friday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Friday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 5:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Saturday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Saturday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                case 6:
                    var table = document.getElementById("timetable_edit");
                    if (rowspan !== 0) {
                        for (var count_r = 0; count_r < rowspan; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === rowspan - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Sunday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = rowspan;
                            }
                            row_insert++;
                        }
                    } else {
                        row[0] = table.insertRow(1);
                        cell_table = row[0].insertCell(0);
                        cell_table.innerHTML = "Sunday";
                        cell_table.style.backgroundColor = "#D9F3FF";
                        row_insert++;
                    }
                    break;
                default:
                    break;
            }
            if (rowspan !== 0) {
                var save_group_insert = "/";
                for (var count_row_span = (rowspan - 1); count_row_span >= 0; count_row_span--) {
                    var sum_cell_in_roll = 0;
                    for (var j = 0; j < 24; j++) {
                        var count_insert = 0;
                        for (var p = 0; p < program.length; p++) {
                            var subject_id = program[p]['subject_detail'][0]['subject_detail'][0]['subject_id'];
                            var subject_name = program[p]['subject_detail'][0]['subject_detail'][0]['subject_namethai'];
                            var split_program = program[p]['timeslot_id'].split(",");
                            if (parseInt(split_program[0]) === i && parseInt(split_program[1]) === j) {
                                var sum_section = 0;
                                for (var count_section = 0; count_section < program[p]['section_detail'].length; count_section++) {
                                    if (sum_section === 0) {
                                        sum_section = program[p]['section_detail'][count_section]['section_no'];
                                    } else {
                                        sum_section = sum_section + "," + program[p]['section_detail'][count_section]['section_no'];
                                    }
                                }
                                if (program[p]['room_detail'].length === 0) {
                                    var room_name = "ไม่ระบุห้องเรียน";
                                } else {
                                    var room_name = program[p]['room_detail'][0]['room_name'];
                                }
                                //check ว่าเอาลงไปหรือยัง
                                var check_insert = 0;
                                var spilt_checl = save_group_insert.split("/");
                                var string_check = i + "," + j + "," + program[p]['group_no'];
                                for (var count_s = 0; count_s < spilt_checl.length; count_s++) {
                                    if (string_check === spilt_checl[count_s]) {
                                        check_insert++;
                                    }
                                }
                                if (check_insert === 0) { //สามารถจัดลงได้
                                    if (count_row_span === (rowspan - 1)) {
                                        cell_table = row[count_row_span].insertCell(j + 1 - sum_cell_in_roll);
                                        cell_table.colSpan = program[p]['timeslot_lenght'];
                                        cell_table.innerHTML = subject_id + " " + subject_name + "<br>" + " (" + sum_section + ") " + room_name;
                                        var id = "S," + i + "," + j + "," + program[p]['group_no'] + "," + subject_id;
                                        cell_table.setAttribute("id", id);
                                        cell_table.setAttribute('onclick', 'checktable(this.id);');
                                    } else {
                                        cell_table = row[count_row_span].insertCell(j - sum_cell_in_roll);
                                        cell_table.colSpan = program[p]['timeslot_lenght'];
                                        cell_table.innerHTML = subject_id + " " + subject_name + "<br>" + " (" + sum_section + ") " + room_name;
                                        var id = "S," + i + "," + j + "," + program[p]['group_no'] + "," + subject_id;
                                        cell_table.setAttribute("id", id);
                                        cell_table.setAttribute('onclick', 'checktable(this.id);');
                                    }
                                    var string_push = i + "," + j + "," + program[p]['group_no'];
                                    sum_cell_in_roll = sum_cell_in_roll + (parseInt(program[p]['timeslot_lenght']) - 1);
                                    j = j + (parseInt(program[p]['timeslot_lenght']) - 1);
                                    save_group_insert = save_group_insert + "/" + string_push;
                                } else {
                                    count_insert++;
                                }
                            } else {
                                count_insert++;
                            }
                        }
                        if (count_insert === program.length) {
                            if (count_row_span === (rowspan - 1)) {
                                cell_table = row[count_row_span].insertCell(j + 1 - sum_cell_in_roll);
                                var id = "S," + i + "," + j;
                                cell_table.setAttribute("id", id);
                                cell_table.setAttribute('onclick', 'checktable(this.id);');
                            } else {
                                cell_table = row[count_row_span].insertCell(j - sum_cell_in_roll);
                                var id = "S," + i + "," + j;
                                cell_table.setAttribute("id", id);
                                cell_table.setAttribute('onclick', 'checktable(this.id);');
                            }
                        }
                    }
                }
            } else { //กรณี I นั้นไม่มี ไม่มี group ใดเรียนเลย
                for (var j = 0; j < 24; j++) {
                    cell_table = row[0].insertCell(j + 1);
                    var id = "S," + i + "," + j;
                    cell_table.setAttribute("id", id);
                    cell_table.setAttribute('onclick', 'checktable(this.id);');
                }
            }
        }
        var set_tag_room = document.getElementById("setvalue_room_row");
        set_tag_room.value = row_insert;
        var set_student_year = document.getElementById("student_year");
        set_student_year.value = value_std;

    }

    function checktable(id) {
        var value_spilt = id.split(",");
        var id_tag_end = document.getElementById("end_edit_time_table");
        var id_tag_start = document.getElementById("start_edit_time_table");
        var id_hidden_tag_end = document.getElementById("hidden_end_edit_time_table");
        var id_hidden_tag_start = document.getElementById("hidden_start_edit_time_table");
        var id_tag_hidden_end = document.getElementById("save_ij_end");
        var id_tag_hidden_start = document.getElementById("save_ij_start");
        var id_hidden_check = document.getElementById("check_edit");
        var id_submit_button = document.getElementById("submit_button");
        var id_check_button = document.getElementById("check_button");
        var id_room_id = document.getElementById("room_id");
        if (value_spilt.length === 3) {
            id_hidden_check.value = 0;
            for (var i = 0; i < data_timeslot.length; i++) {
                var spilt_timeslot = data_timeslot[i]['timeslot_id'].split(",");
                if (spilt_timeslot[0] === value_spilt[1] && spilt_timeslot[1] === value_spilt[2]) {
                    id_tag_hidden_end.value = value_spilt[1] + "," + value_spilt[2];
                    var value_show = data_timeslot[i]['timeslot_day'] + " - " + data_timeslot[i]['timeslot_starttime'];
                    id_hidden_tag_end.value = value_show;
                    id_tag_end.value = value_show;
                    i = data_timeslot.length;
                }
            }
        } else if (value_spilt.length === 5) {
            id_hidden_check.value = 0;
            for (var i = 0; i < data_timeslot.length; i++) {
                var spilt_timeslot = data_timeslot[i]['timeslot_id'].split(",");
                if (spilt_timeslot[0] === value_spilt[1] && spilt_timeslot[1] === value_spilt[2]) {
                    id_tag_hidden_start.value = value_spilt[1] + "," + value_spilt[2] + "," + value_spilt[3] + "," + value_spilt[4];
                    var value_show = value_spilt[4] + " - " + data_timeslot[i]['timeslot_day'] + " - " + data_timeslot[i]['timeslot_starttime'];
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

    function clear_data() {
        var id_tag_end = document.getElementById("end_edit_time_table");
        var id_tag_start = document.getElementById("start_edit_time_table");
        var id_tag_hidden_end = document.getElementById("save_ij_end");
        var id_tag_hidden_start = document.getElementById("save_ij_start");
        var id_hidden_check = document.getElementById("check_edit");
        var id_submit_button = document.getElementById("submit_button");
        var id_check_button = document.getElementById("check_button");
        var id_room_id = document.getElementById("room_id");
        id_room_id.value = "";
        id_check_button.disabled = true;
        id_submit_button.disabled = true;
        id_tag_end.value = "";
        id_tag_start.value = "";
        id_tag_hidden_end.value = "";
        id_tag_hidden_start.value = "";
        id_hidden_check.value = "0";
    }
</script>



