<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTopicAssessment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-topic-assessment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'topic_ass_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assessment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'past')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
