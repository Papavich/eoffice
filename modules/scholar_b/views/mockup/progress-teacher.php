<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 5/3/2561
 * Time: 1:13
 */

?>
<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-4">
                    <h3>รายงานความก้าวหน้าทุน</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-4">
                    <label>ปีการศึกษา</label>
                    <select name="contact[position]" class="form-control pointer required">
                        <option disabled>--- ปีการศึกษา ---</option>
                        <option value="2560" selected value>2560</option>
                        <option value="2559">2559</option>
                        <option value="2558">2558</option>
                        <option value="2557">2557</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <br>
                    <button type="button" class="btn btn-primary" style="width: 100px">ยืนยัน</button>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                            <b>ข้อมูลนักศึกษา</b>
                        </div>
                        <div class="panel-body">
                            <label>ชื่อ-สกุล : นายศุภวิชญ์ ภารจินดา</label>
                            </br><label>รหัสนศ. / ชั้นปี : 573020394-4 / ชั้นปี 4</label>
                            </br> <label>ประเภททุน : ทุนโครงการช้างเผือก</label>
                            </br>  <label>ปีที่เข้าการศึกษา : 2557</label>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                            <b>ผลการเรียน</b>
                        </div>
                        <div class="panel-body">
                            <label>รายงานผลการศึกษา : ประจำปีการศึกษา </label>
                            </br>
                            <label>ภาคต้น เกรดเฉลี่ยประจำภาค 3.30</label>
                            </br>
                            <label>ภาคปลาย เกรดเฉลี่ยประจำภาค 3.50</label>
                            </br>
                            <label>เกรดเฉลี่ยสะสมประจำภาค 3.40</label

                        </div>
                    </div>
                </div>


            </div>
        </div>




        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="tabs nomargin-top">

                        <!-- tabs -->
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#jtab1" data-toggle="tab" aria-expanded="true">
                                    <i class="glyphicon glyphicon-blackboard"></i> โครงงาน
                                </a>
                            </li>
                            <li class="">
                                <a href="#jtab2" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-trophy"></i> ผลงาน
                                </a>
                            </li>
                            <li class="">
                                <a href="#jtab3" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-futbol-o"></i> กิจกรรม
                                </a>
                            </li>
                        </ul>

                        <!-- tabs content -->
                        <div class="tab-content">
                            <div id="jtab1" class="tab-pane active">
                                <div class="form-group">
                                    <!-- Scorbar -->
                                    <div class="panel-body">
                                        <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                             data-railOpacity="1"
                                             data-height="250">
                                            <table class="table table-striped table-hover table-bordered"
                                                   id="sample_editable_1">
                                                <thead>
                                                <tr>
                                                    <th>ชื่อโครงงาน</th>
                                                    <th>ระดับ</th>
                                                    <th>วันที่เริ่ม</th>
                                                    <th>สถานะการดำเนินงาน</th>
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                    <td>KKU Smart Learner HACKFEST 2017</td>
                                                    <td>จังหวัด</td>
                                                    <td>12 ธันวาคม 2560</td>
                                                    <td>

                                                        <div class="progress" style="width: 150px">
                                                            <div class="progress-bar progress-bar-striped active"
                                                                 role="progressbar"
                                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                                 style="width:80%">80%
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>โปรแกรมการหาตำแหน่งม่านตา</td>
                                                    <td>ประเทศ</td>
                                                    <td>1 พฤศจิกายน 2560</td>
                                                    <td>

                                                        <div class="progress" style="width: 150px">
                                                            <div class="progress-bar progress-bar-striped active"
                                                                 role="progressbar"
                                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                                 style="width:50%">50%
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>แอปพลิเคชันตรวจจับช่องถนนและรถยนต์</td>
                                                    <td>ประเทศ</td>
                                                    <td>20 ตุลาคม 2560</td>
                                                    <td>

                                                        <div class="progress" style="width: 150px">
                                                            <div class="progress-bar progress-bar-striped active"
                                                                 role="progressbar"
                                                                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                                 style="width:40%">40%
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /panel content -->
                                </div>
                                <!-- Scorbar -->
                            </div>

                            <div id="jtab2" class="tab-pane">
                                <div class="form-group">
                                    <!-- Scorbar -->
                                    <div class="panel-body">
                                        <div class="slimscroll" data-always-visible="true" data-rail-visible="true"
                                             data-railOpacity="1"
                                             data-height="300">
                                            <table class="table table-striped table-hover table-bordered"
                                                   id="sample_editable_1">
                                                <thead>
                                                <tr>
                                                    <th>ชื่อโครงงาน</th>
                                                    <th>ระดับ</th>
                                                    <th>วันทีรับรางวัล</th>
                                                    <th>ผลรางวัล</th>
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                    <td>KKU Smart Learner HACKFEST 2017</td>
                                                    <td>จังหวัด</td>
                                                    <td>15 ธันวาคม 2560</td>
                                                    <td>ชนะเลิศอันดับที่ 1</td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>โปรแกรมการหาตำแหน่งม่านตา</td>
                                                    <td>ประเทศ</td>
                                                    <td>4 พฤศจิกายน 2560</td>
                                                    <td>
                                                        รองชนะเลิศอันที่ 1
                                                    </td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>แอปพลิเคชันตรวจจับช่องถนนและรถยนต์</td>
                                                    <td>ประเทศ</td>
                                                    <td>27 ตุลาคม 2560</td>
                                                    <td>
                                                        ชมเชย
                                                    </td>
                                                    <td>
                                                        <div style="text-align:center;">
                                                            <a href="../student/activity_kku_detail"
                                                               class="btn btn-warning btn-xs">
                                                                <i class="fa fa-book"></i>รายงานผล
                                                            </a>
                                                            <a href="../student/activity_kku_edit"
                                                               class="btn btn-xs btn-warning white"><i
                                                                        class="fa fa-edit"></i>
                                                                แผน</a>
                                                            <a class="btn btn-warning btn-xs">
                                                                <i class="	glyphicon glyphicon-comment"></i>ลงความเห็น
                                                            </a>
                                                            <div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /panel content -->
                                </div>
                                <!-- Scorbar -->
                            </div>

                            <div id="jtab3" class="tab-pane">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th width="20%">ชื่อกิจกรรม</th>
                                        <th width="20%">ระยะเวลา</th>
                                        <th width="15%">สถานที่</th>
                                        <th width="10%">ประเภทกิจกรรม</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="/cs-e-office/web/scholar_b/activity/view?act_main_id=2&amp;year=2561">
                                                <ul class="list-unstyled list-icons margin-bottom-10">
                                                    <li class="margin-top-6"><i class="fa fa-angle-right"></i>
                                                        <strong> งานรับสมัครนักเรียน รอบผลงาน </strong>
                                                    </li>
                                                </ul>
                                            </a>
                                        </td>
                                        <td>
                                            9/3/18 01:00 - 9/3/18 01:00
                                        </td>
                                        <td>ตึก6 ภาควิชาวิทยาการคอมพิวเตอร์</td>
                                        <td>
                                            <span class="label label-success">อาสา</span></td>
                                    </tr>

                                    </tbody>


                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="/cs-e-office/web/scholar_b/activity/view?act_main_id=3&amp;year=2561">
                                                <ul class="list-unstyled list-icons margin-bottom-10">
                                                    <li class="margin-top-6"><i class="fa fa-angle-right"></i>
                                                        <strong> งานคืนสู่เหย้าภาควิชา </strong>
                                                    </li>
                                                </ul>
                                            </a>
                                        </td>
                                        <td>
                                            9/3/18 01:00 - 9/3/18 01:00
                                        </td>
                                        <td>โรงแรมโฆษะ</td>
                                        <td>
                                            <span class="label label-danger">บังคับ</span></td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="/cs-e-office/web/scholar_b/activity/view?act_main_id=1&amp;year=2560">
                                                <ul class="list-unstyled list-icons margin-bottom-10">
                                                    <li class="margin-top-6"><i class="fa fa-angle-right"></i>
                                                        <strong> งานฝ่ายอำนวยการ สัปดาห์วิทยาศาสตร์ </strong>
                                                    </li>
                                                </ul>
                                            </a>
                                        </td>
                                        <td>
                                            2/3/18 01:00 - 2/3/18 01:00
                                        </td>
                                        <td>ตึก8</td>
                                        <td>
                                            <span class="label label-danger">บังคับ</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    </tbody>

                                </table>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12"><div class="col-md-5"></div>
                    <div class="col-md-2 text-center">
                        <label>ไฟล์นำเสนอ</label><br>
                        <a href="../student/activity_kku_detail"
                           class="btn btn-success">
                            <i class="fa fa-file-powerpoint-o"></i>Download
                        </a>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
        </div>


    </div>
</div>
