<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultQuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'consult_question_id') ?>

    <?= $form->field($model, 'consult_question_name') ?>

    <?= $form->field($model, 'consult_satis_id') ?>

    <?= $form->field($model, 'consult_point_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
