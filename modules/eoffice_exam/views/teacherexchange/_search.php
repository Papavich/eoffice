<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_exam\models\ExamTeacherExchangeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-teacher-exchange-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'exam_exchange_date',[ 'options' => [
                'dateFormat' => 'yyyy-mm-dd',
          ]])->
        input('date', ['placeholder'=>'Enter a valid date-time...']); ?>


    <?php // echo $form->field($model, 'exam_per_exchange') ?>

    <?php // echo $form->field($model, 'exam_type_namethai') ?>

    <?php // echo $form->field($model, 'subopen_year') ?>

    <?php // echo $form->field($model, 'subopen_semester') ?>

    <?php // echo $form->field($model, 'rooms_id') ?>

    <?php // echo $form->field($model, 'eaxm_exchange_tel') ?>

    <?php // echo $form->field($model, 'exam_exchange_status') ?>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-blue']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
