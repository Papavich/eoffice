<!--JS-->
<?= $this->render('/table/_formjs') ?>
<!--JS-->


<section>

    <div id="section-to-print">
        <div id="content" class="padding-20">

            <div class="panel panel-default">
                <div class="panel-body">

                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td width="25%"><b>รหัสวิชา</b></td>
                            <td width="75%"><?= $Data_id_sub ?></td>
                        </tr>
                        <tr>
                            <td><b>ชื่อวิชา</b></td>
                            <td><?= $Data_nameEng ?> (<?= $Data_nameThai ?>)</td>
                        </tr>

                        <tr>
                            <td><b>จำนวนหน่วยกิต</b></td>
                            <td><?= $subject_credit ?></td>
                        </tr>
                        <tr>
                            <td><b>จำนวนชั่วโมงบรรยาย</b></td>
                            <td><?= $subject_count_lec ?></td>
                        </tr>

                        <tr>
                            <td><b>จำนวนชั่วโมงปฏิบัติ</b></td>
                            <td><?= $subject_count_lab ?></td>
                        </tr>
                        <tr>
                            <td><b>หลักสูตรปี</b></td>
                            <td><?= $subject_version ?></td>
                        </tr>

                        <tr>
                            <td><b><b>ภาคการเรียนที่</b></b></td>
                            <td><?= $plan_semester ?></td>
                        </tr>
                        <tr>
                            <td><b>ปีการศึกษา</b></td>
                            <td><?= $sub_year ?></td>
                        </tr>

                        <tr>
                            <td><b>จำนวน section</b></td>
                            <td><?= $section_no ?></td>
                        </tr>

                        <tr>
                            <td><b>รายละเอียด section</b></td>
                            <td>
                                <br>
                                <?php
                                for ($i = 1; $i <= $section_no; $i++) {


                                    ?>
                                    <b>section ที่ <?= $i ?> </b>

                                    <div class="row">
                                        <br>
                                        <div class="col-sm-4">
                                            <u>จำนวนคน :</u>
                                            <div style="margin-left: 40px">
                                                <ul>
                                                    <li><?= $std_amount[$i - 1] ?></li>
                                                </ul>

                                            </div>
                                        </div>
                                        <br>

                                        <!-- ******************   SHOW MAJOR REGISTERED ******************** -->
                                        <div class="col-sm-4">
                                            <u>สาขา :</u>
                                            <div style="margin-left: 40px">

                                                <?php
                                                for ($j = 0; $j < sizeof($major[$i - 1]); $j++) {
                                                    ?>

                                                    <?php
                                                    //********************* CS *************************
                                                    if ($major[$i - 1][$j] == "CS") {

                                                        for ($k = 0; $k < sizeof($std_cs_project1[$i - 1]); $k++) {
                                                            if ($std_cs_project1[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาวิทยาการคอมพิวเตอร์ ชั้นปีที่ 1 " . " ( " . $std_cs_project1[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_cs_project2[$i - 1]); $k++) {

                                                            if ($std_cs_project2[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาวิทยาการคอมพิวเตอร์ ชั้นปีที่ 2 " . " ( " . $std_cs_project2[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_cs_project3[$i - 1]); $k++) {

                                                            if ($std_cs_project3[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาวิทยาการคอมพิวเตอร์ ชั้นปีที่ 3 " . " ( " . $std_cs_project3[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_cs_project4[$i - 1]); $k++) {

                                                            if ($std_cs_project4[$i - 1][$k] != null) {

                                                                echo "<li>" . "สาขาวิทยาการคอมพิวเตอร์ ชั้นปีที่ 4 " . " ( " . $std_cs_project4[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }
                                                    }
                                                    //********************* CS *************************

                                                    //********************* IT *************************
                                                    elseif ($major[$i - 1][$j] == "IT") {

                                                        for ($k = 0; $k < sizeof($std_it_project1[$i - 1]); $k++) {
                                                            if ($std_it_project1[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาเทคโนโลยีสารสนเทศ ชั้นปีที่ 1 " . " ( " . $std_it_project1[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_it_project2[$i - 1]); $k++) {

                                                            if ($std_it_project2[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาเทคโนโลยีสารสนเทศ ชั้นปีที่ 2 " . " ( " . $std_it_project2[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_it_project3[$i - 1]); $k++) {

                                                            if ($std_it_project3[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาเทคโนโลยีสารสนเทศ ชั้นปีที่ 3 " . " ( " . $std_it_project3[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_it_project4[$i - 1]); $k++) {

                                                            if ($std_it_project4[$i - 1][$k] != null) {

                                                                echo "<li>" . "สาขาเทคโนโลยีสารสนเทศ ชั้นปีที่ 4 " . " ( " . $std_it_project4[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }
                                                    }

                                                    //********************* IT *************************

                                                    //********************* GIS *************************
                                                    elseif ($major[$i - 1][$j] == "GIS") {

                                                        for ($k = 0; $k < sizeof($std_gis_project1[$i - 1]); $k++) {
                                                            if ($std_gis_project1[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาภูมิสารสนเทศศาสตร์ ชั้นปีที่ 1 " . " ( " . $std_gis_project1[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_gis_project2[$i - 1]); $k++) {

                                                            if ($std_gis_project2[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาภูมิสารสนเทศศาสตร์ ชั้นปีที่ 2 " . " ( " . $std_gis_project2[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_gis_project3[$i - 1]); $k++) {

                                                            if ($std_gis_project3[$i - 1][$k] != null) {
                                                                echo "<li>" . "สาขาภูมิสารสนเทศศาสตร์ ชั้นปีที่ 3 " . " ( " . $std_gis_project3[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }


                                                        for ($k = 0; $k < sizeof($std_gis_project4[$i - 1]); $k++) {

                                                            if ($std_gis_project4[$i - 1][$k] != null) {

                                                                echo "<li>" . "สาขาภูมิสารสนเทศศาสตร์ ชั้นปีที่ 4 " . " ( " . $std_gis_project4[$i - 1][$k] . " ) " . "</li>";
                                                            }
                                                        }
                                                    }

                                                    //********************* GIS *************************

                                                    ?>


                                                    <?php
                                                }

                                                ?>

                                            </div>


                                            <!-- ******************   SHOW MAJOR REGISTERED ******************** -->

                                            <?php
                                            //                                    echo  $lec_time[$i-1][0];

                                            //LECTURE

                                            if ($lec_time[$i - 1][0] == 1) {
                                                $lec_end_time = 1.00;
                                            } elseif ($lec_time[$i - 1][0] == 1.5) {
                                                $lec_end_time = 1.30;
                                            } elseif ($lec_time[$i - 1][0] == 2) {
                                                $lec_end_time = 2.00;
                                            } elseif ($lec_time[$i - 1][0] == 3) {
                                                $lec_end_time = 3;
                                            }


                                            //LAB

                                            if ($lab_time[$i - 1][0] == 1) {
                                                $lab_end_time = 1.00;
                                            } elseif ($lab_time[$i - 1][0] == 1.5) {
                                                $lab_end_time = 1.30;
                                            } elseif ($lab_time[$i - 1][0] == 2) {
                                                $lab_end_time = 2.00;
                                            } elseif ($lab_time[$i - 1][0] == 3) {
                                                $lab_end_time = 3;
                                            }


                                            ?>

                                            <br>
                                        </div>

                                        <div class="col-sm-4">
                                            <!--************* SHOW LECTURE TIME ***************-->

                                            <u>เวลาเรียนบรรยาย <?= " ( " . $lec_time[$i - 1][0] . " ชม. /คาบ ) " ?>
                                                :</u> <br>
                                            <div style="margin-left: 40px">
                                                <ul>

                                                    <?php
                                                    if ($L1[$i - 1][0] != null) {
                                                        $start_time = number_format(floatval($L1[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lec_end_time), 2);
                                                        echo "<li>" . $L1[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;

                                                    }
                                                    ?>


                                                    <?php
                                                    if ($L2[$i - 1][0] != null) {
                                                        $start_time = number_format(floatval($L2[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lec_end_time), 2);
                                                        echo "<li>" . $L2[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;

                                                    }
                                                    ?>


                                                    <?php
                                                    if ($L3[$i - 1][0] != null) {
                                                        $start_time = number_format(floatval($L3[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lec_end_time), 2);
                                                        echo "<li>" . $L3[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;

                                                    }
                                                    ?>

                                                    <?php
                                                    if ($L1[$i - 1][0] == null & $L2[$i - 1][0] == null & $L3[$i - 1][0] == null) {
                                                        echo(" - <br>");
                                                    }
                                                    ?>


                                                </ul>
                                            </div>
                                            <!--************* SHOW LECTURE TIME ***************-->


                                            <!--************* SHOW LAB TIME ***************-->
                                            <br>
                                            <u>เวลาเรียนปฏิบัติ <?= " ( " . $lab_time[$i - 1][0] . " ชม. /คาบ ) " ?>
                                                :</u> <br>
                                            <div style="margin-left: 40px">
                                                <ul>
                                                    <?php
                                                    if ($LB1[$i - 1][0] != null) {

                                                        $start_time = number_format(floatval($LB1[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lab_end_time), 2);
                                                        echo "<li>" . $LB1[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($LB2[$i - 1][0] != null) {
                                                        $start_time = number_format(floatval($LB2[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lab_end_time), 2);
                                                        echo "<li>" . $LB2[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;
                                                    }
                                                    ?>


                                                    <?php
                                                    if ($LB3[$i - 1][0] != null) {
                                                        $start_time = number_format(floatval($LB3[$i - 1][1]), 2);
                                                        $end_time = number_format(floatval($start_time + $lab_end_time), 2);
                                                        echo "<li>" . $LB3[$i - 1][0] . " ( " . $start_time . " - " . $end_time . " ) " . "</li>";
                                                        $end_time = 0;
                                                    }
                                                    ?>

                                                    <?php
                                                    if ($LB1[$i - 1][0] == null & $LB2[$i - 1][0] == null & $LB3[$i - 1][0] == null) {
                                                        echo(" - <br>");
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <!--************* SHOW LAB TIME ***************-->


                                            <!--************* SHOW LAB'S ROOM ***************-->
                                            <br>
                                            <u>ห้องเรียนเฉพาะทาง: </u> <br>
                                            <div style="margin-left: 40px">
                                                <ul>
                                                    <?php
                                                    if ($condition_lab[$i - 1] == 4) {
                                                        $room_name = " ห้องปฏิบัติการเน็ตเวิร์ค";
                                                    } elseif ($condition_lab[$i - 1] == 3) {
                                                        $room_name = " ห้องปฏิบัติการแปรภาพ";
                                                    } else {
                                                        $room_name = " - ";

                                                    }

                                                    echo "<li>" . $room_name . "</li>";
                                                    ?>

                                                </ul>

                                            </div>
                                        </div>
                                        <!--************* SHOW LAB'S ROOM ***************-->


                                    </div>


                                    <?php
                                    if ($i != $section_no) {
                                        echo("<hr>");
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-heading">
							<span class="title elipsis">
								<!-- PRINT BUTTON -->
<div align="right" class="hidden-print">

   <button class="btn btn-blue btn-sm" onclick="printWindow()"><i class="fa et-printer"></i>Print &nbsp;&nbsp;|&nbsp;&nbsp;     <i
               class="fa et-download"></i>Download</button>
</div>
                                <!-- PRINT BUTTON -->
                            </span>
                </div>
            </div>
        </div>
    </div>

</section>



