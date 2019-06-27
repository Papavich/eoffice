<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTrackingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-tracking-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'template_id') ?>

    <?= $form->field($model, 'cr_date') ?>

    <?= $form->field($model, 'cr_term') ?>

    <?= $form->field($model, 'cr_year') ?>

    <?php // echo $form->field($model, 'req_status') ?>

    <?php // echo $form->field($model, 'req_enddate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
