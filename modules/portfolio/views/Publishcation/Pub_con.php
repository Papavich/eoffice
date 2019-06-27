
    <!--
        MIDDLE
    -->
    <section id="middle">


        <!-- page title -->
        <header id="page-header">
            <h1>ประชุมวิชาการ</h1>
            <ol class="breadcrumb">
                <li><a href="#">กิจกรรม</a></li>
                <li class="active">ประชุมวิชาการ</li>
            </ol>
        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">



            <div id="panel-1" class="panel panel-default">

                <div class="panel-heading">
							<span class="title elipsis">
								<strong>ประชุมวิชาการ</strong> <!-- panel title -->
							</span>

                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                    </ul>
                    <!-- /right options -->

                </div>

                <!-- panel content -->
                <div class="panel-body">

                    <center>	<!-- Large Modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                        <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- header modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                    </div>

                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-transparent">
                                                <strong>FORM VALIDATION</strong>
                                            </div>

                                            <div class="panel-body">

                                                <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                    <fieldset>
                                                        <!-- required [php action request] -->
                                                        <input type="hidden" name="action" value="contact_send" />

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ภาษาที่แสดงผล</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="eng">ภาษาอังกฤษ</option>
                                                                        <option value="thai">ภาษาไทย</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่อบทความ(ไทย)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ระดับการเผยแพร่</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Marketing">ระดับชาติ</option>
                                                                        <option value="Developer">ระดับนานาชาติ</option>

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">


                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ประเภทวารสาร</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Marketing">PR &amp; Marketing</option>
                                                                    <option value="Developer">Web Developer</option>
                                                                    <option value="php">PHP Programmer</option>
                                                                    <option value="Javascript">Javascript Programmer</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>เดือน และ วันที่</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- Select ---</option>
                                                                        <option value="Marketing">2017</option>
                                                                        <option value="Developer">2016</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>จำนวนปี</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ฉบับที่ </label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>เมือง</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ประเทศ</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>จำนวนหน้าที่พิมพ์</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ค่าใช้จ่าย</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ผู้เขียน</label>

                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label></label>

                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2">
                                                                </div>

                                                            </div>


                                                            <div class="col-md-4 col-sm-8">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">เลือก <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><i class="fa fa-edit" data-target="#modal2"></i> อาจารย์ภายใน</li>

                                                                        <li><a href="#"><i class="fa fa-question-circle"></i> นักศึกษา</a></li>

                                                                    </ul>
                                                                </div>
                                                                <a href="#" class="btn btn-3d btn-red"><i class="et-megaphone"></i>ลบ</a><br/>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">


                                                                    <a href="#" class="btn btn-3d btn-blue"><i class="et-strategy"></i>เพิ่มสมาชิก</a>

                                                                </div><br><br>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>keyword</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>
                                                                            ไฟล์บทคคัดย่อ
                                                                            <small class="text-muted">(text)</small>
                                                                        </label>

                                                                        <!-- custom file upload -->
                                                                        <div class="fancy-file-upload fancy-file-primary">
                                                                            <i class="fa fa-upload"></i>
                                                                            <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                            <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                            <span class="button">Choose File</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>
                                                                            ไฟล์บทความ
                                                                            <small class="text-muted">(Full text)</small>
                                                                        </label>

                                                                        <!-- custom file upload -->
                                                                        <div class="fancy-file-upload fancy-file-primary">
                                                                            <i class="fa fa-upload"></i>
                                                                            <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                            <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                            <span class="button">Choose File</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <label>รายละเอียดอื่นๆ</label>
                                                                        <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <label>อยู่ภายใต้โครงการวิจัย</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">อยู่ภายนอกโครงการวิจัย</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </fieldset>








                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                SEND APPLICATION
                                                                <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div></center><br>

                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/>
                            </th>
                            <th>ปีที่ตีพิมพื</th>
                            <th><center>ผลงานวิจัย</center></th>
                            <th>ค่านํ้าหนักฐานข้อมูอ</th>
                            <th>แก้ไข</th>
                            <th>เอกสาร</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2016
                            </td>
                            <td>
                                <a href="Expenses-namepublic.html">
                                    Kokaew U., Wattana M., Tamviset W., Faungfoo S. and Aottiwech N.	,
                                    Augmented Reality Enhanced Learning in Phylum/Division Basidiomycota.,
                                    The 4th International Conference for Science educators and teachers (ISET2016) ,
                                    June, 2016, Khon Kaen, Thailand, pp.9. </a>
                            </td>
                            <td>
                                3.0
                            </td>
                            <td class="center">
                                <!-- Large Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ระดับการเผยแพร่</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>



                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label>

                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label></label>

                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                            <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2">
                                                                        </div>

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">เลือก <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> อาจารย์ภายใน</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> นักศึกษา</a></li>

                                                                            </ul>
                                                                        </div>
                                                                        <a href="#" class="btn btn-3d btn-red"><i class="et-megaphone"></i>ลบ</a><br/>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">


                                                                            <a href="#" class="btn btn-3d btn-blue"><i class="et-strategy"></i>เพิ่มสมาชิก</a>

                                                                        </div><br><br>

                                                                        <div class="row">
                                                                            <div class="form-group">
                                                                                <div class="col-md-12 col-sm-12">
                                                                                    <label>keyword</label>
                                                                                    <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <label>
                                                                                    ไฟล์บทคคัดย่อ
                                                                                    <small class="text-muted">(text)</small>
                                                                                </label>

                                                                                <!-- custom file upload -->
                                                                                <div class="fancy-file-upload fancy-file-primary">
                                                                                    <i class="fa fa-upload"></i>
                                                                                    <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                    <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                    <span class="button">Choose File</span>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <label>
                                                                                    ไฟล์บทความ
                                                                                    <small class="text-muted">(Full text)</small>
                                                                                </label>

                                                                                <!-- custom file upload -->
                                                                                <div class="fancy-file-upload fancy-file-primary">
                                                                                    <i class="fa fa-upload"></i>
                                                                                    <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                    <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                    <span class="button">Choose File</span>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 col-sm-12">
                                                                                <label>รายละเอียดอื่นๆ</label>
                                                                                <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 col-sm-12">
                                                                                <label>อยู่ภายใต้โครงการวิจัย</label>
                                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                                    <option value="">อยู่ภายนอกโครงการวิจัย</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                            </fieldset>








                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2015
                            </td>
                            <td>
                                <a href="mailto:looper90@gmail.com">
                                    Thammasakorn C., So-In C. and Kokaew U.	, Brain Cancer Cell Detection Optimization Schemes Using Image
                                    Processing and Soft-Computing, International
                                    Conference on Communication and Computer Engineering (ICOCOE) , June, 2015. </a>
                            </td>
                            <td>
                                1.0
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประชุมวิชาการ</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label></br>
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> Action</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> Another action</a></li>
                                                                                <li><a href="#"><i class="fa fa-print"></i> Something else here</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a href="#"><i class="fa fa-cogs"></i> Separated link</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2012
                            </td>
                            <td>
                                <a href="mailto:userwow@yahoo.com">
                                    So-In C., Phaudphut C., Tesana S., Weeramongkonlert N., Wijitsopon K., Waikham B., Saiyod S. and Kokaew U.	, Mobile animal tracking systems using light sensor for efficient power and cost saving motion detection, 8th International Symposium on Communication Systems,
                                    Networks & Digital Signal Processing (CSNDSP), 2012 , July 18-20, 2012, Poznan, Poland, pp.1-6.  </a>
                            </td>
                            <td>
                                1.0
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประชุมวิชาการ</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label></br>
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> Action</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> Another action</a></li>
                                                                                <li><a href="#"><i class="fa fa-print"></i> Something else here</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a href="#"><i class="fa fa-cogs"></i> Separated link</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2012
                            </td>
                            <td>
                                <a href="mailto:userwow@gmail.com">
                                    Kokaew U., So-In C. and Promnonsri P.	, Decision Support System for Mushroom Field Trip Management System,
                                    Proceedings of International Conference on Microbial Taxonomy, Basic and Applied Microbiology (MTBA2012) ,
                                    Oct 2012, 2012. </a>
                            </td>
                            <td>
                                2.0
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประชุมวิชาการ</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label></br>
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> Action</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> Another action</a></li>
                                                                                <li><a href="#"><i class="fa fa-print"></i> Something else here</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a href="#"><i class="fa fa-cogs"></i> Separated link</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>


                                <a href="http://202.28.94.53/g22/download/20120034_abstract.txt" target="_blank" class="label label-sm label-warning">Absrtact</a>
                                &nbsp; <br/><br/>
                                <a href="http://202.28.94.53/g22/download/20120034_06292789.pdf" target="_blank" class="label label-sm label-success">Full Paper</a>
                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2010
                            </td>
                            <td>
                                <a href="mailto:userwow@gmail.com">
                                    Kokaew U., BoonLue S., Milintawisamai N. and Naknil S.	,
                                    Production and properties of xylanase from thermoalkalophilic fungal Thermoascus aurantiacus SCGNF27-2 on solid state cultivation,
                                    The Lignobiotech One Symposium , March 28th - April 1st, 2010, France. </a>
                            </td>
                            <td>
                                2.0
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประชุมวิชาการ</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label></br>
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> Action</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> Another action</a></li>
                                                                                <li><a href="#"><i class="fa fa-print"></i> Something else here</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a href="#"><i class="fa fa-cogs"></i> Separated link</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                2016
                            </td>
                            <td>
                                <a href="mailto:userwow@gmail.com">
                                    Kokaew U., Wattana M., Tamviset W., Faungfoo S. and Aottiwech N.	,
                                    Augmented Reality Enhanced Learning in Phylum/Division Basidiomycota.,
                                    The 4th International Conference for Science educators and teachers (ISET2016) ,
                                    June, 2016, Khon Kaen, Thailand, pp.9. </a>
                            </td>
                            <td>
                                2.0
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">บันทึก</button>
                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">บันทึก</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>FORM VALIDATION</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ภาษาที่แสดงผล</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- เลือก ---</option>
                                                                                <option value="eng">ภาษาอังกฤษ</option>
                                                                                <option value="thai">ภาษาไทย</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่อบทความ(ไทย)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                            <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประชุมวิชาการ</label>
                                                                            <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                        </div>

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>Phone *</label>
                                                                            <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ประเภทวารสาร</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Marketing">PR &amp; Marketing</option>
                                                                            <option value="Developer">Web Developer</option>
                                                                            <option value="php">PHP Programmer</option>
                                                                            <option value="Javascript">Javascript Programmer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>Position *</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">PR &amp; Marketing</option>
                                                                                <option value="Developer">Web Developer</option>
                                                                                <option value="php">PHP Programmer</option>
                                                                                <option value="Javascript">Javascript Programmer</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>เดือน และ วันที่</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                                <option value="">--- Select ---</option>
                                                                                <option value="Marketing">2017</option>
                                                                                <option value="Developer">2016</option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>จำนวนปี</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-9">
                                                                            <label>ฉบับที่ </label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>เมือง</label>
                                                                            <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ประเทศ</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>จำนวนหน้าที่พิมพ์</label>
                                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">

                                                                        <div class="col-md-4 col-sm-8">
                                                                            <label>ผู้เขียน</label></br>
                                                                            <label>
                                                                                Website
                                                                                <small class="text-muted">- optional</small>
                                                                            </label>
                                                                            <input type="text" name="contact[website]" placeholder="http://" class="form-control2">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Default <span class="caret"></span></button>
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><i class="fa fa-edit" data-target="#modal2"></i> Action</li>

                                                                                <li><a href="#"><i class="fa fa-question-circle"></i> Another action</a></li>
                                                                                <li><a href="#"><i class="fa fa-print"></i> Something else here</a></li>
                                                                                <li class="divider"></li>
                                                                                <li><a href="#"><i class="fa fa-cogs"></i> Separated link</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>
                                                                                File Attachment
                                                                                <small class="text-muted">Curriculum Vitae - optional</small>
                                                                            </label>

                                                                            <!-- custom file upload -->
                                                                            <div class="fancy-file-upload fancy-file-primary">
                                                                                <i class="fa fa-upload"></i>
                                                                                <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                                <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                                <span class="button">Choose File</span>
                                                                            </div>
                                                                            <small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
                <!-- /panel content -->

            </div>

        </div>

    </section>
    <!-- /MIDDLE -->

</div>

<!--**************************************************************************************************************************-->


<!-- pre code -->
<div class="text-left">
    <a class="btn btn-xs btn-info" href="javascript:;" onclick="jQuery('#pre-0').slideToggle();">Show Code</a>
</div>
<pre id="pre-0" class="text-left noradius text-danger softhide margin-top-10">
<span class="text-success">&lt;!-- HTML DATATABLE --&gt;</span>
&lt;table class="table table-striped table-bordered table-hover" id="datatable_sample"&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th class="table-checkbox"&gt;
				&lt;input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/&gt;
			&lt;/th&gt;
			&lt;th&gt;Username&lt;/th&gt;
			&lt;th&gt;Email&lt;/th&gt;
			&lt;th&gt;Points&lt;/th&gt;
			&lt;th&gt;Joined&lt;/th&gt;
			&lt;th&gt;Status&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;

	&lt;tbody&gt;
		&lt;tr class="odd gradeX"&gt;
			&lt;td&gt;
				&lt;input type="checkbox" class="checkboxes" value="1"/&gt;
			&lt;/td&gt;
			&lt;td&gt;
				 shuxer
			&lt;/td&gt;
			&lt;td&gt;
				&lt;a href="mailto:shuxer@gmail.com"&gt;
				shuxer@gmail.com &lt;/a&gt;
			&lt;/td&gt;
			&lt;td&gt;
				 120
			&lt;/td&gt;
			&lt;td class="center"&gt;
				 12 Jan 2012
			&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="label label-sm label-success"&gt;
				Approved &lt;/span&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr class="odd gradeX"&gt;
			&lt;td&gt;
				&lt;input type="checkbox" class="checkboxes" value="1"/&gt;
			&lt;/td&gt;
			&lt;td&gt;
				 looper
			&lt;/td&gt;
			&lt;td&gt;
				&lt;a href="mailto:looper90@gmail.com"&gt;
				looper90@gmail.com &lt;/a&gt;
			&lt;/td&gt;
			&lt;td&gt;
				 120
			&lt;/td&gt;
			&lt;td class="center"&gt;
				 12.12.2011
			&lt;/td&gt;
			&lt;td&gt;
				&lt;span class="label label-sm label-warning"&gt;
				Suspended &lt;/span&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/tbody&gt;
&lt;/table&gt;


<span class="text-success">&lt;!-- CSS DATATABLE --&gt;</span>
&lt;link href="assets/css/layout-datatable.css" rel="stylesheet" type="text/css" /&gt;



<span class="text-success">&lt;!-- JS DATATABLE --&gt;</span>
&lt;script type="text/javascript"&gt;
loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
	loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){

		if (jQuery().dataTable) {

			var table = jQuery('#datatable_sample');
			table.dataTable({
				"columns": [{
					"orderable": false
				}, {
					"orderable": true
				}, {
					"orderable": false
				}, {
					"orderable": false
				}, {
					"orderable": true
				}, {
					"orderable": false
				}],
				"lengthMenu": [
					[5, 15, 20, -1],
					[5, 15, 20, "All"] // change per page values here
				],
				// set the initial value
				"pageLength": 5,
				"pagingType": "bootstrap_full_number",
				"language": {
					"lengthMenu": "  _MENU_ records",
					"paginate": {
						"previous":"Prev",
						"next": "Next",
						"last": "Last",
						"first": "First"
					}
				},
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}],
				"order": [
					[1, "asc"]
				] // set first column as a default sort by asc
			});

			var tableWrapper = jQuery('#datatable_sample_wrapper');

			table.find('.group-checkable').change(function () {
				var set = jQuery(this).attr("data-set");
				var checked = jQuery(this).is(":checked");
				jQuery(set).each(function () {
					if (checked) {
						jQuery(this).attr("checked", true);
						jQuery(this).parents('tr').addClass("active");
					} else {
						jQuery(this).attr("checked", false);
						jQuery(this).parents('tr').removeClass("active");
					}
				});
				jQuery.uniform.update(set);
			});

			table.on('change', 'tbody tr .checkboxes', function () {
				jQuery(this).parents('tr').toggleClass("active");
			});

			tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

		}

	});
});
&lt;/script"&gt;
</pre>
<!-- /pre code -->

</div>
<!-- /panel footer -->

</div>
<!-- /PANEL -->

</div>
</section>
<!-- /MIDDLE -->

</div>




<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
        loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){

            if (jQuery().dataTable) {

                var table = jQuery('#datatable_sample');
                table.dataTable({
                    "columns": [{
                        "orderable": false
                    }, {
                        "orderable": true
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": true
                    }, {
                        "orderable": false
                    }],
                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "language": {
                        "lengthMenu": "  _MENU_ records",
                        "paginate": {
                            "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ] // set first column as a default sort by asc
                });

                var tableWrapper = jQuery('#datatable_sample_wrapper');

                table.find('.group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            jQuery(this).attr("checked", true);
                            jQuery(this).parents('tr').addClass("active");
                        } else {
                            jQuery(this).attr("checked", false);
                            jQuery(this).parents('tr').removeClass("active");
                        }
                    });
                    jQuery.uniform.update(set);
                });

                table.on('change', 'tbody tr .checkboxes', function () {
                    jQuery(this).parents('tr').toggleClass("active");
                });

                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

            }

        });
    });
</script>





<!--******************************************************************************************************************************-->

<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
    loadScript(plugin_path + "raphael-min.js", function(){
        loadScript(plugin_path + "chart.morris/morris.min.js", function(){

            // demo js script
            loadScript("assets/js/view/demo.graphs.morris.js");

        });
    });
</script>

</body>
</html>