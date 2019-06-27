<!-- page title -->
<header id="page-header">
    <h1>เพิ่มโครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#"></a></li>
        <li class="active"></li>
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
                    <strong></strong>
                </div>

                <div class="panel-body">

                    <form class="validate1" action="/cs-e-office/web/portfolio/portfolio/edited" method="post"
                          data-success="Sent! Thank you!" data-toastr-position="top-right">

                        <fieldset>
                            <!-- required [php action request] -->

                            <?php /* @var $row \app\modules\portfolio\models\Project */ ?>

                            <input type="hidden" name="action" value="contact_send"/>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Project ID</label>
                                        <input type="text" name="owner_id"
                                               value="<?php
                                                   echo $row->project_id;

                                                ?>"class="form-control "><!--disabled-->
                                    </div>


                                </div>
                            </div>

                            <div class="row">


                                <div class="form-group">
                                    <!-- <div class="col-md-6 col-sm-6">
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
                                         <label>ภาษาที่แสดงผล</label>
                                         <select name="prefix" class="form-control pointer required">
                                             <option value="thai">ไทย</option>
                                             <option value="eng">อังกฤษ</option>


                                         </select>


                                     </div>-->

                                    <div class="col-md-6 col-sm-6">
                                        <label>ชื่อโครงการ(ไทย)</label>
                                        <input type="text" name="project_name_thai" value=" <?php
                                        echo $row->project_name_thai;

                                        ?>" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ชื่อโครงการ(อังกฤษ)</label>
                                        <input type="text" name="project_name_eng" value=" <?php
                                        echo $row->project_name_eng;

                                        ?>" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>ชื่อหัวหน้าโครงการ</label>
                                        <input type="text" name="project_led_fname"
                                               value=" <?php foreach ($row->projectMembers as $row4) {

                                                   if ($row4->project_role_id == 1) {
                                                       echo \app\modules\portfolio\models\Person::findOne($row4->member_id)->person_name;
                                                   }


                                               } ?>" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label></label>
                                        <input type="text" name="project_led_lname"
                                               value="<?php foreach ($row->projectMembers as $row4) {
                                                   if ($row4->project_role_id == 1) {
                                                       echo \app\modules\portfolio\models\Person::findOne($row4->member_id)->person_surname;
                                                   }


                                               } ?>" class="form-control required">
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label>สมาชิก</label>
                                </div>

                                <?php foreach ($row->projectMembers as $projectMember) { ?>
                                    <?php if ($projectMember->project_role_id !== 1) { ?>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="project_led_fname[]"
                                                   value="<?=
                                                   ($projectMember->member_name !== null) ?
                                                       $projectMember->member_name :
                                                       app\modules\portfolio\models\Person::findOne($projectMember->member_id)->person_name;
                                                    ?>"

                                                   class="form-control required">
                                             </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" name="project_led_lname[]"
                                                   value="<?=
                                                   ($projectMember->member_name !== null) ?
                                                       $projectMember->member_lname:
                                                       app\modules\portfolio\models\Person::findOne($projectMember->member_id)->person_surname;
                                                   ?>"
                                                   class="form-control required">
                                        </div>


                                    <?php } ?>

                                <?php } ?>
                               <br><br><br>
                            </div>


                            <!--<h4>ที่อยู่</h4>
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
                                            <option value="บุรีรัมย์">บุรีรัมย์</option>
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

                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>รหัสไปรษณีย์</label>
                                        <input type="text" name="zipcode" value="" class="form-control">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label>ที่อยู่</label>
                                        <textarea name="address" rows="2" class="form-control required"></textarea>
                                    </div>

                                </div>
                            </div>


                             }?>
                            <!-------------------------------------------  ----------------------------------------------------------------->

                            <div class="row">
                                <div class="col-md-9 col-md-offset-8">

                                    <input type="submit" name="send" value="เพิ่ม" id="submit" class="btn btn-default">

                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>

                        </fieldset>
                </div>
            </div>
            <!-- /----- -->

        </div>


        <div class="col-md-6">
            <!-- ------ -->
            <div class="panel panel-default">

                <div class="panel-body">


                    <fieldset>
                        <!-- required [php action request] -->
                        <input type="hidden" name="action" value="contact_send"/>


                        <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                        <h4>ข้อมูลโครงการ</h4>

                        <div class="row">
                            <div class="form-group">
                                <!--<div class="col-md-6 col-sm-6">
                                    <label>แหล่งทุน</label>
                                    <input type="text" name="MobilePhone" value="" class="form-control">
                                </div>-->
                                <div class="col-md-6 col-sm-6">
                                    <label>ปีที่เริ่ม</label>
                                    <input type="text" name="project_start"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_name;
                                           } ?>" class="form-control required">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>บีที่สิ้นสุด</label>
                                    <input type="text" name="project_end"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_name;

                                           } ?>" class="form-control required">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>ระยะเวลา</label>
                                    <input type="text" name="project_duration"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_name;

                                           } ?>" class="form-control required">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>งบประมาณ</label>
                                    <input type="text" name="project_budget"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_name;

                                           } ?>" class="form-control required">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>ผู้ใช้ทุน</label>
                                    <input type="text" name="repayment"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_name;

                                           } ?>" class="form-control required">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label>เว็บไซต์</label>
                                    <input type="text" name="project_url"
                                           value="<?php foreach ($row->projectMembers as $row4) {
                                               echo $row4->member_lname;

                                           } ?> "class=" form-control required">
                                </div>


                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">

                        </div>

                        <!--<div class="form-group">
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
                        </div>-->


                </div>
            </div>


            </form>

        </div>

    </div>
    <!-- /----- -->

</div>

</div>

</div>