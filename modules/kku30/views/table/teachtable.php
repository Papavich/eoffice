<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ตารางสอน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">เลือกตารางสอน</li>
    </ol>
</header>
<!--header-->
<!--SELECT MAJOR-->
<div id="select_teacher" class="panel panel-default" style="display: block">
    <?php $form = ActiveForm::begin(['action' => 'showteachtable']); ?>
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกผู้สอนที่ต้องการดูตารางสอน</strong>
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="year" id="year" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_teacher()">
                        <option value="0">--- ปีการศึกษา ---</option>
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
                            style="width: 30% !important;" onchange="disbutton_teacher()">
                        <option value="0">--- ภาคการเรียน ---</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <select name="teacher" id="teacher" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_teacher()">
                        <option value="0">--- เลือกอาจารย์ ---</option>
                        <?php
                        foreach ($Data_tacher as $row) {
                            ?>
                            <option value="<?= $row['teacher_no'] ?>">
                                <b><?= $row['teacher_prefix'] ?><?= $row['teacher_name'] ?> <?= $row['teacher_surname'] ?></b>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <button id="submit_teacher" class="btn btn-3d btn-green" disabled>ดูตารางสอน</button>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
    $("#submit_teacher").click(function() {
        if($('#teacher').val() == 0 || $('#year').val() == 0 || $('#semester').val() == 0){
            alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        }
    });
});
JS
); ?>

<script>
    function disbutton_teacher() {
        var id_button_teacher = document.getElementById("submit_teacher");
        var value_year = document.getElementById("year").value;
        var value_semester = document.getElementById("semester").value;
        var value_teacher = document.getElementById("teacher").value;
        if(value_year !== "0" && value_semester !== "0" && value_teacher !== "0"){
            id_button_teacher.disabled = false;
        }else{
            id_button_teacher.disabled = true;
        }
    }
</script>


<!--SELECT MAJOR-->











