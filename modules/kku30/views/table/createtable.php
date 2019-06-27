<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>

<!--JS-->

<?= $this->render('_formjs') ?>

<!--JS-->

<!--HEADER-->
<header id="page-header">
    <h1>การจัดการตารางเรียน</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">จัดตารางเรียน</li>
    </ol>
</header>
<!--HEADER-->
<!--SELECT MAJOR-->
<div id="selectMajor" class="panel panel-default">
    <?php $form = ActiveForm::begin(['action' => 'groupsection']); ?>
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกปีการศึกษาและภาคการศึกษา</strong>
            </div>
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="year_of" id="year_of" class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbutton_table()">
                        <option disabled="disabled" selected="selected">--- ปีการศึกษา ---</option>
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
                            style="width: 30% !important;" onchange="disbutton_table()">
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
                    <button id="button_table" class="btn btn-3d btn-green" disabled>จัดตารางเรียน</button>
                </div>
            </div>
            <!--SHOW CREATE TABLE STATUS-->
            <div id="panel-1" class="panel panel-default">
                <div id="section-to-print">
                    <div class="panel-heading">
                        <span class="title elipsis">
                            <strong>ตารางแสดงสถานะการจัดตารางเรียน</strong>
                        </span>
                    </div>
                    <!--SHOW CREATE TABLE STATUS-->
                    <?= $this->render('_formcreatetablestatus') ?>
                    <!--SHOW CREATE TABLE STATUS-->
                </div>
            </div>
            <!--SHOW CREATE TABLE STATUS-->
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
    <?php
    $Data_check = \app\modules\kku30\models\Kku30CheckTable::find()
        ->all();
    ?>
</div>

<script>
    function disbutton_table() {
        var id_table_button = document.getElementById("button_table");
        var value_semester = document.getElementById("semester");
        var value_year_of = document.getElementById("year_of");
        if (value_semester !== "0" && value_year_of !== "0") {
            var value_check = <?php echo Json::encode($Data_check)?>;
            var check = 0;
            for (var i = 0 ; i < value_check.length ; i++){
                if(parseInt(value_check[i]['check_table_year']) === parseInt(value_year_of) && parseInt(value_check[i]['check_table_semester']) === parseInt(value_semester)){
                    check++;
                }
            }
            if(check === 0){
                id_table_button.disabled = false;
            }
        } else {
            id_table_button.disabled = true;
        }
    }
</script>
<!--SELECT MAJOR-->


<!--CONTENT-->




