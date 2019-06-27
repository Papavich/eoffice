<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$sub_year2 = "";
$sub_student2 = "";
if($sub_student === "CS"){
    $sub_student2 = "วิทยาการคอมพิวเตอร์";
}
if($sub_student === "IT"){
    $sub_student2 = "เทคโนโลยีสารสนเทศ";
}
if($sub_student === "GIS"){
    $sub_student2= "ภูมิศาสตร์สารสนเทศ";
}

if($sub_year != null){
    $sub_year2 = "ปีการศึกษา ".$sub_year;
}
if($sub_stdyear != null){
    $student_year = "ชั้นปีที่ ".$sub_stdyear;
}


?>

<!--SHOW LIST SUBJECT TABLE-->
<div id="section-to-print">
    <div id="main_table" class="padding-20">
        <div id="panel-1" class="panel panel-default">

            <div align="left">
                <!-- page title -->
                <header id="page-header">
                    <strong>รายวิชาเลือกตามหลักสูตร <?=$sub_student2?> ช้ันปีที่ <?=$sub_stdyear?> ปีการศึกษา <?=$sub_year?></strong>
                </header>
                <!-- /page title -->
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <br>
                <!--                        TABLE-->
                <?php $form = ActiveForm::begin(); ?>
                <div class="table-responsive nomargin" width="100%">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th style="text-align: center; width: 50% !important;">ภาคการเรียนที่ 1</th>
                            <th style="text-align: center; width: 50% !important;">ภาคการเรียนที่ 2</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($Count_AllData_Elective == 0) {
                            ?>
                            <tr>
                                <td>
                                    <h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>
                                </td>
                                <td>
                                    <h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>
                                </td>
                            </tr>
                            <?php
                        } else {
                            for ($i = 0; $i < max($Count_Elective_Term1, $Count_Elective_Term2); $i++) {
                                if ($i >= $Count_Elective_Term2) { ?>
                                    <tr>
                                        <?php
                                        GenerateCode($Data_subject_elective_term1[$i]['subject']['subject_id'], $Data_subject_elective_term1[$i]['subject']['subject_namethai'],$Data_subject_elective_term1[$i]['subject']['subject_nameeng'],
                                            "1", $Data_subject_elective_term1[$i]['subject']['subject_version'], $sub_year, $Data_subject_elective_term1[$i]['subject']['subject_credit'],$Data_subject_elective_term1[$i]['subject']['subject_time_lecture']
                                            ,$Data_subject_elective_term1[$i]['subject']['subject_time_lab'],$sub_student,$sub_stdyear , $Data_section_this_year_term);
                                        ?>
                                        <td>
                                            <h5 align='center' style='color: red'><b> - </b></h5>
                                        </td>
                                    </tr>
                                <?php } elseif ($i >= $Count_Elective_Term1) { ?>
                                    <tr>
                                        <td>
                                            <h5 align='center' style='color: red'><b> - </b></h5>
                                        </td>
                                        <?php
                                        GenerateCode($Data_subject_elective_term2[$i]['subject']['subject_id'], $Data_subject_elective_term2[$i]['subject']['subject_namethai'],$Data_subject_elective_term2[$i]['subject']['subject_nameeng'],
                                            "2", $Data_subject_elective_term2[$i]['subject']['subject_version'], $sub_year, $Data_subject_elective_term2[$i]['subject']['subject_credit'],$Data_subject_elective_term2[$i]['subject']['subject_time_lecture']
                                            ,$Data_subject_elective_term2[$i]['subject']['subject_time_lab'],$sub_student,$sub_stdyear , $Data_section_this_year_term);
                                        ?>
                                    </tr>
                                <?php } else { //ใส่ค่าปกติ ?>
                                    <tr>
                                        <?php
                                        GenerateCode($Data_subject_elective_term1[$i]['subject']['subject_id'], $Data_subject_elective_term1[$i]['subject']['subject_namethai'],$Data_subject_elective_term1[$i]['subject']['subject_nameeng'],
                                            "1", $Data_subject_elective_term1[$i]['subject']['subject_version'], $sub_year, $Data_subject_elective_term1[$i]['subject']['subject_credit'],$Data_subject_elective_term1[$i]['subject']['subject_time_lecture']
                                            ,$Data_subject_elective_term1[$i]['subject']['subject_time_lab'],$sub_student,$sub_stdyear , $Data_section_this_year_term);

                                        GenerateCode($Data_subject_elective_term2[$i]['subject']['subject_id'], $Data_subject_elective_term2[$i]['subject']['subject_namethai'],$Data_subject_elective_term2[$i]['subject']['subject_nameeng'],
                                            "2", $Data_subject_elective_term2[$i]['subject']['subject_version'], $sub_year, $Data_subject_elective_term2[$i]['subject']['subject_credit'],$Data_subject_elective_term2[$i]['subject']['subject_time_lecture']
                                            ,$Data_subject_elective_term2[$i]['subject']['subject_time_lab'],$sub_student,$sub_stdyear , $Data_section_this_year_term);
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                        } ?>
                        </tbody>
                    </table>
                </div>
                <!--                        TABLE-->
                <?php $form = ActiveForm::end(); ?>
            </div>
        </div>
        <!--        </form>-->
    </div>
</div>

