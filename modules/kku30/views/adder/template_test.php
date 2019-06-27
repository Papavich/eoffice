<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!--SHOW LIST SUBJECT TABLE-->
<div id="section-to-print">
    <div id="main_table" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div align="left">
                <!-- page title -->
                <header id="page-header">
                    <strong>รายวิชาตามหลักสูตร</strong>
                </header>
                <!-- /page title -->
            </div>
            <!-- panel content -->
            <label class="checkbox-inline">
                <input type="checkbox" checked data-toggle="toggle"> First
            </label>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['action' => ['searchsubjectsemester']]) ?>
                <div align="right " class="hidden-print">
                    <select id="sub_student" name="sub_student" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected="selected">- - สาขา - -</option>
                        <option value="CS">วิทยาการคอมพิวเตอร์</option>
                        <option value="IT">เทคโนโลยีสารสนเทศ</option>
                        <option value="GIS">ภูมิศาสตร์สารสนเทศ</option>
                    </select>
                    <select id="sub_project" name="sub_project" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected="selected">- - โครงการ - -</option>
                        <option value="1">โครงการปกติ</option>
                        <option value="2">โครงการพิเศษ</option>
                    </select>
                    <select name="sub_year" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected="selected">- - ปีการศึกษา - -</option>
                        <option value="2561">ปีการศึกษา 2561</option>
                    </select>
                    <select name="sub_stdyear" class="form-control pointer required valid inline-block"
                            style="width: 10% !important;">
                        <option disabled="disabled" selected="selected">- - ชั้นปี - -</option>
                        <option value="0">ชั้นปีที่ 1</option>
                        <option value="1">ชั้นปีีที่ 2</option>
                        <option value="2">ชั้นปีีที่ 3</option>
                        <option value="3">ชั้นปีีที่ 4</option>
                    </select>
                    <button type="submit" class="btn btn-success btn-3d">Search</button>
                </div>
                <?php $form = ActiveForm::end(); ?>
                <br>
                <!--                        TABLE-->
                <?php
                function GenerateCode($Data_id_sub, $Data_nameThai)
                {
                    echo "<td>";
                    echo "<b>" . $Data_id_sub . " " . $Data_nameThai . "</b>";
                    echo "<div style=\"display: inline-block; float:right; padding-right:1%;\" class=\"hidden-print\">";
                    echo "<a href='detailsubject?id=" . $Data_id_sub . "' class=\"btn btn-default btn-xs\"><i class=\"fa fa-search white\"></i>View</a>";
                    echo "<a href='updatesubject?id= " . $Data_id_sub . "' class=\"btn btn-default btn-xs\"><i class=\"fa fa-edit white\"></i>Edit</a>";
                    ?>
                    <?= Html::a('<i class="fa fa-times white"> Delete </i>', ['delete', 'id' => $Data_id_sub], [
                    'class' => 'btn btn-default btn-xs',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
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
                            if ($Count_Term1 == 0) { ?>
                                <tr>
                                    <td>
                                        <h5 align='center' style='color: red'><b>..........</b></h5>
                                    </td>
                                    <?php
                                    GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai']);
                                    ?>
                                </tr>
                            <?php } elseif ($Count_Term2 == 0) { ?>
                                <tr>
                                    <?php
                                    GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai']);
                                    ?>
                                    <td>
                                        <h5 align='center' style='color: red'><b>..........</b></h5>
                                    </td>
                                </tr>
                            <?php } else {
                                for ($i = 0; $i < max($Count_Term1, $Count_Term2); $i++) {
                                    if ($i == $Count_Term2) { ?>
                                        <tr>
                                            <?php
                                            GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai']);
                                            ?>
                                            <td>
                                                <h5 align='center' style='color: red'><b>..........</b></h5>
                                            </td>
                                        </tr>
                                    <?php } elseif ($i == $Count_Term1) { ?>
                                        <tr>
                                            <td>
                                                <h5 align='center' style='color: red'><b>..........</b></h5>
                                            </td>
                                            <?php
                                            GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai']);
                                            ?>
                                        </tr>
                                    <?php } else { //ใส่ค่าปกติ ?>
                                        <tr>
                                            <?php
                                            GenerateCode($Data_subject_term1[$i]['subject']['subject_id'], $Data_subject_term1[$i]['subject']['subject_namethai']);
                                            GenerateCode($Data_subject_term2[$i]['subject']['subject_id'], $Data_subject_term2[$i]['subject']['subject_namethai']);
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
                <div class="panel-heading">
							<span class="title elipsis">
								<!-- PRINT BUTTON -->
<div align="right" class="hidden-print">

    <button class="btn btn-blue btn-sm" onclick="printWindow()"><i class="fa et-printer"></i>Print &nbsp;&nbsp;|&nbsp;&nbsp;     <i
                class="fa et-download"></i>Download
</div>
                                <!-- PRINT BUTTON -->
                            </span>
                </div>
            </div>
        </div>
        <!--        </form>-->
    </div>
</div>

