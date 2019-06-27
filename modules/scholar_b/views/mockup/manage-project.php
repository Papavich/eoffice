<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 4/3/2561
 * Time: 23:29
 */
use app\modules\scholar_b\controllers;
use yii\widgets\LinkPager;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-tag"></i>
            จัดการโครงงาน
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
        <div class="panel-body">
            <div class="tabs nomargin">

                <!-- tabs -->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#jtab1_nobg" data-toggle="tab">
                            <i class="fa fa-bars"></i> รายชื่อโครงงาน
                        </a>
                    </li>
                    <li class="">
                        <a href="#jtab2_nobg" data-toggle="tab">
                            <i class="fa fa-cogs"></i> เพิ่มโครงงาน
                        </a>
                    </li>
                </ul>

                <!-- tabs content -->
                <div class="tab-content transparent">
                    <div id="jtab1_nobg" class="tab-pane active">
                        <div class="panel-heading">
                             <span class="title elipsis">
                                <strong>รายชื่อโครงงาน</strong> <!-- panel title -->
                             </span>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="panel-body">
                                    <div class="col-md-4">
                                        <label>ปีการศึกษา</label>
                                        <select name="contact[position]" class="form-control pointer required">
                                            <option disabled selected value>--- ปีการศึกษา ---</option>
                                            <option value="2560">2560</option>
                                            <option value="2559">2559</option>
                                            <option value="2558">2558</option>
                                            <option value="2557">2557</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="radio-inline"><input type="radio" name="optradio">โครงงานที่กำลังดำเนินการ</label>
                                        <br><label class="radio-inline"><input type="radio" name="optradio">โครงงานที่สำเร็จแล้ว</label>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                       class="btn btn-success btn-xs">
                                                        <i class="fa fa-book"></i>รายละเอียด
                                                    </a>
                                                    <a href="../student/activity_kku_edit"
                                                       class="btn btn-xs btn-success white"><i
                                                                class="fa fa-edit"></i>
                                                        แก้ไข</a>
                                                    <a class="btn btn-google btn-xs">
                                                        <i class="fa fa-trash"></i>ลบ
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
                                                       class="btn btn-success btn-xs">
                                                        <i class="fa fa-book"></i>รายละเอียด
                                                    </a>
                                                    <a href="../student/activity_kku_edit"
                                                       class="btn btn-xs btn-success white"><i
                                                                class="fa fa-edit"></i>
                                                        แก้ไข</a>
                                                    <a class="btn btn-google btn-xs">
                                                        <i class="fa fa-trash"></i>ลบ
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
                                                       class="btn btn-success btn-xs">
                                                        <i class="fa fa-book"></i>รายละเอียด
                                                    </a>
                                                    <a href="../student/activity_kku_edit"
                                                       class="btn btn-xs btn-success white"><i
                                                                class="fa fa-edit"></i>
                                                        แก้ไข</a>
                                                    <a class="btn btn-google btn-xs">
                                                        <i class="fa fa-trash"></i>ลบ
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


                    <div id="jtab2_nobg" class="tab-pane">

                        <div id="panel-1" class="panel panel-default ">
                            <div class="panel-heading">
        <span class="title elipsis">
            <strong>เพิ่มโครงงาน</strong> <!-- panel title -->
        </span>
                            </div>

                            <div class="padding-20">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4">
                                            <label>ชื่อโครงงาน</label>
                                            <input type="text" name="contact[first_name]" value=""
                                                   class="form-control required">
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label>ปีการศึกษา</label>
                                            <select name="contact[position]" class="form-control pointer required">
                                                <option disabled selected value>--- ปีการศึกษา ---</option>
                                                <option value="2560">2560</option>
                                                <option value="2559">2559</option>
                                                <option value="2558">2558</option>
                                                <option value="2557">2557</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label>วันที่เริ่มต้น</label>
                                            <!-- date picker -->
                                            <input type="text" class="form-control datepicker"
                                                   data-format="yyyy-mm-dd" data-lang="en"
                                                   data-RTL="false">
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4">
                                            <label>ระดับ</label>
                                            <select name="contact[position]" class="form-control pointer required">
                                                <option disabled selected value>--- ระดับการแข่งขัน ---</option>
                                                <option value="ผลงานที่ได้รับรางวัล">ประเทศ</option>
                                                <option value="ผลงานที่ได้เข้าร่วม">ภาค</option>
                                                <option value="ผลงานที่ได้เข้าร่วม">จังหวัด</option>
                                                <option value="ผลงานที่ได้เข้าร่วม">ภายในมหาวิทยาลัย</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>อาจารย์ที่ปรึกษา</label>
                                            <input type="text" name="contact[first_name]" value=""
                                                   class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-8 col-sm-8">
                                            <br><label>รายละเอียด</label>
                                            <textarea name="contact[experience]" rows="4"
                                                      class="form-control required"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <div style="text-align:center;">
                                    <a href="#" class="btn btn-success white"><i class="fa fa-plus"></i>
                                        เพิ่มโครงงาน</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" class="btn btn-danger white"><i class="fa fa-times"></i> ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
</div>


</div>
</div>
</div>
</div>
