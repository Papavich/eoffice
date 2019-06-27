<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbPortfolioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-portfolio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_portfolio') ?>

    <?= $form->field($model, 'port_name') ?>

    <?= $form->field($model, 'port_date') ?>

    <?= $form->field($model, 'port_img') ?>

    <?= $form->field($model, 'port_location') ?>

    <?php // echo $form->field($model, 'port_detail') ?>

    <?php // echo $form->field($model, 'port_file') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <?php // echo $form->field($model, 'port_type_id') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'semester') ?>

    <?php // echo $form->field($model, 'project_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
