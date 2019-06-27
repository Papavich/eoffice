<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\controllers;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRuleApproach */
/* @var $form yii\widgets\ActiveForm */

$save = controllers::t( 'label', 'Save');
$update = controllers::t( 'label', 'Update');
?>

<div class="ta-rule-approach-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_rule_approach_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_rule_approach_detail')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_type_rule_id')->textInput() ?>

    <?= $form->field($model, 'active_statuss')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?  '<i class="glyphicon glyphicon-floppy-disk"></i>'.$save : '<i class="glyphicon glyphicon-floppy-disk"></i>'.$update, ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
