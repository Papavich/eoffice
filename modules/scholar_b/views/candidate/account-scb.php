<!-- page title -->
<header id="page-header">
    <h1>ข้อมูลส่วนตัว</h1>
</header>
<!-- /page title -->

<div id="content" class="padding-20">
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <h4>ข้อมูลส่วนตัว</h4>
        </div>

        <div class="panel-body">
            <h4><b>ประวัติส่วนตัว</b></h4>
            <div class="row">
                <div class="fancy-form">
                    <div class="col-md-4 col-sm-4">
                        <!-- input -->
                        <label>เลขบัตรประจำตัวประชาชน</label>
                        <input type="text" class="form-control masked" name="contact[SSN]"
                               value="1-2345-22222-22-3"
                               class="form-control required" data-format="9-9999-99999-99-9" data-placeholder="X" disabled>
                    </div><!-- /input -->
                    <!-- <div class="col-md-4 col-sm-4">
                        <label>รหัสผ่าน</label>
                        <input type="password" name="contact[password]" class="form-control required">
                    </div> -->
                </div>
            </div>

            <br>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-2 col-sm-2">
                        <label>คำนำหน้า</label>
                        <select name="contact[prefix]"
                                class="form-control pointer required" disabled>
                            <option selected disabled value="">ระบุคำนำหน้า</option>
                            <option value="Mr." selected>นาย</option>
                            <option value="Miss">นาง</option>
                            <option value="Mrs.">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>ชื่อจริง</label>
                        <input type="text" name="contact[first_name]" value="ศุภวิชญ์"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>นามสกุล</label>
                        <input type="text" name="contact[last_name]" value="ภารจินดา"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <label>หมู่โลหิต</label>
                        <select name="contact[blo]"
                                class="form-control pointer required" disabled>
                            <option selected disabled value="">เลือกหมู่โลหิต</option>
                            <option value="a">A</option>
                            <option value="b" selected>B</option>
                            <option value="ab">AB</option>
                            <option value="o">O</option>
                        </select>
                    </div>
                </div>
            </div>


            <h4><b>ภูมิลำเนา</b></h4>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>ที่อยู่</label>
                        <input type="text" name="contact[school_name]" value="ddd"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>ตำบล/แขวง</label>
                        <input type="text" name="contact[province]" value="dddd"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>อำเภอ</label>
                        <input type="text" name="contact[province]" value="fffff"
                               class="form-control required" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>จังหวัด</label>
                        <input type="text" name="contact[province]" value="ddfs"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>รหัสไปรษณีย์</label>
                        <input type="text" class="form-control masked"
                               name="contact[pcode]"
                               value="24000" class="form-control required"
                               data-format="99999"
                               data-placeholder="X" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>หมายเลขโทรศัพท์</label>
                        <input type="text" name="contact[province]" value="082-1111-111"
                               class="form-control masked"
                               class="form-control required" data-format="999-9999-999" data-placeholder="X" disabled>
                    </div>
                </div>
            </div>

            <h4><b>ประวัติบิดา-มารดา</b></h4>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>บิดาชื่อ</label>
                        <input type="text" name="contact[school_name]" value="sssss"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>นามสกุล</label>
                        <input type="text" name="contact[province]" value="ssss"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>สถานะ</label><br>
                        <input type="radio" name="radio-btn1" value="1" checked="checked">
                        <i></i> ยังมีชีวิต
                        <input type="radio" name="radio-btn1" value="2">
                        <i></i> ถึงแก่กรรม
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>อาชีพ</label>
                        <input type="text" name="contact[province]" value="dsd"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>สถานที่ประกอบอาชีพ</label>
                        <input type="text" name="contact[province]" value="dddd"
                               class="form-control required" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>มารดาชื่อ</label>
                        <input type="text" name="contact[school_name]" value="sss"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>นามสกุล</label>
                        <input type="text" name="contact[province]" value="aaaa"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>สถานะ</label><br>
                        <input type="radio" name="radio-btn2" value="1" checked="checked">
                        <i></i> ยังมีชีวิต
                        <input type="radio" name="radio-btn2" value="2">
                        <i></i> ถึงแก่กรรม
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>อาชีพ</label>
                        <input type="text" name="contact[province]" value="dddd"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>สถานที่ประกอบอาชีพ</label>
                        <input type="text" name="contact[province]" value="dddd"
                               class="form-control required" disabled>
                    </div>
                </div>
            </div>

            <h4><b>ประวัติการศึกษา</b></h4>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>เป็นนักศึกษาชั้นมัธยมปีที่ 6 โรงเรียน</label>
                        <input type="text" name="contact[first_name]" value="aaaa"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>ถนน</label>
                        <input type="text" name="contact[last_name]" value="aaaa"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>อำเภอ</label>
                        <input type="text" name="contact[province]" value="aaa"
                               class="form-control required" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <label>จังหวัด</label>
                        <input type="text" name="contact[province]" value="aaa"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>หมายเลขโทรศัพท์</label>
                        <input type="text" name="contact[province]" value="038-820922"
                               class="form-control required" disabled>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>เป็นโรงเรียน</label><br>
                        <input type="radio" name="radio-btn2" value="1" checked="checked">
                        <i></i> รัฐบาล
                        <input type="radio" name="radio-btn2" value="2">
                        <i></i> เอกชน
                    </div>
                </div>
            </div>
            <br><footer style="text-align:center;">
                <a href="../register/edit_account" class="btn btn-success white"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="../register/index_other" class="btn btn-danger white"><i class="fa fa-times"></i> ยกเลิก</a>
            </footer>
        </div>

    </div>

</div>

