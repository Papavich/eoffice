<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCommentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_comment_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'section') ?>

    <?= $form->field($model, 'ta_id') ?>

    <?= $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'ta_comment_text') ?>

    <?php // echo $form->field($model, 'ta_comment_feeling') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

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
