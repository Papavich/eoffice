<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Sponsor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sponsor-form">
    <div class="row">
        <div class="form-group">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-10 col-sm-10">
                <?= $form->field($model, 'sponsor_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2 col-sm-2">
                &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
