<!-- page title -->
<header id="page-header">
    <h1>Form Edit Infomation</h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Edit Infomation</li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-6">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">


                    <!------------------------------------------- Student form ----------------------------------------------------------------->
                    <strong>Staff Form</strong>
                </div>

                <div class="panel-body">

                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Person ID</label>
                                        <input type="text" name="personid" value="573020749" class="form-control " disabled>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>คำนำหน้า</label>
                                        <select name="prefix" class="form-control pointer required">
                                            <option value="1">นาย</option>
                                            <option value="2">นางสาว</option>
                                            <option value="3">นาง</option>
                                            <option value="4">นาย</option>
                                            <option value="5">ผศ.ดร.</option>
                                            <option value="6">ผศ.</option>
                                            <option value="7">ดร.</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>รหัสประชาชน</label>
                                        <input type="text" name="cardid" value="1-4999-00233-84-5" class="form-control required">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ชื่อ</label>
                                        <input type="text" name="contact[first_name]" value="สุธน" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>นามสกุล</label>
                                        <input type="text" name="contact[last_name]" value="เจริญศิริ" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ชื่อ(ภาษาอังกฤษ)</label>
                                        <input type="text" name="contact[first_name]" value="Suton" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                        <input type="text" name="contact[last_name]" value="Charoensiri" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->

                            <h4>ข้อมูลติดต่อ</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>เบอร์โทรศัพท์มือถือ</label>
                                        <input type="text" name="MobilePhone" value="0959957515" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>เบอร์โทรศัพท์</label>
                                        <input type="text" name="Phone" value="0425555555" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>อีเมล</label>
                                        <input type="email" name="contact[email1]" value="ellouked@gmail.com" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>อีเมลสำรอง</label>
                                        <input type="email2" name="contact[email2]" value="e-llou@hotmail.com" class="form-control required">
                                    </div>

                                </div>
                            </div>

                            <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                            <h4>ที่อยู่</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>ประเทศ</label>
                                        <select name="country">
                                            <option value="" >--------- เลือกประเทศ ---------</option>
                                            <option value="" selected>ไทย</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>จังหวัด</label>
                                        <select name="province">
                                            <option value="" >--------- เลือกจังหวัด ---------</option>
                                            <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                                            <option value="กระบี่">กระบี่ </option>
                                            <option value="กาญจนบุรี">กาญจนบุรี </option>
                                            <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                                            <option value="กำแพงเพชร">กำแพงเพชร </option>
                                            <option value="ขอนแก่น">ขอนแก่น</option>
                                            <option value="จันทบุรี">จันทบุรี</option>
                                            <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                                            <option value="ชัยนาท">ชัยนาท </option>
                                            <option value="ชัยภูมิ">ชัยภูมิ </option>
                                            <option value="ชุมพร">ชุมพร </option>
                                            <option value="ชลบุรี">ชลบุรี </option>
                                            <option value="เชียงใหม่">เชียงใหม่ </option>
                                            <option value="เชียงราย">เชียงราย </option>
                                            <option value="ตรัง">ตรัง </option>
                                            <option value="ตราด">ตราด </option>
                                            <option value="ตาก">ตาก </option>
                                            <option value="นครนายก">นครนายก </option>
                                            <option value="นครปฐม">นครปฐม </option>
                                            <option value="นครพนม">นครพนม </option>
                                            <option value="นครราชสีมา">นครราชสีมา </option>
                                            <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                                            <option value="นครสวรรค์">นครสวรรค์ </option>
                                            <option value="นราธิวาส">นราธิวาส </option>
                                            <option value="น่าน">น่าน </option>
                                            <option value="นนทบุรี">นนทบุรี </option>
                                            <option value="บึงกาฬ">บึงกาฬ</option>
                                            <option value="บุรีรัมย์" selected>บุรีรัมย์</option>
                                            <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                                            <option value="ปทุมธานี">ปทุมธานี </option>
                                            <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                                            <option value="ปัตตานี">ปัตตานี </option>
                                            <option value="พะเยา">พะเยา </option>
                                            <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                                            <option value="พังงา">พังงา </option>
                                            <option value="พิจิตร">พิจิตร </option>
                                            <option value="พิษณุโลก">พิษณุโลก </option>
                                            <option value="เพชรบุรี">เพชรบุรี </option>
                                            <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                                            <option value="แพร่">แพร่ </option>
                                            <option value="พัทลุง">พัทลุง </option>
                                            <option value="ภูเก็ต">ภูเก็ต </option>
                                            <option value="มหาสารคาม">มหาสารคาม </option>
                                            <option value="มุกดาหาร">มุกดาหาร </option>
                                            <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                                            <option value="ยโสธร">ยโสธร </option>
                                            <option value="ยะลา">ยะลา </option>
                                            <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                                            <option value="ระนอง">ระนอง </option>
                                            <option value="ระยอง">ระยอง </option>
                                            <option value="ราชบุรี">ราชบุรี</option>
                                            <option value="ลพบุรี">ลพบุรี </option>
                                            <option value="ลำปาง">ลำปาง </option>
                                            <option value="ลำพูน">ลำพูน </option>
                                            <option value="เลย">เลย </option>
                                            <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                                            <option value="สกลนคร">สกลนคร</option>
                                            <option value="สงขลา">สงขลา </option>
                                            <option value="สมุทรสาคร">สมุทรสาคร </option>
                                            <option value="สมุทรปราการ">สมุทรปราการ </option>
                                            <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                                            <option value="สระแก้ว">สระแก้ว </option>
                                            <option value="สระบุรี">สระบุรี </option>
                                            <option value="สิงห์บุรี">สิงห์บุรี </option>
                                            <option value="สุโขทัย">สุโขทัย </option>
                                            <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                                            <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                                            <option value="สุรินทร์">สุรินทร์ </option>
                                            <option value="สตูล">สตูล </option>
                                            <option value="หนองคาย">หนองคาย </option>
                                            <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                                            <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                                            <option value="อุดรธานี">อุดรธานี </option>
                                            <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                                            <option value="อุทัยธานี">อุทัยธานี </option>
                                            <option value="อุบลราชธานี">อุบลราชธานี</option>
                                            <option value="อ่างทอง">อ่างทอง </option>
                                        </select>


                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>อำเภอ</label>
                                        <select name="Amphur">
                                            <option value="" >--------- เลือกอำเภอ ---------</option>
                                            <option value="แคนดง" selected>แคนดง</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="zipcode" value="31150" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label>ที่อยู่</label>
                                        <textarea name="address" rows="2" class="form-control required">บ้านเลขที่ 103/2 หมู่ 1</textarea>
                                    </div>

                                </div>
                            </div>



                            <!-------------------------------------------  ----------------------------------------------------------------->

                            <div class="row">
                                <div class="col-md-9 col-md-offset-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- /----- -->

        </div>


        <div class="col-md-6">
            <!-- ------ -->
            <div class="panel panel-default">

                <div class="panel-body">

                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />


                            <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                            <h4>ข้อมูลการทำงาน</h4>
                            <div class="col-md-12 col-sm-12">
                                <img width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" ALIGN=LEFT>
                            </div>

                            <div class="form-group">
                                <div class="sky-form">
                                    <div class="col-md-8">
                                        <label for="file" class="input input-file">
                                            <div class="button">
                                                <input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div>
                                            <input type="text" readonly>
                                        </label>
                                        <a href="#" class="btn btn-danger btn-xs nomargin"><i class="fa fa-times"></i> Remove Current Image</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>คณะ</label>
                                        <select name="facalty" class="form-control pointer required">
                                            <option value="2">วิทยาศาสตร์</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>หลักสูตร</label>
                                        <select name="program" class="form-control pointer required">
                                            <option value="2">วิทยาการคอมพิวเตอร์ (โครงการพิเศษ)</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>วิชาโท</label>
                                        <select name="master" class="form-control pointer required">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ระดับการศึกษา</label>
                                        <select name="level" class="form-control pointer required">
                                            <option value="2">ปริญญาตรี โครงการพิเศษ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>อ.ที่ปรึกษา</label>
                                        <input type="text" name="advisor" value="ผศ.ดร.พุธษดี ศิริแสงตระกูล" class="form-control required">
                                    </div>
                                </div>
                            </div>





                    </form>

                </div>

            </div>
            <!-- /----- -->

        </div>

    </div>

</div>