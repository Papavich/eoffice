<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTypeRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-type-rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_type_rule_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_type_detail')->textarea() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
