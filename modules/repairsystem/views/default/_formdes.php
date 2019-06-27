<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rep-des-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true,'readonly' => true]) ?>
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'rep_date')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'asset_code')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'asset_type_dept_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'building_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'room_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'rep_des_detail')->textInput(['maxlength' => true,'readonly' => true]) ?>

    <?= $form->field($model, 'rep_status_id')->textInput() ?>

    <?= $form->field($model, 'rep_photo_id')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
