<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--CHECKBOX SHOW TABLE-->
<label class="radio" style="color: #F44336"><input name="model_schedule" type="radio" value="1"
                                                   onclick="setvaluetagmodel(this.value)" checked><i></i><b>แบบที่
        1</b></label>
<label class="radio" style="color: blue"><input name="model_schedule" type="radio" value="2"
                                                onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        2</b></label>
<label class="radio" style="color: #009688"><input name="model_schedule" type="radio" value="3"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        3</b></label>
<label class="radio" style="color: #FFA000"><input name="model_schedule" type="radio" value="4"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        4</b></label>
<label class="radio" style="color: #E040FB"><input name="model_schedule" type="radio" value="5"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        5</b></label>
<label class="radio" style="color: #000066"><input name="model_schedule" type="radio" value="6"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        6</b></label>
<label class="radio" style="color: #000066"><input id="sumary_show" name="sumary_show" type="checkbox"
                                                   onclick="displaytagdiv(this.id)"><i></i><b>สรุปผลการจัดตารางเรียน</b></label>
<!-- CHECKBOX SHOW TABLE -->
<!-- CREATE TABLE BTN -->
<div align="center" id="hide-print">
    <button type="button" class="btn btn-3d btn-green" onclick="insertTimeslot()">บันทึกตารางเรียน</button>
</div>
<!-- CREATE TABLE BTN -->
<script>
    function displaytagdiv(value_id) {
        var id_div_sumary = document.getElementById("div_sumary_model");
        var value_checked = document.getElementById(value_id).checked;
        var id_table_suamry = document.getElementById("table_sumary_model");
        var value_model = document.getElementById("setvalue_model").value;
        var count_row_table_sumary = id_table_suamry.rows.length;
        var Room = <?php echo Json::encode($Data_room) ?>;
        var model_room = 0;
        if (value_checked === true) {
            id_div_sumary.style.display = "";
            if (count_row_table_sumary > 2) {
                for (var i = 0; i < count_row_table_sumary - 1; i++) {
                    id_table_suamry.deleteRow(2);
                }
            }
            switch (parseInt(value_model)) {
                case 1:
                    model_room = save_room;
                    break;
                case 2:
                    model_room = save_room_1;
                    break;
                case 3:
                    model_room = save_room_2;
                    break;
                case 4:
                    model_room = save_room_3;
                    break;
                case 5:
                    model_room = save_room_4;
                    break;
                case 6:
                    model_room = save_room_5;
                    break;
            }
            for (var i = 0; i < Room.length; i++) {
                var slot_2 = 0;
                var slot_3 = 0;
                var slot_4 = 0;
                var slot_6 = 0;
                var row = id_table_suamry.insertRow(2);
                var cell = row.insertCell(0);
                cell.innerHTML = Room[i]['room_name'];
                for (var j = 0; j < 5; j++) {
                    for (var k = 0; k < 24; k++) {
                        if (k !== 8 && k !== 9) {
                            if (typeof model_room[j] !== "undefined" && model_room[j] !== null && model_room[j].length !== 0) {
                                if (typeof model_room[j][k] !== "undefined" && model_room[j][k] !== null && model_room[j][k].length !== 0) {
                                    if (typeof model_room[j][k][Room[i]['room_id']] !== "undefined" && model_room[j][k][Room[i]['room_id']] !== null && model_room[j][k][Room[i]['room_id']].length !== 0) {
                                        var save_value = model_room[j][k][Room[i]['room_id']];
                                        var check_slot = 1;
                                        for (var a = k + 1; a < 24; a++) {
                                            if (typeof model_room[j] !== "undefined" && model_room[j] !== null) {
                                                if (typeof model_room[j][a] !== "undefined" && model_room[j][a] !== null) {
                                                    if (typeof model_room[j][a][Room[i]['room_id']] !== "undefined" && model_room[j][a][Room[i]['room_id']] !== null && model_room[j][a][Room[i]['room_id']].length !== 0) {
                                                        if (model_room[j][a][Room[i]['room_id']] === save_value) {
                                                            check_slot++;
                                                        } else {
                                                            a = 24;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        k = k + check_slot - 1;
                                        switch (check_slot) {
                                            case 2:
                                                slot_2++;
                                                break;
                                            case 3:
                                                slot_3++;
                                                break;
                                            case 4:
                                                slot_4++;
                                                break;
                                            case 6:
                                                slot_6++;
                                                break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                var cell = row.insertCell(1);
                cell.innerHTML = slot_2;
                var cell = row.insertCell(2);
                cell.innerHTML = slot_3;
                var cell = row.insertCell(3);
                cell.innerHTML = slot_4;
                var cell = row.insertCell(4);
                cell.innerHTML = slot_6;
                for (var j = 0; j < 5; j++) {
                    for (var k = 0; k < 24; k++) {
                        if (k !== 8 && k !== 9) {
                            if (typeof model_room[j] !== "undefined" && model_room[j] !== null && model_room[j].length !== 0) {

                            }
                        }
                    }
                }
            }

        } else {
            id_div_sumary.style.display = "none";
            if (count_row_table_sumary > 2) {
                for (var i = 0; i < count_row_table_sumary - 1; i++) {
                    id_table_suamry.deleteRow(2);
                }
            }
        }

    }

    function insertTimeslot() {
        var value_model = document.getElementById('setvalue_model').value;
        var room = 0;
        switch (parseInt(value_model)) {
            case 1:
                room = save_room;
                break;
            case 2:
                room = save_room_1;
                break;
            case 3:
                room = save_room_2;
                break;
            case 4:
                room = save_room_3;
                break;
            case 5:
                room = save_room_4;
                break;
            case 6:
                room = save_room_5;
                break;
            default:
                room = save_room;
                break;
        }
        $.ajax({
            url: 'ajax-insert-timeslot',
            type: 'POST',
            data: {
                Room: room,
                semester:<?=$semester?>,
                year_of:<?=$year_of?>
            },
            success: function (data) {
                alert(data.search);
                window.location = "createtable";
            }
        })
    }
</script>