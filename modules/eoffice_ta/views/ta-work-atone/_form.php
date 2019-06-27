<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkAtone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-work-atone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_work_plan_id')->textInput() ?>

    <?= $form->field($model, 'atone_date')->textInput() ?>

    <?= $form->field($model, 'atone_note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_status_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
