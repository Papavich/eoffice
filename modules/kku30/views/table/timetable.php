<?php

use yii\widgets\ActiveForm;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ตารางเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">เลือกสาขาวิชาและชั้นปี</li>
    </ol>
</header>
<!--header-->
<!--SELECT MAJOR-->
<div id="selectMajor" class="panel panel-default">
    <?php $form = ActiveForm::begin(['action' => 'showtimetable']); ?>
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกตารางเรียน</strong>
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <select name="program" id="program" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_timetable()">
                        <option value="0">- - สาขา - -</option>
                        <?php
                        foreach ($Data_programs as $row) {
                            $name_type = "";
                            if (intval($row['program_class']) == 1) {
                                $name_type = "ปกติ";
                            } else {
                                $name_type = "พิเศษ";
                            }
                            ?>
                            <option value="<?= $row['program_id'] ?>,<?= $row['program_class'] ?>"><?= $row['program_name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <select name="student_year" id="student_year"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_timetable()">
                        <option value="0">- - ชั้นปี - -</option>
                        <option value="1">ชั้นปีที่ 1</option>
                        <option value="2">ชั้นปีที่ 2</option>
                        <option value="3">ชั้นปีที่ 3</option>
                        <option value="4">ชั้นปีที่ 4</option>
                    </select>
                    <br><br>
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="year" id="year" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_timetable()">
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
                    <select name="semester" id="semester" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_timetable()">
                        <option value="0">- - ภาคการเรียน - -</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <button id="button_timetable" class="btn btn-3d btn-green" disabled>ดูตารางเรียน</button>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<script>
    function disbutton_timetable() {
        var id_tag_timetable = document.getElementById("button_timetable");
        var value_programs = document.getElementById("program").value;
        var value_student_year = document.getElementById("student_year").value;
        var value_year = document.getElementById("year").value;
        var value_semester = document.getElementById("semester").value;
        if(value_year !== "0" && value_semester !== "0" && value_programs !== "0" && value_student_year !== "0"){
            id_tag_timetable.disabled = false;
        }else{
            id_tag_timetable.disabled = true;
        }
    }
</script>


<!--SELECT MAJOR-->

















