<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'question_id') ?>

    <?= $form->field($model, 'question_one') ?>

    <?= $form->field($model, 'question_two') ?>

    <?= $form->field($model, 'question_three') ?>

    <?= $form->field($model, 'question_four') ?>

    <?php // echo $form->field($model, 'question_five') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
