<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<div class="panel-body">

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table_room"
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

    function changetableRoom() {
        deletetable();
        var value = $('#select_room').val();
        var value_parseInt = parseInt(value);
        var save_value_Room = [];
        var Data_subject = <?php echo Json::encode($Data_real_subject_group)?>;
        var check_model = document.getElementById("setvalue_model").value;
        var Room = 0 ;
        switch (parseInt(check_model)) {
            case 1:
                Room = save_room;
                break;
            case 2:
                Room = save_room_1;
                break;
            case 3:
                Room = save_room_2;
                break;
            case 4:
                Room = save_room_3;
                break;
            case 5:
                Room = save_room_4;
                break;
            case 6:
                Room = save_room_5;
                break;
            default:
                Room = save_room;
                break;
        }
        for (var i = 0; i < 7; i++) {
            if (typeof Room[i] !== "undefined" && Room[i] !== null && Room[i].length !== 0) { //check ว่าตำแหน่งนั้นว่างหรือไม้
                for (var j = 0; j < 24; j++) {
                    if (typeof Room[i][j] !== "undefined" && Room[i][j] !== null && Room[i][j].length !== 0) { // checkว่าตำแหน่งนั้นถูกสร้างหรือยัง
                        if (typeof Room[i][j][value_parseInt] !== "undefined" && Room[i][j][value_parseInt] !== null && Room[i][j][value_parseInt].length !== 0) {
                            if (Room[i][j][value_parseInt] !== null && Room[i][j][value_parseInt].length !== 0) {
                                save_value_Room.push(i + "," + j + "," + Room[i][j][value_parseInt]);
                            }
                        }
                    }
                }
            }
        }
        var array_check = [];
        var spilt_value;
        for (var i = 6; i > -1; i--) { //Loop ตำแหน่ง i ตัวแรก
            switch (i) {
                case 6:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Sunday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 5:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Saturday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 4:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Friday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 3:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Thursday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 2:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Wednesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 1:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Tuesday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                case 0:
                    var table = document.getElementById("table_room");
                    var row = table.insertRow(1);
                    var cell = row.insertCell(0);
                    cell.innerHTML = "Monday";
                    cell.style.backgroundColor = "#D9F3FF";
                    break;
                default:
                    break;
            }
            var sum_count = 0;
            for (var j = 0; j < 24; j++) { //Loop ตำแหน่ง j ตัวที่ 2
                var mark_slot = 0;
                for (var k = 0; k < save_value_Room.length; k++) { //ลูปหาว่า ตำแหน่ง i , j มีค่าหรือไม้
                    spilt_value = save_value_Room[k].split(",");
                    if (parseInt(spilt_value[0]) === i && parseInt(spilt_value[1]) === j) { //มันจะออกมาค่าเดียวเป็นไปไม่ได้ที่ จะออกมา มากกว่า 2
                        mark_slot = save_value_Room[k]; //เก็บค่าเมื่อ ในตำแหน่ง I J มีค่าอยู่
                        k = save_value_Room.length //เมื่อหาเจอให้หลุดลูป
                    }
                }
                if (mark_slot !== 0) { //เมื่อเจอว่า ตำแหน่ง I J มีค่าอยู่
                    var check_repeat = 0;
                    for (var k = 0; k < array_check.length; k++) { //check ว่า ค่านั้นถูกจัดไปหรือยัง
                        if (array_check[k] === mark_slot) {
                            check_repeat++;
                        }
                    }
                    //mark_slot เก็บเป็น i,j,group
                    if (check_repeat === 0) { //ถ้า === 0 แสดงว่ายังไม่มมีการจัด
                        var count_time_slot = 0;
                        var mark_slot_spilt = mark_slot.split(",");
                        for (var k = (parseInt(mark_slot_spilt[1]) + 1); k < 24; k++) { //loop นี้หาว่า มีค่าในตำแหน่งถัดไปหรือไม่
                            var max_slot_compare = mark_slot_spilt[0] + "," + k + "," + mark_slot_spilt[2];
                            var check_continued = 0;
                            for (var k2 = 0; k2 < save_value_Room.length; k2++) {
                                if (max_slot_compare === save_value_Room[k2]) {
                                    count_time_slot++; //จำนวนช่องที่ต้อง colspan
                                    check_continued++;
                                }
                            }
                            if (check_continued === 0) {
                                k = 24;
                            }
                        }
                        mark_slot_spilt = mark_slot.split(",");
                        var cell = row.insertCell((j + 1) - sum_count);
                        cell.setAttribute("id", i + "," + j);
                        cell.colSpan = count_time_slot + 1;
                        var type = 0;
                        var save_subject_id = 0;
                        var save_section = 0;
                        for (var count_s = 0; count_s < Data_subject.length; count_s++) {
                            if (Data_subject[count_s]['group_no'] === mark_slot_spilt[2]) {
                                save_subhect_id = Data_subject[count_s]['group_detail'][0]['subject_detail'][0]['subject_id'];
                                type = settypeshow(Data_subject[count_s]['group_type']);
                                for (var count_section = 0; count_section < Data_subject[count_s]['group_detail'].length; count_section++) {
                                    if (save_section === 0) {
                                        save_section = Data_subject[count_s]['group_detail'][count_section]['section_no'];
                                    } else {
                                        save_section = save_section + "," + Data_subject[count_s]['group_detail'][count_section]['section_no'];
                                    }
                                }
                                save_section = "(" + save_section + ")";
                                count_s = Data_subject.length;
                            }
                        }
                        for (var count_s = 0 ; count_s < Data_subject.length ; count_s++){
                            if (Data_subject[count_s]['group_no'] === mark_slot_spilt[2]){
                                save_subject_id = Data_subject[count_s]['group_detail'][0]['subject_detail'][0]['subject_id'];
                                type = settypeshow(Data_subject[count_s]['group_type']);
                                count_s = Data_subject.length;
                            }
                        }
                        cell.innerHTML = save_subject_id + type + " " + save_section;
                        j = j + count_time_slot;
                        sum_count = sum_count + count_time_slot;
                    }
                } else {
                    var Position_J = (j + 1) - sum_count;
                    var cell = row.insertCell(Position_J);
                    cell.setAttribute("id", i + "," + j);
                }
            }
        }

        //ต้อง insert จากหลังมาหน้า
    }

    function settypeshow(type) {
        var set_name_type = 0;
        if (type === 1){
            set_name_type = "(Lec)";
        }else if(type === 2){
            set_name_type = "(Lab)";
        }else if(type === 3){
            set_name_type = "(แปลภาพ)";
        }else if(type === 4){
            set_name_type = "(LabNetwork)";
        }
        return set_name_type;
    }

    function deletetable() {
        for (var i = 1; i <= 7; i++) {
            document.getElementById("table_room").deleteRow(1);
        }
    }



</script>

