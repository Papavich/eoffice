<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;
use kartik\widgets\Select2;

?>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="time_table"
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
            <strong> เคลื่อนย้ายจากตำแหน่ง : </strong><input type="text" id="start_edit_time_table"
                                                             name="start_edit_time_table"> ||
            <strong>ไปยังตำแหน่ง : </strong><input type="text" id="end_edit_time_table"
                                                   name="end_edit_time_table"><br><br>
            <button type="button" class="btn btn-3d btn-green" onclick="">บันทึกการแก้ไข</button>
            <button type="button" class="btn btn-3d btn-green" onclick="">ลบตำแหน่งการเคลื่อนย้าย</button>
            <input type="hidden" id="save_ij_start" name="save_ij_start" value="">
            <input type="hidden" id="save_ij_end" name="save_ij_end" value="">
            <input type="hidden" id="check_edit" name="check_edit" value="0">
            <!-- bottom  -->
    </div>
</div>
<script>
    function changeTimetable() {
        var data_real_group = <?php echo Json::encode($Data_real_subject_group) ?>;
        var value_select_year = document.getElementById("select_stdyear").value; //ตำแหน่งที่ 3 ของอาเรย์ programs
        var check_programs = document.getElementById("setvalue_togle").value;
        var check_model = document.getElementById("setvalue_model").value; //
        var value_row = document.getElementById("setvalue_room_row").value;
        var programs = 0;
        var Room = 0;
        var row_table = 0;
        var cell_table = 0;
        var row_insert = 0;
        var Data_Room = <?php echo Json::encode($Data_room)?>;

        switch (check_programs) {
            case "CS":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_cs;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_cs_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_cs_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_cs_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_cs_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_cs_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            case "CS_VIP":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_cs2;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_cs2_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_cs2_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_cs2_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_cs2_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_cs2_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            case "IT":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_it;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_it_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_it_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_it_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_it_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_it_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            case "IT_VIP":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_it2;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_it2_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_it2_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_it2_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_it2_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_it2_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            case "GIS":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_gis;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_gis_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_gis_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_gis_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_gis_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_gis_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            case "GIS_VIP":
                switch (parseInt(check_model)) {
                    case 1:
                        programs = save_programs_gis2;
                        Room = save_room;
                        break;
                    case 2:
                        programs = save_programs_gis2_1;
                        Room = save_room_1;
                        break;
                    case 3:
                        programs = save_programs_gis2_2;
                        Room = save_room_2;
                        break;
                    case 4:
                        programs = save_programs_gis2_3;
                        Room = save_room_3;
                        break;
                    case 5:
                        programs = save_programs_gis2_4;
                        Room = save_room_4;
                        break;
                    case 6:
                        programs = save_programs_gis2_5;
                        Room = save_room_5;
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        delete_row_table(parseInt(value_row));

        for (var i = 6; i > -1; i--) { //loop ของวันทั้ง 7 || ตำแหน่งแรกของอาเรย์ programs
            var max_row_incell = 0; //max row ที่เหมือนกันคือ 0 กับ 1 คือไม่รู้ว่า มีหรือไม่มี
            var split_program = 0;
            var save_subject_in_tag_row = [];
            for (var j = 0; j < 24; j++) { //หาว่า ตำแหน่งที่ i และ j - 24 นั้นมีค่าหรือไม่
                if (typeof programs[i] !== "undefined" && programs[i] !== null && programs[i].length !== 0) {
                    if (typeof programs[i][j] !== "undefined" && programs[i][j] !== null && programs[i][j].length !== 0) {
                        if (typeof programs[i][j][parseInt(value_select_year)] !== "undefined" && programs[i][j][parseInt(value_select_year)] !== null && programs[i][j][parseInt(value_select_year)].length !== 0) {
                            split_program = programs[i][j][parseInt(value_select_year)].split(",");
                            if (split_program.length > max_row_incell) {
                                max_row_incell = split_program.length;
                            }
                        }
                    }
                }
            }
            var row = [];
            switch (i) {
                case 0:
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Monday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Tuesday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Wednesday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Thursday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Friday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Saturday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
                    var table = document.getElementById("time_table");
                    if (max_row_incell !== 0) {
                        for (var count_r = 0; count_r < max_row_incell; count_r++) {
                            row[count_r] = table.insertRow(1);
                            if (count_r === max_row_incell - 1) {
                                cell_table = row[count_r].insertCell(0);
                                cell_table.innerHTML = "Sunday";
                                cell_table.style.backgroundColor = "#D9F3FF";
                                cell_table.rowSpan = max_row_incell;
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
            if (max_row_incell !== 0) { //กรณี i นั้นมี Group เรียนอยู่
                for (var count_max_row = 0; count_max_row < max_row_incell; count_max_row++) { //จัดการแถวแรกก่อน ทีละแถว
                    var sum_cell_in_roll = 0;
                    var group_length = 0;
                    var subject_id = 0;
                    var subopen_year = 0;
                    var subopen_semester = 0;
                    var subject_version = 0;
                    var subject_name = 0;
                    for (var j = 0; j < 24; j++) {
                        // ไม่ต้อง Check i เพราะ ว่า i ถูก check ตั้งแต่ตอนที่ หา max_row_cell
                        if (typeof programs[i][j] !== "undefined" && programs[i][j] !== null && programs[i][j].length !== 0) {
                            if (typeof programs[i][j][parseInt(value_select_year)] !== "undefined" && programs[i][j][parseInt(value_select_year)] !== null && programs[i][j][parseInt(value_select_year)].length !== 0) {
                                //แสดงว่า ใน ตำแหน่ง I , J มีค่า ของ value_select_year อยู่
                                split_program = programs[i][j][parseInt(value_select_year)].split(",");
                                if (typeof split_program[(max_row_incell - 1) - count_max_row] !== "undefined" && split_program[(max_row_incell - 1) - count_max_row] !== null && split_program[(max_row_incell - 1) - count_max_row].length !== 0) {
                                    //หาว่า Group นี้ใช้ไปกี่ Length
                                    var sum_section = 0;
                                    var group_type = 0;
                                    var save_id_name_room = null;
                                    for (var count_real_group = 0; count_real_group < data_real_group.length; count_real_group++) { //ต้องหาเจอเพราะ ก่อนจะจัดได้ ต้องมี Length อยู่แล่ว
                                        if (data_real_group[count_real_group]['group_no'] === split_program[(max_row_incell - 1) - count_max_row]) {
                                            group_length = parseInt(data_real_group[count_real_group]['group_length']);
                                            subject_id = data_real_group[count_real_group]['group_detail'][0]['subject_detail'][0]['subject_id'];
                                            subject_version = data_real_group[count_real_group]['group_detail'][0]['subject_detail'][0]['subject_version'];
                                            subopen_year = data_real_group[count_real_group]['group_detail'][0]['section_programs'][0]['subopen_year'];
                                            subopen_semester = data_real_group[count_real_group]['group_detail'][0]['section_programs'][0]['subopen_semester'];
                                            subject_name = data_real_group[count_real_group]['group_detail'][0]['subject_detail'][0]['subject_namethai'];
                                            group_type = set_type_group(data_real_group[count_real_group]['group_type']);
                                            for (var count_section = 0; count_section < data_real_group[count_real_group]['group_detail'].length; count_section++) {
                                                if (sum_section === 0) {
                                                    sum_section = data_real_group[count_real_group]['group_detail'][count_section]['section_no'];
                                                } else {
                                                    sum_section = sum_section + "," + data_real_group[count_real_group]['group_detail'][count_section]['section_no'];
                                                }
                                            }

                                            for (var count_room = 0; count_room < Data_Room.length; count_room++) {
                                                if (Room[i][j][count_room] === data_real_group[count_real_group]['group_no']) {
                                                    save_id_name_room = count_room;
                                                }
                                            }
                                            if (save_id_name_room !== null) {
                                                for (count_room = 0; count_room < Data_Room.length; count_room++) {
                                                    if (Data_Room[count_room]['room_id'] === parseInt(save_id_name_room)) {
                                                        save_id_name_room = Data_Room[count_room]['room_name'];
                                                    }
                                                }
                                            } else {
                                                save_id_name_room = "WBA";
                                            }
                                            //หาห้องที่ใช้
                                            // i / j / group_no
                                            //หาห้องที่ใช้
                                            count_real_group = data_real_group.length; //ทำให้หลุดลูป
                                        }
                                    }
                                    if (count_max_row === (max_row_incell - 1)) { //check ว่าเป็นตำแหน่ง TR ที่เท่าไร
                                        cell_table = row[count_max_row].insertCell((j + 1) - sum_cell_in_roll);
                                        cell_table.colSpan = group_length;
                                        cell_table.innerHTML = subject_id + " " + subject_name + "<br>" + " (" + sum_section + ") " + group_type + " " + save_id_name_room;
                                        var set_value = "check_edit(" + i + "," + j + "," + group_length + ",'" + split_program[(max_row_incell - 1) - count_max_row].toString() + "','" + subject_id.toString() + "'," + subject_version + "," + subopen_year + "," + subopen_semester + ")";
                                        cell_table.setAttribute('onClick', set_value);
                                        sum_cell_in_roll = sum_cell_in_roll + (group_length - 1);
                                        j = j + (group_length - 1);

                                    } else {
                                        cell_table = row[count_max_row].insertCell(j - sum_cell_in_roll);
                                        cell_table.colSpan = group_length;
                                        cell_table.innerHTML = subject_id + " " + subject_name + "<br>" + " (" + sum_section + ") " + group_type + " " + save_id_name_room;
                                        var set_value = "check_edit(" + i + "," + j + "," + group_length + ",'" + split_program[(max_row_incell - 1) - count_max_row].toString() + "','" + subject_id.toString() + "'," + subject_version + "," + subopen_year + "," + subopen_semester + ")";
                                        cell_table.setAttribute('onClick', set_value);
                                        sum_cell_in_roll = sum_cell_in_roll + (group_length - 1);
                                        j = j + (group_length - 1);
                                    }
                                    //หาว่า Group นี้ใช้ไปกี่ Length

                                } else {
                                    if (count_max_row === (max_row_incell - 1)) {
                                        cell_table = row[count_max_row].insertCell((j + 1) - sum_cell_in_roll);
                                        var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                        cell_table.setAttribute('onClick', set_value);
                                    } else {
                                        cell_table = row[count_max_row].insertCell(j - sum_cell_in_roll);
                                        var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                        cell_table.setAttribute('onClick', set_value);
                                    }
                                }
                                //แสดงว่า ใน ตำแหน่ง I , J มีค่า ของ value_select_year อยู่
                            } else {
                                if (count_max_row === (max_row_incell - 1)) {
                                    cell_table = row[count_max_row].insertCell((j + 1) - sum_cell_in_roll);
                                    var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                    cell_table.setAttribute('onClick', set_value);
                                } else {
                                    cell_table = row[count_max_row].insertCell(j - sum_cell_in_roll);
                                    var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                    cell_table.setAttribute('onClick', set_value);
                                }
                            }
                        } else { // insert ตาราง ถอยหลัง
                            if (count_max_row === (max_row_incell - 1)) {
                                cell_table = row[count_max_row].insertCell((j + 1) - sum_cell_in_roll);
                                var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                cell_table.setAttribute('onClick', set_value);
                            } else {
                                cell_table = row[count_max_row].insertCell(j - sum_cell_in_roll);
                                var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                                cell_table.setAttribute('onClick', set_value);
                            }
                        }
                    }
                }
            } else { //กรณี I นั้นไม่มี ไม่มี group ใดเรียนเลย
                for (var j = 0; j < 24; j++) {
                    cell_table = row[0].insertCell(j + 1);
                    var set_value = "check_edit(" + i + "," + j + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + "," + 0 + ")";
                    cell_table.setAttribute('onClick', set_value);
                }
            }
        }
        var set_tag_room = document.getElementById("setvalue_room_row");
        set_tag_room.value = row_insert;
    }

    function set_type_group(group_type) {
        switch (group_type) {
            case 1:
                return "Lec";
                break;
            case 2:
                return "Lab";
                break;
            case 3:
                return "Labแปลภาพ";
                break;
            case 4:
                return "LabNetwork";
                break;
            default:
                return 0;
                break;
        }
    }

    function check_edit(i, j, group_lng, group_no, subjectid, subjectversion, subopenyear, subopensemester) {
        alert(i + " " + j);
        if (parseInt(group_lng) === 0 && parseInt(group_no) === 0) {
            for (var check_timeslot = 0; check_timeslot < save_timeslot.length; check_timeslot++) {
                var spilt_timeslot = save_timeslot[check_timeslot]['timeslot_id'].split(",");
                if (parseInt(spilt_timeslot[0]) === i && parseInt(spilt_timeslot[1]) === j) {
                    document.getElementById("end_edit_time_table").value = save_timeslot[check_timeslot]['timeslot_day'] + " " + save_timeslot[check_timeslot]['timeslot_starttime'];
                    document.getElementById("save_ij_end").value = i + "," + j;
                    document.getElementById("check_edit").value = 0;
                }
            }
        } else {
            for (var check_timeslot = 0; check_timeslot < save_timeslot.length; check_timeslot++) {
                var spilt_timeslot = save_timeslot[check_timeslot]['timeslot_id'].split(",");
                if (parseInt(spilt_timeslot[0]) === i && parseInt(spilt_timeslot[1]) === j) {
                    document.getElementById("start_edit_time_table").value = subjectid + " " + save_timeslot[check_timeslot]['timeslot_day'] + " " + save_timeslot[check_timeslot]['timeslot_starttime'];
                    document.getElementById("save_ij_start").value = i + "," + j + "," + group_no + "," + subjectid + "," + subjectversion + "," + subopenyear + "," + subopensemester;
                    document.getElementById("check_edit").value = 0;
                }
            }
        }
        var value_start_edit = document.getElementById('save_ij_start').value;
        var value_end_edit = document.getElementById('save_ij_end').value;
        //เมื่อ 2 ค่าครบแล้วให้ไป check ajax
        if (value_start_edit !== null && value_end_edit !== null && value_start_edit.length !== 0 && value_end_edit.length !== 0) {
            var value_togle = document.getElementById('setvalue_togle').value;
            var value_model = document.getElementById('setvalue_model').value;
            var value_student = document.getElementById('select_stdyear').value;
            //ติดปัญหา overload data
            $.ajax({
                url: 'ajax-check-edit',
                type: 'POST',
                data: {
                    program: value_togle,
                    model: value_model,
                    stdyear: value_student,
                    value_start_edit: value_start_edit,
                    value_end_edit: value_end_edit,

                    save_room: save_room,
                    save_room_1: save_room_1,
                    save_room_2: save_room_2,
                    save_room_3: save_room_3,
                    save_room_4: save_room_4,
                    save_room_5: save_room_5,

                    save_teacher: save_teacher,
                    save_teacher_1: save_teacher_1,
                    save_teacher_2: save_teacher_2,
                    save_teacher_3: save_teacher_3,
                    save_teacher_4: save_teacher_4,
                    save_teacher_5: save_teacher_5,

                    save_programs_cs: save_programs_cs,
                    save_programs_cs_1: save_programs_cs_1,
                    save_programs_cs_2: save_programs_cs_2,
                    save_programs_cs_3: save_programs_cs_3,
                    save_programs_cs_4: save_programs_cs_4,
                    save_programs_cs_5: save_programs_cs_5,

                    save_programs_cs2: save_programs_cs2,
                    save_programs_cs2_1: save_programs_cs2_1,
                    save_programs_cs2_2: save_programs_cs2_2,
                    save_programs_cs2_3: save_programs_cs2_3,
                    save_programs_cs2_4: save_programs_cs2_4,
                    save_programs_cs2_5: save_programs_cs2_5,

                    save_programs_it: save_programs_it,
                    save_programs_it_1: save_programs_it_1,
                    save_programs_it_2: save_programs_it_2,
                    save_programs_it_3: save_programs_it_3,
                    save_programs_it_4: save_programs_it_4,
                    save_programs_it_5: save_programs_it_5,

                    save_programs_it2: save_programs_it2,
                    save_programs_it2_1: save_programs_it2_1,
                    save_programs_it2_2: save_programs_it2_2,
                    save_programs_it2_3: save_programs_it2_3,
                    save_programs_it2_4: save_programs_it2_4,
                    save_programs_it2_5: save_programs_it2_5,

                    save_programs_gis: save_programs_gis,
                    save_programs_gis_1: save_programs_gis_1,
                    save_programs_gis_2: save_programs_gis_2,
                    save_programs_gis_3: save_programs_gis_3,
                    save_programs_gis_4: save_programs_gis_4,

                    save_programs_gis2: save_programs_gis2,
                    save_programs_gis2_1: save_programs_gis2_1,
                    save_programs_gis2_2: save_programs_gis2_2,
                    save_programs_gis2_3: save_programs_gis2_3,
                    save_programs_gis2_4: save_programs_gis2_4,
                    save_programs_gis2_5: save_programs_gis2_5
                },
                success: function (data) {
                    alert(data.program);
                }
            })
        }
        //เมื่อ 2 ค่าครบแล้วให้ไป check ajax
//        alert("i : " + i + " j : " + j + " length : " + group_lng + " group_no : " + group_no);
    }

    function delete_row_table(row_table) {
        for (var i = 1; i <= row_table; i++) {
            document.getElementById("time_table").deleteRow(1);
        }
    }
</script>



