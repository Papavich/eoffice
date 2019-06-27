<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Asset */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_id')->textInput() ?>

    <?= $form->field($model, 'asset_date')->textInput() ?>

    <?= $form->field($model, 'asset_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_get')->textInput() ?>

    <?= $form->field($model, 'asset_budget')->textInput() ?>

    <?= $form->field($model, 'asset_company')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
