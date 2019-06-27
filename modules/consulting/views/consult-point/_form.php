<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consult_point_id')->textInput() ?>

    <?= $form->field($model, 'consult_point_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
