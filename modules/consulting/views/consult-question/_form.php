<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultQuestion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consult_question_id')->textInput() ?>

    <?= $form->field($model, 'consult_question_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consult_satis_id')->textInput() ?>

    <?= $form->field($model, 'consult_point_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
