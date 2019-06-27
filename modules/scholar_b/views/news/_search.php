<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbNewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_news') ?>

    <?= $form->field($model, 'news_name') ?>

    <?= $form->field($model, 'news_type') ?>

    <?= $form->field($model, 'news_detail') ?>

    <?= $form->field($model, 'news_date') ?>

    <?php // echo $form->field($model, 'news_ref') ?>

    <?php // echo $form->field($model, 'news_image') ?>

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
