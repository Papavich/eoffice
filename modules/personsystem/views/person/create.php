<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Importsql */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="importsql-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('username') ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('email') ?>
    <?= $form->field($model, 'age')->textInput()->label('password') ?>
    <?= $form->field($model, 'img')->fileInput(['options' => ['class' => 'input input-file']])->label("&nbsp;") ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>