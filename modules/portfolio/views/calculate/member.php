<section id="middle">


    <!-- page title -->
    <header id="page-header">
        <h1>สมาชิก</h1>
        <ol class="breadcrumb">
            <li><a href="#">กิจกรรม</a></li>
            <li class="active">สมาชิก</li>
        </ol>
    </header>
    <!-- /page title -->

    <div id="content" class="padding-20">



        <div id="panel-1" class="panel panel-default">

            <div class="panel-heading">
							<span class="title elipsis">
								<strong>สมาชิก</strong> <!-- panel title -->
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

                <center><!-- Large Modal -->
                    <a href="#" class="btn btn-3d btn-reveal btn-blue" data-toggle="modal" data-target="#modal1"><i class="fa fa-user-plus"></i><span>เพิ่มสมาชิก</span></a>
                    <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- header modal -->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel">แก้ไขสมาชิก</h4>
                                </div>

                                <!-- body modal -->
                                <div class="modal-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel-heading-transparent">
                                            <strong></strong>
                                        </div>

                                        <div class="panel-body">

                                            <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                <fieldset>
                                                    <!-- required [php action request] -->
                                                    <input type="hidden" name="action" value="contact_send" />

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>คำนำหน้า</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Mr.">นาย</option>
                                                                    <option value="Miss.">นางสาว</option>

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


                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ชื่อ(อังกฤษ)</label>
                                                                <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                            </div>

                                                            <div class="col-md-4 col-sm-8">
                                                                <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                            </div>



                                                        </div>
                                                    </div>
                                                    <br/><br/>
                                                    <div class="row">

                                                        <div class="col-md-4 col-sm-8">
                                                            <label>รหัสประจำตัว :</label>
                                                            <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                        </div>

                                                        <div class="col-md-4 col-sm-8">
                                                            <label>ตำแหน่ง</label>
                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                <option value="">--- เลือก ---</option>
                                                                <option value="Mr.">นักศึกษา</option>
                                                                <option value="Miss.">อาจารย์</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-sm-8">
                                                            <label>วุฒิการศึกษา</label>
                                                            <select name="contact[position]" class="form-control2 pointer required">
                                                                <option value="">--- เลือก ---</option>
                                                                <option value="Mr.">ปริญญาตรี</option>
                                                                <option value="Miss.">ปริญญาโท</option>
                                                                <option value="Miss.">ปริญญาเอก</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">

                                                            </div>


                                                            <div class="col-md-4 col-sm-8">
                                                                <label>สถานะ</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Mr.">นักศึกษา</option>
                                                                    <option value="Miss.">อาจารย์</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>สาขา</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Mr.">CS</option>
                                                                    <option value="Miss.">ICT</option>
                                                                    <option value="Miss.">GIS</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4 col-sm-8">

                                                            </div>


                                                            <div class="col-md-4 col-sm-8">
                                                                <label>Thesis / IS</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Mr.">Thesis</option>
                                                                    <option value="Miss.">IS</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 col-sm-8">



                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <button type="button" class="btn btn-success">บันทึก</button>
                                                    <button type="button" class="btn btn-danger">ยกเลิก</button>





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
                        <th>รหัสประจำตัว</th>
                        <th><center>ชื่อ - นามสกุล</center></th>
                        <th>วุฒิการศึกษา</th>
                        <th>สาขา</th>
                        <th>Thesis/IS</th>
                        <th>ปรับปรุง</th>


                    </tr>
                    </thead>

                    <tbody>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>

                        <td class="center">

                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไขข้อมูล</h4>
                                        </div>

                                        <!-- body modal -->
                                        <div class="modal-body">
                                            <div class="panel panel-default">
                                                <div class="panel-heading panel-heading-transparent">
                                                    <strong></strong>
                                                </div>

                                                <div class="panel-body">

                                                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                        <fieldset>
                                                            <!-- required [php action request] -->
                                                            <input type="hidden" name="action" value="contact_send" />

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">นาย</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>





                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>
                        <td class="center">
                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไข</h4>
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
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>




                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>
                        <td class="center">
                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไข</h4>
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
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>





                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>
                        <td class="center">
                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไข</h4>
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
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>




                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                        </td>

                    </tr>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>
                        <td class="center">
                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไข</h4>
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
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>






                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>





                        </td>
                    </tr>
                    <tr class="odd gradeX">
                        <td>
                            <input type="checkbox" class="checkboxes" value="1"/>
                        </td>
                        <td>
                            463333489-5
                        </td>
                        <td>
                            <a href="#">
                                ทองคำ ไวกา </a>
                        </td>
                        <td>
                            ปริญญาตรี
                        </td>
                        <td>
                            CS
                        </td>
                        <td>
                            IS
                        </td>
                        <td class="center">
                            <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>
                            <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myLargeModalLabel">แก้ไข</h4>
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
                                                                        <label>คำนำหน้า</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นาย</option>
                                                                            <option value="Miss.">นางสาว</option>

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


                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>ชื่อ(อังกฤษ)</label>
                                                                        <input type="email" name="contact[email]" value="" class="form-control2 required">
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                                                        <input type="text" name="contact[phone]" value="" class="form-control2 required">
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>รหัสประจำตัว :</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ตำแหน่ง</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">นักศึกษา</option>
                                                                        <option value="Miss.">อาจารย์</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>วุฒิการศึกษา</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Mr.">ปริญญาตรี</option>
                                                                        <option value="Miss.">ปริญญาโท</option>
                                                                        <option value="Miss.">ปริญญาเอก</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สถานะ</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">นักศึกษา</option>
                                                                            <option value="Miss.">อาจารย์</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>สาขา</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">CS</option>
                                                                            <option value="Miss.">ICT</option>
                                                                            <option value="Miss.">GIS</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-4 col-sm-8">

                                                                    </div>


                                                                    <div class="col-md-4 col-sm-8">
                                                                        <label>Thesis / IS</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">--- เลือก ---</option>
                                                                            <option value="Mr.">Thesis</option>
                                                                            <option value="Miss.">IS</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-8">



                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>






                                                            <button type="button" class="btn btn-success">บันทึก</button>
                                                            <button type="button" class="btn btn-danger">ยกเลิก</button>


                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>




                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
            <!-- /panel content -->

        </div>

    </div>

</section>