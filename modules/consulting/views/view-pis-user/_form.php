<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ViewPisUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-pis-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consult_user_id')->textInput() ?>

    <?= $form->field($model, 'consult_user_fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consult_user_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consult_user_tel')->textInput() ?>

    <?= $form->field($model, 'consult_user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consult__user_password')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
