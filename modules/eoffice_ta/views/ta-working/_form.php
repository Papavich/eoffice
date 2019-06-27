<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaTypeWork;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorking */
/* @var $form yii\widgets\ActiveForm */



$lect = controllers::t('label','Lecture');
$lab = controllers::t('label','LAB');
?>

<div class="ta-working-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">

            <?php  if($t_wload == 'C'){?>
                <?php echo $form->field($model, 'ta_type_work_id',[ 'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-12',
                ]])->radioList(
                    ['C' => $lect,]); ?>

            <?php  }elseif($t_wload == 'L'){?>
                <?php echo $form->field($model, 'ta_type_work_id',[ 'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-12',
                ]])->radioList(
                    ['L' => $lab,]); ?>
            <?php  }else{?>
            <?php echo $form->field($model, 'ta_type_work_id',[ 'options' => [
                'tag' => 'div',
                'class' => 'col-md-12',
            ]])->radioList(
                ['C' => $lect, 'L' => $lab]); ?>
            <?php  }?>

   <?= $form->field($model, 'ta_work_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_work_role')->textarea()?>



        </div>




            <div class="col-lg-6">

      <?= $form->field($model, 'working_date',[ 'options' => [
          'tag' => 'div',
          'class' => 'col-md-12',
      ]])->
          input('date', ['placeholder'=>'Enter a valid date-time...']); ?>


    <?=  $form->field($model, 'time_start',[ 'options' => [
        'tag' => 'div',
        'class' => 'col-md-6',
    ]])->
    input('time', ['placeholder'=>'Enter a valid time...']);?>


    <?=  $form->field($model, 'time_end',[ 'options' => [
        'tag' => 'div',
         'class' => 'col-md-6',
    ]])->
    input('time', ['placeholder'=>'Enter a valid time...']);?>
    <?php
      /*echo $form->field($model, 'hr_working',[
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-12',
        ]])->textInput([
          'disabled' => 'disabled',
        //'type' => 'number',
        'value'=>$model->hr_working,
        'max' => 3,
        'min' => 0,

    ])*/?> </div> </div>
              <div class="row ">
                  <div class="col-lg-3">
                <div class="well text-center ">
                    <?= Html::img($model->getPhotoViewer(),['style'=>'width:100px;','class'=>'img-rounded']); ?>
                    </div>

                  </div> <div class="col-lg-9">
                <?= $form->field($model,'working_evidence')->fileInput() ?>
                  </div>
              </div>




    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success pull-right'] ) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
