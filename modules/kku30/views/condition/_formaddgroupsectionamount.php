<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\Json;

?>


<?php
//echo ();
//echo ("<br>");
//
//echo ("section_no = ".$section_no);
//echo ("<br>");
//
//echo ("Data_id_sub = ".$Data_id_sub);
//echo ("<br>");
//
//echo ("Data_nameThai = ".$Data_nameThai);
//echo ("<br>");
//
//echo ("plan_semester = ".$plan_semester);
//echo ("<br>");
//
//echo ("subject_version = ".$subject_version);
//echo ("<br>");
//
//echo ("subject_credit = ".$subject_credit);
//echo ("<br>");
//
//echo ("subject_count_lec = ".$subject_count_lec);
//echo ("<br>");
//
//echo ("subject_count_lab = ".$subject_count_lab);
//echo ("<br>");
//
//echo ("sub_year = ".$sub_year);
//echo ("<br>");
//
//echo ("sub_student = ".$sub_student);
//echo ("<br>");
//
//echo ("sub_stdyear = ".$sub_stdyear);
//echo ("<br>");
//
//
//
//
//print_r($std_amount);
//echo ("<br>");
//
//
//
//print_r($L2);
//echo ("<br>");
//print_r($L3);
//echo ("<br>");
//
//print_r($LB1);
//echo ("<br>");
//print_r($LB2);
//echo ("<br>");
//print_r($LB3);
//echo ("<br>");
//
//print_r($condition_lab);
//echo ("<br>");
//print_r($condition_section);
//echo ("<br>");
//print_r($major);
//echo ("<br>");
//print_r($std_year);
//echo ("<br>");
//print_r($std_project);
//echo ("<br>");
//print_r($lec_time);
//echo ("<br>");
//print_r($lab_time);
//echo ("<br>");
//
//
//echo ("count_lecture = ".$count_lecture);
//echo ("<br>");
//
//echo ("count_lab = ".$count_lab);
//echo ("<br>");
//$data = [1,2,3];
//echo Json::encode($data);
//echo Json::encode($L1);
?>

<!--'group_amount' => $group_amount,-->
<!--'section_no' => $section_no,-->
<!--'Data_id_sub' => $Data_id_sub,-->
<!--'Data_nameThai' => $Data_nameThai,-->
<!--'plan_semester' => $plan_semester,-->
<!--'subject_version' => $subject_version,-->
<!--'subject_credit' => $subject_credit,-->
<!--'subject_count_lec' => $subject_count_lec,-->
<!--'subject_count_lab' => $subject_count_lab,-->
<!--'sub_year' => $sub_year,-->
<!--'sub_student' => $sub_student,-->
<!--'sub_stdyear' => $sub_stdyear,-->
<!---->
<!--'L1' => $L1,-->
<!--'L2' => $L2,-->
<!--'L3' => $L3,-->
<!--'LB1' => $LB1,-->
<!--'LB2' => $LB2,-->
<!--'LB3' => $LB3,-->
<!---->
<!--'condition_lab' => $condition_lab,-->
<!--'condition_section' => $condition_section,-->
<!--'major' => $major,-->
<!--'std_year' => $std_year,-->
<!--'std_project' => $std_project,-->
<!--'lec_time' => $lec_time,-->
<!--'lab_time' => $lab_time,-->
<!---->
<!--'count_lecture' => $count_lecture,-->
<!--'count_lab' => $count_lab,-->

<div id="content" class="padding-20">



    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <strong>ระบุจำนวนกลุ่มของผู้เรียน </strong>
        </div>

        <div class="panel-body">
<!--            --><?php //$form = ActiveForm::begin(['action' => ['']]) ?>
            <div align="center " class="hidden-print">

                <select id="g_amount" onchange="getGroupamount(this)" class="form-control pointer required valid inline-block" style="width: 17% !important; ">
                    <option disabled="disabled" selected="selected">เลือกจำนวน Group ที่ต้องการแบ่ง Section</option>
                    <?php

                    for($i=0;$i< 10;$i++) {

                        ?>
                        <option value="<?= $i+1 ?>"><?= $i+1 ?></option>
                        <?php
                    }
                    ?>
                </select>

            </div>

                <input type="hidden" name="section_no" value="<?=$section_no?>">
                <input type="hidden" name="sub_student" value="<?=$sub_student?>">
                <input type="hidden" name="sub_year" value="<?=$sub_year?>">
                <input type="hidden" name="sub_stdyear" value="<?=$sub_stdyear?>">
<!--                <input type="hidden" name="std_amount" value="--><?//=$std_amount?><!--">-->


<!--                <input type="text" name="nos[]" value="--><?//=Json::encode($L1) ?><!--">-->
<!--                <input type="hidden" name="L2" value="--><?//=$L2?><!--">-->
<!--                <input type="hidden" name="L3" value="--><?//=$L3?><!--">-->
<!--                <input type="hidden" name="LB1" value="--><?//=$LB1?><!--">-->
<!--                <input type="hidden" name="LB2" value="--><?//=$LB2?><!--">-->
<!--                <input type="hidden" name="LB3" value="--><?//=$LB3?><!--">-->
<!---->
<!---->
<!--                <input type="hidden" name="condition_lab" value="--><?//=$condition_lab?><!--">-->
<!--                <input type="hidden" name="condition_section" value="--><?//=$condition_section?><!--">-->
<!--                <input type="hidden" name="major" value="--><?//=$major?><!--">-->
<!--                <input type="hidden" name="std_year" value="--><?//=$std_year?><!--">-->
<!--                <input type="hidden" name="std_project" value="--><?//=$std_project?><!--">-->
<!--                <input type="hidden" name="lec_time" value="--><?//=$lec_time?><!--">-->
<!--                <input type="hidden" name="lab_time" value="--><?//=$lab_time?><!--">-->

<!--                --><?php
//                Html::a('เพิ่มจำนวนกลุ่มเรียน', ['savesection',

////                    'Data_id_sub' => $Data_id_sub,
////                    'Data_nameThai' => $Data_nameThai,
////                    'plan_semester' => $plan_semester,
////                    'subject_version' => $subject_version,
////                    'subject_credit' => $subject_credit,
////                    'subject_count_lec' => $subject_count_lec,
////                    'subject_count_lab' => $subject_count_lab,
//
//                ],
//                    [
//                        'class' => 'btn btn-success btn-3d',
//                        'style' => 'display: inline;',
//                        'data' => [
//                            'confirm' => 'ยืนยันการเพิ่มจำนวนกลุ่มผู้เรียน ? ',
//                            'method' => 'post',
//                        ],
//
//                    ]);
//
//
//                ?>

<!--            --><?php //$form = ActiveForm::end() ?>


        </div>

    </div>



</div>

<script>
    function getGroupamount(selectObject) {
        var value = selectObject.value;
        alert(value);
    }

</script>






