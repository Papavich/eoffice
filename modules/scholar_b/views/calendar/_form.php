<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbCalendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-calendar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'calendar_id')->textInput() ?>

    <?= $form->field($model, 'staff_id_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calendar_topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calendar_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calendar_date_start')->textInput() ?>

    <?= $form->field($model, 'calendar_date_end')->textInput() ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
