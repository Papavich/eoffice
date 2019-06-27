<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignFieldSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approve-design-field-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'approve_field_ref') ?>

    <?= $form->field($model, 'approve_field_name') ?>

    <?= $form->field($model, 'approve_field_order') ?>

    <?= $form->field($model, 'approve_design_id') ?>

    <?= $form->field($model, 'attribute_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
