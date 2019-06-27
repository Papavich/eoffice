<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Institution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institution-form">
    <div class="row">
        <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>

            <div class="col-md-6 col-sm-6">

                <?= $form->field($model, 'ag_award_name')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="form-group">
               <br/> <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
