<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\PublicTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="public-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'crby') ?>

    <?= $form->field($model, 'udby') ?>

    <?= $form->field($model, 'crtime') ?>

    <?= $form->field($model, 'udtime') ?>

    <?php // echo $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
