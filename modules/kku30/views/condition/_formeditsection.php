<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

?>

<?php
$section_no = count($section_data);

$subject_count_lec = $section_data[0]['subject_detail']['subject_time_lecture'];
$subject_count_lab = $section_data[0]['subject_detail']['subject_time_lab'];

$displayLec = "block";
$displayLab = "block";

if ($subject_count_lec == 0) {
    $displayLec = "none";
}
if ($subject_count_lab == 0) {
    $displayLab = "none";
}

?>

<section>
    <!-- page title -->
    <header id="page-header">
        <h1>เพิ่มจำนวนกลุ่มผู้เรียนในรายวิชา</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li><a href="searchsubjectcondition?sub_student=<?=$sub_student ?>&sub_year=<?=$sub_year ?>&sub_stdyear=<?=$sub_stdyear ?>">เพิ่มเงื่อนไขรายวิชาที่เปิดสอน</a></li>
            <li class="active">เพิ่มกลุ่มผู้เรียน</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>เพิ่มเงื่อนไขรายวิชา <?= $Data_id_sub ?> <?= $Data_nameEng ?> (<?= $Data_nameThai ?>) </strong>
            </div>
            <div class="panel-body">

                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td width="10%" style="text-align: center"><b>รหัสรายวิชา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $Data_id_sub ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>ชื่อวิชา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $Data_nameEng ?> (<?= $Data_nameThai ?>)</a>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>เวอร์ชั่นรายวิชา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $subject_version ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>หน่วยกิตรายวิชา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $subject_credit ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>ปีการศึกษา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $sub_year ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>ภาคการศึกษา</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $plan_semester ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>จำนวนชั่วโมงบรรยาย/สัปดาห์</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $subject_count_lec ?></a></td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align: center"><b>จำนวนชั่วโมงปฎิบัติการ/สัปดาห์</b></td>
                        <td width="90%"><a href="#" id="username" data-type="text" data-pk="1"
                                           data-title="Enter username"><?= $subject_count_lab ?></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="tagcondition" class="panel-body">
            <?php $form = ActiveForm::begin(['action' => ['editsection']]) ?>
            จำนวน Section : <select id="section_no" name="section_no"
                                    class="form-control pointer required valid inline-block"
                                    style="width: 17% !important;">
                <option disabled="disabled" selected="selected">เลือกจำนวน Section</option>
                <option value="1">1 Section</option>
                <option value="2">2 Section</option>
                <option value="3">3 Section</option>
                <option value="4">4 Section</option>
                <option value="5">5 Section</option>
                <option value="6">6 Section</option>
                <option value="7">7 Section</option>
                <option value="8">8 Section</option>
                <option value="9">9 Section</option>
                <option value="10">10 Section</option>
            </select>
            <?=
            Html::a('ตกลง', ['editsection',
                'Data_id_sub' => $Data_id_sub,
                'Data_nameThai' => $Data_nameThai,
                'Data_nameEng' => $Data_nameEng,
                'plan_semester' => $plan_semester,
                'subject_version' => $subject_version,
                'sub_year' => $sub_year,
                'subject_credit' => $subject_credit,
                'subject_count_lec' => $subject_count_lec,
                'subject_count_lab' => $subject_count_lab,
                'sub_student' => $sub_student,
                'sub_stdyear' => $sub_stdyear
            ],
                [
                    'class' => 'btn btn-success btn-3d',
                    'style' => 'display: inline;',
                    'data' => [
                        'confirm' => 'ยืนยันการเพิ่ม section ? ',
                        'method' => 'post',
                    ],
                ]);
            ?>
            <?php $form = ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin(['action' => ['newinsert']]) ?>
            <?php if ($section_no != null) { ?>
            <input type="hidden" name="subject_id" value="<?= $Data_id_sub ?>">
            <input type="hidden" name="subject_version" value="<?= $subject_version ?>">
            <input type="hidden" name="plna_semester" value="<?= $plan_semester ?>">
            <input type="hidden" name="subject_credit" value="<?= $subject_credit ?>">
            <input type="hidden" name="subject_count_lab" value="<?= $subject_count_lab ?>">
            <input type="hidden" name="subject_count_lec" value="<?= $subject_count_lec ?>">
            <input type="hidden" name="sub_year" value="<?= $sub_year ?>">
            <input type="hidden" name="sub_student" value="<?= $sub_student ?>">
            <input type="hidden" name="sub_stdyear" value="<?= $sub_stdyear ?>">
            <?php
            if (intval($new_section_no) == 0) {
                ?>
                <input type="hidden" id="sum_section" name="sum_section" value="<?= $section_no ?>">
                <?php
            } else { ?>
                <input type="hidden" id="sum_section" name="sum_section" value="<?= $new_section_no ?>">
                <?php
            }
            ?>

            <!-- ******************************************************************************************* SECTION FROM DATABASE **********************************************************************-->
            <?php
            if ($new_section_no !== 0 && $new_section_no < $section_no) {
                for ($i = 0; $i < $section_no - $new_section_no; $i++) {
                    ?>
                    <div id="content" class="padding-20">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>section ที่ <?= $i + 1 ?></strong>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <b>จำนวนคน :</b><br>
                                        <input type="text" value="<?= $section_data[$i]['section_size'] ?>"
                                               class="form-control pointer required valid inline-block"
                                               id="<?= $i + 1 ?>section_size"
                                               name="<?= $i + 1 ?>section_size"
                                               style="width: 300px; margin-left: 50px; text-align: center;"
                                               onchange="checkdisplaybutton_condition()">

                                        <br><br>
                                        <b>สาขาเรียน :</b>

                                        <!-- ******************CS ******************-->
                                        <div style="margin-left: 50px;">
                                            สาขาวิทยาการคอมพิวเตอร์
                                            <div name="cs<?= $i + 1 ?>" id="cs<?= $i + 1 ?>">

                                                <?php
                                                $array_learn_CS_old = $section_data[$i]['section_program'];

                                                if (sizeof($array_learn_CS != 0)) {
                                                    $data = array();
                                                    foreach ($array_learn_CS as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";

                                                    }

                                                    $dataInDb = [];
                                                    foreach ($array_learn_CS_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }


                                                    echo Select2::widget([
                                                        'id' => 'section_programCS' . ($i + 1),
                                                        'name' => 'section_programCS' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <!-- ******************CS ******************-->

                                        <br>

                                        <!-- ******************IT ******************-->
                                        <div style="margin-left: 50px">
                                            สาขาเทคโนโลยีสารสนเทศ
                                            <div name="it<?= $i + 1 ?>" id="it<?= $i + 1 ?>">
                                                <?php
                                                $array_learn_IT_old = $section_data[$i]['section_program'];

                                                if (sizeof($array_learn_IT) != 0) {
                                                    $data = array();
                                                    foreach ($array_learn_IT as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                    }


                                                    $dataInDb = [];
                                                    foreach ($array_learn_IT_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }


                                                    echo Select2::widget([
                                                        'id' => 'section_programIT' . ($i + 1),
                                                        'name' => 'section_programIT' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                            'oneclick'
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <!-- ******************IT ******************-->
                                        <br>
                                        <!-- ****************** GIS ******************-->
                                        <div style="margin-left: 50px;">
                                            สาขาภูมิสารสนเทศศาสตร์
                                            <div name="gis<?= $i + 1 ?>" id="gis<?= $i + 1 ?>">
                                                <?php
                                                $array_learn_GIS_old = $section_data[$i]['section_program'];
                                                if (sizeof($array_learn_GIS) != 0) {
                                                    $data = array();
                                                    foreach ($array_learn_GIS as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                    }
                                                    $dataInDb = [];
                                                    foreach ($array_learn_GIS_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }
                                                    echo Select2::widget([
                                                        'id' => 'section_programGIS' . ($i + 1),
                                                        'name' => 'section_programGIS' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                            'oneclick'
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <!-- ****************** GIS ******************-->

                                        <br>

                                        <!-- ****************** CONDITION GROUP ******************-->
                                        <b>เงื่อนไขของกลุ่มเรียน :</b>

                                        <div style="margin-left: 50px">
                                            <?php if ($subject_count_lab != 0) { ?>
                                                ห้องเฉพาะทาง (สำหรับห้องปฎิบัติการ) :
                                                <br>
                                                <select id="condition_lab<?= $i + 1 ?>"
                                                        name="condition_lab<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 300px !important;">
                                                    <option value="0">-- ห้องเฉพาะทาง --</option>
                                                    <?php
                                                    foreach ($Data_Room as $row) {
                                                        if ($section_data[$i]['section_condition_lab'] == $row['room_id']) {
                                                            ?>
                                                            <option value="<?= $row['room_id'] ?>"
                                                                    selected="selected"><?= $row['room_name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?= $row['room_id'] ?>"><?= $row['room_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                            <br><br>

                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                            <div id="tag_section<?= $i + 1 ?>">
                                                <?php

                                                if ($section_no > 0) {

                                                    if (intval($section_data[$i]['section_count_lec']) != 0) {
                                                        $join_lec = explode(",", $section_data[$i]['section_join_lec']);
                                                        ?>
                                                        เรียนร่วมกัน (Lecture) :
                                                        <br>
                                                        <?php
                                                        $show_join_checkbox = 0;
                                                        if ($new_section_no == 0) {
                                                            $show_join_checkbox = $section_no;
                                                        } else {
                                                            $show_join_checkbox = $new_section_no;
                                                        }
                                                        for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                            $status = "";
                                                            for ($k = 0; $k < count($join_lec); $k++) {
                                                                if ($join_lec[$k] == "0" . ($j + 1)) {
                                                                    $status = "checked";
                                                                }
                                                            }
                                                            if ($j != $i) {
                                                                ?>
                                                                <label class="checkbox">
                                                                    <input id="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           name="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           type="checkbox" <?= $status ?>
                                                                           value="0<?= $j + 1 ?>"
                                                                           onclick="displaysection(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                                    Section <?= $j + 1 ?>
                                                                </label>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>

                                            </div>

                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                            <!--***** JOIN SECTION FOR LAB *********-->
                                            <div id="tag_section<?= $i + 1 ?>?">
                                                <?php
                                                if ($section_no > 0) {
                                                    if (intval($section_data[$i]['section_count_lab']) != 0) {
                                                        $join_lab = explode(",", $section_data[$i]['section_join_lab']);
                                                        ?>

                                                        เรียนร่วมกัน (Lab) :
                                                        <br>
                                                        <?php
                                                        $show_join_checkbox = 0;
                                                        if ($new_section_no == 0) {
                                                            $show_join_checkbox = $section_no;
                                                        } else {
                                                            $show_join_checkbox = $new_section_no;
                                                        }
                                                        for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                            $status = "";
                                                            for ($k = 0; $k < count($join_lab); $k++) {
                                                                if ($join_lab[$k] == "0" . ($j + 1)) {
                                                                    $status = "checked";
                                                                }
                                                            }
                                                            if ($j != $i) {
                                                                ?>
                                                                <label class="checkbox">
                                                                    <input id="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           name="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>" <?= $status ?>
                                                                           type="checkbox" value="0<?= $j + 1 ?>"
                                                                           onclick="displaysection2(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                                    Section <?= $j + 1 ?>
                                                                </label>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                        </div>
                                        <!-- ****************** CONDITION GROUP ******************-->
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- ******************* TEACH PATTERN FOR LECTURE  ***********************-->
                                        <b style="display: <?= $displayLec ?>;">รูปแบบการสอนคาบบรรยาย :</b>
                                        <div style="margin-left: 50px; display: <?= $displayLec ?>;">
                                            <?php
                                            $subject_count_lec = $section_data[$i]['subject_detail']['subject_time_lecture'];

                                            $hour_lec_type = "";
                                            if ($section_data[$i]['section_count_lec'] != 0) {
                                                $hour_lec_type = $section_data[$i]['subject_detail']['subject_time_lecture'] / $section_data[$i]['section_count_lec'];

                                            }
                                            $ds1 = "";
                                            $ds2 = "";
                                            $ds3 = "";
                                            if ($subject_count_lec == 3) {
                                                ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s15 = "";
                                                $s3 = "";

                                                if ($hour_lec_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "block";

                                                } elseif ($hour_lec_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lec_type == 3) {
                                                    $s3 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s3 ?>
                                                                            value="3"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 2) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s2 = "";
                                                if ($hour_lec_type == 1) {
                                                    $s1 = "checked";

                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lec_type == 2) {
                                                    $s2 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked=""
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s2 ?>
                                                                            value="2"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1.5) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s15 = "";

                                                if ($hour_lec_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";

                                                if ($hour_lec_type == 1.5) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked="checked"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <h1>-</h1>
                                                <?php
                                            }
                                            ?>
                                            <div id="lec" style="display:">
                                                <br>
                                                <div id="lec1<?= $i + 1 ?>" name="lec1<?= $i + 1 ?>"
                                                     style="display: <?= $ds1 ?>">
                                                    <a style="color: red ">ระบุเวลาเรียน*(บรรยาย) :</a><br>
                                                    <select id="day_lec1<?= $i + 1 ?>" name="day_lec1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec1<?= $i + 1 ?>" name="time_lec1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lec2<?= $i + 1 ?>" name="lec2<?= $i + 1 ?>"
                                                     style="display: <?= $ds2 ?>">
                                                    <select id="day_lec2<?= $i + 1 ?>" name="day_lec2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec2<?= $i + 1 ?>" name="time_lec2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lec3<?= $i + 1 ?>" name="lec3<?= $i + 1 ?>"
                                                     style="display: <?= $ds3 ?>">
                                                    <select id="day_lec3<?= $i + 1 ?>" name="day_lec3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec3<?= $i + 1 ?>" name="time_lec3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- ******************* TEACH PATTERN FOR LECTURE  ***********************-->
                                        <br>
                                        <!-- ******************* TEACH PATTERN FOR LAB  ***********************-->
                                        <b style="display:<?= $displayLab ?>; ">รูปแบบการสอนปฎิบัติการ :</b>
                                        <div style="margin-left: 50px; display: <?= $displayLab ?>;">
                                            <?php
                                            $subject_count_lab = $section_data[$i]['subject_detail']['subject_time_lab'];
                                            $hour_lab_type = "";
                                            if ($section_data[$i]['section_count_lab'] != 0) {
                                                $hour_lab_type = $section_data[$i]['subject_detail']['subject_time_lab'] / $section_data[$i]['section_count_lab'];
                                            }
                                            $ds1 = "";
                                            $ds2 = "";
                                            $ds3 = "";
                                            if ($subject_count_lab == 3) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s15 = "";
                                                $s3 = "";
                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "block";
                                                } elseif ($hour_lab_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lab_type == 3) {
                                                    $s3 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->

                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s3 ?>
                                                                            value="3" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 2) { ?>

                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s2 = "";

                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lab_type == 2) {
                                                    $s2 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->

                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s2 ?>
                                                                            value="2"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1.5) { ?>

                                                <!--check hour type-->
                                                <?php

                                                $s15 = "";

                                                if ($hour_lab_type == 1) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1) { ?>
                                                <!--check hour type-->
                                                <?php

                                                $s1 = "";


                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <label><h4>-</h4></label>
                                                <?php
                                            }
                                            ?>

                                            <div id="lab" style="display:">
                                                <br>

                                                <div id="lab1<?= $i + 1 ?>" name="lab1<?= $i + 1 ?>"
                                                     style="display: <?= $ds1 ?>">
                                                    <b style="color: red ">ระบุเวลาเรียน*(ปฏิบัติ) :</b><br>
                                                    <select id="day_lab1<?= $i + 1 ?>" name="day_lab1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab1<?= $i + 1 ?>" name="time_lab1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lab2<?= $i + 1 ?>" name="lab2<?= $i + 1 ?>"
                                                     style="display: <?= $ds2 ?>">
                                                    <select id="day_lab2<?= $i + 1 ?>" name="day_lab2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab2<?= $i + 1 ?>" name="time_lab1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="s20">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lab3<?= $i + 1 ?>" name="lab3<?= $i + 1 ?>"
                                                     style="display: <?= $ds3 ?>">
                                                    <select id="day_lab3<?= $i + 1 ?>" name="day_lab3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab3<?= $i + 1 ?>" name="time_lab3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ******************* TEACH PATTERN FOR LAB  ***********************-->
                                        <br>
                                        <!-- ******************* SELECT TEACHER  ***********************-->

                                        <b>อาจารย์ผู้สอน :</b>
                                        <div style="margin-left: 50px">
                                            <?php
                                            $data = array();
                                            foreach ($Data_teacher as $row) {
                                                $data[$row['teacher_no']] = $row['teacher_prefix'] . $row['teacher_name'] . " " . $row['teacher_surname'];
                                            }
                                            ?>

                                            <?php
                                            $array_teacher_old = $section_data[$i]['section_teacher'];
                                            $dataInDb = [];
                                            foreach ($array_teacher_old as $item) {
                                                $dataInDb[] = $item['teacher_no'];
                                            }
                                            ?>
                                            <?php echo Select2::widget([
                                                'id' => 'section_teacher' . ($i + 1),
                                                'name' => 'section_teacher' . ($i + 1),
                                                'hideSearch' => true,
                                                'value' => $dataInDb,
                                                'data' => $data,
                                                'options' => [
                                                    'multiple' => true,
                                                ],
                                                'size' => Select2::SMALL,
                                                'class' => 'form-control pointer required valid inline-block',
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                    'width' => '300px',
                                                    'oneclick'
                                                ],
                                            ]);
                                            ?>
                                        </div>

                                        <!-- ******************* SELECT TEACHER  ***********************-->

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                for ($i = 0; $i < $section_no; $i++) {
                    ?>
                    <div id="content" class="padding-20">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>section ที่ <?= $i + 1 ?></strong>
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <b>จำนวนคน :</b><br>
                                        <input type="text" value="<?= $section_data[$i]['section_size'] ?>"
                                               class="form-control pointer required valid inline-block"
                                               name="<?= $i + 1 ?>section_size"
                                               id="<?= $i + 1 ?>section_size"
                                               style="width: 300px; margin-left: 50px; text-align: center;"
                                               onchange="checkdisplaybutton_condition()">

                                        <br><br>
                                        <b>สาขาเรียน :</b>

                                        <!-- ******************CS ******************-->
                                        <div style="margin-left: 50px;">
                                            สาขาวิทยาการคอมพิวเตอร์
                                            <div name="cs<?= $i + 1 ?>" id="cs<?= $i + 1 ?>">

                                                <?php
                                                $array_learn_CS_old = $section_data[$i]['section_program'];

                                                if (sizeof($array_learn_CS != 0)) {
                                                    $data = array();
                                                    foreach ($array_learn_CS as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";

                                                    }

                                                    $dataInDb = [];
                                                    foreach ($array_learn_CS_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }


                                                    echo Select2::widget([
                                                        'id' => 'section_programCS' . ($i + 1),
                                                        'name' => 'section_programCS' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <!-- ******************CS ******************-->

                                        <br>

                                        <!-- ******************IT ******************-->
                                        <div style="margin-left: 50px">
                                            สาขาเทคโนโลยีสารสนเทศ
                                            <div name="it<?= $i + 1 ?>" id="it<?= $i + 1 ?>">

                                                <?php

                                                $array_learn_IT_old = $section_data[$i]['section_program'];

                                                if (sizeof($array_learn_IT) != 0) {
                                                    $data = array();
                                                    foreach ($array_learn_IT as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                    }


                                                    $dataInDb = [];
                                                    foreach ($array_learn_IT_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }


                                                    echo Select2::widget([
                                                        'id' => 'section_programIT' . ($i + 1),
                                                        'name' => 'section_programIT' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                            'oneclick'
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }

                                                ?>
                                            </div>
                                        </div>
                                        <!-- ******************IT ******************-->
                                        <br>
                                        <!-- ****************** GIS ******************-->
                                        <div style="margin-left: 50px;">
                                            สาขาภูมิสารสนเทศศาสตร์
                                            <div name="gis<?= $i + 1 ?>" id="gis<?= $i + 1 ?>">

                                                <?php

                                                $array_learn_GIS_old = $section_data[$i]['section_program'];

                                                if (sizeof($array_learn_GIS) != 0) {
                                                    $data = array();
                                                    foreach ($array_learn_GIS as $row) {
                                                        $name_program = "";
                                                        if ($row['program_class'] == 1) {
                                                            $name_program = "ปกติ";
                                                        } else {
                                                            $name_program = "พิเศษ";
                                                        }
                                                        $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                    }


                                                    $dataInDb = [];
                                                    foreach ($array_learn_GIS_old as $item) {
                                                        $dataInDb[] = $item['program_id'] . "," . $item['program_class'] . "," . $item['student_year'];
                                                    }


                                                    echo Select2::widget([
                                                        'id' => 'section_programGIS' . ($i + 1),
                                                        'name' => 'section_programGIS' . ($i + 1),
                                                        'hideSearch' => true,
                                                        'value' => $dataInDb,
                                                        'data' => $data,
                                                        'options' => [
                                                            'multiple' => true,
                                                        ],
                                                        'size' => Select2::SMALL,
                                                        'class' => 'form-control pointer required valid inline-block',
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'width' => '300px',
                                                            'oneclick'
                                                        ],
                                                    ]);
                                                } else {
                                                    echo " <b>-</b> ";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <!-- ****************** GIS ******************-->

                                        <br>

                                        <!-- ****************** CONDITION GROUP ******************-->
                                        <b>เงื่อนไขของกลุ่มเรียน :</b>

                                        <div style="margin-left: 50px">
                                            <?php if ($subject_count_lab != 0) { ?>
                                                ห้องเฉพาะทาง (สำหรับห้องปฎิบัติการ) :
                                                <br>
                                                <select id="condition_lab<?= $i + 1 ?>"
                                                        name="condition_lab<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 300px !important;">
                                                    <option value="0">-- ห้องเฉพาะทาง --</option>
                                                    <?php
                                                    foreach ($Data_Room as $row) {
                                                        if ($section_data[$i]['section_condition_lab'] == $row['room_id']) {
                                                            ?>
                                                            <option value="<?= $row['room_id'] ?>"
                                                                    selected="selected"><?= $row['room_name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?= $row['room_id'] ?>"><?= $row['room_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                            <br><br>

                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                            <div id="tag_section<?= $i + 1 ?>">
                                                <?php

                                                if ($section_no > 0) {

                                                    if (intval($section_data[$i]['section_count_lec']) != 0) {
                                                        $join_lec = explode(",", $section_data[$i]['section_join_lec']);
                                                        ?>
                                                        เรียนร่วมกัน (Lecture) :
                                                        <br>
                                                        <?php
                                                        $show_join_checkbox = 0;
                                                        if ($new_section_no == 0) {
                                                            $show_join_checkbox = $section_no;
                                                        } else {
                                                            $show_join_checkbox = $new_section_no;
                                                        }
                                                        for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                            $status = "";
                                                            for ($k = 0; $k < count($join_lec); $k++) {
                                                                if ($join_lec[$k] == "0" . ($j + 1)) {
                                                                    $status = "checked";
                                                                }
                                                            }
                                                            if ($j != $i) {
                                                                ?>
                                                                <label class="checkbox">
                                                                    <input id="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           name="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           type="checkbox" <?= $status ?>
                                                                           value="0<?= $j + 1 ?>"
                                                                           onclick="displaysection(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                                    Section <?= $j + 1 ?>
                                                                </label>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                            <!--***** JOIN SECTION FOR LAB *********-->
                                            <div id="tag_section<?= $i + 1 ?>?">
                                                <?php
                                                if ($section_no > 0) {
                                                    if (intval($section_data[$i]['section_count_lab']) != 0) {
                                                        $join_lab = explode(",", $section_data[$i]['section_join_lab']);
                                                        ?>
                                                        เรียนร่วมกัน (Lab) :
                                                        <br>
                                                        <?php
                                                        $show_join_checkbox = 0;
                                                        if ($new_section_no == 0) {
                                                            $show_join_checkbox = $section_no;
                                                        } else {
                                                            $show_join_checkbox = $new_section_no;
                                                        }
                                                        for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                            $status = "";
                                                            for ($k = 0; $k < count($join_lab); $k++) {
                                                                if ($join_lab[$k] == "0" . ($j + 1)) {
                                                                    $status = "checked";
                                                                }
                                                            }
                                                            if ($j != $i) {
                                                                ?>
                                                                <label class="checkbox">
                                                                    <input id="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>"
                                                                           name="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>" <?= $status ?>
                                                                           type="checkbox" value="0<?= $j + 1 ?>"
                                                                           onclick="displaysection2(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                                    Section <?= $j + 1 ?>
                                                                </label>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <!--***** JOIN SECTION FOR LECTURE *********-->

                                        </div>
                                        <!-- ****************** CONDITION GROUP ******************-->
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- ******************* TEACH PATTERN FOR LECTURE  ***********************-->
                                        <b style="display: <?= $displayLec ?>;">รูปแบบการสอนคาบบรรยาย :</b>
                                        <div style="margin-left: 50px; display: <?= $displayLec ?>;">
                                            <?php
                                            $subject_count_lec = $section_data[$i]['subject_detail']['subject_time_lecture'];
                                            $hour_lec_type = "";
                                            if ($section_data[$i]['section_count_lec'] != 0) {
                                                $hour_lec_type = $section_data[$i]['subject_detail']['subject_time_lecture'] / $section_data[$i]['section_count_lec'];

                                            }
                                            $ds1 = "";
                                            $ds2 = "";
                                            $ds3 = "";
                                            if ($subject_count_lec == 3) {
                                                ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s15 = "";
                                                $s3 = "";

                                                if ($hour_lec_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "block";

                                                } elseif ($hour_lec_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lec_type == 3) {
                                                    $s3 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s3 ?>
                                                                            value="3"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 2) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s2 = "";
                                                if ($hour_lec_type == 1) {
                                                    $s1 = "checked";

                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lec_type == 2) {
                                                    $s2 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked=""
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s2 ?>
                                                                            value="2"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"><i></i>แบบ
                                                    2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1.5) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s15 = "";

                                                if ($hour_lec_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";

                                                if ($hour_lec_type == 1.5) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked="checked"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <h1>-</h1>
                                                <?php
                                            }
                                            ?>
                                            <div id="lec" style="display:">
                                                <br>
                                                <div id="lec1<?= $i + 1 ?>" name="lec1<?= $i + 1 ?>"
                                                     style="display: <?= $ds1 ?>">
                                                    <a style="color: red ">ระบุเวลาเรียน*(บรรยาย) :</a><br>
                                                    <select id="day_lec1<?= $i + 1 ?>" name="day_lec1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec1<?= $i + 1 ?>" name="time_lec1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lec2<?= $i + 1 ?>" name="lec2<?= $i + 1 ?>"
                                                     style="display: <?= $ds2 ?>">
                                                    <select id="day_lec2<?= $i + 1 ?>" name="day_lec2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec2<?= $i + 1 ?>" name="time_lec2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lec3<?= $i + 1 ?>" name="lec3<?= $i + 1 ?>"
                                                     style="display: <?= $ds3 ?>">
                                                    <select id="day_lec3<?= $i + 1 ?>" name="day_lec3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>

                                                    <select id="time_lec3<?= $i + 1 ?>" name="time_lec3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- ******************* TEACH PATTERN FOR LECTURE  ***********************-->
                                        <br>
                                        <!-- ******************* TEACH PATTERN FOR LAB  ***********************-->
                                        <b style="display:<?= $displayLab ?>; ">รูปแบบการสอนปฎิบัติการ :</b>
                                        <div style="margin-left: 50px; display: <?= $displayLab ?>;">
                                            <?php
                                            $subject_count_lab = $section_data[$i]['subject_detail']['subject_time_lab'];
                                            $hour_lab_type = "";
                                            if ($section_data[$i]['section_count_lab'] != 0) {
                                                $hour_lab_type = $section_data[$i]['subject_detail']['subject_time_lab'] / $section_data[$i]['section_count_lab'];
                                            }
                                            $ds1 = "";
                                            $ds2 = "";
                                            $ds3 = "";
                                            if ($subject_count_lab == 3) { ?>
                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s15 = "";
                                                $s3 = "";
                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "block";
                                                } elseif ($hour_lab_type == 1.5) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lab_type == 3) {
                                                    $s3 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->

                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s3 ?>
                                                                            value="3" checked="checked"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 2) { ?>

                                                <!--check hour type-->
                                                <?php
                                                $s1 = "";
                                                $s2 = "";

                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "block";
                                                    $ds3 = "none";
                                                } elseif ($hour_lab_type == 2) {
                                                    $s2 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->

                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s2 ?>
                                                                            value="2"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1.5) { ?>

                                                <!--check hour type-->
                                                <?php

                                                $s15 = "";

                                                if ($hour_lab_type == 1) {
                                                    $s15 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s15 ?>
                                                                            value="1.5"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1) { ?>
                                                <!--check hour type-->
                                                <?php

                                                $s1 = "";


                                                if ($hour_lab_type == 1) {
                                                    $s1 = "checked";
                                                    $ds1 = "block";
                                                    $ds2 = "none";
                                                    $ds3 = "none";
                                                }
                                                ?>
                                                <!--check hour type-->
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>" <?= $s1 ?>
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <label><h4>-</h4></label>
                                                <?php
                                            }
                                            ?>

                                            <div id="lab" style="display:">
                                                <br>

                                                <div id="lab1<?= $i + 1 ?>" name="lab1<?= $i + 1 ?>"
                                                     style="display: <?= $ds1 ?>">
                                                    <b style="color: red ">ระบุเวลาเรียน*(ปฏิบัติ) :</b><br>
                                                    <select id="day_lab1<?= $i + 1 ?>" name="day_lab1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab1<?= $i + 1 ?>" name="time_lab1<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lab2<?= $i + 1 ?>" name="lab2<?= $i + 1 ?>"
                                                     style="display: <?= $ds2 ?>">
                                                    <select id="day_lab2<?= $i + 1 ?>" name="day_lab2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab2<?= $i + 1 ?>" name="time_lab2<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="s20">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>

                                                <div id="lab3<?= $i + 1 ?>" name="lab3<?= $i + 1 ?>"
                                                     style="display: <?= $ds3 ?>">
                                                    <select id="day_lab3<?= $i + 1 ?>" name="day_lab3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">วัน</option>
                                                        <option value="Monday">วันจันทร์</option>
                                                        <option value="Tuesday">วันอังคาร</option>
                                                        <option value="Wednesday">วันพุธ</option>
                                                        <option value="Thursday">วันพฤหัสบดี</option>
                                                        <option value="Friday">วันศุกร์</option>
                                                        <option value="Saturday">วันเสาร์</option>
                                                        <option value="Sunday">วันอาทิตย์</option>
                                                    </select>
                                                    <select id="time_lab3<?= $i + 1 ?>" name="time_lab3<?= $i + 1 ?>"
                                                            class="form-control pointer required valid inline-block"
                                                            style="width: 150px !important;">
                                                        <option value="0" selected="selected">เวลาเริ่มต้น
                                                        </option>
                                                        <option value="08.00">08.00</option>
                                                        <option value="08.30">08.30</option>
                                                        <option value="9.00">9.00</option>
                                                        <option value="9.30">9.30</option>
                                                        <option value="10.00">10.00</option>
                                                        <option value="10.30">10.30</option>
                                                        <option value="11.00">11.00</option>
                                                        <option value="11.30">11.30</option>
                                                        <option value="12.00">12.00</option>
                                                        <option value="12.30">12.30</option>
                                                        <option value="13.00">13.00</option>
                                                        <option value="13.30">13.30</option>
                                                        <option value="14.00">14.00</option>
                                                        <option value="14.30">14.30</option>
                                                        <option value="15.00">15.00</option>
                                                        <option value="15.30">15.30</option>
                                                        <option value="16.00">16.00</option>
                                                        <option value="16.30">16.30</option>
                                                        <option value="17.00">17.00</option>
                                                        <option value="17.30">17.30</option>
                                                        <option value="17.30">18.00</option>
                                                        <option value="18.30">18.30</option>
                                                        <option value="19.00">19.00</option>
                                                        <option value="19.30">19.30</option>
                                                        <option value="20.00">20.00</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ******************* TEACH PATTERN FOR LAB  ***********************-->
                                        <br>
                                        <!-- ******************* SELECT TEACHER  ***********************-->

                                        <b>อาจารย์ผู้สอน :</b>
                                        <div style="margin-left: 50px">
                                            <?php
                                            $data = array();
                                            foreach ($Data_teacher as $row) {
                                                $data[$row['teacher_no']] = $row['teacher_prefix'] . $row['teacher_name'] . " " . $row['teacher_surname'];
                                            }
                                            ?>

                                            <?php
                                            $array_teacher_old = $section_data[$i]['section_teacher'];
                                            $dataInDb = [];
                                            foreach ($array_teacher_old as $item) {
                                                $dataInDb[] = $item['teacher_no'];
                                            }
                                            ?>
                                            <?php echo Select2::widget([
                                                'id' => 'section_teacher' . ($i + 1),
                                                'name' => 'section_teacher' . ($i + 1),
                                                'hideSearch' => true,
                                                'value' => $dataInDb,
                                                'data' => $data,
                                                'options' => [
                                                    'multiple' => true,
                                                ],
                                                'size' => Select2::SMALL,
                                                'class' => 'form-control pointer required valid inline-block',
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                    'width' => '300px',
                                                    'oneclick'
                                                ],
                                            ]);
                                            ?>
                                        </div>

                                        <!-- ******************* SELECT TEACHER  ***********************-->

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <!-- ******************************************************************************************* SECTION FROM DATABASE **********************************************************************-->

            <!--****************************************************************************** NEW SECTION **********************************************************************************************-->
            <?php if ($new_section_no != null) { ?>
                <?php
                for ($i = $section_no; $i < $new_section_no; $i++) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-transparent">
                            <strong>section ที่ <?= $i + 1 ?> <p style="color:red; display: inline-block">
                                    (เพิ่มใหม่)</p></strong>
                        </div>

                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <b>จำนวนคน :</b>
                                    <br>
                                    <input type="text"
                                           class="form-control pointer required valid inline-block"
                                           name="<?= $i + 1 ?>section_size"
                                           id="<?= $i + 1 ?>section_size"
                                           style="width: 300px; margin-left: 50px; text-align: center;"
                                           onchange="checkdisplaybutton_condition()">

                                    <br><br>

                                    <b>สาขาเรียน :</b>

                                    <!-- ****************** NEW CS ******************-->
                                    <div style="margin-left: 50px">
                                        สาขาวิทยาการคอมพิวเตอร์
                                        <div name="cs<?= $i + 1 ?>" id="cs<?= $i + 1 ?>">
                                            <?php
                                            if (sizeof($array_learn_CS) != 0) {
                                                $data = array();
                                                foreach ($array_learn_CS as $row) {
                                                    $name_program = "";
                                                    if ($row['program_class'] == 1) {
                                                        $name_program = "ปกติ";
                                                    } else {
                                                        $name_program = "พิเศษ";
                                                    }
                                                    $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                }
                                                echo Select2::widget([
                                                    'id' => 'section_programCS' . ($i + 1),
                                                    'name' => 'section_programCS' . ($i + 1),
                                                    'hideSearch' => true,
                                                    'data' => $data,
                                                    'options' => [
                                                        'multiple' => true,
                                                    ],
                                                    'size' => Select2::SMALL,
                                                    'class' => 'form-control pointer required valid inline-block',
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'width' => '300px',
                                                        'oneclick'
                                                    ],
                                                ]);
                                            } else {
                                                echo "<a style='color: red'> ** วิชานี้ยังไม่ได้เปิดสอนสำหรับ สาขาวิทยาการคอมพิวเตอร์ ** </a>";
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <!-- ****************** NEW CS ******************-->
                                    <br>

                                    <!-- ****************** NEW IT ******************-->
                                    <div style="margin-left: 50px">
                                        สาขาเทคโนโลยีสารสนเทศ
                                        <div name="cs<?= $i + 1 ?>" id="cs<?= $i + 1 ?>">

                                            <?php
                                            if (sizeof($array_learn_IT) != 0) {
                                                $data = array();
                                                foreach ($array_learn_IT as $row) {
                                                    $name_program = "";
                                                    if ($row['program_class'] == 1) {
                                                        $name_program = "ปกติ";
                                                    } else {
                                                        $name_program = "พิเศษ";
                                                    }
                                                    $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                }
                                                echo Select2::widget([
                                                    'id' => 'section_programIT' . ($i + 1),
                                                    'name' => 'section_programIT' . ($i + 1),
                                                    'hideSearch' => true,
                                                    'data' => $data,
                                                    'options' => [
                                                        'multiple' => true,
                                                    ],
                                                    'size' => Select2::SMALL,
                                                    'class' => 'form-control pointer required valid inline-block',
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'width' => '300px',
                                                        'oneclick'
                                                    ],
                                                ]);
                                            } else {
                                                echo "<a style='color: red'> ** วิชานี้ยังไม่ได้เปิดสอนสำหรับ สาขาเทคโนโลยีสารสนเทศ ** </a>";
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <!-- ****************** NEW IT ******************-->
                                    <br>

                                    <!-- ****************** NEW GIS ******************-->
                                    <div style="margin-left: 50px">
                                        สาขาภูมิสารสนเทศศาสตร์
                                        <div name="cs<?= $i + 1 ?>" id="cs<?= $i + 1 ?>">

                                            <?php
                                            if (sizeof($array_learn_GIS) != 0) {
                                                $data = array();
                                                foreach ($array_learn_GIS as $row) {
                                                    $name_program = "";
                                                    if ($row['program_class'] == 1) {
                                                        $name_program = "ปกติ";
                                                    } else {
                                                        $name_program = "พิเศษ";
                                                    }
                                                    $data[$row['program_id'] . "," . $row['program_class'] . "," . $row['student_year']] = "ชั้นปีที่ " . $row['student_year'] . "(" . $name_program . ")";
                                                }
                                                echo Select2::widget([
                                                    'id' => 'section_programGIS' . ($i + 1),
                                                    'name' => 'section_programGIS' . ($i + 1),
                                                    'hideSearch' => true,
                                                    'data' => $data,
                                                    'options' => [
                                                        'multiple' => true,
                                                    ],
                                                    'size' => Select2::SMALL,
                                                    'class' => 'form-control pointer required valid inline-block',
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'width' => '300px',
                                                        'oneclick'
                                                    ],
                                                ]);
                                            } else {
                                                echo "<a style='color: red'> ** วิชานี้ยังไม่ได้เปิดสอนสำหรับ สาขาภูมิสารสนเทศศาสตร์ ** </a>";
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <!-- ****************** NEW GIS ******************-->
                                    <br>

                                    <!-- ****************** NEW CONDITION GROUP ******************-->
                                    <b>เงื่อนไขของกลุ่มเรียน :</b>

                                    <div style="margin-left: 50px">

                                        <?php if ($subject_count_lab != 0) { ?>
                                            ห้องเฉพาะทาง (สำหรับห้องปฎิบัติการ) :
                                            <br>
                                            <select id="condition_lab<?= $i + 1 ?>" name="condition_lab<?= $i + 1 ?>"
                                                    class="form-control pointer required valid inline-block"
                                                    style="width: 300px !important;">
                                                <option selected="selected" value="0">-- ห้องเฉพาะทาง --</option>
                                                <?php
                                                foreach ($Data_Room as $row) {
                                                    ?>
                                                    <option value="<?= $row['room_id'] ?>"><?= $row['room_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        <br><br>

                                        <!--***** NEW JOIN SECTION FOR LECTURE *********-->
                                        <div id="tag_section<?= $i + 1 ?>?">
                                            <?php
                                            if (intval($subject_count_lec) != 0) { ?>
                                                เรียนร่วมกัน (Lecture) :
                                                <br>
                                                <?php
                                                $show_join_checkbox = $new_section_no;

                                                for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                    if ($j != $i) {
                                                        ?>
                                                        <label class="checkbox">
                                                            <input id="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                   name="section_join_lec<?= $i + 1 ?><?= $j + 1 ?>"
                                                                   type="checkbox" value="0<?= $j + 1 ?>"
                                                                   onclick="displaysection(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                            Section <?= $j + 1 ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>

                                        <!--***** NEW JOIN SECTION FOR LECTURE *********-->
                                        <!--***** NEW JOIN SECTION FOR LAB *********-->

                                        <div id="tag_section<?= $i + 1 ?>?">
                                            <?php
                                            if (intval($subject_count_lab) != 0) { ?>
                                                เรียนร่วมกัน (Lab) :
                                                <br>
                                                <?php
                                                $show_join_checkbox = $new_section_no;
                                                for ($j = 0; $j < $show_join_checkbox; $j++) {
                                                    if ($j != $i) {
                                                        ?>
                                                        <label class="checkbox">
                                                            <input id="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>"
                                                                   name="section_join_lab<?= $i + 1 ?><?= $j + 1 ?>"
                                                                   type="checkbox" value="0<?= $j + 1 ?>"
                                                                   onclick="displaysection2(<?= $i + 1 ?>,<?= $j + 1 ?>,this.id)"><i></i>
                                                            Section <?= $j + 1 ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>

                                        <!--***** NEW JOIN SECTION FOR LAB *********-->

                                    </div>
                                    <!-- ****************** NEW CONDITION GROUP ******************-->

                                </div>

                                <div class="col-sm-6">
                                    <!-- ******************* NEW TEACH PATTERN FOR LECTURE  ***********************-->
                                    <div id="lec" style="display:<?= $displayLec ?>">
                                        <b>รูปแบบการสอนคาบบรรยาย :</b>
                                        <div style="margin-left: 50px">
                                            <?php
                                            if ($subject_count_lec == 3) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="3"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 2) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="2"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1.5) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="1.5"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lec == 1) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lec<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLecTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <h1>-</h1>
                                                <?php
                                            }
                                            ?>
                                            <br><br>
                                            <b style="color: red ">ระบุเวลาเรียน*(บรรยาย) :</b>
                                            <div id="lec1<?= $i + 1 ?>" name="lec1<?= $i + 1 ?>">
                                                <select id="day_lec1<?= $i + 1 ?>" name="day_lec1<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lec1<?= $i + 1 ?>" name="time_lec1<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="17.30">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                            <div id="lec2<?= $i + 1 ?>" name="lec2<?= $i + 1 ?>" style="display: none">
                                                <select id="day_lec2<?= $i + 1 ?>" name="day_lec2<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lec2<?= $i + 1 ?>" name="time_lec2<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="17.30">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                            <div id="lec3<?= $i + 1 ?>" name="lec3<?= $i + 1 ?>" style="display: none">
                                                <select id="day_lec3<?= $i + 1 ?>" name="day_lec3<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lec3<?= $i + 1 ?>" name="time_lec3<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px!important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="17.30">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ******************* NEW TEACH PATTERN FOR LECTURE  ***********************-->

                                    <br>
                                    <!-- ******************* TEACH PATTERN FOR LAB  ***********************-->
                                    <div id="lab" style="display:<?= $displayLab ?>">
                                        <b>รูปแบบการสอนปฎิบัติการ :</b>
                                        <div style="margin-left: 50px">
                                            <?php
                                            if ($subject_count_lab == 3) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="1.5"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="3"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,3,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 3 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 2) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"><i></i>
                                                    แบบ 1 ชม.</label>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="2"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,2,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 2 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1.5) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="1.5"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1.5,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 1.5 ชม.</label>
                                                <?php
                                            } elseif ($subject_count_lab == 1) { ?>
                                                <label class="radio"><input type="radio"
                                                                            name="cout_time_lab<?= $i + 1 ?>"
                                                                            value="1"
                                                                            onclick="showInputLabTime(<?= $i + 1 ?>,1,<?= $subject_count_lec ?>)"
                                                                            checked><i></i>
                                                    แบบ 1 ชม.</label>
                                                <?php
                                            } else { ?>
                                                <label><h4>-</h4></label>
                                                <?php
                                            }
                                            ?>


                                            <br><br>
                                            <b style="color: red ">ระบุเวลาเรียน*(ปฏิบัติ) :</b>
                                            <div id="lab1<?= $i + 1 ?>" name="lab1<?= $i + 1 ?>">
                                                <select id="day_lab1<?= $i + 1 ?>" name="day_lab1<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lab1<?= $i + 1 ?>" name="time_lab1<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="17.30">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                            <div id="lab2<?= $i + 1 ?>" name="lab2<?= $i + 1 ?>" style="display: none">
                                                <select id="day_lab2<?= $i + 1 ?>" name="day_lab2<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lab2<?= $i + 1 ?>" name="time_lab2<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="s20">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                            <div id="lab3<?= $i + 1 ?>" name="lab3<?= $i + 1 ?>" style="display: none">
                                                <select id="day_lab3<?= $i + 1 ?>" name="day_lab3<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">วัน</option>
                                                    <option value="Monday">วันจันทร์</option>
                                                    <option value="Tuesday">วันอังคาร</option>
                                                    <option value="Wednesday">วันพุธ</option>
                                                    <option value="Thursday">วันพฤหัสบดี</option>
                                                    <option value="Friday">วันศุกร์</option>
                                                    <option value="Saturday">วันเสาร์</option>
                                                    <option value="Sunday">วันอาทิตย์</option>
                                                </select>
                                                <select id="time_lab3<?= $i + 1 ?>" name="time_lab3<?= $i + 1 ?>"
                                                        class="form-control pointer required valid inline-block"
                                                        style="width: 150px !important;">
                                                    <option value="0" selected="selected">เวลาเริ่มต้น
                                                    </option>
                                                    <option value="08.00">08.00</option>
                                                    <option value="08.30">08.30</option>
                                                    <option value="9.00">9.00</option>
                                                    <option value="9.30">9.30</option>
                                                    <option value="10.00">10.00</option>
                                                    <option value="10.30">10.30</option>
                                                    <option value="11.00">11.00</option>
                                                    <option value="11.30">11.30</option>
                                                    <option value="12.00">12.00</option>
                                                    <option value="12.30">12.30</option>
                                                    <option value="13.00">13.00</option>
                                                    <option value="13.30">13.30</option>
                                                    <option value="14.00">14.00</option>
                                                    <option value="14.30">14.30</option>
                                                    <option value="15.00">15.00</option>
                                                    <option value="15.30">15.30</option>
                                                    <option value="16.00">16.00</option>
                                                    <option value="16.30">16.30</option>
                                                    <option value="17.00">17.00</option>
                                                    <option value="17.30">17.30</option>
                                                    <option value="17.30">18.00</option>
                                                    <option value="18.30">18.30</option>
                                                    <option value="19.00">19.00</option>
                                                    <option value="19.30">19.30</option>
                                                    <option value="20.00">20.00</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ******************* NEW TEACH PATTERN FOR LAB  ***********************-->
                                    <br>
                                    <!-- ******************* NEW SELECT TEACHER  ***********************-->

                                    <b>อาจารย์ผู้สอน :</b>
                                    <div style="margin-left: 50px">
                                        <?php
                                        $data = array();
                                        foreach ($Data_teacher as $row) {
                                            $data[$row['teacher_no']] = $row['teacher_prefix'] . $row['teacher_name'] . " " . $row['teacher_surname'];
                                        }
                                        ?>
                                        <?php echo Select2::widget([
                                            'id' => 'section_teacher' . ($i + 1),
                                            'name' => 'section_teacher' . ($i + 1),
                                            'hideSearch' => true,
                                            'data' => $data,
                                            'options' => [
                                                'multiple' => true,
                                            ],
                                            'size' => Select2::SMALL,
                                            'class' => 'form-control pointer required valid inline-block',
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                'width' => '300px',

                                            ],
                                        ]);
                                        ?>

                                    </div>
                                    <!-- ******************* NEW SELECT TEACHER  ***********************-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
            <!--****************************************************************************** NEW SECTION **********************************************************************************************-->
            <br>
            <div id="div_condition_button" style="text-align: center; background-color: white;display: none">
                <hr style="border-color: black">
                <?=
                Html::a('ยืนยันการเพิ่ม section', ['newinsert',
                ],
                    [
                        'class' => 'btn btn-success btn-3d',
                        'style' => 'display: inline;',
                        'data' => [
                            'confirm' => 'ยืนยันการเพิ่ม section ? ',
                            'method' => 'post',
                        ],

                    ]);
                ?>
                <hr style="border-color: black">
            </div>
            <div id="div_condition_button2" style="text-align: center; background-color: white;">
                <hr style="border-color: black">
                <span class="btn btn-success btn-3d" style="display: inline;">กรุณากรอกข้อมูล</span>
                <hr style="border-color: black">
            </div>
        </div>
        <?php } ?>
        <?php $form = ActiveForm::end(); ?>
    </div>
</section>


<!--GET VALUE SECTION NUMBER-->


<?php
$this->registerJs(<<<JS
    $(document).ready(function() {       
        if($new_section_no == 0){
            $("#section_no").val($section_no).change();
        }else{
            $("#section_no").val($new_section_no).change();
        }
});

JS
); ?>

<!--GET VALUE SECTION NUMBER-->


<script>
    var Data_timeslot = <?php echo Json::encode($Data_time_slot)?>;
    var section_data = <?php echo Json::encode($section_data) ?>;
    var Data_Group = <?php echo Json::encode($Data_Group)?>;
    var count_lec = 1;
    var count_lab = 1;
    var group_type = 0;
    for (var i = 0; i < section_data.length; i++) {
        if (typeof section_data[i]['time'] !== "undefined" && section_data[i]['time'] !== null && section_data[i]['time'].length !== 0) {
            for (var j = 0; j < section_data[i]['time'].length; j++) {
                for (var k = 0; k < section_data[i]['time'][j]['group_timeslot'].length; k++) {
                    for (var i1 = 0; i1 < Data_Group.length; i1++) {
                        if (Data_Group[i1]['group_no'] === section_data[i]['time'][j]['group_timeslot'][k]['group_no']) {
                            group_type = Data_Group[i1]['group_type'];
                            i1 = Data_Group.length;
                        }
                    }
                    switch (parseInt(group_type)) {
                        case 1:
                            var id_tag_day = document.getElementById("day_lec" + count_lec + (i+1));
                            var id_tag_time = document.getElementById("time_lec" + count_lec + (i+1));
                            var day = 0;
                            var time = 0;
                            for(var i1 = 0; i1 < Data_timeslot.length; i1++){
                                if(Data_timeslot[i1]['timeslot_id'] === section_data[i]['time'][j]['group_timeslot'][k]['timeslot_id']){
                                    day = Data_timeslot[i1]['timeslot_day'];
                                    time = Data_timeslot[i1]['timeslot_starttime'];
                                }
                            }
                            id_tag_day.value = day;
                            id_tag_time.value = time;
                            count_lec++;
                            break;
                        case 2:
                            var id_tag_day = document.getElementById("day_lab" + count_lab + (i+1));
                            var id_tag_time = document.getElementById("time_lab" + count_lab + (i+1));
                            var day = 0;
                            var time = 0;
                            for(var i1 = 0; i1 < Data_timeslot.length; i1++){
                                if(Data_timeslot[i1]['timeslot_id'] === section_data[i]['time'][j]['group_timeslot'][k]['timeslot_id']){
                                    day = Data_timeslot[i1]['timeslot_day'];
                                    time = Data_timeslot[i1]['timeslot_starttime'];
                                }
                            }
                            id_tag_day.value = day;
                            id_tag_time.value = time;
                            count_lab++;
                            break;
                    }
                }
            }
        }
    }

    function checkdisplaybutton_condition() {
        var value_sum_section = document.getElementById("sum_section").value;
        var id_tag_button = document.getElementById("div_condition_button");
        var id_tag_button2 = document.getElementById("div_condition_button2");
        var count = 0;
        for (var i = 0; i < parseInt(value_sum_section); i++) {
            var section_size = document.getElementById((i + 1) + "section_size").value;
            if (!isNaN(parseInt(section_size))) {
                count++;
            }
        }
        if(count === parseInt(value_sum_section)){
            id_tag_button.style.display = "";
            id_tag_button2.style.display = "none";
        }else{
            id_tag_button.style.display = "none";
            id_tag_button2.style.display = "";
        }
    }

    function displaysection(SectionNo, checkSection, thisid) {
        var namesection = "section_join_lec" + checkSection + SectionNo;
        if (document.getElementById(thisid).checked == true) {
            document.getElementById(namesection).checked = true;
        } else {
            document.getElementById(namesection).checked = false;
        }
    }

    function displaysection2(SectionNo, checkSection, thisid) {
        var namesection = "section_join_lab" + checkSection + SectionNo;
        if (document.getElementById(thisid).checked == true) {
            document.getElementById(namesection).checked = true;
        } else {
            document.getElementById(namesection).checked = false;
        }
    }

    function showInputLecTime(i, hr, lec_time) {

        var L1 = document.getElementById("lec1" + i);
        var L2 = document.getElementById("lec2" + i);
        var L3 = document.getElementById("lec3" + i);

        if ((lec_time / hr) == 1) {

            L1.style.display = "none";
            L2.style.display = "none";
            L3.style.display = "none";

            L1.style.display = "block";

        } else if ((lec_time / hr) == 2) {

            L1.style.display = "none";
            L2.style.display = "none";
            L3.style.display = "none";

            L1.style.display = "block";
            L2.style.display = "block";

        } else if ((lec_time / hr) == 3) {
            L1.style.display = "none";
            L2.style.display = "none";
            L3.style.display = "none";

            L1.style.display = "block";
            L2.style.display = "block";
            L3.style.display = "block";
        }
    }

    function showInputLabTime(i, hr, lab_time) {

        var LB1 = document.getElementById("lab1" + i);
        var LB2 = document.getElementById("lab2" + i);
        var LB3 = document.getElementById("lab3" + i);

        if ((lab_time / hr) == 1) {

            LB1.style.display = "none";
            LB2.style.display = "none";
            LB3.style.display = "none";

            LB1.style.display = "block";

        } else if ((lab_time / hr) == 2) {

            LB1.style.display = "none";
            LB2.style.display = "none";
            LB3.style.display = "none";

            LB1.style.display = "block";
            LB2.style.display = "block";

        } else if ((lab_time / hr) == 3) {

            LB1.style.display = "none";
            LB2.style.display = "none";
            LB3.style.display = "none";

            LB1.style.display = "block";
            LB2.style.display = "block";
            LB3.style.display = "block";
        }
    }
</script>