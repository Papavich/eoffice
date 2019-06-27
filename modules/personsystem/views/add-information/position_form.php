<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\PositionDirectors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="position-directors-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'position_name_eng')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
