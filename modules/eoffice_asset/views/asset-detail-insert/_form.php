<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asset_univ_code_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_univ_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_dept_code_start')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_dept_type')->textInput() ?>

    <?= $form->field($model, 'asset_detail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_detail_brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asset_detail_amount')->textInput() ?>

    <?= $form->field($model, 'asset_detail_age')->textInput() ?>

    <?= $form->field($model, 'asset_detail_price')->textInput() ?>

    <?= $form->field($model, 'asset_detail_price_wreck')->textInput() ?>

    <?= $form->field($model, 'asset_detail_insurance')->textInput() ?>

    <?= $form->field($model, 'asset_detail_building')->textInput() ?>

    <?= $form->field($model, 'asset_detail_room')->textInput() ?>

    <?= $form->field($model, 'asset_asset_id')->textInput() ?>

    <?= $form->field($model, 'asset_image_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
