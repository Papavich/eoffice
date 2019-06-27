<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AgencyAwardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-award-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'areward_order_id') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'data_detail') ?>

    <?= $form->field($model, 'locus_areward') ?>

    <?= $form->field($model, 'countries_areward') ?>

    <?php // echo $form->field($model, 'cities_areward') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
