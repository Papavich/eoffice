<?php
Yii::setAlias('@myweb', '@web/web_scb');
Yii::getAlias('@myweb');
$this->registerCssFile('@myweb/css/custom.css');
?>
    <header id="page-header">
        <h1>สมัครทุนโครงการผู้มีความสามารถดีเด่น</h1>
        <ol class="breadcrumb">
            <li><a href="#">สมัครทุน</a></li>
            <li class="active">สมัครทุนโครงการผู้มีความสามารถดีเด่น</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <section>
                <div class="wizard" style="padding-bottom: 10px">
                    <div style="margin: 0 100px">
                        <header>
                            <br>
                            <center><img src="<?= Yii::$app->homeUrl ?>web_scb\images\LogoKKU3.png" width="80"
                                         height="142" border="1"></center>
                            <h4><strong>

                                    <center>
                                        แบบฟอร์มสมัครทุนโครงการส่งเสริมการผลิตบัณฑิตที่มีความสามารถพิเศษทางคอมพิวเตอร์และเทคโนโลยีสารสนเทศ
                                        <br>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ มหาวิทยาลัยขอนแก่น ปีการศึกษา
                                        2560
                                        <br>(โครงการผู้มีความสามารถดีเด่นด้านคอมพิวเตอร์และเทคโนโลยีสารสนเทศ)
                                    </center>
                                </strong></h4>
                        </header>

                        <div class="wizard-inner">
                            <!-- <div class="connecting-line"></div> -->
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                       title="ประวัติส่วนตัว">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                                    </a>
                                    <button href="#step1" data-toggle="tab" aria-controls="step1"
                                            class="cs-hidded"></button>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                       title="ประวัติบิดา-มารดา">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-home"></i>
                            </span>
                                    </a>
                                    <button href="#step2" data-toggle="tab" aria-controls="step2"
                                            class="cs-hidded"></button>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"
                                       title="ประวัติการศึกษา">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-education"></i>
                            </span>
                                    </a>
                                    <button href="#step3" data-toggle="tab" aria-controls="step3"
                                            class="cs-hidded"></button>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"
                                       title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                    </a>
                                    <button href="#step4" data-toggle="tab" aria-controls="step4"
                                            class="cs-hidded"></button>
                                </li>
                            </ul>

                        </div>


                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">

                                    <h4>ประวัติส่วนตัว</h4>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>เลขบัตรประจำตัวประชาชน *</label>
                                                <input type="text" class="form-control masked"
                                                       name="contact[SSN]"
                                                       value=""
                                                       class="form-control required"
                                                       data-format="9-9999-99999-99-9"
                                                       data-placeholder="X">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2 col-sm-2">
                                                <label>คำนำหน้า *</label>
                                                <select name="contact[prefix]"
                                                        class="form-control pointer required">
                                                    <option value="">--ระบุคำนำหน้า--</option>
                                                    <option value="Mr.">นาย</option>
                                                    <option value="Miss">นาง</option>
                                                    <option value="Mrs.">นางสาว</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>ชื่อจริง *</label>
                                                <input type="text" name="contact[first_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>นามสกุล *</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <label>หมู่โลหิต</label>
                                                <select name="contact[blo]"
                                                        class="form-control pointer required">
                                                    <option value="">-- เลือกหมู่โลหิต --</option>
                                                    <option value="a">A</option>
                                                    <option value="b">B</option>
                                                    <option value="ab">AB</option>
                                                    <option value="o">O</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2 col-sm-2">
                                                <label>เกิดวันที่</label>
                                                <input type="text" class="form-control datepicker"
                                                       data-format="dd-mm-yyyy"
                                                       data-lang="en" data-RTL="false"
                                                       placeholder="คลิกเลือกวันเกิด">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>เชื้อชาติ</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>สัญชาติ</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <label>ศาสนา</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>สถานที่เกิดอำเภอ</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>จังหวัด</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6">
                                                <label>ที่อยู่ปัจจุบัน (สามารถติดต่อได้ทางไปรษณีย์)</label>
                                                <input type="text" name="contact[school_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>ตำบล/แขวง</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>อำเภอ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3">
                                                <label>จังหวัด</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>รหัสไปรษณีย์</label>
                                                <input type="text" class="form-control masked"
                                                       name="contact[pcode]"
                                                       value="" class="form-control required"
                                                       data-format="99999"
                                                       data-placeholder="X">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>หมายเลขโทรศัพท์</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>หมายเลขโทรศัพท์มือถือ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li>
                                            <button type="button" name="show" onclick="nextpage(2)"
                                                    class="btn btn-success next-step">ถัดไป
                                            </button>
                                        </li>
                                    </ul>

                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h4>ประวัติบิดา-มารดา</h4>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>บิดาชื่อ *</label>
                                                <input type="text" name="contact[school_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>นามสกุล *</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>สถานะ</label><br>
                                                <label class="radio">
                                                    <input type="radio" name="radio-btn1" value="1">
                                                    <i></i> ยังมีชีวิต
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="radio-btn1" value="2">
                                                    <i></i> ถึงแก่กรรม
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>อาชีพ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>สถานที่ประกอบอาชีพ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>วุฒิการศึกษา</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>หมายเลขโทรศัพท์มือถือ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>มารดาชื่อ *</label>
                                                <input type="text" name="contact[school_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>นามสกุล *</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>สถานะ</label><br>
                                                <label class="radio">
                                                    <input type="radio" name="radio-btn2" value="1">
                                                    <i></i> ยังมีชีวิต
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="radio-btn2" value="2">
                                                    <i></i> ถึงแก่กรรม
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>อาชีพ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>สถานที่ประกอบอาชีพ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>วุฒิการศึกษา</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>หมายเลขโทรศัพท์มือถือ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3">
                                                <lable>บิดา-มารดา มีบุตรทั้งสิ้น(ที่ยังมีชีวิตอยู่)</lable>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <lable>เป็นชาย</lable>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <lable>เป็นหญิง</lable>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">

                                        <li>
                                            <button type="button" name="show" onclick="nextpage(3)"
                                                    class="btn btn-success next-step">ถัดไป
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h4>ประวัติการศึกษา</h4>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3">
                                                <label>เป็นนักศึกษาชั้นมัธยมปีที่ 6 โรงเรียน</label>
                                                <input type="text" name="contact[first_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>ถนน</label>
                                                <input type="text" name="contact[last_name]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>อำเภอ</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label>จังหวัด</label>
                                                <input type="text" name="contact[province]" value=""
                                                       class="form-control required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 รวมทุกวิชา
                                                    เท่ากับ</label>
                                                <input type="text" class="form-control masked"
                                                       name="contact[pcode]"
                                                       value="" class="form-control required"
                                                       data-format="9.99"
                                                       data-placeholder="X">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4 col-sm-4">
                                                <label>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5
                                                    เฉพาะวิชาคณิตศาสตร์
                                                    เท่ากับ</label>
                                                <input type="text" class="form-control masked"
                                                       name="contact[pcode]"
                                                       value="" class="form-control required"
                                                       data-format="9.99"
                                                       data-placeholder="X">
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">

                                        <li>
                                            <button type="button" name="show" onclick="nextpage(4)"
                                                    class="btn btn-success next-step">ถัดไป
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <h4>สมัครเรียบร้อย</h4>
                                    <a href="../student/index_other"
                                       class="text-center new-account">กลับสู่หน้าหลัก </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>

                    </div>
                </div>
            </section>
        </div>
    </div>


<?php
$this->registerJs(<<<JS
$(document).ready(function () {
        var max_fields = 100;
        var max_fields2 = 100;
        var x=1;
        var y=1;
        $("#boxvalue1").val(x);
        $("#boxvalue2").val(y);
        $("#addInput1").click(function (e) {
            e.preventDefault();
            if(x<max_fields) {
                x++;
                $("#gpaInput1").append("<div id='awardform'><br><div class='form-group'><input type='text' name='award_name"+x+"' class='form-control' placeholder='ชื่อผลงานที่ได้รับรางวัล' style='width: 250px;'></div> " + "" +
                    "<div class='form-group'><select style='width: 250px;' name='award_level"+x+"'><option value=''>เลือกระดับ</option><option value=''>ระดับประเทศ</option><option value=''>ระดับภาค</option><option value=''>ระดับจังหวัด</option>" +
                    "</select> </div> <div class='form-group'> <input type='text' name='award_date"+x+"' value='' class='form-control datepicker' data-format='yyyy-mm-dd' " +
                    "data-lang='en' data-RTL='false' placeholder='วันที่แข่งขัน' style='width: 250px;'></div><a class='btn btn-sm btn-danger' id='remove'><i class='fa fa-minus'>ลบ</i></a><br></div>");
            }
            });
        $(wrapper).on("click","#remove",function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
            $("#boxvalue1").val(x);
        });

        $("#addInput2").click(function (e) {
            e.preventDefault();
            if(x<max_fields2) {
                $("#gpaInput2").append("<div id='portform'><br><div class='form-group'><input type='text' name='port_name"+y+"' class='form-control' placeholder='ชื่อผลงานที่เข้าร่วมแข่งขัน' style='width: 250px;'></div> " +
                    "<div class='form-group'><select style='width: 250px;' name='port_level"+y+"'><option value=''>เลือกระดับ</option><option value=''>ระดับประเทศ</option><option value=''>ระดับภาค</option><option value=''>ระดับจังหวัด</option>" +
                    "</select> </div> <div class='form-group'> <input type='text' name='port_date"+y+"' value='' class='form-control datepicker' data-format='yyyy-mm-dd' " +
                    "data-lang='en' data-RTL='false' placeholder='วันที่แข่งขัน' style='width: 250px;'> </div><a class='btn btn-sm btn-danger' id='remove2'><i class='fa fa-minus'>ลบ</i></a><br></div>");
            }
        });
        $(wrapper).on("click","#remove2",function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            y--;
            $("#boxvalue2").val(x);
        });
    });
JS
);
?>