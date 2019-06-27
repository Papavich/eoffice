<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbCandidate */
/* @var $form yii\widgets\ActiveForm */

$this->title = Html::encode($this->title) . 'สมัครสมาชิก';

$this->registerCssFile('@web/web_scb/css/stepbystep.css');
$this->registerCssFile('@web/web_scb/css/custom.css');
$this->registerJsFile('@web/web_scb/js/stepbystep.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_scb/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
?>

<div id="content" class="padding-20">
    <div class="row">
        <div class="panel-body">
            <section>
                <div class="wizard" style="padding-bottom: 10px">
                    <div style="margin: 0 50px">
                        <headerioh>
                            <br>
                            <center><img src="<?= Yii::$app->homeUrl ?>web_scb\images\LogoKKU3.png" width="80"
                                         height="142" border="1"></center>
                            <h4><strong>
                                    <center>แบบฟอร์มสมัครสมาชิกสำหรับนักเรียน</center>
                                </strong></h4>
                        </headerioh>

                        <div class="stepwizard col-md-offset-3">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                    <button href="#step-1" aria-controls="step-1"
                                            class="cs-hidded"></button>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2" type="button" class="btn btn-default btn-circle"
                                       disabled="disabled">2</a>
                                    <button href="#step-2" aria-controls="step-2"
                                            class="cs-hidded"></button>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-3" type="button" class="btn btn-default btn-circle"
                                       disabled="disabled">3</a>
                                    <button href="#step-3" aria-controls="step-3"
                                            class="cs-hidded"></button>
                                </div>
                            </div>
                        </div>

                        <?php $form = ActiveForm::begin([
                            'action' => '../candidate/create',
                            'method' => 'post',
                            'enableAjaxValidation' => true, //เปิดการ validate ด้วย AJAX
                            'enableClientValidation' => false, // validate ฝั่ง client เมื่อ submit หรือ เปลี่ยนค่า
                            'validateOnChange' => true,// validateเมื่ อมีการเปลี่ยนค่า
                            'validateOnSubmit' => true,// validate เมื่อ submit ข้อมูล
                            'validateOnBlur' => false,// validate เมื่อเปลี่ยนตำแหน่ง cursor ไป input อื่น
                            'options' => [
                                'enctype' => 'multipart/form-data'
                            ]]); ?>

                        <div class="row setup-content" id="step-1">
                            <!-- ************************************ STEP 1 ******************************************* -->
                            <h4>ประวัติส่วนตัว</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">เลขบัตรประจำตัวประชาชน *</label>
                                        <?= $form->field($model_candidate, 'id_card')->textInput()->label(false)->widget(MaskedInput::className(), [
                                            'mask' => '9-9999-99999-99-9',
                                        ]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model_candidate, 'password')->passwordInput(['name' => 'password',
                                            'maxlength' => 32]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model_candidate, 'password')->passwordInput(['name' => 'confirmpassword',
                                            'maxlength' => 32]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'prefix')->dropDownList(['null' => '--',
                                            'นาย' => 'นาย',
                                            'นาง' => 'นาง',
                                            'นางสาว' => 'นางสาว']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <?php echo $form->field($model_candidate, 'firstname')->textInput(['maxlength' => 30]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <?php echo $form->field($model_candidate, 'lastname')->textInput(['maxlength' => 30]) ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'blood_type')->dropDownList(['null' => '---',
                                            'A' => 'A',
                                            'B' => 'B',
                                            'AB' => 'AB',
                                            'O' => 'O']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-2 col-sm-4">
                                        <?= $form->field($model_candidate, 'birth_date')->widget(DatePicker::classname(), [
                                            'language' => 'th',
                                            'dateFormat' => 'yyyy-MM-dd',
                                            'clientOptions' => [
                                                'changeMonth' => true,
                                                'changeYear' => true,
                                            ],
                                            'options' => ['class' => 'form-control']
                                        ]) ?>
                                    </div>

                                    <div class="col-md-3 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'origin')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-md-3 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'nationality')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-md-2 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'religion')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-md-3 col-sm-2">
                                        <?php echo $form->field($model_candidate, 'place_of_birth')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <?php echo $form->field($model_candidate, 'email')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?php echo $form->field($model_candidate, 'mobile')->textInput()->widget(MaskedInput::className(), [
                                            'mask' => '999-9999999',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model_candidate, 'schoolname')->textInput(['maxlength' => true]) ?>
                                    </div>

                                    <div class="col-md-4 col-sm-4">
                                        <?php echo $form->field($model_candidate, 'school_status')->dropDownList(['null' => '---',
                                            'รัฐบาล' => 'รัฐบาล',
                                            'เอกชน' => 'เอกชน']); ?>
                                    </div>
                                </div>
                            </div>

                            <div align="right">
                                <button class="btn btn-default nextBtn pull-right" type="button">ถัดไป</button>
                            </div>
                        </div>
                        <!-- *************************** END 1 ****************************************** -->

                        <!-- *************************** STEP 2 ****************************************** -->
                        <div class="row setup-content" id="step-2">
                            <h4>ภูมิลำเนา</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">บ้านเลขที่</label>
                                        <?php echo $form->field($model_address, 'address_type')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">ตำบล/แขวง</label>
                                        <?php echo $form->field($model_address, 'tumbon')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">อำเภอ</label>
                                        <?php echo $form->field($model_address, 'amphor')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">จังหวัด</label>
                                        <?php echo $form->field($model_address, 'province')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">รหัสไปรษณีย์</label>
                                        <?php echo $form->field($model_address, 'zipcode')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div style="display: inline;float: right ">
                                <button class="btn btn-default prevBtn" type="button">ย้อนกลับ</button>
                                <button class="btn btn-default nextBtn" type="button">ถัดไป</button>
                            </div>
                        </div>
                        <!-- *************************** END 2 ****************************************** -->
                        <!-- *************************** STEP 3 ****************************************** -->
                        <div class="row setup-content" id="step-3">
                            <h4>ประวัติครอบครัว</h4>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <?php echo $form->field($model_candidate, 'total_brethren')->textInput(['min' => '0',
                                            'max' => 100,
                                            'class' => 'form-control stepper']) ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo $form->field($model_candidate, 'number_of_sister')->textInput(['min' => '0',
                                            'max' => 100,
                                            'class' => 'form-control stepper']) ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo $form->field($model_candidate, 'number_of_brother')->textInput(['min' => '0',
                                            'max' => 100,
                                            'class' => 'form-control stepper']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">เลขบัตรประจำตัวประชาชนบิดา *</label>
                                        <?= $form->field($models['model1'], '[model1]id_card_parent')->textInput()->widget(MaskedInput::className(), [
                                            'mask' => '9-9999-99999-99-9',
                                        ]) ?>
                                    </div>

                                    <div class="col-md-3 col-sm-2">
                                        <label class="control-label col-sm-9">คำนำหน้า</label>
                                        <?php echo $form->field($models['model1'], '[model1]parent_type')->dropDownList(['null' => '----------',
                                            'นาย' => 'นาย',
                                            'นาง' => 'นาง',
                                            'นางสาว' => 'นางสาว']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">บิดาชื่อ</label>
                                        <?= $form->field($models['model1'], '[model1]firstname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">นามสกุล</label>
                                        <?= $form->field($models['model1'], '[model1]lastname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="status_father">
                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label col-sm-10">สถานะ</label><br>
                                            <?php echo $form->field($models['model1'], '[model1]status')->radioList([
                                                1 => 'ยังมีชีวิต',
                                                2 => 'เสียชีวิต',
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">อาชีพ</label>
                                        <?= $form->field($models['model1'], '[model1]occupation')->textInput(['maxlength' => 30]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">สถานที่ประกอบอาชีพ</label>
                                        <input type="text" name="contact[province]" value=""
                                               class="form-control required">
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">เบอร์โทรศัพท์</label>
                                        <?= $form->field($models['model1'], '[model1]mobile')->textInput()->widget(MaskedInput::className(), [
                                            'mask' => '999-9999999',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">เลขบัตรประจำตัวประชาชนมารดา *</label>
                                        <?= $form->field($models['model2'], '[model2]id_card_parent')->textInput()->widget(MaskedInput::className(), [
                                            'mask' => '9-9999-99999-99-9',
                                        ]) ?>

                                    </div>

                                    <div class="col-md-3 col-sm-2">
                                        <label class="control-label col-sm-9">คำนำหน้า</label>
                                        <?php echo $form->field($models['model2'], '[model2]parent_type')->dropDownList(['null' => '----------',
                                            'นาย' => 'นาย',
                                            'นาง' => 'นาง',
                                            'นางสาว' => 'นางสาว']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">มารดาชื่อ</label>
                                        <?= $form->field($models['model2'], '[model2]firstname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">นามสกุล</label>
                                        <?= $form->field($models['model2'], '[model2]lastname')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="status_mother">
                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label col-sm-10">สถานะ</label><br>
                                            <?php echo $form->field($models['model2'], '[model2]status')->radioList([
                                                1 => 'ยังมีชีวิต',
                                                2 => 'เสียชีวิต',
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">อาชีพ</label>
                                        <?= $form->field($models['model2'], '[model2]occupation')->textInput(['maxlength' => 30]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">สถานที่ประกอบอาชีพ</label>
                                        <input type="text" name="contact[province]" value=""
                                               class="form-control required">
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label col-sm-10">เบอร์โทรศัพท์</label>
                                        <?= $form->field($models['model2'], '[model2]mobile')->textInput()->widget(MaskedInput::className(), [
                                            'mask' => '999-9999999',
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div style="display: inline;float: right ">
                                <button class="btn btn-default prevBtn" type="button">ย้อนกลับ</button>
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>
            </section>
        </div>
    </div>
</div>

