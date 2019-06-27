<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\models\TaTypeWork;
use app\modules\eoffice_ta\controllers;

//use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkloadTeacher */
/* @var $form yii\widgets\ActiveForm */

$lect = controllers::t('label','Lecture');
$lab = controllers::t('label','LAB');
$C_L = controllers::t('label','Lecture & LAB');
?>

<div class="ta-workload-teacher-form">
    AM ย่อมาจาก Ante Meridiem = ใช้เวลา หลังเที่ยงคืน ถึง ก่อนเที่ยงวัน เริ่มที่ 00.01 น. ไปจนถึง 11.59 น.<br>
    PM ย่อมาจาก Post Meridiem = ใช้เวลา หลังเที่ยงวัน ถึง ก่อนเที่ยงคืน เริ่มตอน 12.01 น.
  
    <?php $form = ActiveForm::begin( ); ?>
    <?php echo $form->field($model, 'ta_type_work_id',[ 'options' => [
        'tag' => 'div',
        'class' => 'col-md-12',
    ]])->radioList(
        ['C' => $lect, 'L' => $lab,'C&L '=>$C_L]); ?>
    <hr/>
    <div class="row">
    <div class=" col-md-6">

    <?php  /*
    $form->field($model, 'ta_type_work_id')
        ->radioList(
            ['C' => 'Lec', 'L' => 'Lab','C&L'=>'Lec & Lab'],
            [
                'item' => function($index, $label, $name, $checked, $value) {

                    $return = '<label class="modal-radio">';
                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                    $return .= '<i></i>';
                    $return .= '<span>' . ucwords($label) . '</span>';
                    $return .= '</label>';

                    return $return;
                }
            ]
        )
        ->label(false);*/
    ?>

    <?php /*$form->field($model, 'ta_type_work_id')->dropdownList(
        ArrayHelper::map(TaTypeWork::find()->all(),
            'ta_type_work_id',
            'ta_type_work_fullname'),
        [
            'id'=>'ta-type-work',
            'prompt'=>'เลือกประเภทงานสอน'
        ]);*/ ?>


            <h4><strong><?=$lect?></strong></h4>
    <?= $form->field($model, 'lec_inspect',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        //'type' => 'number',
        'length',
    ])?>
    <?= $form->field($model, 'lect_check_list_std',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput()?>
    <?= $form->field($model, 'lec_other',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput()?>
        <!--
AM ย่อมาจาก Ante Meridiem = ใช้เวลา หลังเที่ยงคืน ถึง ก่อนเที่ยงวัน เริ่มที่ 00.01 น. ไปจนถึง 11.59 น.
PM ย่อมาจาก Post Meridiem = ใช้เวลา หลังเที่ยงวัน ถึง ก่อนเที่ยงคืน เริ่มตอน 12.01 น. -->
        <?=  $form->field($model, 'time_start',[ 'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->
        input('time', ['placeholder'=>'Enter a valid time...']);?>

        <?=  $form->field($model, 'time_end',[ 'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->
        input('time', ['placeholder'=>'Enter a valid time...']);?>
        <?= $form->field($model, 'day_lect',[
            'options' => [
                'tag' => 'div',
                'class' => 'col-md-4',
            ]])->dropDownList(
            [ 'จันทร์'=>'จันทร์', 'อังคาร'=>'อังคาร','พุธ'=>'พุธ','พฤหัสบดี'=>'พฤหัสบดี'
                ,'ศุกร์'=>'ศุกร์','เสาร์'=>'เสาร์','อาทิตย์'=>'อาทิตย์' ], ['prompt' => '--- วันที่สอน ---']) ?>
        </div>

    <div class="  col-md-6">

            <h4><strong><?=$lab?></strong></h4>
            <?= $form->field($model, 'lab_hr',[ 'options' => [
            'tag' => 'div',
            'class' => 'col-md-12',
        ]])->textInput()?>
        <?=  $form->field($model, 'time_start_lab',[ 'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->
        input('time', ['placeholder'=>'Enter a valid time...']);?>

        <?=  $form->field($model, 'time_end_lab',[ 'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->
        input('time', ['placeholder'=>'Enter a valid time...']);?>

        <?= $form->field($model, 'day_lab',[
            'options' => [
                'tag' => 'div',
                'class' => 'col-md-4',
            ]])->dropDownList(
            [ 'จันทร์'=>'จันทร์', 'อังคาร'=>'อังคาร','พุธ'=>'พุธ','พฤหัสบดี'=>'พฤหัสบดี'
                ,'ศุกร์'=>'ศุกร์','เสาร์'=>'เสาร์','อาทิตย์'=>'อาทิตย์' ], ['prompt' => '--- วันที่สอน ---']) ?>

    <?php
     /*$form->field($model, 'time_start')->widget(DatePicker::className(),
        [
            'language' => 'en',
        'value' => date('Y-m-d')]); */
    ?>
    <?php /*
    $form->field($model, 'time_end')->widget(DatePicker::className(),
        [
            'language' => 'en',
            'value' => date('H:i:s')]);   */
    ?>
        </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
