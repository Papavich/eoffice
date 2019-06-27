<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\AttributeDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attribute-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'attribute_data_id') ?>

    <?= $form->field($model, 'attribute_data') ?>

    <?= $form->field($model, 'attribute_order') ?>

    <?= $form->field($model, 'attribute_ref') ?>

    <?= $form->field($model, 'design_section_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
