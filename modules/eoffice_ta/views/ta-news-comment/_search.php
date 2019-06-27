<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNewsCommentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-news-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_news_comment_id') ?>

    <?= $form->field($model, 'ta_news_comment_text') ?>

    <?= $form->field($model, 'ta_news_comment_img') ?>

    <?= $form->field($model, 'ta_news_id') ?>

    <?= $form->field($model, 'ta_status') ?>

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
