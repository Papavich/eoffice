<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Level */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="level-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'level_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4 col-sm-4">
        &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-md-2 col-sm-2">

    </div>

    <?php ActiveForm::end(); ?>

</div>
