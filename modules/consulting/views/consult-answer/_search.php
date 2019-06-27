<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultAnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'consult_answer_id') ?>

    <?= $form->field($model, 'consult_answer_text') ?>

    <?= $form->field($model, 'consult_post_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
