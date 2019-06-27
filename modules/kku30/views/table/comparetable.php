<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>เปรียบเทียบตาราง</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">เลือกตารางเปรียบเทียบ</li>
    </ol>
</header>
<!--header-->
<!--SHOW TABLE COMPARE TABLE-->
<div id="show_teachtable">
    <?php $form = ActiveForm::begin(['action' => 'showcomparetable']); ?>
    <div id="main_table" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>เลือกตารางที่ต้องการจะเปรียบเทียบ &nbsp;<i><span
                                    id="t_table_content"></span></i>&nbsp; &nbsp;<i><span
                                    id="t_year_content"></span></i>&nbsp;  &nbsp; <i><span
                                    id="t_term_content"></span></i>&nbsp;
                    </strong>
            </span>
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <div align="right ">
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select id="year" name="year" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;" onchange="check_button()">
                        <option value="0" selected="selected">- - ปีการศึกษา - -</option>
                        <?php
                        foreach ($Data_year as $row) {
                            ?>
                            <option value="<?= $row['year_id'] ?>">ปีการศึกษา <?= $row['year_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    $Data_semester = \app\modules\kku30\models\Kku30Semester::find()
                        ->all();
                    ?>
                    <select id="semester" name="semester" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;" onchange="check_button()">
                        <option value="0" selected="selected">- - ภาคการเรียน - -</option>
                        <?php
                        foreach ($Data_semester as $row) {
                            ?>
                            <option value="<?= $row['semester_id'] ?>">ภาคการเรียน <?= $row['semester_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id=""
                           style="text-align: center !important;">
                        <thead>
                        <tr style="text-align: center !important;">
                            <th bgcolor="#9FA8DA" align="center"><b>นักศึกษา</b></th>
                            <th bgcolor="#80CBC4">อาจารย์</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: left !important;">

                        <tr class="odd gradeX">
                            <td>
                                <?php
                                $Data_programs = \app\modules\kku30\models\Kku30Program::find()
                                    ->all();

                                foreach ($Data_programs as $row) {
                                    for ($i = 1; $i <= 4; $i++) {
                                        ?>
                                        <label class="checkbox">
                                            <input name="program[]" type="checkbox"
                                                   value="<?= $row['program_id'] ?>,<?= $row['program_class'] ?>,<?= $i ?>" onclick="check_button()">
                                            <i></i> <?= $row['program_name'] ?> ชั้นปีที่ <?= $i ?>
                                        </label>
                                        <br>
                                        <?php
                                    }
                                    echo "<hr>";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                $data_teacher = \app\modules\kku30\models\Kku30Teacher::find()
                                    ->all();
                                foreach ($data_teacher as $row) {
                                    ?>
                                    <label class="checkbox">
                                        <input id="teacher[]" name="teacher[]" type="checkbox" value="<?= $row['teacher_no'] ?>" onclick="check_button()">
                                        <i></i> <?= $row['teacher_prefix'] ?><?= $row['teacher_name'] ?>  <?= $row['teacher_surname'] ?>
                                    </label>
                                    <br>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div align="center">
                    <button id="submit_button" class="btn btn-3d btn-green" disabled><span>เปรียบเทียบตาราง</span></button>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<script>
    function check_button() {
        var value_semester = document.getElementById("semester").value;
        var value_year = document.getElementById("year").value;
        var id_tag_button = document.getElementById("submit_button");
        if (value_semester !== "0" && value_year !== "0"){
            id_tag_button.disabled = false;
        }else{
            id_tag_button.disabled = true;
        }
//        alert(value_teacher);
    }
</script>
<!--SHOW TABLE COMPARE TABLE-->





