<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Year;
use app\modules\eoffice_ta\models\Term;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaSchedule */
/* @var $form yii\widgets\ActiveForm */
?>


    <div id="content" class="padding-10">
        <div class="ta-schedule-form">
            <div class="row">
                <?php $form = ActiveForm::begin(); ?>

                <div class="col-lg-6">
                    <?= $form->field($model, 'ta_schedule_title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'ta_schedule_url')->dropDownList([
                            '/cs-e-office/web/eoffice_ta/teacher/request-ta'=>'หน้าร้องขอผู้ช่วยสอน',
                        '/cs-e-office/web/eoffice_ta/ta-register/index'=>'หน้าสมัครผู้ช่วยสอน',
                        '/cs-e-office/web/eoffice_ta/teacher/choose-ta'=>'หน้าคัดเลือกผู้ช่วยสอน',
                        '/cs-e-office/web/eoffice_ta/ta-working/index'=>'บันทึกการปฏิบัติงาน',
                        '/cs-e-office/web/eoffice_ta/teacher/check-working-ta'=>'ตรวจสอบการบันทึกการปฏิบัติงานของผู้ช่วยสอน',
                    ], ['prompt' => '-- เลือกหน้าเว็บของกิจกรรม --']) ?>
                    <div class="row">
                        <div class="col-lg-6">
                    <?= $form->field($model, 'term')->dropdownList(
                        ArrayHelper::map(Term::find()->all(),
                            'term_id',
                            'term_id'),
                            [1,2,3], ['prompt' => '-- ภาคเรียน --']) ?>
                        </div>
                        <div class="col-lg-6">
                    <?=  $form->field($model, 'year')->dropdownList(
                            ArrayHelper::map(Year::find()->all(),
                            'year_id',
                            'year_id'),
                            [
                            'id'=>'ddl-document',
                            'prompt'=>'เลือกปีการศึกษา'
                            ]); ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'ta_schedule_type')->dropDownList([
                            'REQ' => 'ร้องขอผู้ช่วยสอน',
                        //'WLOAD-TA' => 'กำหนดภาระงาน',
                        'REGIS' => 'สมัครผู้ช่วยสอน',
                        'CHO-TA' => 'คัดเลือกผู้ช่วยสอน',
                        //'CONFIRM-REQ' => 'อนุมัติการร้องขอผู้ช่วยสอน',
                        //'CONFIRM-TA' => 'CONFIRM-TA',
                        'WORKING-TA' => 'บันทึกการปฏิบัติงาน',
                        'CHECK-HR' => 'ตรวจสอบชั่วโมงปฏิบัติงานของผู้ช่วยสอน(อาจารย์)',
                        'ASSESS-TA' => 'ประเมินผู้ช่วยสอน',
                        'PAYMENT-TA' => 'ค่าตอบแทนผู้ช่วยสอน',
                        'OTHER' => 'อื่นๆ',
                        ], ['prompt' => '-- เลือกกิจกรรม --']) ?>

                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                    <?= $form->field($model, 'time_start')->
                    input('date', ['placeholder'=>'Enter a valid date-time...']); ?>
                        </div><div class="col-lg-6">
                    <?= $form->field($model, 'time_end')->
                    input('date', ['placeholder'=>'Enter a valid date-time...']); ?>
                        </div></div>
                    <?= $form->field($model, 'ta_schedule_detail')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'active_status')->dropDownList([ '0', '1', '2', ], ['prompt' => '']) ?>
                </div>


            </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

            </div>
