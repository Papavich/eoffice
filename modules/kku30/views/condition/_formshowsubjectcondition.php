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
                    <strong>รายวิชาบังคับตามหลักสูตร <?=$sub_student2?> ช้ันปีที่ <?=$sub_stdyear?> ปีการศึกษา <?=$sub_year?></strong>
                </header>
                <!-- /page title -->
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <?php
                function GenerateCode($Data_id_sub, $Data_nameThai, $Data_nameEng, $plan_semester, $subject_version, $sub_year, $subject_credit, $subject_count_lec, $subject_count_lab, $sub_student, $sub_stdyear, $Data_section_this_year_term)
                {
                    $check = 0;
                    for ($i = 0; $i < sizeof($Data_section_this_year_term); $i++) {
                        if ($Data_id_sub == $Data_section_this_year_term[$i]['subject_id'] && $subject_version == $Data_section_this_year_term[$i]['subject_version']) {
                            $check++;
                        }
                    }
                    ?>
                    <td>
                        <?php
                        if ($check == 0) { ?>
                        <a href='../adder/detailsubject?id=<?= $Data_id_sub ?>'><b style="color:red;"><?= $Data_id_sub ?>    <?= $Data_nameEng ?>
                                (<?= $Data_nameThai ?>)</b></a>
                        <div style="display: inline-block; float:right; padding-right:1%;" class="hidden-print">
                            <?=
                            Html::a('<i class="fa fa-edit white"> เพิ่มเงื่อนไข </i>', ['addsection',
                                'Data_id_sub' => $Data_id_sub,
                                'Data_nameEng' => $Data_nameEng,
                                'Data_nameThai' => $Data_nameThai,
                                'plan_semester' => $plan_semester,
                                'subject_version' => $subject_version,
                                'subject_credit' => $subject_credit,
                                'subject_count_lec' => $subject_count_lec,
                                'subject_count_lab' => $subject_count_lab,
                                'sub_year' => $sub_year,
                                'sub_student' => $sub_student,
                                'sub_stdyear' => $sub_stdyear
                            ],
                                [
                                    'class' => 'btn btn-danger',
                                    'style' => 'font-size: 12px; padding: 0.5px; height:26px; width:85px; vertical-align: top',
                                    'data' => [
                                        'confirm' => 'ต้องการเพิ่มเงื่อนไขรายวิชา ' . " " . $Data_id_sub . " " . $Data_nameEng . " ? ",
                                        'method' => 'post',
                                    ],
                                ]);
                            ?>
                            <?php
                            } else { ?>
                            <a href='../adder/detailsubject?id=<?= $Data_id_sub ?>'><b><?= $Data_id_sub ?>    <?= $Data_nameEng ?>
                                    (<?= $Data_nameThai ?>)</b></a>
                            <div style="display: inline-block; float:right; padding-right:1%;" class="hidden-print">
                                <?=
                                Html::a('<i class="fa fa-edit white" > แก้ไขเงื่อนไข </i>', ['editsection',
                                    'Data_id_sub' => $Data_id_sub,
                                    'Data_nameEng' => $Data_nameEng,
                                    'Data_nameThai' => $Data_nameThai,
                                    'plan_semester' => $plan_semester,
                                    'subject_version' => $subject_version,
                                    'subject_credit' => $subject_credit,
                                    'subject_count_lec' => $subject_count_lec,
                                    'subject_count_lab' => $subject_count_lab,
                                    'sub_year' => $sub_year,
                                    'sub_student' => $sub_student,
                                    'sub_stdyear' => $sub_stdyear
                                ],
                                    [
                                        'class' => 'btn btn-info',
                                        'style' => 'font-size: 12px; padding: 0.5px; height:26px; width:85px; vertical-align: top',
                                        'data' => [
                                            'confirm' => 'ต้องการแก้ไขเงื่อนไขรายวิชา ' . " " . $Data_id_sub . " " . $Data_nameEng . " ? ",
                                            'method' => 'post',
                                        ],
                                    ]);
                                ?>
                                <?php
                                }
                                ?>

                            </div>
                    </td>
                    <?php
                }

                ?>
                <?php $form = ActiveForm::begin(['action' => ['']]) ?>
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
                                        GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'],
                                            $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_year, $Data_subject_term2[$i]['subject']['subject_credit'], $Data_subject_term2[$i]['subject']['subject_time_lecture'],
                                            $Data_subject_term2[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
                                        ?>
                                    </tr>
                                <?php }
                            } elseif ($Count_Term2 == 0) {
                                for ($i = 0; $i < max($Count_Term1, $Count_Term2); $i++) {
                                    ?>
                                    <tr>
                                        <?php
                                        GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'],
                                            $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_year, $Data_subject_term1[$i]['subject']['subject_credit'], $Data_subject_term1[$i]['subject']['subject_time_lecture'],
                                            $Data_subject_term1[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
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
                                            GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'],
                                                $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_year, $Data_subject_term1[$i]['subject']['subject_credit'], $Data_subject_term1[$i]['subject']['subject_time_lecture'],
                                                $Data_subject_term1[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
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
                                            GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'],
                                                $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_year, $Data_subject_term2[$i]['subject']['subject_credit'], $Data_subject_term2[$i]['subject']['subject_time_lecture'],
                                                $Data_subject_term2[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
                                            ?>
                                        </tr>
                                    <?php } else { //ใส่ค่าปกติ ?>
                                        <tr>
                                            <?php
                                            GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai'], $Data_subject_term1[$i]['subject']['subject_nameeng'],
                                                $Data_subject_term1[$i]['plan_semester'], $Data_subject_term1[$i]['subject']['subject_version'], $sub_year, $Data_subject_term1[$i]['subject']['subject_credit'], $Data_subject_term1[$i]['subject']['subject_time_lecture'],
                                                $Data_subject_term1[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
                                            GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai'], $Data_subject_term2[$i]['subject']['subject_nameeng'],
                                                $Data_subject_term2[$i]['plan_semester'], $Data_subject_term2[$i]['subject']['subject_version'], $sub_year, $Data_subject_term2[$i]['subject']['subject_credit'], $Data_subject_term2[$i]['subject']['subject_time_lecture'],
                                                $Data_subject_term2[$i]['subject']['subject_time_lab'], $sub_student, $sub_stdyear, $Data_section_this_year_term);
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
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
</div>

<?php
$this->registerJs(<<<JS
                    $('#sub_student').val("$sub_student");
                    $('#sub_year').val("$sub_year");
                    $('#sub_stdyear').val("$sub_stdyear");
JS
); ?>
<script type="text/javascript">
    function Test321(sub_id, sub_version) {
        $("#test321").val(sub_id + sub_version);
    }

    function addconditionsubject(subject_id, subject_version, sub_year, plan_semester, subject_credit) {
        $("#tagcondition").show();
        $("#subject_id").text(subject_id);
        $("#subject_version").text(subject_version);
        $("#plan_year").text(sub_year);
        $("#plan_semerter").text(plan_semester);
        $("#subject_credit").text(subject_credit);
    }
</script>


