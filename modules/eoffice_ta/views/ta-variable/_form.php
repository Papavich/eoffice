<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaVariable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-variable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_variable_name')->textInput(['maxlength' => true,'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'ta_variable_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_variable_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'var' => 'Var', 'nonfix' => 'Nonfix', 'fix' => 'Fix', 'main' => 'Main'], ['prompt' => '','disabled' => 'disabled']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
