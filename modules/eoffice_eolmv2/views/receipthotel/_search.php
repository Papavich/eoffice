<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmReceiptHotelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-receipt-hotel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eolm_app_id') ?>

    <?= $form->field($model, 'eolm_hotel_id') ?>

    <?= $form->field($model, 'eolm_rec_hotel_stay_date') ?>

    <?= $form->field($model, 'eolm_rec_hotel_checkout_date') ?>

    <?= $form->field($model, 'eolm_rec_hotel_room_amount') ?>

    <?php // echo $form->field($model, 'eolm_rec_hotel_nights_amount') ?>

    <?php // echo $form->field($model, 'eolm_rec_hotel_price_per_room') ?>

    <?php // echo $form->field($model, 'eolm_rec_hotel_amount') ?>

    <?php // echo $form->field($model, 'eolm_rec_hotel_amount_text') ?>

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
