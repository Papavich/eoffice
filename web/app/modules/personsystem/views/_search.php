<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-of-directors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'board_id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'director_id') ?>

    <?= $form->field($model, 'period_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
