<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRuleApproachSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-rule-approach-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_rule_approach_id') ?>

    <?= $form->field($model, 'ta_rule_approach_name') ?>

    <?= $form->field($model, 'ta_rule_approach_detail') ?>

    <?= $form->field($model, 'ta_type_rule_id') ?>

    <?= $form->field($model, 'active_statuss') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
