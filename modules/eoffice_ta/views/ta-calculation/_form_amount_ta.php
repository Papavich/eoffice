<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-type-rule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['numberta'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'symbol_value') ?>

    <div class="form-group">
        <?= Html::submitButton('process', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
