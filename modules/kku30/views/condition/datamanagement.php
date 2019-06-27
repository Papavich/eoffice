<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

?>
<style>
    #table-wrapper {
        position: relative;
    }

    #table-scroll {
        height: 300px;
        overflow: auto;
        margin-top: 20px;
    }

    #table-wrapper table {
        width: 100%;
    }

    #table-wrapper table thead th .text {
        position: absolute;
        top: -20px;
        z-index: 2;
        height: 20px;
        width: 35%;
        border: 1px solid red;
    }
</style>
<!--SHOW LIST SUBJECT TABLE-->
<section>
    <header id="page-header">
        <h1>จัดการข้อมูล</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li class="active">จัดการข้อมูล</li>
        </ol>
    </header>
    <div id="panel-1" class="panel panel-default">
        <!-- ******* INPUT MAJOR YEAR AND STDYEAR FOR SEARCHING SUBJECT ********* -->
        <!--   source     -->
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกข้อมูลชั้นปีและปีการศึกษา (<a style="color: red">ต้นแบบ</a>)</strong>
            </div>
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="source_year" id="source_year" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="setoptiondesyear()">
                        <option value="0">- - ปีการศึกษา - -</option>
                        <?php
                        foreach ($Data_year as $row) {
                            ?>
                            <option value="<?= $row['year_id'] ?>">ปีการศึกษา <?= $row['year_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <?php
                    $Data_semester = \app\modules\kku30\models\Kku30Semester::find()
                        ->all();
                    ?>
                    <select name="source_semester" id="source_semester"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="setsemesterdes()">
                        <option value="0">- - ภาคการเรียน - -</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!--   source     -->
        <!--   des     -->
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกข้อมูลชั้นปีและปีการศึกษา (<a style="color: red">ที่ต้องการนำไปใช้</a>)</strong>
            </div>
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <select name="des_year" id="des_year" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="displaydiv()">
                        <option value="0">- - ปีการศึกษา - -</option>
                    </select>
                    <br><br>
                    <select name="des_semester" id="des_semester"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="displaydiv()">
                        <option value="0">- - ภาคการเรียน - -</option>
                    </select>
                    <br><br>
                    <div align="center">
                        <button class="btn btn-3d btn-green" onclick="showdivtable()"><span> จัดการข้อมูล </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--   des     -->

        <!--   manage_data     -->
        <div id="div_manage" class="panel panel-default" style="display: none">
            <div class="panel-heading panel-heading-transparent">
                <strong id="tag_strong_manage"></strong>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr align="center">
                            <th colspan="2" style="text-align: center" id="row_copy_subject_open">คัดลอกวิชาที่เปิดสอน
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="odd gradeX">
                            <td width="50%">
                                <label style="color: #009688">
                                    <b>คัดลอกวิชาที่เปิดสอน</b>
                                </label>
                                <br><strong style="color: red">หมายเหตุ* </strong>วิชาที่ทำการคัดลอกจะอิงตามหลักสูตรของปีที่ต้องการนำไปใช้
                                ในกรณีวิชานั้นไม่มีในหลักสูตรที่ใช้ในปีนั้น จะไม่ทำการคัดลอกมา (ตารางข้างใต้
                                แสดงรายวิชาที่สามารถคัดลอกได้ เนื่องจากมีรายชื่อวิชา
                                ในหลักสูตรที่ใช้ในแต่ละชั้นปีการศึกษา)
                                <div id="table-wrapper">
                                    <div id="table-scroll">
                                        <table class="table table-striped table-bordered table-hover"
                                               id="table_copy_subject_open">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>รหัสวิชา</th>
                                                <th>เวอร์ชั่นรายวิชา</th>
                                                <th>หน่วยกิต</th>
                                                <th>สถานะรายวิชา</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div>
                                    <label class="radio" style="color: #009688">
                                        <input id="checked_all" name="checked_all" type="checkbox"
                                               onchange="checkedinput(this.id)"><i></i><b>เลือกทั้งหมด</b>
                                    </label>
                                </div>
                                <div align="center">
                                    <button id="copy_same_subject" class="btn btn-3d btn-green"
                                            onclick="insertCopysubjectopen()">
                                        <span> คัดลอกวิชาที่เปิดสอน </span>
                                        <button>
                                </div>
                            </td>
                            <td width="50%">
                                <label style="color: #009688">
                                    <b>คัดลอกSectionและเงื่อนไข</b>
                                </label>
                                <br><strong style="color: red">หมายเหตุ* </strong>วิชาที่ทำการคัดลอกจะอิงตามหลักสูตรของปีที่ต้องการนำไปใช้
                                ในกรณีวิชานั้นไม่มีในหลักสูตรที่ใช้ในปีนั้น จะไม่ทำการคัดลอกมา (คัดลอก ผู้สอน
                                จำนวนSection ผู้เรียนแต่ละSection รวมไปถึงวิชาที่มีการระบุเวลาเรียน)
                                <div id="table-wrapper">
                                    <div id="table-scroll">
                                        <table class="table table-striped table-bordered table-hover"
                                               id="table_copy_subject_open_condition">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>รหัสวิชา</th>
                                                <th>เวอร์ชั่นรายวิชา</th>
                                                <th>หน่วยกิต</th>
                                                <th>สถานะรายวิชา</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br><br>
                                <div>
                                    <label class="radio" style="color: #009688">
                                        <input id="checked_all_section" name="checked_all_section"
                                               type="checkbox" onchange="checkedinputCondition(this.id)"><i></i><b>เลือกทั้งหมด</b>
                                    </label>
                                </div>
                                <div align="center">
                                    <button id="copy_all_subject" class="btn btn-3d btn-green" onclick="insertCopyCondition()">
                                        <span> คัดลอกSectionและเงื่อนไข </span>
                                        <button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
        <!--   manage_data     -->
    </div>
    <!--        </form>-->
</section>

<script>
    
    function checkedinput(value_id_checked) {
        var id_table_copy_subject = document.getElementById("table_copy_subject_open");
        var value_idcheck = document.getElementById(value_id_checked).checked;
        if (value_idcheck === true) {
            var count_row_table_allcopy = id_table_copy_subject.rows.length;
            for (var i = 0; i < count_row_table_allcopy - 1; i++) {
                document.getElementById(i).checked = true;
            }
        } else {
            var count_row_table_allcopy = id_table_copy_subject.rows.length;
            for (var i = 0; i < count_row_table_allcopy - 1; i++) {
                document.getElementById(i).checked = false;
            }
        }
    }

    function checkedinputCondition(value_id_checked) {
        var id_table_copy_condition = document.getElementById("table_copy_subject_open_condition");
        var value_idcheck = document.getElementById(value_id_checked).checked;
        if (value_idcheck === true) {
            var count_row_table_allcopy = id_table_copy_condition.rows.length;
            for (var i = 0; i < count_row_table_allcopy - 1; i++) {
                var ID_tag = "C" + i;
                document.getElementById(ID_tag).checked = true;
            }
        } else {
            var count_row_table_allcopy = id_table_copy_condition.rows.length;
            for (var i = 0; i < count_row_table_allcopy - 1; i++) {
                var ID_tag = "C" + i;
                document.getElementById(ID_tag).checked = false;
            }
        }
    }

    function displaydiv() {
        var div_manage = document.getElementById("div_manage");
        div_manage.style.display = "none";
        DeleteTablerow();
    }

    function setsemesterdes() {
        var id_des = document.getElementById("des_semester");
        var value_semester_source = document.getElementById("source_semester").value;
        var option = document.createElement("option");
        var length = id_des.options.length;
        for (var i = 1; i < length; i++) {
            id_des.options[i] = null;
        }
        option.text = "ภาคการเรียนที่ " + value_semester_source;
        option.value = value_semester_source;
        id_des.add(option);
        id_des.value = value_semester_source;
        DeleteTablerow();
    }

    function setoptiondesyear() {
        var data_year_source_year = <?php echo Json::encode($Data_year)?>;
        var value_year_source = document.getElementById("source_year").value;
        var id_year_des = document.getElementById("des_year");
        var div_manage = document.getElementById("div_manage");
        div_manage.style.display = "none";
        var length = id_year_des.options.length;
        if (parseInt(value_year_source) === 0) {
            for (var i = id_year_des.options.length - 1; i >= 0; i--) {
                id_year_des.remove(i);
            }
        } else {
            for (var i = id_year_des.options.length - 1; i >= 0; i--) {
                id_year_des.remove(i);
            }
            for (var j = 0; j < data_year_source_year.length; j++) {
                if (parseInt(data_year_source_year[j]["year_id"]) > parseInt(value_year_source)) {
                    var option = document.createElement("option");
                    option.text = "ปีการศึกษา " + data_year_source_year[j]["year_id"];
                    option.value = data_year_source_year[j]["year_id"];
                    id_year_des.add(option);
                }
            }
        }
        DeleteTablerow();
    }

    function insertCopysubjectopen() {
        var source_year = document.getElementById("source_year").value;
        var source_semester = document.getElementById("source_semester").value;
        var des_year = document.getElementById("des_year").value;
        var des_semester = document.getElementById("des_semester").value;
        var id_table_copy_subject = document.getElementById("table_copy_subject_open");
        var count_row_table_allcopy = id_table_copy_subject.rows.length;
        var data_value = [];
        for (var i = 0; i < count_row_table_allcopy - 1; i++) {
            var value_checked = document.getElementById(i).checked;
            if (value_checked === true) {
                data_value.push(document.getElementById(i).value);
            }
        }
        $.ajax({
            url: 'ajax-insert-copy-subjectopen',
            type: 'POST',
            data: {
                source_year: source_year,
                source_semester: source_semester,
                des_year: des_year,
                des_semester: des_semester,
                Data_insert: data_value
            },
            success: function (data) {
                if (data.sucess > 0){
                    alert("บางวิชามีข้อมูลในระบบแล้ว")
                }else{
                    alert("คัดลอกวิชาที่เปิดสอนเสร็จสิ้น");
                }
            }
        })
    }
    
    function insertCopyCondition() {
        var source_year = document.getElementById("source_year").value;
        var source_semester = document.getElementById("source_semester").value;
        var des_year = document.getElementById("des_year").value;
        var des_semester = document.getElementById("des_semester").value;
        var id_table_copy_section = document.getElementById("table_copy_subject_open_condition");
        var count_row_table_allcopy = id_table_copy_section.rows.length;
        var data_value = [];
        for (var i = 0; i < count_row_table_allcopy - 1; i++) {
            var ID_Tag = "C" + i;
            var value_checked = document.getElementById(ID_Tag).checked;
            if (value_checked === true) {
                data_value.push(document.getElementById(ID_Tag).value);
            }
        }
        $.ajax({
            url: 'ajax-insert-copy-section',
            type: 'POST',
            data: {
                source_year: source_year,
                source_semester: source_semester,
                des_year: des_year,
                des_semester: des_semester,
                Data_insert: data_value
            },
            success: function (data) {
                if (parseInt(data.sucess) === 0){
                    alert("คัดลอก Section และ เงื่อนไขเสร็จสิ้น");
                }else{
                    alert("บางวิชามีข้อมูลในระบบแล้ว")
                }
            }
        })
    }

    function DeleteTablerow() {
        var id_table_copy_subject = document.getElementById("table_copy_subject_open");
        var id_table_copy_condition = document.getElementById("table_copy_subject_open_condition");
        var count_row_table_allcopy = id_table_copy_subject.rows.length;
        var count_row_table_copy_condtion = id_table_copy_condition.rows.length;
        if (count_row_table_allcopy !== 1) {
            for (var i = 0; i < count_row_table_allcopy; i++) {
                id_table_copy_subject.deleteRow(1);
            }
        }
        if (count_row_table_copy_condtion !== 1) {
            for (var i = 0; i < count_row_table_copy_condtion; i++) {
                id_table_copy_condition.deleteRow(1);
            }
        }
    }

    function showdivtable() {
        var source_year = document.getElementById("source_year").value;
        var source_semester = document.getElementById("source_semester").value;
        var des_year = document.getElementById("des_year").value;
        var des_semester = document.getElementById("des_semester").value;
        var id_tag_div = document.getElementById("div_manage");
        var id_tag_show_copy_subject_open = document.getElementById("row_copy_subject_open");
        var id_tag_showmanage = document.getElementById("tag_strong_manage");
        var id_table_copy_subject = document.getElementById("table_copy_subject_open");
        var id_table_copy_condition = document.getElementById("table_copy_subject_open_condition");
        if (parseInt(source_year) === 0 || parseInt(source_semester) === 0 || parseInt(des_year) === 0 || parseInt(des_semester) === 0) {
            alert("กรุณากรอกข้อมูลให้ครับ");
            id_tag_div.style.display = "none";
        } else {
            id_tag_show_copy_subject_open.innerHTML = "คัดลอกวิชาที่เปิดสอนปีการศึกษา : " + source_year + " ภาคการศึกษา : " + source_semester + " ไปยังปีการศึกษา : " + des_year + " ภาคการศึกษา : " + des_semester;
            id_tag_showmanage.innerHTML = "จัดการคัดลอกข้อมูลปีการศึกษา : " + source_year + " ภาคการศึกษา : " + source_semester + " ไปยังปีการศึกษา : " + des_year + " ภาคการศึกษา : " + des_semester;
            id_tag_div.style.display = "";
            $.ajax({
                url: 'ajax-get-data-subject',
                type: 'POST',
                data: {
                    source_year: source_year,
                    source_semester: source_semester,
                    des_year: des_year,
                    des_semester: des_semester
                },
                success: function (data) {
                    var array_set = data.datasubjectopen;
                    var array_set_condition = data.datausecopycondition;
                    var array_subopen_desyear = data.datasubopendesyear;
                    var array_section_des = data.datasectiondes;

                    for (var i = 0; i < array_set.length; i++) {
                        var row = id_table_copy_subject.insertRow(1);
                        var cell = row.insertCell(0);
                        var input = document.createElement("input");
                        input.setAttribute("type", "checkbox");
                        input.setAttribute("name", "copy_subject_open[]");
                        input.setAttribute("id", i);
                        var value = array_set[i]['subject_id'] + "," + array_set[i]['subject_version'];
                        input.setAttribute("value", value);
                        cell.appendChild(input);
                        var cell = row.insertCell(1);
                        cell.innerHTML = array_set[i]['subject_id'];
                        var cell = row.insertCell(2);
                        cell.innerHTML = array_set[i]['subject_version'];
                        var cell = row.insertCell(3);
                        cell.innerHTML = array_set[i]['subject_detail']['subject_time'];
                        var cell = row.insertCell(4);
                        var check = 0;
                        for (var j = 0; j < array_subopen_desyear.length; j++) {
                            if (array_subopen_desyear[j]['subject_id'] === array_set[i]['subject_id'] && array_subopen_desyear[j]['subject_version'] === array_set[i]['subject_version']) {
                                check++;
                            }
                        }
                        if (check > 0) {
                            cell.innerHTML = '<strong style="color: red">"มีในระบบแล้ว"</strong>';
                        }
                    }

                    for (var i = 0; i < array_set_condition.length; i++) {
                        var row = id_table_copy_condition.insertRow(1);
                        var cell = row.insertCell(0);
                        var input = document.createElement("input");
                        input.setAttribute("type", "checkbox");
                        input.setAttribute("name", "copy_section_all[]");
                        input.setAttribute("id", "C" + i);
                        var value = array_set_condition[i]['subject_id'] + "," + array_set_condition[i]['subject_version'];
                        input.setAttribute("value", value);
                        cell.appendChild(input);
                        var cell = row.insertCell(1);
                        cell.innerHTML = array_set_condition[i]['subject_id'];
                        var cell = row.insertCell(2);
                        cell.innerHTML = array_set_condition[i]['subject_version'];
                        var cell = row.insertCell(3);
                        cell.innerHTML = array_set_condition[i]['subject_detail']['subject_time'];
                        var cell = row.insertCell(4);
                        var check = 0;
                        for (var j = 0; j < array_section_des.length; j++) {
                            if (array_section_des[j]['subject_id'] === array_set_condition[i]['subject_id'] && array_section_des[j]['subject_version'] === array_set_condition[i]['subject_version']) {
                                check++;
                            }
                        }
                        if (check > 0) {
                            cell.innerHTML = '<strong style="color: red">"มีในระบบแล้ว"</strong>';
                        }
                    }
                }
            })
        }
    }

</script>

