<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_schedule_id') ?>

    <?= $form->field($model, 'ta_schedule_url') ?>

    <?= $form->field($model, 'ta_schedule_title') ?>

    <?= $form->field($model, 'time_start') ?>

    <?= $form->field($model, 'time_end') ?>

    <?php // echo $form->field($model, 'ta_schedule_detail') ?>

    <?php // echo $form->field($model, 'ta_schedule_type') ?>

    <?php // echo $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'active_status') ?>

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
