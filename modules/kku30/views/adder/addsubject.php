<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

?>

<section>
    <!-- page title -->
    <header id="page-header">
        <h1>เพิ่มวิชาที่จะทำการเปิดการสอน</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li><a href="searchsubjectsemester?sub_student=<?=$sub_student?>&sub_year=<?=$sub_year?>&sub_stdyear=<?=$sub_stdyear?>">แสดงรายวิชาที่เปิดสอน</a></li>
            <li class="active">เพิ่มวิชา</li>
        </ol>
    </header>
    <!-- /page title -->
    <!--    SHOW SUBJECT LIST-->
    <div id="partA">
        <?php $form = ActiveForm::begin(['action' => ['insertsubject']]) ?>
        <div id="content" class="padding-20">
            <input type="hidden" name="sub_student" id="sub_student" value="<?=$sub_student?>">
            <input type="hidden" name="sub_year" id="sub_year" value="<?=$sub_year?>">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">รหัสหลักสูตร </label>
                    <input id=course_id" name="course_id" type="text" class="form-control" value="<?=$course_id?>" readonly>
                </div>
                <div class="form-group">
                    <label class="control-label">รหัสวิชา </label>
                    <input id="subject_id" name="subject_id" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">ปีหลักสูตร </label>
                    <input id="subject_version" name="subject_version" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label">ชั้นปี </label>
                    <input id="plan_studentyear" name="plan_studentyear" type="text" class="form-control" value="<?=$sub_stdyear?>" readonly>
                </div>
                <div class="form-group">
                    <label class="control-label">ภาคการศึกษา </label>
                    <input id="plan_semester" name="plan_semester" type="text" class="form-control" value="<?=$plan_semester?>" readonly>
                </div>
                <div class="form-group" align="center">
                    <button type="submit" class="btn btn-reveal btn-success">บันทึกวิชาเรียน</button>
                </div>
            </div>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
    <!--    SHOW SUBJECT LIST-->

</section>



