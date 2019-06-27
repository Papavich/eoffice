<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetdetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'asset_detail_id') ?>

    <?= $form->field($model, 'asset_univ_code_start') ?>

    <?= $form->field($model, 'asset_univ_type') ?>

    <?= $form->field($model, 'asset_dept_code_start') ?>

    <?= $form->field($model, 'asset_dept_type') ?>

    <?php // echo $form->field($model, 'asset_detail_name') ?>

    <?php // echo $form->field($model, 'asset_detail_brand') ?>

    <?php // echo $form->field($model, 'asset_detail_amount') ?>

    <?php // echo $form->field($model, 'asset_detail_age') ?>

    <?php // echo $form->field($model, 'asset_detail_price') ?>

    <?php // echo $form->field($model, 'asset_detail_price_wreck') ?>

    <?php // echo $form->field($model, 'asset_detail_insurance') ?>

    <?php // echo $form->field($model, 'asset_detail_building') ?>

    <?php // echo $form->field($model, 'asset_detail_room') ?>

    <?php // echo $form->field($model, 'asset_asset_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
