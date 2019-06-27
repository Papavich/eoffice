<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairDescription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-description-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rep_desc_fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rep_desc_request_date')->textInput() ?>

    <?= $form->field($model, 'rep_image_id')->textInput() ?>

    <?= $form->field($model, 'rep_status_id')->textInput() ?>

    <?= $form->field($model, 'rep_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_detail_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_detail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staff')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
