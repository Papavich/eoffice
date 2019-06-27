<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Leave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leave-form">

    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">

                <div class="col-lg-2">
                    <?= $form->field($model, 'leave_year')->textInput(['maxlength' => true])->hint('**ตัวอย่าง 2559') ?>
                </div>


            </div>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'leave_type')->radioList(array('ลาป่วย' => 'ลาป่วย', 'ลากิจส่วนตัว' => 'ลากิจส่วนตัว', 'ลาพักผ่อน' => 'ลาพักผ่อน')); ?>
                </div>

                <div class="col-lg-4">

                    <?= $form->field($model, 'leave_day')->radioList(array('เต็มวัน' => 'เต็มวัน', 'ครึ่งเช้า' => 'ครึ่งเช้า', 'ครึ่งบ่าย' => 'ครึ่งบ่าย')); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <?=
                    $form->field($model, 'leave_date_start')->widget(
                            DatePicker::className(), [
                        'clientOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>    
                </div>

                <div class="col-lg-4">
                    <?=
                    $form->field($model, 'leave_date_end')->widget(
                            DatePicker::className(), [
                        'clientOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>  
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'leave_reason')->textArea(['rows' => '3']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>


            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>
