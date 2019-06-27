<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="board-of-directors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'board_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'director_id')->textInput() ?>

    <?= $form->field($model, 'period_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
