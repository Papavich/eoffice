<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
        if($semester != null){
               $("#semester").val($semester).change();
        }
        if($year != null){
               $("#year").val($year).change();
        }
});
JS
); ?>


<!--HEADER-->
<header id="page-header">
    <h1>ลบผลการจัดตารางเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">ลบผลการจัดตาราง</li>
    </ol>
</header>

<!--HEADER-->

<!--SELECT MAJOR-->
<div id="selectMajor" class="panel panel-default">
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกปีการศึกษาและภาคการศึกษา ที่ต้องการลบผลการจัดตารางเรียน</strong>
            </div>
            <div class="panel-body">
                <div align="center">
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="delete_data_year" id="delete_data_year"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="hiddendiv()">
                        <option value="0" selected="selected">--- ปีการศึกษา ---</option>
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
                    <select name="delete_data_semester" id="delete_data_semester"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="hiddendiv()">
                        <option value="0" selected="selected">--- ภาคการศึกษา ---</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <div align="center">
                        <button class="btn btn-3d btn-green" onclick="showdivdeleteData()"><span>จัดการข้อมูล</span>
                        </button>
                    </div>
                </div>

                <div id="div_delete_data" class="panel panel-default" style="display: none">
                    <div class="panel-heading panel-heading-transparent">
                        <strong id="show_manage"></strong>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><strong>การจัดการข้อมูล</strong></th>
                                    <th><strong>คำอธิบาย</strong></th>
                                    <th><strong>ลบข้อมูล</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="odd gradeX">

                                    <td>
                                        ลบรายวิชาที่เปิดสอน
                                    </td>
                                    <td>
                                        ทำการลบวิชาทั้งหมดที่เปิดสอนในภาคการศึกษาและชั้นปีที่เลือก
                                    </td>
                                    <td>
                                        <button id="delete_subject_open" class="btn btn-danger btn-3d"
                                                style="display: inline;" disabled="disabled"
                                                onclick="deletesubjectopen()">ลบข้อมูล (1)
                                        </button>
                                    </td>
                                <tr class="odd gradeX">
                                    <td>
                                        ลบเงื่อนไข
                                    </td>
                                    <td>
                                        ทำการลบเงื่อนไข Section ของวิชาในภาคการศึกษาและชั้นปีที่เลือก
                                    </td>
                                    <td>
                                        <button id="delete_section_condition" class="btn btn-danger btn-3d"
                                                style="display: inline;" disabled="disabled"
                                                onclick="deleteCondition()">ลบข้อมูล (2)
                                        </button>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>
                                        ลบผลการจัดตาราง
                                    </td>
                                    <td>
                                        ทำการลบผลการจัดตารางจากภาคการศึกษาและชั้นปีที่เลือก
                                    </td>
                                    <td>
                                        <button id="delete_group_timeslot" class="btn btn-danger btn-3d"
                                                style="display: inline;" disabled="disabled" onclick="deletetimeslot()">
                                            ลบข้อมูล (3)
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--SELECT MAJOR-->

<script>
    function hiddendiv() {
        var id_tag_div_delete = document.getElementById("div_delete_data");
        id_tag_div_delete.style.display = "none";
    }

    function showdivdeleteData() {
        var value_year = document.getElementById("delete_data_year").value;
        var value_semester = document.getElementById("delete_data_semester").value;
        var id_tag_div_delete = document.getElementById("div_delete_data");
        var id_strong_show = document.getElementById("show_manage");
        var id_delete_subject_open = document.getElementById("delete_subject_open");
        var id_delete_section_condition = document.getElementById("delete_section_condition");
        var id_delete_group_timeslot = document.getElementById("delete_group_timeslot");
        if (parseInt(value_year) === 0 || parseInt(value_semester) === 0) {
            alert("กรูณากรอกให้ครบ");
            id_tag_div_delete.style.display = "none";
        } else {
            id_tag_div_delete.style.display = "";
            $.ajax({
                url: 'ajax-check-delete',
                type: 'POST',
                data: {
                    year: value_year,
                    semester: value_semester
                },
                success: function (data) {
                    if (parseInt(data.sizeofTimeslot) !== 0) {
                        id_delete_group_timeslot.disabled = "";
                        id_delete_section_condition.disabled = "disabled";
                        id_delete_subject_open.disabled = "disabled";
                        id_strong_show.innerHTML = "จัดการข้อมูล ปีการศึกษา : " + value_year + " ภาคการศึกษา : " + value_semester;
                    } else if (parseInt(data.sizeofSection) !== 0) {
                        id_delete_section_condition.disabled = "";
                        id_delete_group_timeslot.disabled = "disabled";
                        id_delete_subject_open.disabled = "disabled";
                        id_strong_show.innerHTML = "จัดการข้อมูล ปีการศึกษา : " + value_year + " ภาคการศึกษา : " + value_semester;
                    } else if (parseInt(data.sizeofSubject) !== 0) {
                        id_delete_subject_open.disabled = "";
                        id_delete_group_timeslot.disabled = "disabled";
                        id_delete_section_condition.disabled = "disabled";
                        id_strong_show.innerHTML = "จัดการข้อมูล ปีการศึกษา : " + value_year + " ภาคการศึกษา : " + value_semester;
                    } else if (parseInt(data.sizeofTimeslot) === 0 && parseInt(data.sizeofSection) === 0 && parseInt(data.sizeofSubject) === 0) {
                        id_delete_subject_open.disabled = "disabled";
                        id_delete_section_condition.disabled = "disabled";
                        id_delete_group_timeslot.disabled = "disabled";
                        id_strong_show.innerHTML = "ปีการศึกษา : " + value_year + " ภาคการศึกษา : " + value_semester + " ยังไม่มีการกรอกข้อมูล";
                    }
                }
            })
        }
    }

    function deletesubjectopen() {
        var value_year = document.getElementById("delete_data_year").value;
        var value_semester = document.getElementById("delete_data_semester").value;
        var id_delete_subject_open = document.getElementById("delete_subject_open");
        var id_strong_show_manage = document.getElementById("show_manage");
        var value_confirm = confirm("ยืนยันการลบข้อมูลวิชาที่เปิดสอนทั้งหมดหรือไม่ ?");
        if (value_confirm) {
            $.ajax({
                url: 'ajax-delete-subject-open',
                type: 'POST',
                data: {
                    year: value_year,
                    semester: value_semester
                },
                success: function (data) {
                    alert("ดำเนินการเสร็จสิ้น");
                    id_delete_subject_open.disabled = "disabled";
                    id_strong_show_manage.innerHTML = "ปีการศึกษา : " + value_year + " ภาคการศึกษา : " + value_semester + " ยังไม่มีการกรอกข้อมูล";
                }
            })
        }
    }

    function deleteCondition() {
        var value_year = document.getElementById("delete_data_year").value;
        var value_semester = document.getElementById("delete_data_semester").value;
        var value_confirm = confirm("ยืนยันการลบข้อมูล Section และเงื่อนไข ?");
        var id_delete_subject_open = document.getElementById("delete_subject_open");
        var id_delete_section_condition = document.getElementById("delete_section_condition");
        if (value_confirm) {
            $.ajax({
                url: 'ajax-delete-section-condition',
                type: 'POST',
                data: {
                    year: value_year,
                    semester: value_semester
                },
                success: function (data) {
                    alert("ดำเนินการเสร็จสิ้น");
                    id_delete_subject_open.disabled = "";
                    id_delete_section_condition.disabled = "disabled";
                }
            })
        }
    }

    function deletetimeslot() {
        var value_year = document.getElementById("delete_data_year").value;
        var value_semester = document.getElementById("delete_data_semester").value;
        var button_id_delete_timeslot = document.getElementById("delete_group_timeslot");
        var button_id_delete_section_condition = document.getElementById("delete_section_condition");
        var value_confirm = confirm("ยืนยันการลบผลการจัดตาราง ?");
        if (value_confirm) {
            $.ajax({
                url: 'ajax-delete-timeslot',
                type: 'POST',
                data: {
                    year: value_year,
                    semester: value_semester
                },
                success: function (data) {
                    alert("ดำเนินการเสร็จสิ้น");
                    button_id_delete_timeslot.disabled = "disabled";
                    button_id_delete_section_condition.disabled = "";
                }
            })
        }
    }
</script>
<!--CONTENT-->




