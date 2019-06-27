<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
