<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->registerCssFile('@web/web_scb/css/stepbyscb.css');
$this->registerJsFile('@web/web_scb/js/step_scb.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
?>
    <!-- page title -->
    <header id="page-header">
        <h1>สมัครทุนโครงการช้างเผือก</h1>
        <ol class="breadcrumb">
            <li><a href="../login/login-success">หน้าหลัก</a></li>
            <li class="active">สมัครทุนโครงการช้างเผือก</li>
        </ol>
    </header>
    <!-- /page title -->

    <div id="content" class="padding-5">
        <div class="row">
            <div class="panel-body">
                <div class="container">
                    <section>
                        <div class="wizard">
                            <div style="margin: 0 30px">
                                <header>
                                    <br>
                                    <center><img src="<?= Yii::$app->homeUrl ?>web_scb\images\LogoKKU3.png"
                                                 width="80"
                                                 height="142" border="1"></center>
                                    <h4><strong>

                                            <center>
                                                แบบฟอร์มสมัครสอบคัดเลือกเข้าเป็นนักศึกษา ปีการศึกษา 2560
                                                <br>ภาควิชาการวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น
                                                <br>โครงการส่งเสริมการผลิตบัณฑิตที่มีความสามารถพิเศษทางวิทยาการคอมพิวเตอร์
                                                (โครงการช้างเผือก)
                                            </center>
                                        </strong></h4>
                                </header>

                                <div class="stepwizard col-md-offset-3">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step">
                                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                            <p>ประวัติการศึกษา</p>
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle"
                                               disabled="disabled">2</a>
                                            <p>เลือกสาขาและอัพโหลดเอกสาร</p>
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-3" type="button" class="btn btn-default btn-circle"
                                               disabled="disabled">3</a>
                                            <p>บันทึกข้อมูล</p>
                                        </div>
                                    </div>
                                </div>

                                <?php $form = ActiveForm::begin([
                                    'action' => '../scholarship/register1',
                                    'method' => 'post']); ?>

                                <form role="form" action="" method="post">
                                    <!-- Step1 -->
                                    <div class="row setup-content" id="step-1">
                                        <h4>ประวัติการศึกษา</h4>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_math4')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_math5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_math4to5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_chem4')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_chem5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_physic4')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_physic5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpa_sum_chem_physic_math_4to5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <?= $form->field($model_scb, 'gpax_4to5')->textInput()->widget(MaskedInput::className(), [
                                                        'mask' => '9.99',
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div align="right">
                                            <button class="btn btn-default nextBtn btn-lg" type="button" id="createReport">ถัดไป</button>
                                        </div>
                                    </div>


                                    <!-- End Step1 -->
                                    <!-- Step2 -->
                                    <div class="row setup-content" id="step-2">
                                        <h4>เลือกสาขาและอัพโหลดเอกสาร</h4>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4 col-sm-4">
                                                    <label>เลือกสาขาวิชาที่ต้องการสมัครรับทุนการศึกษา</label>
                                                    <select class="form-control">
                                                        <?php $ScbBranch = \app\modules\scholar_b\models\ScbBranch::find()->all();
                                                        foreach ($ScbBranch as $item) {
                                                            echo '<option>' . $item['branch_name'] . '</option>';
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>อัพโหลดรูปถ่าย 1 นิ้ว</label>
                                                    <!-- custom file upload -->
                                                    <div class="fancy-file-upload fancy-file-success">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control"
                                                               name="contact[attachment]"
                                                               onchange="jQuery(this).next('input').val(this.value)"
                                                        />
                                                        <input type="text" class="form-control"
                                                               placeholder="no file selected" readonly=""/>
                                                        <span class="button">เลือกไฟล์ </span>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>อัพโหลดหลักฐาน โดยเป็นไฟล์ ZIP<br>1.ใบสมัครสอบ<br>2.สำเนา
                                                        รบ.1-ป (รับรองสำเนา)<br>3.สำเนาแสดงผลการเรียน
                                                        ชั้นมัธยมศึกษาปีที่ 4-5 (ปพ.1) (รับรองสำเนา)<br>4.สำเนาทะเบียนบ้านของนักเรียน
                                                        (รับรองสำเนา)<br>5.สำเนาทะเบียนบ้านของบิดามารดา / ผู้ปกครอง
                                                        (รับรองสำเนา)</label>
                                                    <div class="fancy-file-upload fancy-file-success">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control"
                                                               name="contact[attachment]"
                                                               onchange="jQuery(this).next('input').val(this.value)"
                                                        />
                                                        <input type="text" class="form-control"
                                                               placeholder="no file selected" readonly=""/>
                                                        <span class="button">เลือกไฟล์ </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div align="right">
                                            <button class="btn btn-default nextBtn btn-lg" type="button" id="createReport">ถัดไป</button>
                                        </div>
                                    </div>
                                    <div class="row setup-content" id="step-3">
                                        <center><h4>สมัครทุนเรียบร้อย</h4></center>
                                        <div class="form-group" align="center">
                                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                        </div>
                                        <a href="../login/login-success"
                                           class="text-center new-account">กลับสู่หน้าหลัก </a>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </section>
                </div>
            </div>
        </div>
    </div>


<?php

$this->registerJs(<<<JS

        $("#createReport").click(function(){
               var mobile =  $('#mobile').val();
          console.log(mobile);
        });

JS
);
?>