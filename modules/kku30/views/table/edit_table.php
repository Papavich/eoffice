<?php

use yii\widgets\ActiveForm;

?>
<!--JS-->
<?= $this->render('_formjs') ?>
<!--JS-->
<!--header-->
<header id="page-header">
    <h1>แก้ไขผลการจัดตาราง</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li class="active">แก้ไขผลการจัดตาราง</li>
    </ol>
</header>
<!--header-->
<!--SELECT MAJOR-->
<div id="selectMajor" class="panel panel-default">
    <?php $form = ActiveForm::begin(['action' => 'showedittable']); ?>
    <div class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เลือกปีการศึกษาและภาคเรียนที่ต้องการแก้ไข</strong>
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <div align="center" id="selectmajor-content">
                    <select name="subopen_year" id="subopen_year"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbuttonedittable()">
                        <option value="0" selected="selected">- - ปีการศึกษา- -</option>
                        <option value="2560">2560</option>
                        <option value="2561">2561</option>
                    </select>
                    <br><br>
                    <select name="subopen_semester" id="subopen_semester"
                            class="form-control pointer required valid inline-block"
                            style="width: 30% !important;" onchange="disbuttonedittable()">
                        <option value="0" selected="selected">- - ภาคการศึกษา - -</option>
                        <option value="1">ภาคการเรียนที่ 1</option>
                        <option value="2">ภาคการเรียนที่ 2</option>
                    </select>
                    <br><br>
                    <button id="button_edit" class="btn btn-3d btn-green" disabled>ดูตารางเรียน</button>
                </div>
            </div>
        </div>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>

<script>
    function disbuttonedittable() {
        var id_tag_edit = document.getElementById("button_edit");
        var value_subopen_year = document.getElementById("subopen_year").value;
        var value_subopen_semester = document.getElementById("subopen_semester").value;
        if(value_subopen_year !== "0" && value_subopen_semester !== "0"){
            id_tag_edit.disabled = false;
        }else{
            id_tag_edit.disabled = true;
        }
    }
</script>


<!--SELECT MAJOR-->
