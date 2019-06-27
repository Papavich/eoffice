<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use yii\timeago\TimeAgo;
use app\modules\personsystem\controllers;
use kartik\dialog\Dialog;
?>

<?php $form = ActiveForm::begin(); ?>
<div id="content" class="padding-20">
    <div class="panel-body">

        <div class="panel-body" style="background-color: #f1fbe5">
            <div class=" nomargin">
                <div class="col-md-6">
                    <div class="panel-body">


                        <h4>
                            <span style="color:#428bca;">ข้อมูลทั่วไป</span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>Person ID</b></label>
                                    <div class="line" name="person_id">
                                        <?= $modelStudent->STUDENTID; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เลขประจำตัวนักศึกษา</b></label>
                                    <div class="line" name="student_code">
                                        <?= $modelStudent->STUDENTCODE; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>คำนำ</b></label>
                                    <div class="line" name="prefix">
                                        <?= $modelStudent->PREFIXNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เลขประจำตัวประชาชน</b></label>
                                    <div class="line" name="card_id">
                                        <?= $modelStudent->CITIZENID; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชื่อ</b></label>
                                    <div class="line" name="person_name">
                                        <?= $modelStudent->STUDENTNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>นามสกุล</b></label>
                                    <div class="line" name="person_surname">
                                        <?= $modelStudent->STUDENTSURNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>Name (Eng)</b></label>
                                    <div class="line" name="person_name_eng">
                                        <?= $modelStudent->STUDENTNAMEENG; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>Surname (Eng)</b></label>

                                    <div class="line" name="person_surname_eng">
                                        <?= $modelStudent->STUDENTSURNAMEENG; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>วันเกิด</b></label>
                                    <div class="line" name="blood_type">
                                        <?= $modelStudent->BIRTHDATE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ศาสนา</b></label>
                                    <div class="line" name="religion">
                                        <?= $modelStudent->RELIGIONNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สัญชาติ</b></label>

                                    <div class="line" name="nationality">
                                        <?= $modelStudent->NATIONNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;">ข้อมูลติดต่อ</span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>หมายเลขโทรศัพท์</b></label>

                                    <div class="line" name="mobile_phone_register">
                                        <?= $modelStudent->STUDENTMOBILE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>Email</b></label>
                                    <div class="line" name="person_email_register">
                                        <?= $modelStudent->STUDENTEMAIL; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- บุคคลที่สามารถติดต่อได้ ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;">บุคคลที่สามารถติดต่อได้</span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชื่อ</label>
                                    <div class="line" name="person_contact_name">
                                        <?= $modelStudent->CONTACTPERSON; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เกี่ยวข้องเป็น</b></label>
                                    <div class="line" name="person_contact_relationship">
                                        <?= $modelStudent->CONTACTRELATION; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>หมายเลขโทรศัพท์</label>
                                    <div class="line" name="person_contact_mobile_register">
                                        <?= $modelStudent->CONTACTPHONENO; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="panel-body">
                        <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                        <h4>
                            <span style="color:#428bca;">ข้อมูลการศึกษา</span>
                        </h4>
                        <hr>
                        <div class="col-md-12 col-sm-12">
                            <?php if ($modelStudent->student_img != "<span style='color:red'>N/A</span>") { ?>
                                <img src="<?= Yii::getAlias( '@web' ) ?>/web_personal/upload/System/<?= $modelStudent->student_img ?>" width="200">
                            <?php } else { ?>
                                <img width="150" height="150" alt=""
                                     src="<?= Yii::getAlias( '@web' ) ?>/web_personal/upload/noavatar.jpg">
                            <?php } ?></div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <br><label><b>สถานภาพทางการศึกษา</b></label>
                                    <div class="line" name="student_status">
                                        <?= $modelStudent->STUDENTSTATUS; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <br><label><b>อาจารย์ที่ปรึกษา</b></label>
                                    <div class="line" name="advisor">
                                        <?= $modelStudent->OFFICERNAME . " " . $modelStudent->OFFICERSURNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>คณะ</b></label>
                                    <div class="line" name="facalty_name">
                                        <?= $modelStudent->FACULTYNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชั้นปี</b></label>
                                    <div class="line" name="level_name">
                                        <?= $modelStudent->LEVELNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ทุนการศึกษา</b></label>
                                    <div class="line" name="sc_name">
                                        <?php
                                        $data = \app\modules\scholar_b\models\ScbScholarshipType::find()
                                            ->where(['scholarship_id'=>$student->scholarship_id])->one();

                                        if($data) echo $data->scholarship_name ." ".$student->scholarship_year; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อาจารย์ที่ปรึกษาทุน</b></label>
                                    <div class="line" name="advisor_name">
                                        <?php if($teacher_detail)
                                            echo $teacher_detail->PREFIXABB.$teacher_detail->person_name." ".$teacher_detail->person_surname; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label><b>หลักสูตร</b></label>
                                    <div class="line" name="program_name">
                                        <?= $modelStudent->PROGRAMNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ปีที่เข้าศึกษา</b></label>
                                    <div class="line" name="admit_academic_year">
                                        <?= $modelStudent->ADMITACADYEAR; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เทอมที่เข้าศึกษา</b></label>
                                    <div class="line" name="admit_academic_semester">
                                        <?= $modelStudent->ADMITSEMESTER; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>Entry Degree</b></label>
                                    <div class="line" name="pre_certificate">
                                        <?= $modelStudent->ENTRYDEGREE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เกรดเฉลี่ยก่อนเข้ารับการศึกษา</b></label>
                                    <div class="line" name="pre_certificate_grade">
                                        <?= $modelStudent->ENTRYGPA; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>โรงเรียน</b></label>
                                    <div class="line" name="graduated_from">
                                        <?= $modelStudent->SCHOOLNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ผลการศึกษา ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;">ผลการศึกษา</span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>GPA</b></label>

                                    <div class="line" name="gpa">
                                        <?= $modelStudent->GPA; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ข้อมูลผู้ปกครอง ----------------------------------------------------------------->

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชื่อบิดา</b></label>
                                    <div class="line" >
                                        <div class="line" name="father_name" value="">
                                            <?= $modelStudent->STUDENTFATHERNAME ; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>วันเกิด</b></label>
                                    <div class="line" name="father_birthdate" value="">
                                        <?= $modelStudent->father_birthday ; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>วุฒิการศึกษาสูงสุด</b></label>
                                    <div class="line" name="father_highest_qualification" value="">
                                        <?= $modelStudent->father_highest_qualification ;?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อาชีพ</b></label>
                                    <div class="line" name="father_career" value="">
                                        <?= $modelStudent->father_career ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สถานที่ทำงาน</b></label>
                                    <div class="line" name="father_work_place" value="">
                                        <?= $modelStudent->father_work_place ;?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>รายได้ต่อเดือน</b></label>
                                    <div class="line" name="father_income_per_month" value="">
                                        <?= $modelStudent->father_income_per_month ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เบอร์โทรศัพท์</b></label>
                                    <div class="line" name="father_mobile_register" value="">
                                        <?= $modelStudent->father_mobile ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label><b>ที่อยู่</b></label>
                                    <div class="line" name="father_address" value="">
                                        <?= $modelStudent->father_address ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ตำบล</b></label>
                                    <div class="line" name="father_district" value="">
                                        <?php
                                        if(empty($Father_District->DISTRICT_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Father_District->DISTRICT_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อำเภอ</b></label>
                                    <div class="line" name="father_amphur" value="">
                                        <?php
                                        if(empty($Father_Amphur->AMPHUR_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Father_Amphur->AMPHUR_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>จังหวัด</b></label>
                                    <div class="line" name="father_province" value="">
                                        <?php
                                        if(empty($Father_Province->PROVINCE_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Father_Province->PROVINCE_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>รหัสไปรษณีย์</b></label>
                                    <div class="line" name="father_zipcode" value="">
                                        <?= $modelStudent->father_zipcode_id;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ศาสนา</b></label>
                                    <div class="line" name="father_religion" value="">
                                        <?php
                                        if(empty($Father_Religion->RELIGIONNAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Father_Religion->RELIGIONNAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สัญชาติ</b></label>
                                    <div class="line" name="father_nationality" value="">
                                        <?php
                                        if(empty($Father_Nation->NATIONNAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Father_Nation->NATIONNAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชื่อมารดา</b></label>
                                    <div class="line" >
                                        <div class="line" name="motherName" value="">
                                            <?= $modelStudent->STUDENTMOTHERNAME ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>วันเกิด</b></label>
                                    <div class="line" name="mother_birthdate" value="">
                                        <?= $modelStudent->mother_birthday ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>วุฒิการศึกษาสูงสุด</b></label>
                                    <div class="line" name="mother_highest_qualification" value="">
                                        <?= $modelStudent->mother_highest_qualification ;?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อาชีพ</b></label>
                                    <div class="line" name="mother_career" value="">
                                        <?= $modelStudent->mother_career ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สถานที่ทำงาน</b></label>
                                    <div class="line" name="mother_work_place" value="">
                                        <?= $modelStudent->mother_work_place ;?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>รายได้ต่อเดือน</b></label>
                                    <div class="line" name="mother_income_per_month" value="">
                                        <?= $modelStudent->mother_income_permonth ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เบอร์โทรศัพท์</b></label>
                                    <div class="line" name="mother_mobile_register" value="">
                                        <?= $modelStudent->mother_mobile ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label><b>ที่อยู่</b></label>

                                    <div class="line" name="mother_address" value="">
                                        <?= $modelStudent->mother_address ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ตำบล</b></label>
                                    <div class="line" name="mother_district" value="">
                                        <?php
                                        if(empty($Mother_District->DISTRICT_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Mother_District->DISTRICT_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อำเภอ</b></label>
                                    <div class="line" name="mother_amphur" value="">
                                        <?php
                                        if(empty($Mother_Amphur->AMPHUR_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Mother_Amphur->AMPHUR_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>จังหวัด</b></label>
                                    <div class="line" name="mother_province" value="">
                                        <?php
                                        if(empty($Mother_Province->PROVINCE_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Mother_Province->PROVINCE_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>รหัสไปรษณีย์</b></label>

                                    <div class="line" name="mother_zipcode" value="">
                                        <?=$modelStudent->mother_zipcode_id; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ศาสนา</b></label>
                                    <div class="line" name="mother_religion" value="">
                                        <?php
                                        if(empty($Mother_Religion->RELIGIONNAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Mother_Religion->RELIGIONNAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สัญชาติ</b></label>
                                    <div class="line" name="mother_nationality" value="">
                                        <?php
                                        if(empty($Mother_Nation->NATIONNAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Mother_Nation->NATIONNAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>สถานะสมรส</b></label>
                                    <div class="line" name="marital_status_parent" value="">
                                        <?= $modelStudent->marital_status_parents ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ชื่อผู้ปกครอง</label>
                                    <div class="line" >
                                        <div class="line" name="parent_name" value="">
                                            <?= $modelStudent->PARENTNAME ;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อาชีพ</b></label>

                                    <div class="line" name="parent_career" value="">
                                        <?= $modelStudent->parent_career ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เบอร์โทรศัพท์(สำนักทะเบียน)</b></label>
                                    <div class="line" name="parent_mobile_register" value="">
                                        <?= $modelStudent->PARENTPHONENO ;?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>เบอร์โทรศัพท์(ในระบบ)</b></label>
                                    <div class="line" name="parent_mobile" value="">
                                        <?= $modelStudent->parent_mobile ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label><b>ที่อยู่</b></label>
                                    <div class="line" name="parent_address" value="">
                                        <?= $modelStudent->parent_address ;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>อำเภอ</b></label>
                                    <div class="line" name="parent_amphur" value="">
                                        <?php
                                        if(empty($Parent_Amphur->AMPHUR_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Parent_Amphur->AMPHUR_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>จังหวัด</b></label>
                                    <div class="line" name="parent_province" value="">
                                        <?php
                                        if(empty($Parent_Province->PROVINCE_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Parent_Province->PROVINCE_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b>ตำบล</b></label>

                                    <div class="line" name="parent_country" value="">
                                        <?php
                                        if(empty($Parent_District->DISTRICT_NAME)){
                                            echo "<span style='color:red;'>N/A</span>";
                                        }else{
                                            echo $Parent_District->DISTRICT_NAME;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b>รหัสไปรษณีย์</b></label>

                                    <div class="line" name="parent_zipcode" value="">
                                        <?= $modelStudent->parent_zipcode_id;?>
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
<?php ActiveForm::end(); ?>