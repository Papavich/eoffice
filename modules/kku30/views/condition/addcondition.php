<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
        
        if($sub_year != null){
               $("#sub_year").val($sub_year).change();
               $("#sub_stdyear").val($sub_stdyear).change();
                // $("#sub_student").val($sub_student).change();
        }

});
JS
); ?>

<section>
    <!-- page title -->
    <header id="page-header">
        <h1>แสดงรายวิชาที่ทำการเพิ่มเงื่อนไข</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li class="active">เพิ่มเงื่อนไขรายวิชาที่เปิดสอน</li>
        </ol>
    </header>
    <!-- /page title -->

    <div align="right">
        <!-- search subject condition -->
<!--        <header id="page-header" style="display: none">-->
<!--            <div align="right " class="hidden-print">-->
<!--                <select id="" name="" class="form-control pointer required valid inline-block"-->
<!--                        style="width: 10% !important;">-->
<!--                    <option disabled="disabled" selected>- - สาขา - -</option>-->
<!--                    <option value="CS" >วิทยาการคอมพิวเตอร์</option>-->
<!--                    <option value="IT" >เทคโนโลยีสารสนเทศ</option>-->
<!--                    <option value="GIS" >ภูมิศาสตร์สารสนเทศ</option>-->
<!--                </select>-->
<!---->
<!--                <select name="" id="" class="form-control pointer required valid inline-block"-->
<!--                        style="width: 10% !important;">-->
<!--                    <option disabled="disabled" selected>- - ปีการศึกษา - -</option>-->
<!--                    <option value="2561">ปีการศึกษา 2561</option>-->
<!--                </select>-->
<!--                <select name="" id="" class="form-control pointer required valid inline-block" style="width: 10% !important;">-->
<!--                    <option disabled="disabled" selected>- - ชั้นปี - -</option>-->
<!--                    <option value="1">ชั้นปีที่ 1</option>-->
<!--                    <option value="2">ชั้นปีที่ 2</option>-->
<!--                    <option value="3">ชั้นปีที่ 3</option>-->
<!--                    <option value="4">ชั้นปีที่ 4</option>-->
<!--                </select>-->
<!--                <button type="submit" class="btn btn-success btn-3d" style="display: inline;">Search</button>-->
<!--            </div>-->
<!--        </header>-->

        <header id="page-header">
            <?php $form = ActiveForm::begin(['action' => ['searchsubjectcondition']]) ?>
            <select id="sub_student" name="sub_student" class="form-control pointer required valid inline-block" style="width: 10% !important;">
                <option disabled="disabled" selected>- - สาขา - -</option>
                <option value="CS">วิทยาการคอมพิวเตอร์</option>
                <option value="IT">เทคโนโลยีสารสนเทศ</option>
                <option value="GIS">ภูมิศาสตร์สารสนเทศ</option>
            </select>
            <?php
            $Data_year = \app\modules\kku30\models\Kku30Year::find()
                ->all();
            ?>
            <select id="sub_year" name="sub_year" class="form-control pointer required valid inline-block" style="width: 10% !important;">
                <option disabled="disabled" selected>- - ปีการศึกษา - -</option>
                <?php
                foreach ($Data_year as $row) {
                    ?>
                    <option value="<?= $row['year_id'] ?>">ปีการศึกษา <?= $row['year_id'] ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="sub_stdyear" id="sub_stdyear" class="form-control pointer required valid inline-block" style="width: 10% !important;">
                <option disabled="disabled" selected>- - ชั้นปี - -</option>
                <option value="1">ชั้นปีที่ 1</option>
                <option value="2">ชั้นปีที่ 2</option>
                <option value="3">ชั้นปีที่ 3</option>
                <option value="4">ชั้นปีที่ 4</option>
            </select>
            <button type="submit" class="btn btn-success btn-3d" style="display: inline-block;">ค้นหา</button>
            <?php $form = ActiveForm::end(); ?>
        </header>
        <!-- search subject condition -->
    </div>
    <!--    SHOW SUBJECT LIST-->

    <div id="partA">
        <?= $this->render('_formshowsubjectcondition', [
            'Count_AllData' => $Count_AllData,
            'Count_Term1' => $Count_Term1,
            'Count_Term2' => $Count_Term2,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'course_id' => $course_id,
            'Data_section_this_year_term' => $Data_section_this_year_term
        ]) ?>
    </div>
    <!--    SHOW SUBJECT LIST-->
    <!--    SHOW ADD SUBJECT-->
    <div id="partB">
        <?= $this->render('_formsubjectelectivecondition', [
            'Count_AllData_Elective' => $Count_AllData_Elective,
            'Count_Elective_Term1' => $Count_Elective_Term1,
            'Count_Elective_Term2' => $Count_Elective_Term2,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
            'sub_year' => $sub_year,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'Data_section_this_year_term' => $Data_section_this_year_term
        ]) ?>
    </div>

    <!--    SHOW ADD SUBJECT-->

</section>



