<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-calculation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_calculate_id') ?>

    <?= $form->field($model, 'symbol') ?>

    <?= $form->field($model, 'symbol_value') ?>

    <?= $form->field($model, 'status_symbol') ?>

    <?= $form->field($model, 'ta_rule_id') ?>

    <?php // echo $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
