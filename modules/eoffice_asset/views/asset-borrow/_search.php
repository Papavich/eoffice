<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-borrow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'borrow_id') ?>

    <?= $form->field($model, 'borrow_date') ?>

    <?= $form->field($model, 'borrow_status') ?>

    <?= $form->field($model, 'borrow_object') ?>

    <?= $form->field($model, 'borrow_person') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
