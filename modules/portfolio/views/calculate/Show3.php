<section id="#S">


    <!-- page title -->
    <header id="page-header">
        <h1>โครงการวิจัย</h1>
        <ol class="breadcrumb">
            <li><a href="#">กิจกรรม</a></li>
            <li class="active">โครงการวิจัย</li>
        </ol>
    </header>
    <!-- /page title -->

    <div id="content" class="padding-20">


        <div id="panel-1" class="panel panel-default">

            <div class="panel-heading">
							<span class="title elipsis">
								<strong>โครงการวิจัย</strong> <!-- panel title -->
							</span>

                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                           data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                           data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm"
                           data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip"
                           title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                </ul>
                <!-- /right options -->

            </div>

            <!-- panel content -->
            <div class="panel-body">

                <center><!-- Large Modal -->
                    <a href="#" class="btn btn-3d btn-reveal btn-blue" data-toggle="modal" data-target="#modal1"><i
                                class="fa fa-diamond"></i><span>เพิ่มโครงการวิจัย</span></a>
                    <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- header modal -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel">บันทึกโครงการวิจัย</h4>
                                </div>

                                <!-- body modal -->
                                <div class="modal-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel-heading-transparent">
                                            <strong>โครงการวิจัย</strong>
                                        </div>

                                        <div class="panel-body">

                                            <form class="validate" action="php/contact.php" method="post"
                                                  enctype="multipart/form-data" data-success="Sent! Thank you!"
                                                  data-toastr-position="top-right">
                                                <fieldset>
                                                    <!-- required [php action request] -->
                                                    <input type="hidden" name="action" value="contact_send"/>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ภาษาที่แสดงผล</label>
                                                                <select name="contact[position]"
                                                                        class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="eng">ภาษาอังกฤษ</option>
                                                                    <option value="thai">ภาษาไทย</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ชื่อโครงการ(ไทย)</label>
                                                                <input type="text" name="contact[last_name]" value=""
                                                                       class="form-control2 required">
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ชื่อโครงการ(อังกฤษ)</label>
                                                                <input type="text" name="contact[last_name]" value=""
                                                                       class="form-control2 required">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>หัวหน้าโครงการ</label>
                                                                <input type="email" name="contact[email]" value="ชื่อ"
                                                                       class="form-control2 required">
                                                            </div>

                                                            <div class="col-md-4 col-sm-8">

                                                                <input type="text" name="contact[phone]" value="นามสกุล"
                                                                       class="form-control2 required">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-8">
                                                            <label>แหล่งทุน</label>
                                                            <select name="contact[position]"
                                                                    class="form-control2 pointer required">
                                                                <option value="">--- เลือก ---</option>
                                                                <option value="Marketing">ภายใน</option>
                                                                <option value="Developer">ภายนอก</option>

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-3 col-sm-9">
                                                                <label>ปี ที่เริ่มต้น</label>
                                                                <input type="text" name="contact[start_date]" value=""
                                                                       class="form-control2 datepicker required"
                                                                       data-format="yyyy-mm-dd" data-lang="en"
                                                                       data-RTL="false">
                                                            </div>
                                                            <div class="col-md-3 col-sm-9">
                                                                <label>ปี ที่สิ้นสุด</label>
                                                                <input type="text" name="contact[start_date]" value=""
                                                                       class="form-control2 datepicker required"
                                                                       data-format="yyyy-mm-dd" data-lang="en"
                                                                       data-RTL="false">
                                                            </div>
                                                            <div class="col-md-3 col-sm-9">
                                                                <label>ระยะเวลา</label>
                                                                <input type="text" name="contact[expected_salary]"
                                                                       value="" class="form-control2 required">
                                                            </div>
                                                            <div class="col-md-3 col-sm-9">
                                                                <label>งบประมาณ </label>
                                                                <input type="text" name="contact[start_date]" value=""
                                                                       class="form-control2  required">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ผู้ใช้ทุน</label>
                                                                <input type="text" name="contact[start_date]" value=""
                                                                       class="form-control2 required"
                                                                       data-format="yyyy-mm-dd" data-lang="en"
                                                                       data-RTL="false">
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>เว็บไซต์</label>
                                                                <input type="text" name="contact[expected_salary]"
                                                                       value="" class="form-control2 required">
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">

                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">

                                                            <div class="col-md-4 col-sm-8">
                                                                <label>สมาชิกโครงการ </label>

                                                                <input type="text" name="contact[website]"
                                                                       placeholder="ชื่อ" class="form-control2"><br>
                                                                <input type="text" name="contact[website]"
                                                                       placeholder="ชื่อ" class="form-control2">
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label></label>

                                                                <input type="text" name="contact[website]"
                                                                       placeholder="นามสกุล" class="form-control2"><br>
                                                                <input type="text" name="contact[website]"
                                                                       placeholder="นามสกุล" class="form-control2">
                                                            </div>


                                                        </div>


                                                        <div class="col-md-4 col-sm-8">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-info dropdown-toggle"
                                                                        data-toggle="dropdown">เลือก <span
                                                                            class="caret"></span></button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><i class="fa fa-edit" data-target="#modal2"></i>
                                                                        อาจารย์ภายใน
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                    class="fa fa-question-circle"></i>
                                                                            อาจารย์ภายนอก</a></li>

                                                                    <li><a href="#"><i
                                                                                    class="fa fa-question-circle"></i>
                                                                            นักศึกษา</a></li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="fancy-file-upload fancy-file-info">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control"
                                                               name="contact[attachment]"
                                                               onchange="jQuery(this).next('input').val(this.value);"/>
                                                        <input type="text" class="form-control"
                                                               placeholder="no file selected" readonly=""/>
                                                        <span class="button">Choose File</span>
                                                    </div>
                                                    <button type="button" class="btn btn-primary">เพิ่มสมาชิก</button>

                                                </fieldset>
                                                <br><br>

                                                <div class="row">
                                                    <button type="button" class="btn btn-success">บันทึก</button>&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-danger">ยกเลิก</button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </center>
                <br>
                <?php /* @var $row \app\modules\portfolio\models\Project */
                foreach ($sql2 as $row) { ?>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <thead>

                        <tr>
                            <th><?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;
                                    echo $row4->project->project_name_eng;

                                } ?></th>
                            <th>
                                <a href="Expenses-namepublic.html" class="btn btn-xs btn-default btn-bordered">
                                    <i class="et-megaphone"></i>
                                    <span>ผลงานตีพิมพ์</span></a>

                            </th>
                        </tr>

                        </thead>

                    </table>
                    <div class="col-md-9 col-sm-8">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                            <tbody>
                            <tr>หัวหน้าโครงการ : <?php foreach ($row->projectMembers as $row4) {
                                    if ($row4->project_role_id == 1) {
                                        echo \app\modules\portfolio\models\Person::findOne($row4->member_id)->person_name;
                                    }


                                } ?>&nbsp;

                                <?php foreach ($row->projectMembers as $row5) {
                                    echo $row5->project->project_name_eng;

                                } ?>
                            </tr>
                            <br>
                            <tr>ระยะเวลา :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>
                            <th>
                                งบประมาณ :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></th>
                            <br>
                            <tr>
                                เว็บไซต์ :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>
                            <br>
                            <tr>ผู้ให้ทุนสนับสนุน :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row->sponsorSponsor->sponsor_name;


                                } ?></tr>
                            <br>
                            <tr>ปีที่เริ่มต้น-ปีที่สิ้นสุด :&nbsp;&nbsp;<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>

                            </tbody>

                        </table>

                    </div>
                    <div class="col-md-3col-sm-8">
                        <table>
                            <tr><h5>สมาชิกโครงการ</h5></tr>


                            <th><?php foreach ($row->projectMembers as $row2) {
                                    echo $row2->member_name;

                                } ?></th>


                        </table>

                    </div>
                <?php } ?>
            </div>
            <!-- /panel content -->


        </div>

    </div>

</section>