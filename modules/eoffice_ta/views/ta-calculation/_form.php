<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaCalculation;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-calculation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'symbol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'symbol_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_symbol')->dropDownList([ 'main' => 'Main', 'var' => 'Var', 'op' => 'Op', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'ta_rule_id')->dropdownList(
        ArrayHelper::map(TaRuleApproach::find()->all(),
            'ta_rule_approach_id',
            'ta_rule_approach_name'),
        [
            'id'=>'ddl-type',
            'prompt'=>'เลือกสูตร'
        ]); ?>
    <?= $form->field($model, 'order', [
        'options' => [
            'tag' => 'div',
            'class' => '',
        ],
        'template' => '<span class="col-md-2 col-lg-2"><label class="control-label">Order</label>{input}{error}</span>'
    ])->textInput([
        'type' => 'number',
        'max' => 10,
        'min' => 0,

    ])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
