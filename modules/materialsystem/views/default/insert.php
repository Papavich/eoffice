<!-- page title -->
<header id="page-header">
    <h1>รายการเพิ่มวัสดุ</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-12">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>แบบฟอร์มการทำรายการ</strong>
                </div>

                <div class="panel-body">

                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send"/>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label>เลขที่รายการ</label>
                                        <input type="text" name="contact[requisition]" value="00108011/60" class="form-control required" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label>วันที่</label>
                                        <input type="text" name="contact[date]" value="21/06/60" class="form-control required" disabled>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label>ชื่อโครงการ</label>
                                        <input type="text" name="mat_project" value="" class="form-control" placeholder="กรอกชื่อโครงการ ทั้งนี้อาจมีหรือไม่มีก็ได้">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label>ชื่อวัสดุ</label>
                                        <input type="text" class="form-control" name="mat_name" placeholder="กรอกชื่อวัสดุ" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label>หมวดหมู่</label> <br>
                                        <select name="mat_type">
                                            <option selected disabled>-- กรุณาเลือก --</option>
                                            <option value="">วัสดุใช้สำนักงาน</option>
                                            <option value="">วัสดุคงทนถาวร</option>
                                            <option value="">วัสดุสิ้นเปลือง</option>
                                            <option value="">วัสดุทั่วไป</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>รายละเอียด</label> <br>
                                        <textarea name="mat_detail" row="4" class="form-control required"  placeholder="กรอกรายละเอียด ข้อมูลเกี่ยวกับวัสดุ"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>จำนวน</label>
                                        <input type="number" name="mat_price" value="" class="form-control required" placeholder="00.00">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>ราคา/หน่วย</label>
                                        <input type="number" name="mat_name" value="" class="form-control required" placeholder="00.00">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>หน่วยนับ</label>
                                        <input type="text" name="mat_amount" value="" class="form-control required" placeholder="สกุลเงิน เช่น หน่วยเป็นบาท">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>ยอดรวม</label>
                                        <input type="number" name="mat_name" value="" class="form-control required" placeholder="00.00" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>วัตถุประสงค์การใช้งาน</label> <br>
                                        <textarea name="mat_objective" class="form-control required" placeholder="อธิบายเกี่ยวกับวัตถุประสงค์ในการนำวัสดุไปใช้งาน"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <label>ชื่อบริษัท</label>
                                        <input type="text" name="mat_employee" value="" class="form-control required" placeholder="กรอกชื่อบริษัท ห้างร้าน หรือสถานที่ติดต่อซื้อวัสดุ">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <label>ที่อยู่</label>
                                        <textarea name="mat_address" row="4" class="form-control required" placeholder="กรอกรายละเอียดที่อยู่ หรือสถาานที่ตั้งของบริษัทที่สั่งซื้อวัสดุ"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <label>ชื่อผู้ติดต่อ</label>
                                        <input type="text" name="mat-contact" value="" class="form-control required" placeholder="กรอกชื่อบุคคลที่ทำการติดต่อซื้อขายวัสดุ">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12" >
                                        <label>เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control masked" name="mat_tel" data-format="999-999?-9999" data-placeholder="X" placeholder="กรอกเบอร์โทรศัพท์" required>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <label>สถานที่จัดเก็บ</label>
                                        <select name="location" class="form-control required">
                                            <option selected disabled>-- กรุณาเลือก --</option>
                                            <option name="1">ภาควิชาวิทยาการคอมพิวเตอร์</option>
                                            <option name="2">ห้องเก็บวัสดุ SC.05</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label>เลือกรูปภาพประกอบ</label>
                                        <!-- custom file upload -->
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                            <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                                            <span class="button">Choose File</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="#" class="btn btn-3d btn-success btn-xl btn-block margin-top-30">
                                    <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>บันทึก
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <a href="#" class="btn btn-danger btn-warning btn-xl btn-block margin-top-30">
                                    <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก
                                </a>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
            <!-- /----- -->

        </div>

    </div>
</div>