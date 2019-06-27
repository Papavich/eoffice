<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_news_id') ?>

    <?= $form->field($model, 'ta_news_name') ?>

    <?= $form->field($model, 'ta_news_detail') ?>

    <?= $form->field($model, 'ta_news_img') ?>

    <?= $form->field($model, 'ta_news_imgs') ?>

    <?php // echo $form->field($model, 'ta_news_url') ?>

    <?php // echo $form->field($model, 'ta_documents_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'ta_status') ?>

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
