<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\DesignattributeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="design-attribute-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->attribute($model, 'attribute_ref') ?>

    <?= $form->attribute($model, 'attribute_name') ?>

    <?= $form->attribute($model, 'attribute_order') ?>

    <?= $form->attribute($model, 'design_section_id') ?>

    <?= $form->attribute($model, 'attribute_function_id') ?>

    <?php // echo $form->attribute($model, 'attribute_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
