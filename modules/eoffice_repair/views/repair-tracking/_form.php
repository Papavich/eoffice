<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairTracking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-tracking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rep_desc_id')->textInput() ?>

    <?= $form->field($model, 'rep_status_id')->textInput() ?>

    <?= $form->field($model, 'rep_tracking_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
