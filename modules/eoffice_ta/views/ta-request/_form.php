<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\models\TaTypeWork;
use app\modules\eoffice_ta\models\Year;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRequest */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php
    $RuleApproach = TaRuleApproach::findOne(
        ['ta_type_rule_id'=>TaTypeRule::TYPE_R_NUMBER_OF_TA,
            'active_statuss'=>TaRuleApproach::APPROACH_ACTIVE
        ]);

    ?>

    <?php $form = ActiveForm::begin([//\yii\helpers\Url::current(),
        'class' => 'horizontal',
        //'action' => ['test'],
        'method' => 'get', //['csrf' => false]
    ]); ?>
    <?php  //$form->field($model, 'symbol_value') ?>

<div class="alert alert-bordered-dotted margin-bottom-30"><!-- DOTTED -->
<div class="row">
    <div class="col-lg-1">
        จำนวนนักศึกษา </div>
    <div class="col-lg-3">
        <?= Html::input('number', 'symbol_value','',
        ['class'=>'form-control'/*,'style'=>'width:60%;'*/])?>
    </div>
    <div class="col-lg-8">

        <?= Html::submitButton('<i class = "et-gears size-25"></i>',
            ['class' => 'btn btn-default']) ?>
    <?php
    $L = TaCalculation::findOne(['symbol'=>'L','status_symbol'=>TaCalculation::SYMBOL_VARIABLE,
        'ta_rule_id'=>$RuleApproach->ta_rule_approach_id]);
    $Operator = TaCalculation::findOne(['status_symbol'=>TaCalculation::SYMBOL_OPERATOR,
        'ta_rule_id'=>$RuleApproach->ta_rule_approach_id]);
     $op =  $Operator->symbol;
    ?>
    <?php   //การแสดงค่าที่ได้จาก text inputออกมา คำรสณหรือแสดงได้
    //--------------------------------
    $estimate_ta =0;
    $process=0;
    $number_std = \Yii::$app->request->get('symbol_value');
    if($op=='+'){
        $process =  $number_std+$L->symbol_value;
        $estimate_ta = ceil($process);
    }elseif ($op=='-'){
        $process =  $number_std-$L->symbol_value;
        $estimate_ta = ceil($process);
    }elseif ($op=='*'){
        $process =  $number_std*$L->symbol_value;
        $estimate_ta = ceil($process);
    }elseif ($op=='/'){
        $process =  $number_std/$L->symbol_value;
        $estimate_ta = ceil($process);
    }
    //--------------------------------
    ?>&nbsp;
        <span class="alert alert-warning">
    ประมาณการจำนวนTA &nbsp;<strong class="label label-warning size-14">&nbsp;<?=$estimate_ta?>&nbsp;</strong> &nbsp;คน
        </span>&nbsp;
      <!--  <span class="alert alert-warning">
    ประมาณการค่าตอบแทนผู้ช่วยสอน &nbsp;<strong class="label label-warning size-14">&nbsp;____&nbsp;</strong> &nbsp;บาท
        </span> -->
    </div>
</div>
</div>
    <?php ActiveForm::end(); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">

            <?= $form->field($model, 'ta_type_work_id',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-6',
                ]])->dropdownList(
                ArrayHelper::map(TaTypeWork::find()->all(),
                    'ta_type_work_id',
                    'ta_type_work_fullname'),
                [
                    'id'=>'ddl-type',
                    'prompt'=>'--- เลือกประเภทงาน ---'
                ]); ?>
            <?= $form->field($model, 'property_grade',[
                'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-6',
                ]])->dropDownList(
                [ 'A', 'B+', 'B','C+','C','D+','D' ], ['prompt' => '--- เลือกเกรด ---']) ?>

            <br> <strong>จำนวนผู้ช่วยสอน </strong><br>
            <div class="panel-body alert alert-info">

                <?php
                if ($estimate_ta==0){
                    $estimate_ta=10;
                }
                ?>
    <?= $form->field($model, 'degree_bachelor',[
    'options' => [
        'tag' => 'div',
        'class' => 'col-md-4',
    ]])->textInput([
        'type' => 'number',
        'max' => $estimate_ta,
        'min' => 0,
    ])?>
    <?= $form->field($model, 'degree_master',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
        'max' => $estimate_ta,
        'min' => 0,
    ])?>
    <?= $form->field($model, 'degree_doctorate',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
        'max' => $estimate_ta,
        'min' => 0,
    ])?>
    <?php
     /*
    if ($model->degree_bachelor==$estimate_ta){
     $form->field($model, 'degree_master',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
            'disabled' => true,
        'max' => 0,
        'min' => 0,
    ]);
     $form->field($model, 'degree_doctorate',[
         'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
         ]])->textInput([
         'type' => 'number',
            'disabled' => true,
           'max' => 0,
          'min' => 0,
     ]);

    } if($model->degree_master==$estimate_ta){
         $form->field($model, 'degree_bachelor',[
            'options' => [
                'tag' => 'div',
                'class' => 'col-md-4',
            ]])->textInput([
            'type' => 'number',
            'disabled' => true,
            'max' => 0,
            'min' => 0,
        ]);
     $form->field($model, 'degree_doctorate',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
            'disabled' => true,
        'max' => 0,
        'min' => 0,
    ]);
     if ($model->degree_doctorate==$estimate_ta){
     $form->field($model, 'degree_bachelor',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
         'disabled' => true,
        'max' => 0,
        'min' => 0,
    ]);
     $form->field($model, 'degree_master',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-4',
        ]])->textInput([
        'type' => 'number',
        'disabled' => true,
        'max' => 0,
        'min' => 0,
    ]);
    }}*/?>
            </div>
        </div>
        <div class="col-lg-6">
    <?= $form->field($model, 'request_note')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'property_text')->textarea(['maxlength' => true]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success pull-right'] ) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


