<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Profile;
/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var app\models\Profile $profile
 */
?>

<!-- page title -->
<header id="page-header">
    <h1>ข้อมูลส่วนบุคคล</h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Edit Infomation</li>
    </ol>
    <br>
    <ol class="breadcrumb">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </ol>
</header>
<!-- /page title -->

<div id="content" class="padding-20">

    <div class="row">

        <div class="">
            <div class="">

                <!-- tabs -->
                <ul class="nav nav-tabs" style="margin-left: 14px;">
                    <li class="active">
                        <a href="#tab1_nobg" data-toggle="tab">
                            <i class="fa fa-pencil-square-o"></i> ข้อมูลส่วนบุคคล
                        </a>
                    </li>
                    <li class="">
                        <a href="#tab2_nobg" data-toggle="tab">
                            <i class="fa fa-cogs"></i> เปลี่ยนรหัสผ่าน
                        </a>
                    </li>
                </ul>

                <!-- tabs content -->
                <div class="tab-content transparent">
                    <div id="tab1_nobg" class="tab-pane active">
                        <!------------------------------------------- แถบระบบข้อมูลบุคคล ----------------------------------------------------------------->
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <!------------------------------------------- Student form ----------------------------------------------------------------->
                                <div class="panel-body">
                    <br>
                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />
                            <div class="alert alert-info">
                                <h4>ข้อมูลเจ้าหน้าที่</h4></div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Person ID</label>
                                        <input type="text" name="person_id" value="503020749" class="form-control " disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>รหัสบัตรประชาชน</label>
                                        <input type="text" name="card_id" value="1-4999-00233-84-5" class="form-control required"disabled>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>คำนำหน้า</label>
                                        <select name="prefix" class="form-control pointer required"disabled>
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
                                        <label>เพศ</label>
                                        <select name="sex" class="form-control pointer required"disabled>
                                            <option value="1">ชาย</option>
                                            <option value="2">หญิง</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>ชื่อ</label>
                                        <input type="text" name="person_name" value="สุธน" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>นามสกุล</label>
                                        <input type="text" name="person_surname" value="เจริญศิริ" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>ชื่อ(ภาษาอังกฤษ)</label>
                                        <input type="text" name="person_name_eng" value="Suton" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>นามสกุล(ภาษาอังกฤษ)</label>
                                        <input type="text" name="person_surname_eng" value="Charoensiri" class="form-control required"disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>วันเกิด</label>
                                        <input type="text" name="birthdate" value="26-06-1983" class="form-control datepicker required" data-format="dd-mm-yyyy" value="04-07-1980" data-lang="en" data-RTL="false"disabled>
                                        <!--			 <input type="text" class="form-control masked" data-format="99/99/9999" data-placeholder="_" placeholder="DD/MM/YYYY" value="04/07/1996"> -->
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ส่วนสูง</label>
                                        <input type="number" value="160" name="hight" min="100" max="200" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>น้ำหนัก</label>
                                        <input type="number" value="40" name="weight" min="10" max="300" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สถานภาพการสมรส</label>
                                        <select name="marital_status" class="form-control pointer required"disabled>
                                            <option value="1">โสด</option>
                                            <option value="2">แต่งงานแล้ว</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>หมู่เลือด</label>
                                        <select name="prefix" class="form-control pointer required"disabled>
                                            <option value="1">O</option>
                                            <option value="2">A</option>
                                            <option value="3">B</option>
                                            <option value="4">AB</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>โรคประจำตัว</label>
                                        <input type="text" name="health_problem" value="หอบหืด" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>ศาสนา</label>
                                        <input type="text" name="religion" value="พุทธ" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สัญชาติ</label>
                                        <input type="text" name="nationality" value="ไทย" class="form-control required"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>เชื้อชาติ</label>
                                        <input type="text" name="race" value="ไทย" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->

                            <br>
                            <div class="alert alert-info">
                                <h4>ข้อมูลติดต่อ</h4></div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>เบอร์โทรศัพท์มือถือ</label>
                                        <input type="text" name="mobile_phone" value="0959957515" class="form-control"disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>เบอร์โทรศัพท์</label>
                                        <input type="text" name="office_phone" value="0-4336-2188-90 ต่อ 209" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>เบอร์โทรสาร</label>
                                        <input type="text" name="fax_number" value="0-4334-2910" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>อีเมล</label>
                                        <input type="email" name="person_email" value="suton@gmail.com" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>Line ID</label>
                                        <input type="text" name="line_id" value="suton" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>Facebook</label>
                                        <input type="text" name="facebook_name" value="Suton Charoensiri" class="form-control required">
                                    </div>

                                </div>
                            </div>

                            <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                            <br>
                            <div class="alert alert-info">
                                <h4>ที่อยู่</h4></div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>ที่อยู่ (ตามทะเบียนบ้าน)</label>
                                        <textarea name="address" rows="2" class="form-control required" disabled>บ้านเลขที่ 103/2 หมู่ 1 ต.ในเมือง</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>อำเภอ</label><br>
                                        <select name="amphur" class="form-control pointer required" disabled>
                                            <option value="" >--------- เลือกอำเภอ ---------</option>
                                            <option value="แคนดง" selected>แคนดง</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>จังหวัด</label><br>
                                        <select name="province" class="form-control pointer required" disabled>
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

                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="zipcode" value="31150" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>ประเทศ</label><br>
                                        <select name="country" class="form-control pointer required" disabled>
                                            <option value="" >--------- เลือกประเทศ ---------</option>
                                            <option value="" selected>ไทย</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>ที่อยู่ (ปัจจุบัน)</label>
                                        <textarea name="current_address" rows="2" class="form-control required">บ้านเลขที่ 103/2 หมู่ 1 ต.ในเมือง</textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>อำเภอ</label><br>
                                        <select name="current_amphur">
                                            <option value="" >--------- เลือกอำเภอ ---------</option>
                                            <option value="แคนดง" selected>แคนดง</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>จังหวัด</label><br>
                                        <select name="current_province">
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

                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="current_zipcode" value="31150" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>ประเทศ</label><br>
                                        <select name="current_country">
                                            <option value="" >--------- เลือกประเทศ ---------</option>
                                            <option value="" selected>ไทย</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <!-------------------------------------------  ----------------------------------------------------------------->

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
                    <br>
                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />


                            <!------------------------------------------- ประวัติการศึกษา ----------------------------------------------------------------->
                            <div class="alert alert-info">
                                <h4>ประวัติการศึกษา</h4></div>
                            <div class="col-md-12 col-sm-12">
                                <img width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/System/Suton.jpg" height="34" ALIGN=LEFT>
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
                                    <div class="col-md-12 col-sm-12"><br>
                                        <button type="button" id="add_more" class="btn btn-success">
                                            <span class="fa fa-plus-circle" style="font-size: 22px"></span> เพิ่มวุฒิการศึกษา</button><br><br>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>วุฒิการศึกษา</label>
                                        <input type="text" name="educational_background" value="ปริญญาเอก เทคโนโลยีสารสนเทศ" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>วุฒิการศึกษา(ภาษาอังกฤษ)</label>
                                        <input type="text" name="educational_background_eng" value="Ph.D. (Information Technology)" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สถาบันการศึกษา</label>
                                        <input type="text" name="educational_institution" value="สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง" class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สถาบันการศึกษา(ภาษาอังกฤษ)</label>
                                        <input type="text" name="educational_institution_eng" value="King Mongkut’s Institute of Technology Ladkrabang, Thailand" class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>ปีที่จบ</label>
                                        <select name="graduate_year">
                                            <option value="1"></option>
                                            <option value="2" selected>2554</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>วุฒิการศึกษา</label>
                                        <input type="text" name="educational_background" value="วิทยาศาสตรมหาบัณฑิต วิทยาการคอมพิวเตอร์" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>วุฒิการศึกษา(ภาษาอังกฤษ)</label>
                                        <input type="text" name="educational_background_eng" value="M.Sc. (Computer Science)" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สถาบันการศึกษา</label>
                                        <input type="text" name="educational_institution" value="มหาวิทยาลัยขอนแก่น" class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>สถาบันการศึกษา(ภาษาอังกฤษ)</label>
                                        <input type="text" name="educational_institution_eng" value="Khon Kaen University, Thailand" class="form-control">

                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>ปีที่จบ</label>
                                        <select name="graduate_year">
                                            <option value="1"></option>
                                            <option value="2" selected>2548</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <br><h4>ภาระหน้าที่</h4><hr>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                                     <textarea name="research_name" rows="3" class="form-control required">
- ระบบ Cloud Computing
- ระบบ Server ภาควิชาฯ
- ระบบเครือข่าย Network ภาควิชาฯ
- ระบบ RFID
                                                        </textarea>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <br><label>ตำแหน่ง</label>
                                        <input type="text" name="staff_position" value="นักวิชาการคอมพิวเตอร์" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>


                        </fieldset>

                    </form>

                </div>

            </div>
            <!-- /----- -->

        </div>

    </div>
    <div id="tab2_nobg" class="tab-pane">

        <!------------------------------------------- แถบระบบสำนักทะเบียน ----------------------------------------------------------------->

        <div class="col-md-6">
            <div class="panel panel-default">


                <!------------------------------------------- Student form ----------------------------------------------------------------->

                <div class="panel-body">

                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>

                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />
                            <h4>เปลี่ยนรหัสผ่าน</h4><hr>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>อีเมล</label>
                                        <input type="text" name="person_id" value="suton@kkumail.com" class="form-control " disabled>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label>รหัสใหม่</label>
                                        <input type="text" name="student_code" value="" class="form-control" >
                                    </div>
                                    <div class="col-md-6 col-sm-6"><br>
                                        <label>รหัสผ่านเดิม</label>
                                        <input type="text" name="student_code" value="" class="form-control" >
                                    </div>

                                </div>
                            </div>

                          </fieldset></form></div></div></div></div>

</div>