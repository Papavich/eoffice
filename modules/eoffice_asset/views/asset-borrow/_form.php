<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-borrow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'borrow_user_fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrow_user_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrow_user_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrow_date')->textInput() ?>

    <?= $form->field($model, 'borrow_object')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>