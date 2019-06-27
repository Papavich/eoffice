<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\controllers;
use dosamigos\datepicker\DatePicker;
use app\modules\eoffice_ta\models\TaAssessmentOpen;
use app\modules\eoffice_ta\models\TaAssessment;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-assessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <!-- <div class="col-lg-3"> -->
        <?php /* $form->field($model, 'time_start')->widget(
                DatePicker::className(),[
                'inline' =>true,'size' => 'sm',
                'template' =>
                    '<div class="well well-sm" style="background-color: #fff;width: 250px">{input}</div>',
               // 'clientOption' => ['auto-close' => true, 'format' => 'dd-M-yyyy']
            ])->hint('วันที่ใช้ในการแสดงบนปฏิทิน')->label('วันเริ่มต้น'); */?>
        <!--  </div>
        <div class="col-lg-3"> -->
        <?php /* $form->field($model, 'time_end')->widget(
                DatePicker::className(),[
                'inline' =>true,'size' => 'sm',
                'template' =>
                    '<div class="well well-sm" style="background-color: #fff0f0;width: 250px">{input}</div>',
                // 'clientOption' => ['auto-close' => true, 'format' => 'dd-M-yyyy']
            ])->label('วันสิ้นสุด'); */?>
        <!--   </div> -->

        <div class="col-lg-6">
            <?= $form->field($model, 'ta_assessment_id')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'ta_assessment_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type_user')->textInput(['maxlength' => true]) ?>

        </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'ta_assessment_detail')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'past')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'ta_assessment_note')->textInput(['maxlength' => true]) ?>



    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            '<i class="glyphicon glyphicon-floppy-disk"></i>'
            .controllers::t('label','Save'):
            '<i class="glyphicon glyphicon-floppy-disk"></i>'
            .controllers::t('label','Update'),
            ['class' => $model->isNewRecord ?
                'btn btn-success pull-right' : 'btn btn-success pull-right'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
