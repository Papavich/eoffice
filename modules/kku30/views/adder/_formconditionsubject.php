<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<!--SHOW LIST SUBJECT TABLE-->

<div id="section-to-print">
    <div id="main_table" class="padding-20">

        <div id="panel-1" class="panel panel-default">
            <div class="panel-heading panel-heading-transparent">
                <strong>รายวิชาวิชาที่จะทำการเปิดการสอน <?= $sub_student?>&nbsp;<?= $sub_project?> <?= "ชั้นปีที่". $sub_stdyear?> &nbsp;<?= "ปีการศึกษา".$sub_year?></strong>
            </div>
            <form action="addcondition" method="get">
                <!-- panel content -->
                <div class="panel-body">
                    <div align="right " class="hidden-print">
                        <select name="sub_student"  class="form-control pointer required valid inline-block" style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - สาขา - -</option>
                            <option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>
                            <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                            <option value="ภูมิศาสตร์สารสนเทศ">ภูมิศาสตร์สารสนเทศ</option>
                        </select>
                        <select name="sub_project"  class="form-control pointer required valid inline-block" style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - โครงการ - -</option>
                            <option value="โครงการปกติ">โครงการปกติ</option>
                            <option value="โครงการพิเศษ">โครงการพิเศษ</option>
                        </select>
                        <select name="sub_year"  class="form-control pointer required valid inline-block" style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - ปีการศึกษา - -</option>
                            <option value="2561">ปีการศึกษา 2561</option>
                            <option value="2560">ปีการศึกษา 2560</option>
                            <option value="2559">ปีการศึกษา 2559</option>
                        </select>
                        <select name="sub_stdyear" class="form-control pointer required valid inline-block" style="width: 10% !important;">
                            <option disabled="disabled" selected="selected">- - ชั้นปี - -</option>
                            <option value="1">ชั้นปีที่ 1</option>
                            <option value="2">ชั้นปีีที่ 2</option>
                            <option value="3">ชั้นปีีที่ 3</option>
                            <option value="4">ชั้นปีีที่ 4</option>
                        </select>
                        <button type="submit" class="btn btn-success btn-3d">Search</button>
                    </div>
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
                            if (count($data_term1) == 0) {

                                echo " <tr>";
                                echo " <td>";
                                echo "<h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>";
                                echo " </td>";
                                if( count($data_term2) == 0){
                                    echo " <td>";
                                    echo "<h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>";
                                    echo " </td>";
                                }
                                echo " </tr>";

                            } else {
                                for ($i = 0; $i < $N; $i++) {
                                    echo '<tr>';
                                    if (empty($data_term1[$i])) {
                                        echo "<td></td>";
                                    } else {
                                        $data_1 = $data_term1[$i];
                                        ?>
                                        <td>
                                            <b><?= $data_1->sub_id ?> <?= $data_1->sub_thainame ?></b>
                                            <div style="display: inline-block; float:right; padding-right:1%;" class="hidden-print">
                                                <a onclick="showAddcondition('<?= $data_1->sub_thainame ?>','<?= $data_1->sub_teacher ?>')"
                                                   class="btn btn-default btn-xs">
                                                    <i class="fa fa-edit white"></i> เพิ่มเงื่อนไข</a>

                                            </div>
                                        </td>

                                    <?php }

                                    if (empty($data_term2[$i])) {
                                        if($i == 0){

                                            echo " <td>";
                                            echo "<h5 align='center' style='color: red'><b>*** ไม่พบข้อมูล ***</b></h5>";
                                            echo " </td>";

                                        }else{
                                            echo "<td></td>";
                                        }


                                    } else {
                                        $data_2 = $data_term2[$i];


                                        ?>

                                        <td>
                                            <b><?= $data_2->sub_id ?> <?= $data_2->sub_thainame ?></b>
                                            <div style="display: inline-block; float:right; padding-right:1%;"  class="hidden-print">
                                                <a onclick="showAddcondition('<?= $data_1->sub_thainame ?>','<?= $data_1->sub_teacher ?>')"
                                                   class="btn btn-default btn-xs">
                                                    <i class="fa fa-edit white"></i> เพิ่มเงื่อนไข</a>
                                            </div>
                                        </td>
                                    <?php }
                                    echo '</tr>';

                                }
                            }

                            ?>

                            </tr>
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
        </form>
    </div>


</div>