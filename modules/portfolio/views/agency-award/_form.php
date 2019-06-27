<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AgencyAward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-award-form">
    <div class="row">
        <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'image')->fileInput()?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'data_detail')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'locus_areward')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'countries_areward')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'cities_areward')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                &nbsp; &nbsp; &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
