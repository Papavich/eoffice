<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\modelsRepairTrackingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-tracking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rep_track_id') ?>

    <?= $form->field($model, 'rep_desc_id') ?>

    <?= $form->field($model, 'rep_status_id') ?>

    <?= $form->field($model, 'rep_tracking_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
