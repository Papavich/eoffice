<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

?>




<?php
//        echo Json::encode($subject_opened_program);
//exit();
//?>
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

<?php
$sub_year2 = "";
$sub_student2 = "";
$std_selected_cs = "";
$std_selected_it = "";
$std_selected_gis = "";
if ($sub_student === "CS") {
    $sub_student2 = "วิทยาการคอมพิวเตอร์";
    $std_selected_cs = "selected";
}
if ($sub_student === "IT") {
    $sub_student2 = "เทคโนโลยีสารสนเทศ";
    $std_selected_it = "selected";
}
if ($sub_student === "GIS") {
    $sub_student2 = "ภูมิศาสตร์สารสนเทศ";
    $std_selected_gis = "selected";
}

if ($sub_year != null) {
    $sub_year2 = "ปีการศึกษา " . $sub_year;
}
if ($sub_stdyear != null) {
    $sub_stdyear = $sub_stdyear;
    $student_year = "ชั้นปีที่ " . $sub_stdyear;
}

?>
<!--SHOW LIST SUBJECT TABLE-->
<div id="section-to-print">
    <div id="panel-1" class="panel panel-default">
        <!-- ******* INPUT MAJOR YEAR AND STDYEAR FOR SEARCHING SUBJECT ********* -->
        <div align="right">
            <header id="page-header">
                <?php $form = ActiveForm::begin(['action' => ['searchsubjectsemester']]) ?>
                <div align="right " class="hidden-print">

                    <select id="sub_student" name="sub_student" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected>- - สาขา - -</option>
                        <option value="CS" <?= $std_selected_cs ?>>วิทยาการคอมพิวเตอร์</option>
                        <option value="IT" <?= $std_selected_it ?>>เทคโนโลยีสารสนเทศ</option>
                        <option value="GIS" <?= $std_selected_gis ?>>ภูมิศาสตร์สารสนเทศ</option>
                    </select>
                    <?php
                    $Data_year = \app\modules\kku30\models\Kku30Year::find()
                        ->all();
                    ?>
                    <select name="sub_year" id="sub_year" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected>- - ปีการศึกษา - -</option>
                        <?php
                        foreach ($Data_year as $row) {
                            ?>
                            <option value="<?= $row['year_id'] ?>">ปีการศึกษา <?= $row['year_id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="sub_stdyear" id="sub_stdyear" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected>- - ชั้นปี - -</option>
                        <option value="1">ชั้นปีที่ 1</option>
                        <option value="2">ชั้นปีที่ 2</option>
                        <option value="3">ชั้นปีที่ 3</option>
                        <option value="4">ชั้นปีที่ 4</option>
                    </select>
                    <button type="submit" class="btn btn-success btn-3d" style="display: inline;">ค้นหา</button>
                </div>
                <?php $form = ActiveForm::end(); ?>
            </header>
        </div>
        <!-- ******* INPUT MAJOR YEAR AND STDYEAR FOR SEARCHING SUBJECT ********* -->

        <!-- ******* TITLE TO SHOW SUBJECT NAME  ********* -->

        <div align="left">
            <header id="page-header">
                <strong>รายวิชาบังคับตามหลักสูตร <?= $sub_student2 ?>
                    <?php
                    if ($sub_stdyear != null) {
                        echo "ชั้นปี " . $sub_stdyear;
                    }
                    ?>
                    <?= $sub_year2 ?>
                </strong>
            </header>
        </div>
        <!-- ******* TITLE TO SHOW SUBJECT NAME  ********* -->
        <!-- panel content -->
        <div class="panel-body">
            <br>
            <?php

            function GenerateCode($Data_id_sub, $Data_nameThai, $Data_nameEng, $course_id, $plan_semester, $subject_version, $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program)
            {
                echo "<td>";
                echo "<a href='detailsubject?id=" . $Data_id_sub . "'><b>" . $Data_id_sub . " " . $Data_nameEng . " ( " . $Data_nameThai . " ) " . "</b></a>";
                echo "<div style=\"display: inline-block; float:right; padding-right:1%;\" class=\"hidden-print\">";
                ?>
                <input type="hidden" id="sub_student" value="<?= $sub_student ?>">
                <input type="hidden" id="sub_year" value="<?= $sub_year ?>">
                <input type="hidden" id="sub_stdyear" value="<?= $sub_stdyear ?>">
                <?=
                Html::a('<i class="glyphicon glyphicon-remove"> Delete </i>', ['deletesubjectopen',
                    'course_id' => $course_id,
                    'subject_id' => $Data_id_sub,
                    'plan_semester' => $plan_semester,
                    'subject_version' => $subject_version,
                    'sub_student' => $sub_student,
                    'sub_year' => $sub_year,
                    'sub_stdyear' => $sub_stdyear,
                ],
                    [
                        'class' => 'btn btn-danger ',
                        'style' => 'font-size: 12px; padding: 0.5px; height:30px; width:70px; vertical-align: top',
                        'data' => [
                            'confirm' => 'ยืนยันการลบวิชา ' . " " . $Data_id_sub . " " . $Data_nameThai . " ? ",
                            'method' => 'post',
                        ],

                    ]);
                ?>
                <?php
                $check_subject_in_subjectopenprogram = "";
                for ($j = 0; $j < count($subject_opened_program); $j++) {
                    if ($subject_opened_program[$j]['subject_id'] == $Data_id_sub and
                        $subject_opened_program[$j]['subject_version'] == $subject_version and
                        $subject_opened_program[$j]['subopen_semester'] == $plan_semester and
                        $subject_opened_program[$j]['subopen_year'] == $sub_year and
                        $subject_opened_program[$j]['program_id'] == $sub_student and
                        $subject_opened_program[$j]['student_year'] == $sub_stdyear
                    ) {
                        $check_subject_in_subjectopenprogram = "opened";
                    }
                }


                $check_status_subj = "";
                for ($i = 0; $i < count($subject_opened); $i++) {
                    if ($subject_opened[$i]['subject_id'] == $Data_id_sub and
                        $subject_opened[$i]['subject_version'] == $subject_version and
                        $subject_opened[$i]['subopen_semester'] == $plan_semester and
                        $subject_opened[$i]['subopen_year'] == $sub_year) {
                        $check_status_subj = "opened";

                    }
                }

                ?>
                <?php
                if ($check_status_subj == "opened" and $check_subject_in_subjectopenprogram == "opened") {
                    ?>
                    <?=
                    Html::a('<i class="glyphicon glyphicon-save"> Close </i>', ['closesubject',
                        'course_id' => $course_id,
                        'subject_id' => $Data_id_sub,
                        'sub_stdyear' => $sub_stdyear,
                        'plan_semester' => $plan_semester,
                        'subject_version' => $subject_version,
                        'sub_year' => $sub_year,
                        'sub_student' => $sub_student,

                    ],
                        [
                            'class' => 'btn btn-default',
                            'style' => 'font-size: 12px; padding: 0.5px; height:30px; width:70px; vertical-align: top',
                            'data' => [
                                'confirm' => 'ยืนยันการปิดวิชา ' . " " . $Data_id_sub . " " . $Data_nameThai . " ? ",
                                'method' => 'post',
                            ],

                        ]);
                    ?>
                    <?php
                } else {
                    ?>
                    <?=
                    Html::a('<i class="glyphicon glyphicon-open"> Open </i>', ['addsubjectopen',
                        'course_id' => $course_id,
                        'subject_id' => $Data_id_sub,
                        'sub_stdyear' => $sub_stdyear,
                        'plan_semester' => $plan_semester,
                        'subject_version' => $subject_version,
                        'sub_year' => $sub_year,
                        'sub_student' => $sub_student,

                    ],
                        [
                            'class' => 'btn btn-success',
                            'style' => 'font-size: 12px; padding: 0.5px; height:30px; width:70px; vertical-align: top',
                            'data' => [
                                'confirm' => 'ยืนยันการเปิดวิชา ' . " " . $Data_id_sub . " " . $Data_nameThai . " ? ",
                                'method' => 'post',
                            ],

                        ]);
                    ?>
                    <?php
                }
                ?>
                <?php
                echo "</div>";
                echo "</td>";
            }

            ?>
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
                    if ($Count_AllData == 0) { ?>
                        <tr>
                            <td>
                                <h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>
                            </td>
                            <td>
                                <h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>
                            </td>
                        </tr>
                    <?php } else {
                        if ($Count_Term1 == 0) {
                            for ($i = 0; $i < max($Count_Term1, $Count_Term2); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <h5 align='center' style='color: red'><b> - </b></h5>
                                    </td>
                                    <?php
                                    GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                    ?>
                                </tr>
                            <?php }
                        } elseif ($Count_Term2 == 0) {
                            for ($i = 0; $i < max($Count_Term1, $Count_Term2); $i++) {
                                ?>
                                <tr>
                                    <?php
                                    GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                    ?>
                                    <td>
                                        <h5 align='center' style='color: red'><b> - </b></h5>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            for ($i = 0; $i < max($Count_Term1, $Count_Term2); $i++) {
                                if ($i >= $Count_Term2) { ?>
                                    <tr>
                                        <?php
                                        GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                        ?>
                                        <td>
                                            <h5 align='center' style='color: red'><b> - </b></h5>
                                        </td>
                                    </tr>
                                <?php } elseif ($i >= $Count_Term1) { ?>
                                    <tr>
                                        <td>
                                            <h5 align='center' style='color: red'><b> - </b></h5>
                                        </td>
                                        <?php
                                        GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                        ?>
                                    </tr>
                                <?php } else { //ใส่ค่าปกติ ?>
                                    <tr>
                                        <?php
                                        GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                        GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'], $course_id, $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_stdyear, $sub_year, $sub_student, $subject_opened, $subject_opened_program);
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                    <?php
                    if ($course_id != null) { ?>
                        <tr class="hidden-print">
                            <th style="text-align: center; width: 50% !important;"><a
                                        href="addsubject?course_id=<?= $course_id ?>&sub_stdyear=<?= $sub_stdyear ?>&plan_semester=1&sub_student=<?= $sub_student ?>&sub_year=<?= $sub_year ?>">เพิ่มวิชาสำหรับภาคการเรียนที่
                                    1</a></th>
                            <th style="text-align: center; width: 50% !important;"><a
                                        href="addsubject?course_id=<?= $course_id ?>&sub_stdyear=<?= $sub_stdyear ?>&plan_semester=2&sub_student=<?= $sub_student ?>&sub_year=<?= $sub_year ?>">เพิ่มวิชาสำหรับภาคการเรียนที่
                                    2</a></th>
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

