<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>




<?php



//if($sub_year != null){
//    $sub_year = "ปีการศึกษา ".$sub_year;
//}
if($sub_stdyear != null){
    $sub_stdyear = $sub_stdyear;
    $student_year = "ชั้นปีที่ ".$sub_stdyear;
}


?>

<?php
function GenerateCode2($Data_id_sub, $Data_nameThai,$Data_nameEng,$course_id,$plan_semester,$subject_version,$sub_stdyear,$sub_student,$sub_year)
{


    echo "<td>";
    echo "<a href='detailsubject?id=" . $Data_id_sub . "'><b>" . $Data_id_sub . " " .$Data_nameEng. " ( ". $Data_nameThai . " ) "."</b></a>";
    echo "<div style=\"display: inline-block; float:right; padding-right:1%;\" class=\"hidden-print\">";


    ?>

    <?=
    Html::a('<i class="glyphicon glyphicon-remove"> Delete </i>', ['deleteelectivesub',
        'sub_student' => $sub_student,
        'course_id' => $course_id,
        'subject_id' => $Data_id_sub,
        'sub_stdyear' => $sub_stdyear,
        'plan_semester' => $plan_semester,
        'subject_version' => $subject_version,
        'sub_year' => $sub_year,
        //'id' => $Data_id_sub,

    ],
        [
            'class' => 'btn btn-danger ',
            'style' => 'font-size: 12px; padding: 0.5px; height:30px; width:70px; vertical-align: top',
            'data' => [
                'confirm' => 'ยืนยันการลบวิชา '." ".$Data_id_sub. " " .$Data_nameThai. " ? ",
                'method' => 'post',
            ],

        ]) ;


    ?>


    <?php


    ?>

    <?php
    echo "</div>";
    echo "</td>";
}
?>



<!--SHOW LIST SUBJECT TABLE-->
<div id="section-to-print">
    <div id="panel-1" class="panel panel-default">

        <div align="left">
            <!-- page title -->
            <header id="page-header">
                <strong>รายวิชาเลือกตามหลักสูตร <?php
                    if($sub_student === "CS"){
                        echo " วิทยาการคอมพิวเตอร์ ";
                    }
                    if($sub_student === "IT"){
                        echo " เทคโนโลยีสารสนเทศ ";
                    }
                    if($sub_student === "GIS"){
                        echo " ภูมิศาสตร์สารสนเทศ ";
                    }
                    ?>


                    <?php
                    if($sub_stdyear !=null){
                        echo "ชั้นปีที่ ".$sub_stdyear;
                    }
                    ?>


                    <?php
                    if($sub_year != null){
                        echo " ปีการศึกษา ".$sub_year;
                    }
                    ?>


                </strong>
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
                                    GenerateCode2($Data_subject_elective_term1[$i]['subject']['subject_id'], $Data_subject_elective_term1[$i]['subject']['subject_namethai'],$Data_subject_elective_term1[$i]['subject']['subject_nameeng'],
                                        $course_id, "1", $Data_subject_elective_term1[$i]['subject']['subject_version'], $sub_stdyear,$sub_student,$sub_year);
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
                                    GenerateCode2($Data_subject_elective_term2[$i]['subject']['subject_id'], $Data_subject_elective_term2[$i]['subject']['subject_namethai'],$Data_subject_elective_term2[$i]['subject']['subject_nameeng'],
                                        $course_id, "2", $Data_subject_elective_term2[$i]['subject']['subject_version'], $sub_stdyear,$sub_student,$sub_year);
                                    ?>
                                </tr>
                            <?php } else { //ใส่ค่าปกติ ?>
                                <tr>
                                    <?php
                                    GenerateCode2($Data_subject_elective_term1[$i]['subject']['subject_id'], $Data_subject_elective_term1[$i]['subject']['subject_namethai'],$Data_subject_elective_term1[$i]['subject']['subject_nameeng'],
                                        $course_id, "1", $Data_subject_elective_term1[$i]['subject']['subject_version'], $sub_stdyear,$sub_student,$sub_year);
                                    GenerateCode2($Data_subject_elective_term2[$i]['subject']['subject_id'], $Data_subject_elective_term2[$i]['subject']['subject_namethai'],$Data_subject_elective_term2[$i]['subject']['subject_nameeng'],
                                        $course_id, "2", $Data_subject_elective_term2[$i]['subject']['subject_version'], $sub_stdyear,$sub_student,$sub_year);
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                    } ?>

                    <?php
                    if($course_id != null){ ?>

                        <tr>
                            <th style="text-align: center; width: 50% !important;"><a href="addsubjectelective?course_id=<?= $course_id ?>&sub_stdyear=<?= $sub_stdyear ?>&plan_semester=1&sub_student=<?= $sub_student ?>&sub_year=<?= $sub_year ?>">เพิ่มวิชาสำหรับภาคการเรียนที่ 1</a></th>

                            <th style="text-align: center; width: 50% !important;"><a href="addsubjectelective?course_id=<?= $course_id ?>&sub_stdyear=<?= $sub_stdyear ?>&plan_semester=2&sub_student=<?= $sub_student ?>&sub_year=<?= $sub_year ?>">เพิ่มวิชาสำหรับภาคการเรียนที่ 2</a></th>
                        </tr>

                        <?php
                    }
                    ?>



                    </tbody>
                </table>
            </div>
            <!--                        TABLE-->
            <?php $form = ActiveForm::end(); ?>

        </div>
    </div>
    <!--        </form>-->

</div>

