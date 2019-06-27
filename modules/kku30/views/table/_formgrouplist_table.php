<?php

use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['action' => 'newfieldtable']); ?>
    <input name="year_of" type="hidden" value="<?= $year_of ?>">
    <input name="semester" type="hidden" value="<?= $semester ?>">
    <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="" style="text-align: center !important;">
            <thead>
            <tr style="text-align: center !important;">
                <th bgcolor="#9FA8DA" style="text-align:center"><b><h4>ชื่อวิชา</h4></b></th>
                <th bgcolor="#80CBC4" style="text-align:center"><h4>กลุ่มที่เปิดสอน</h4></th>
            </tr>
            </thead>
            <?php $Sublen = $Arrlen; ?> <!-- get subject length-->
            <tbody style="text-align: left !important;">
            <?php for ($i = 0; $i < $Sublen; $i++) { ?>
                <tr class="odd gradeX">
                    <!--td SUBJECT-->
                    <td>
                        <?= $array_render_view[$i]['subject_id'] . " &nbsp&nbsp&nbsp" . $array_render_view[$i]['subject_detail']['subject_namethai'] ?>
                        <!-- echo subject list-->
                    </td>
                    <!--td SUBJECT-->
                    <!--td SECTION-->
                    <?php $secpersub = count($array_render_view[$i]['section_detail']); // count section in subject $i ?>
                    <td>
                        <?php for ($j = 0; $j < $secpersub; $j++) {
                            if ($j > 0 and $j != $secpersub) {
                                echo "<br>";
                            }
                            echo "Section ที่ " . $array_render_view[$i]['section_detail'][$j]['section_no'] . " &nbsp&nbsp&nbsp"; // <!-- echo section list in subject $i-->
                            $programpersec = count($array_render_view[$i]['section_detail'][$j]['section_program']);  // count program in SECTION $j and SUBJECT $i
                            for ($k = 0; $k < $programpersec; $k++) {
                                if ($k > 0 and $k != $programpersec) {
                                    echo " ,";
                                }
                                $project = $array_render_view[$i]['section_detail'][$j]['section_program'][$k]['program_class'];
                                if ($project == "1") {
                                    $project = "โครงการปกติ";
                                }
                                if ($project == "2") {
                                    $project = "โครงการพิเศษ";
                                }
                                if ($array_render_view[$i]['section_detail'][$j]['section_program'][$k]['program_id'] == "CS") {
                                    echo " สาขาวิทยาการคอมพิวเตอร์ " . " " . $project;
                                }

                                if ($array_render_view[$i]['section_detail'][$j]['section_program'][$k]['program_id'] == "IT") {
                                    echo " สาขาเทคโนโลยีสารสนเทศ " . " " . $project;
                                }

                                if ($array_render_view[$i]['section_detail'][$j]['section_program'][$k]['program_id'] == "GIS") {
                                    echo " สาขาภูมิสารสนเทศศาสตร์ " . " " . $project;
                                }

                                //echo $array_render_view[$i]['section_detail'][$j]['section_program'][$k]['program_id'];
                            }
                            if ($j != ($secpersub - 1)) {
                                echo "<hr style='margin-bottom: 0px; margin-top: 20px;'>";
                            }
                        } ?>
                        <br>
                    </td>
                    <!--td SECTION-->
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div align="center">
            <button class="btn btn-3d btn-green">จัดตารางเรียน</button>
        </div>
    </div>
<?php $form = ActiveForm::end(); ?>