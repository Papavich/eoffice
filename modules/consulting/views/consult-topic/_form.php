<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultTopic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-topic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consult_topic_id')->textInput() ?>

    <?= $form->field($model, 'consult_topic_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
