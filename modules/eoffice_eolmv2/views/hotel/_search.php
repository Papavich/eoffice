<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmHotelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eolm-hotel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'eolm_hotel_id') ?>

    <?= $form->field($model, 'eolm_hotel_name') ?>

    <?= $form->field($model, 'eolm_hotel_address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
