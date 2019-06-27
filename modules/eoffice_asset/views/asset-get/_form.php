<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetGet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-get-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_get_id')->textInput() ?>

    <?= $form->field($model, 'asset_get_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
