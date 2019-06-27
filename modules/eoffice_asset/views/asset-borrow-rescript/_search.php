<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescriptSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-borrow-rescript-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borrow_rescript_id') ?>

    <?= $form->field($model, 'asset_borrow_detail_id') ?>

    <?= $form->field($model, 'borrow_rescript_date') ?>

    <?= $form->field($model, 'borrow_rescript_time') ?>

    <?= $form->field($model, 'borrow_rescript_location') ?>

    <?php // echo $form->field($model, 'borrow_rescript_staff') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
