<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-borrow-rescript-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_borrow_detail_id')->textInput() ?>

    <?= $form->field($model, 'borrow_rescript_date')->textInput() ?>

    <?= $form->field($model, 'borrow_rescript_time')->textInput() ?>

    <?= $form->field($model, 'borrow_rescript_location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrow_rescript_staff')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
