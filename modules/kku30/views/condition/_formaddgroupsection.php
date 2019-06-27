<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\Json;

?>
<?php

//
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
//print_r($std_amount);
//echo ("<br>");
//
//
//print_r($L1);
//echo ("<br>");
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
//print_r($std_cs_project1);
//echo ("<br>");
//print_r($std_cs_project2);
//echo ("<br>");
//print_r($std_cs_project3);
//echo ("<br>");
//print_r($std_cs_project4);
//echo ("<br>");
//
//print_r($std_it_project1);
//echo ("<br>");
//print_r($std_it_project2);
//echo ("<br>");
//print_r($std_it_project3);
//echo ("<br>");
//print_r($std_it_project4);
//echo ("<br>");
//
//print_r($std_gis_project1);
//echo ("<br>");
//print_r($std_gis_project2);
//echo ("<br>");
//print_r($std_gis_project3);
//echo ("<br>");
//print_r($std_gis_project4);
//echo ("<br>");
//
//
//
//echo ("count_lecture = ".$count_lecture);
//echo ("<br>");
//
//echo ("count_lab = ".$count_lab);
//echo ("<br>");

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

<div id="partB">
    <?= $this->render('_formshowsubjectsection', [
//            'group_amount' => $group_amount,
        'section_no' => $section_no,
        'Data_id_sub' => $Data_id_sub,
        'Data_nameThai' => $Data_nameThai,
        'Data_nameEng' => $Data_nameEng,
        'plan_semester' => $plan_semester,
        'subject_version' => $subject_version,
        'subject_credit' => $subject_credit,
        'subject_count_lec' => $subject_count_lec,
        'subject_count_lab' => $subject_count_lab,
        'sub_year' => $sub_year,
        'sub_student' => $sub_student,
        'sub_stdyear' => $sub_stdyear,
        'std_amount' => $std_amount,
        'L1' => $L1,
        'L2' => $L2,
        'L3' => $L3,
        'LB1' => $LB1,
        'LB2' => $LB2,
        'LB3' => $LB3,

        'condition_lab' => $condition_lab,
        'condition_section' => $condition_section,
        'major' => $major,
        'std_year' => $std_year,
        'std_project' => $std_project,
        'lec_time' => $lec_time,
        'lab_time' => $lab_time,

        'count_lecture' => $count_lecture,
        'count_lab' => $count_lab,

        'std_cs_project1' => $std_cs_project1,
        'std_cs_project2' => $std_cs_project2,
        'std_cs_project3' => $std_cs_project3,
        'std_cs_project4' => $std_cs_project4,

        'std_it_project1' => $std_it_project1,
        'std_it_project2' => $std_it_project2,
        'std_it_project3' => $std_it_project3,
        'std_it_project4' => $std_it_project4,

        'std_gis_project1' => $std_gis_project1,
        'std_gis_project2' => $std_gis_project2,
        'std_gis_project3' => $std_gis_project3,
        'std_gis_project4' => $std_gis_project4,

    ]) ?>
</div>



<?php $form = ActiveForm::begin(['action' => ['newinsert']]) ?>
<div id="insertGroupamount" class="padding-20">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <strong>ระบุจำนวนกลุ่มของ Group ที่ต้องการแบ่ง section </strong>
        </div>

        <div class="panel-body">
            <!--            --><?php //$form = ActiveForm::begin(['action' => ['']]) ?>
            <div align="center " class="hidden-print">

                <select name="g_amount" id="g_amount" onchange="getGroupamount(this)"
                        class="form-control pointer required valid inline-block" style="width: 17% !important; ">
                    <option disabled="disabled" selected="selected">เลือกจำนวน Group ที่ต้องการแบ่ง Section</option>
                    <?php
                    for ($i = 0; $i < $section_no; $i++) {
                        ?>
                        <option value="<?= $i + 1 ?>"><?= $i + 1 ?></option>
                        <?php
                    }
                    ?>
                </select>
                <button type="submit">test</button>


            </div>

            <input type="hidden" name="section_no" value="<?= $section_no ?>">
            <input type="hidden" name="sub_student" value="<?= $sub_student ?>">
            <input type="hidden" name="sub_year" value="<?= $sub_year ?>">
            <input type="hidden" name="sub_stdyear" value="<?= $sub_stdyear ?>">
            <!--                <input type="hidden" name="std_amount" value="--><? //=$std_amount?><!--">-->


            <!--                <input type="text" name="nos[]" value="--><? //=Json::encode($L1) ?><!--">-->
            <!--                <input type="hidden" name="L2" value="--><? //=$L2?><!--">-->
            <!--                <input type="hidden" name="L3" value="--><? //=$L3?><!--">-->
            <!--                <input type="hidden" name="LB1" value="--><? //=$LB1?><!--">-->
            <!--                <input type="hidden" name="LB2" value="--><? //=$LB2?><!--">-->
            <!--                <input type="hidden" name="LB3" value="--><? //=$LB3?><!--">-->
            <!---->
            <!---->
            <!--                <input type="hidden" name="condition_lab" value="--><? //=$condition_lab?><!--">-->
            <!--                <input type="hidden" name="condition_section" value="-->
            <? //=$condition_section?><!--">-->
            <!--                <input type="hidden" name="major" value="--><? //=$major?><!--">-->
            <!--                <input type="hidden" name="std_year" value="--><? //=$std_year?><!--">-->
            <!--                <input type="hidden" name="std_project" value="--><? //=$std_project?><!--">-->
            <!--                <input type="hidden" name="lec_time" value="--><? //=$lec_time?><!--">-->
            <!--                <input type="hidden" name="lab_time" value="--><? //=$lab_time?><!--">-->

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
<button type="submit">test</button>
<?php $form = ActiveForm::end(); ?>


<!--****************************************************************************************************************************************************************************************************************-->


<div id="showGroupsection" class="padding-20" style="display: none">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <strong>จัดกลุ่มผู้เรียนสำหรับรายวิชา </strong>
        </div>

        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <tbody>
                <tr>

                    <td width="20%" style="text-align: center"><b>กลุ่มที่</b></td>
                    <td width="80%" style="text-align: center"><b>section ที่เรียน</b></td>
                </tr>

                <tr id="g1">
                    <td width="20%" style="text-align: center">1</td>
                    <?php $form = ActiveForm::begin(['action' => ['testsend']]) ?>
                    nos : <input type="hidden" name="nos" id="nos" style="display: none" value="nos">
                    <button type="submit">test</button>
                    <?php $form = ActiveForm::end(); ?>
                    <td width="80%">
                        <a id="g1_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g1_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g1_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g1_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g1_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g1_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g1_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g1_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g1_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g1_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>
                </tr>
                <tr id="g2">
                    <td width="20%" style="text-align: center">2</td>

                    <td width="80%">
                        <a id="g2_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g2_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g2_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g2_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g2_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g2_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g2_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g2_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g2_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g2_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>


                <tr id="g3">
                    <td width="20%" style="text-align: center">3</td>

                    <td width="80%">
                        <a id="g3_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g3_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g3_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g3_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g3_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g3_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g3_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g3_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g3_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g3_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g4">
                    <td width="20%" style="text-align: center">4</td>

                    <td width="80%">
                        <a id="g4_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g4_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g4_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g4_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g4_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g4_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g4_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g4_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g4_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g4_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g5">
                    <td width="20%" style="text-align: center">5</td>

                    <td width="80%">
                        <a id="g5_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g5_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g5_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g5_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g5_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g5_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g5_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g5_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g5_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g5_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g6">
                    <td width="20%" style="text-align: center">6</td>

                    <td width="80%">
                        <a id="g6_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g6_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g6_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g6_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g6_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g6_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g6_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g6_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g6_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g6_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g7">
                    <td width="20%" style="text-align: center">7</td>

                    <td width="80%">
                        <a id="g7_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g7_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g7_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g7_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g7_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g7_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g7_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g7_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g7_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g7_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g8">
                    <td width="20%" style="text-align: center">8</td>

                    <td width="80%">
                        <a id="g8_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g8_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g8_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g8_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g8_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g8_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g8_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g8_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g8_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g8_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g9">
                    <td width="20%" style="text-align: center">9</td>

                    <td width="80%">
                        <a id="g9_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g9_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g9_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g9_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g9_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g9_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g9_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g9_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g9_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g9_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>

                <tr id="g10">
                    <td width="20%" style="text-align: center">10</td>

                    <td width="80%">
                        <a id="g10_1" href="#" style="display: none"><b>section 1</b>, </a>
                        <a id="g10_2" href="#" style="display: none"><b>section 2</b>,&nbsp; </a>
                        <a id="g10_3" href="#" style="display: none"><b>section 3</b>,&nbsp; </a>
                        <a id="g10_4" href="#" style="display: none"><b>section 4</b>,&nbsp; </a>
                        <a id="g10_5" href="#" style="display: none"><b>section 5</b>,&nbsp; </a>
                        <a id="g10_6" href="#" style="display: none"><b>section 6</b>,&nbsp; </a>
                        <a id="g10_7" href="#" style="display: none"><b>section 7</b>,&nbsp; </a>
                        <a id="g10_8" href="#" style="display: none"><b>section 8</b>,&nbsp; </a>
                        <a id="g10_9" href="#" style="display: none"><b>section 9</b>,&nbsp; </a>
                        <a id="g10_10" href="#" style="display: none"><b>section 10</b>&nbsp; </a>
                    </td>

                </tr>


                </tbody>
            </table>


            <!-- ***************** ADD SECTION TO GS ********************-->

            <div class="hidden-print">

                <select name="group_section" id="group_section" class="form-control pointer required valid inline-block"
                        style="width: 20% !important;">
                    <option disabled="disabled" selected="selected">- - กลุ่มที่ - -</option>
                    <option id="gs1" value="1">1</option>
                    <option id="gs2" value="2">2</option>
                    <option id="gs3" value="3">3</option>
                    <option id="gs4" value="4">4</option>
                    <option id="gs5" value="5">5</option>
                    <option id="gs6" value="6">6</option>
                    <option id="gs7" value="7">7</option>
                    <option id="gs8" value="8">8</option>
                    <option id="gs9" value="9">9</option>
                    <option id="gs10" value="10">10</option>
                </select>

                <select name="section" id="section" class="form-control pointer required valid inline-block"
                        style="width: 12% !important;">
                    <option disabled="disabled" selected="selected">- - section - -</option>
                    <?php
                    for ($i = 1; $i <= $section_no; $i++) {
                        ?>
                        <option id="s<?= $i ?>" value="<?= $i ?>">section ที่ <?= $i ?></option>

                        <?php
                    }
                    ?>
                </select>
                <a class="btn btn-success btn-3d" style="width: 70px" onclick="pushSection()">เพิ่ม</a>

            </div>
            <!-- ***************** ADD SECTION TO GS ********************-->
            <div align="right" class="hidden-print" style="display: inline;  width:20% !important"></div>
            <!-- ***************** DELETE SECTION FROM GS ********************-->


            <div class="hidden-print">
                <select name="del_group_section" id="del_group_section"
                        class="form-control pointer required valid inline-block" style="width: 20% !important;">
                    <option disabled="disabled" selected="selected">- - กลุ่มที่ - -</option>
                    <option id="gs1" value="1">1</option>
                    <option id="gs2" value="2">2</option>
                    <option id="gs3" value="3">3</option>
                    <option id="gs4" value="4">4</option>
                    <option id="gs5" value="5">5</option>
                    <option id="gs6" value="6">6</option>
                    <option id="gs7" value="7">7</option>
                    <option id="gs8" value="8">8</option>
                    <option id="gs9" value="9">9</option>
                    <option id="gs10" value="10">10</option>
                </select>

                <select name="del_section" id="del_section" class="form-control pointer required valid inline-block"
                        style="width: 12% !important;">
                    <option disabled="disabled" selected="selected">- - section - -</option>
                    <?php
                    for ($i = 1; $i <= $section_no; $i++) {
                        ?>
                        <option id="s<?= $i ?>" value="<?= $i ?>">section ที่ <?= $i ?></option>

                        <?php
                    }
                    ?>
                </select>
                <a class="btn btn-danger btn-3d" style="width: 70px" onclick="popSection()"> ลบ</a>
                <!--                    </form>-->
            </div>
            <!-- ***************** DELETE SECTION FROM GS ********************-->
        </div>
    </div>
    <div style="text-align: center; background-color: white">
        <hr style="border-color: black">
        <?=
        Html::a('บันทึก', ['newinsert',
        ],
            [
                'class' => 'btn btn-success btn-3d',
                'style' => 'width: 100px',
                'data' => [
                    'confirm' => 'ยืนยันการเพิ่ม section ? ',
                    'method' => 'post',
                ],
            ]);
        ?>
        <hr style="border-color: black">

    </div>

</div>


<script>
    function getGroupamount(selectObject) {


        var value = selectObject.value;
//        alert(value);
        var x = document.getElementById("insertGroupamount");
        var y = document.getElementById("showGroupsection");
        if (value != null) {
            x.style.display = "none";
            y.style.display = "block";
        }

        for (var i = 1; i <= 10; i++) {

            var z = document.getElementById("g" + i);
            var a = document.getElementById("gs" + i);
            if (i > value) {
                z.style.display = "none";
                a.style.display = "none";
            }

        }
    }

    function pushSection() {
        var group_section = document.getElementById('group_section');
        var section = document.getElementById('section');
        var row = group_section.value;
        var col = section.value;

        for (var i = 1; i <= 10; i++) {
            var z = document.getElementById("g" + row + "_" + col);
            z.style.display = "inline-block";
        }
    }

    function popSection() {
        var group_section = document.getElementById('del_group_section');
        var section = document.getElementById('del_section');
        var row = group_section.value;
        var col = section.value;

        for (var i = 1; i <= 10; i++) {
            var z = document.getElementById("g" + row + "_" + col);
            z.style.display = "none";
        }
    }
</script>

