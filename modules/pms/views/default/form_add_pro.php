<?php
use yii\widgets\ActiveForm;
use app\modules\pms\models\PmsYearBudget;
use yii\helpers\ArrayHelper;
?>

    <!-- page title -->
    <header id="page-header">
        <h1><strong>แบบเสนอโครงการ</strong></h1>

    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">

        <div class="row">

            <div class="col-md-12">

                <!-- ------ -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['action'=> '../addpro/addyearbudget']); ?>
<!--                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data"-->
<!--                              data-success="Sent! Thank you!" data-toastr-position="top-right">-->
                            <fieldset>
                                <!-- required [php action request] -->
                                <input type="hidden" name="action" value="contact_send"/>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ชื่อโครงการย่อย</label>
                                            <input type="text" name="prosubName" value=""
                                                   class="form-control required " placeholder="กรอกใส่ชื่อโครงการ">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>รหัสโครงการย่อย</label>
                                            <input type="text" name="prosubCode" value=""
                                                   class="form-control required masked"
                                                   data-format="99-99-99-99-99-99" data-placeholder="X"
                                                   placeholder="กรอกใส่รหัสโครงการ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ภายใต้ชื่อโครงการหลัก</label>
                                            <select name="projectName" class="form-control pointer required">
                                                <option value="" disabled selected>--- เลือกชื่อโครงการหลัก ---
                                                </option>
                                                <option value="">ชื่อโครงการ</option>
                                                <option value="">ชื่อโครงการ</option>
                                                <option value="">ชื่อโครงการ</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>ประจำปีงบประมาณ</label>
                                            <?= $form->field($pro,
                                                'pms_year_budget_year_id')->dropDownList(ArrayHelper::map(PmsYearBudget::find()->all(),
                                                'year_id', 'year'), ['prompt' => '--เลือกปีประจำงบประมาณ--'])->label(false) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ลักษณะโครงการ</label>
                                            <select name="prosubType" class="form-control pointer required">
                                                <option disabled selected>--- เลือกลักษณะโครงการ ---</option>
                                                <option value="Routine">งานประจำ (Routine : R)</option>
                                                <option value="Strategy">งานเชิงกลยุทธ์ (Strategy : S)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>หน่วยงาน</label>
                                            <select name="prosubDeparment" class="form-control pointer required">
                                                <option disabled selected>--- เลือกสาขา ---</option>
                                                <option value="cs">cs</option>
                                                <option value="ict">ict</option>
                                                <option value="gis">gis</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ประเด็นยุทธศาสตร์</label>
                                            <select name="strategicIssues" class="form-control pointer required">
                                                <option disabled selected>--- เลือกประเด็นยุทธศาสตร์ ---</option>
                                                <option value="">เป็นองค์กรที่เป็นเลิศด้านการผลิตบัณฑิต</option>
                                                <option value="">xxxxx</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>กลยุทธ์</label>
                                            <select name="strategic" class="form-control pointer required">
                                                <option disabled selected>--- เลือกกลยุทธ์ ---</option>
                                                <option value="">พัฒนาศักยภาพนักศึกษาให้เป็นบัณทิตที่พึงประสงค์
                                                </option>
                                                <option value="">xxxxx</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ตอบสนองตามหลักธรรมาภิบาล (สามารถระบุได้มากกว่า 1 ข้อ)</label><br>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName1" value="1">
                                                    <i></i> การมีส่วนร่วม
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName2" value="2">
                                                    <i></i> ความโปร่งใส
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName3" value="3">
                                                    <i></i> การตอบสนอง
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName4" value="4">
                                                    <i></i> ภาระรับผิดชอบ
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName5" value="5">
                                                    <i></i> ประสิทธิผล
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName6" value="6">
                                                    <i></i> ประสิทธิภาพ
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName7" value="7">
                                                    <i></i> การกระจายอำนาจ
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName8" value="8">
                                                    <i></i> นิติธรรม
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-4">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName10" value="10">
                                                    <i></i> การมุ่งเน้นฉันทามติ
                                                </label>
                                            </div>
                                            <div class="col-md-3 col-sm-5">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="governanceName9" value="9">
                                                    <i></i> ความเสมอภาค/เที่ยงธรรม
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>หลักการและเหตุผล</label>
                                            <textarea name="prosubPrinciple" rows="4"
                                                      class="form-control required"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="purposeForm" class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>วัตถุประสงค์</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="purposeDetail1" value=""
                                                   class="form-control required"
                                                   placeholder="กรอกวัตถุประสงค์">
                                            <input type="hidden" id="purposeV" name="purposeV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addPurpose">
                                            <a class="btn btn-sm btn-3d btn-green">
                                                <i class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="indicatorForm">
                                        <div class="col-md-7 col-sm-7">
                                            <label>ตัวชี้วัด</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-3">
                                                <label>ค่าเป้าหมายของโครงการ</label>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                                <input type="text" name="indicator1" value=""
                                                       class="form-control required" placeholder="กรอกใส่ตัวชี้วัด">
                                                <input type="hidden" id="indicatorV" name="indicatorV" value="">
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <input type="text" name="goalValue1" value=""
                                                       class="form-control required" placeholder="กรอกค่าเป้าหมาย">
                                            </div>
                                            <div class="col-md-1 col-sm-1" id="addIndicator">
                                                <a class="btn btn-sm btn-3d btn-green"><i
                                                            class="fa fa-plus"></i>เพิ่มแถว</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>ระยะเวลาดำเนินการ</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="prosub_start"
                                               class="form-control datepicker required" data-format="dd-mm-yyyy"
                                               data-lang="en" data-RTL="false" placeholder="วัน-เดือน-ปี">
                                    </div>
                                    <div class="col-md-1">
                                        <center><label>ถึง</label></center>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="prosub_end"
                                               class="form-control datepicker required" data-format="dd-mm-yyyy"
                                               data-lang="en" data-RTL="false" placeholder="วัน-เดือน-ปี">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="placeForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>สถานที่</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="place1" value="" class="form-control required"
                                                   placeholder="กรอกชื่อสถานที่">
                                            <input type="hidden" id="placeV" name="placeV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addPlace">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row well">
                                    <div class="form-group ">
                                        <div class="col-md-12 col-sm-12">
                                            <label>การดำเนินการ (ให้ระบุโครงการ / กิจกรรม)</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>โครงการ / กิจกรรม</label>
                                            <input type="text" name="activity" value=""
                                                   class="form-control required" placeholder="กรอกชื่อกิจกรรม">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>ระยะเวลาดำเนินงาน</label>
                                            <input type="text" class="form-control rangepicker"
                                                   value="วัน-เดือน-ปี ถึง วัน-เดือน-ปี" data-format="dd-mm-yyyy"
                                                   data-from="01-01-2017" data-to="01-01-2018">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>งบประมาณ (บาท)</label>
                                            <input type="text" name="budget" value="" class="form-control required"
                                                   placeholder="กรอกจำนวนงบประมาณ">
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>กลุ่มเป้าหมาย</label>
                                            <input type="text" name="targetgroup" value=""
                                                   class="form-control required"
                                                   placeholder="กรอกชื่อกลุ่มเป้าหมาย">
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label>จำนวน (คน)</label>
                                            <input type="text" name="amount" value="" class="form-control required"
                                                   placeholder="กรอกจำนวนคน">
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <label>รูปแบบการดำเนินงาน (โดยสรุป)</label>
                                            <textarea name="operation" rows="4"
                                                      class="form-control required"></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <br>
                                            <a class="btn btn-green btn-lg btn-block"><i
                                                        class="fa fa-plus"></i>เพิ่มแถวการดำเนินการ</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label>งบประมาณ</label>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label class="radio">
                                                <input type="radio" name="radio-btn" value="1" checked="checked">
                                                <i></i> งบประมาณ (งบจากรัฐ)
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radio-btn" value="2" checked="checked">
                                                <i></i> งบประมาณ (งบรายได้)
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="radio-btn" value="3" checked="checked">
                                                <i></i> งบอื่นๆ (เช่น เงิน 1% ระดับคณะ เงินสนับสนุนจากหน่วยงานอื่น
                                                เงินบำรุงกีฬา เงินบำรุงสโมสร เป็นต้น)
                                            </label>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label>แหล่งงบประมาณ</label>
                                            <select name="selectproject" class="form-control pointer required">
                                                <option selected disabled>--- เลือกแหล่งงบประมาณ ---</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="costPlanForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>แจกแจงรายละเอียดค่าใช้จ่าย
                                                (สำหรับใช้ประกอบขออนุมัติจัดโครงการหรือขออนุมัติใช้เงิน)</label>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" name="costDetail1" value=""
                                                   class="form-control required" placeholder="กรอกชื่อรายการ">
                                            <input type="hidden" id="costV" name="costV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1">
                                            <center>เป็นเงิน</center>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" name="costPrice1" value=""
                                                   class="form-control required" placeholder="กรอกจำนวนเงิน">
                                        </div>
                                        <div class="col-md-1 col-sm-1">
                                            <center>บาท</center>
                                        </div>

                                        <div class="col-md-1 col-sm-1" id="addCost">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="resultExpectForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ผลที่คาดว่าจะได้รับ</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="resultExpect1" value=""
                                                   class="form-control required"
                                                   placeholder="กรอกผลที่คาดว่าจะได้รับ">
                                            <input type="hidden" id="resultExpectV" name="resultExpectV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addResultExpect">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="effectBeforeForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ผลกระทบหรือความเสี่ยงอาจจะเกิดขึ้นถ้าไม่ได้ดำเนินโครงการ</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="effectBDetail1" value=""
                                                   class="form-control required" placeholder="กรอกผลกระทบ">
                                            <input type="hidden" id="effectBeforeV" name="effectBeforeV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addEffectBefore">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="problemBeforeForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>ปัญหาอุปสรรคในรอบปีที่ผ่านมา</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="problemBDetail1" value=""
                                                   class="form-control required" placeholder="กรอกอุปสรรค">
                                            <input type="hidden" id="problemBeforeV" name="problemBeforeV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addProblemBefore">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group" id="suggestBeforeForm">
                                        <div class="col-md-12 col-sm-12">
                                            <label>แนวทางปรับปรุงการดำเนินงานในรอบปีที่ผ่านมา</label>
                                        </div>
                                        <div class="col-md-10 col-sm-10">
                                            <input type="text" name="suggestBDetail1" value=""
                                                   class="form-control required" placeholder="กรอกแนวทางปรับปรุง">
                                            <input type="hidden" id="suggestBeforeV" name="suggestBeforeV" value="">
                                        </div>
                                        <div class="col-md-1 col-sm-1" id="addSuggestBefore">
                                            <a class="btn btn-sm btn-3d btn-green"><i
                                                        class="fa fa-plus"></i>เพิ่มแถว</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ผู้รับผิดชอบระดับปฏิบัติ</label>
                                            <input type="text" name="p1" value="" class="form-control required"
                                                   placeholder="กรอกชื่อผู้รับผิดชอบระดับปฏิบัติ">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>ตำแหน่ง</label>
                                            <input type="text" name="p2" value="" class="form-control required"
                                                   placeholder="เจ้าหน้าที่บริหารงานทั่วไป">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="checkbox">
                                                <input type="checkbox" id="check" value="1"
                                                       required>
                                                <i></i> เพิ่มผู้ที่เกี่ยวข้อง
                                            </label>
                                        </div>
                                        <div id="relevant" style="display: none" class="col-md-6 col-sm-6">
                                            <label>ผู้ที่เกี่ยวข้อง</label>
                                            <input type="text" name="prosubRelevantPerson" value=""
                                                   class="form-control required"
                                                   placeholder="กรอกชื่อผู้ที่เกี่ยวข้อง">
                                        </div>
                                        <div id="position" style="display: none" class="col-md-6 col-sm-6">
                                            <label>ตำแหน่ง</label>
                                            <select name="position2" class="form-control pointer required">
                                                <option value="" disabled selected>--- เลือกตำแหน่ง ---
                                                </option>
                                                <option value="">ชื่อโครงการ</option>
                                                <option value="">ชื่อโครงการ</option>
                                                <option value="">ชื่อโครงการ</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <label>ผู้รับผิดชอบระดับนโยบาย/บริหาร</label>
                                            <input type="text" name="p3" value="" class="form-control required"
                                                   placeholder="กรอกชื่อผู้รับผิดชอบระดับนโยบาย/บริหาร">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>ตำแหน่ง</label>
                                            <input type="text" name="p4" value="" class="form-control required"
                                                   placeholder="หัวหน้าภาค">
                                        </div>

                                    </div>
                                </div>


                            </fieldset>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-3d btn-green btn-xlg btn-block margin-top-30">
                                        <strong>บันทึกโครงการ</strong>
                                    </button>
                                </div>
                            </div>

<!--                        </form>-->
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
                <!-- /----- -->

            </div>


        </div>

    </div>

<!-- /MIDDLE -->



