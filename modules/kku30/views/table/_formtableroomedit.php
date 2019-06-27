<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table_room_edit"
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
    </div>
</div>

<script>
    function changeTableRoomedit() {
        var value_room = document.getElementById('select_room').value;
        deleterowtable();
        for (var i = 6; i > -1; i--) { //Loop ตำแหน่ง i ตัวแรก
            switch (i) {
                case 6:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Sunday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 5:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Saturday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 4:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Friday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 3:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Thursday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 2:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Wednesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 1:
                    var table = document.getElementById("table_room_edit");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Tuesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 0:
                    var table = document.getElementById("table_room_edit");
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
                var count_check = 0;
                for (var count_room = 0; count_room < Room.length; count_room++) {
                    var spilt_value = Room[count_room]['timeslot_id'].split(",");
                    if (parseInt(spilt_value[0]) === i && parseInt(spilt_value[1]) === j && parseInt(Room[count_room]['room_id']) === parseInt(value_room)) {
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
                        cell.innerHTML = subject_id + "<br>" + "(" + section_sum + ")";
                        cell.colSpan = parseInt(Room[count_room]['timeslot_lenght']);
                        j = j + (parseInt(Room[count_room]['timeslot_lenght']) - 1);
                        sum_col = sum_col + (parseInt(Room[count_room]['timeslot_lenght']) - 1);
                    } else {
                        count_check++;
                    }
                }
                if (count_check === Room.length) {
                    var Position_j = ((j + 1) - sum_col);
                    var cell = row.insertCell(Position_j);
                }
            }
        }
    }

    function deleterowtable() {
        for (var i = 1; i <= 7; i++) {
            document.getElementById("table_room_edit").deleteRow(1);
        }
    }
</script>

