<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveFieldListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approve-field-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'approve_field_list_id') ?>

    <?= $form->field($model, 'approve_field_list_name') ?>

    <?= $form->field($model, 'approve_field_list_order') ?>

    <?= $form->field($model, 'approve_field_ref') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
