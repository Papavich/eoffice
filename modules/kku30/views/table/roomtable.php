<?php

use yii\widgets\ActiveForm;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>ตารางการใช้ห้องเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">เลือกห้องเรียน</li>
    </ol>
</header>
<!--header-->
<!--SELECT MAJOR-->
<div id="select_teacher" class="panel panel-default">
    <?php $form = ActiveForm::begin(['action' => 'showroomtable']); ?>
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>กรุณาเลือกห้องเรียนที่ต้องการดูตาราง</strong>
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <br><br>
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="year_of" id="year_of" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton()">
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
                    <select name="semester" id="semester" class="form-control pointer  valid inline-block"
                            style="width: 30% !important;" onchange="disbutton()">
                        <option disabled="disabled" selected="selected">--- ภาคการศึกษา ---</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <select name="Room" id="Room" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton()">
                        <option value="0">--- ห้อง ---</option>
                        <?php
                        foreach ($data_room as $row) {
                            $type_name_row = "";
                            if (intval($row['room_type']) == 1) {
                                $type_name_row = "บรรยาย";
                            } elseif (intval($row['room_type']) == 2) {
                                $type_name_row = "ปฎิบัติการ";
                            } elseif (intval($row['room_type']) == 3) {
                                $type_name_row = "แปลภาพ";
                            } elseif (intval($row['room_type']) == 4) {
                                $type_name_row = "ปฎิบัติการ Network";
                            }
                            ?>
                            <option value="<?= $row['room_id'] ?>"><?= $row['room_name'] ?> (<?= $row['room_seat'] ?>)
                                -- <?= $type_name_row ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br><br>
                    <button id="submit_room" class="btn btn-3d btn-green" disabled>ดูตารางการใช้ห้อง</button>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
    $("#submit_room").click(function() {
        if($('#teacher').val() == 0 || $('#year').val() == 0 || $('#semester').val() == 0){
            alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        }
    });
});
JS
); ?>

<script>
    function disbutton() {
        var value_year = document.getElementById("year_of").value;
        var value_semester = document.getElementById("semester").value;
        var value_room = document.getElementById("Room").value;
        var id_submit_room = document.getElementById("submit_room");
        if (value_year !== "0" && value_semester !== "0" && value_room !== "0"){
            id_submit_room.disabled = false;
        }else{
            id_submit_room.disabled = true;
        }
    }
</script>


<!--SELECT MAJOR-->


s