<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessmentOpen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-assessment-open-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_assessment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'past')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'term')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'crby')->textInput() ?>

    <?= $form->field($model, 'crtime')->textInput() ?>

    <?= $form->field($model, 'udby')->textInput() ?>

    <?= $form->field($model, 'udtime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['update', 'id' => $model->isNewRecord],['class' => $model->isNewRecord ?
            'btn btn-success pull-right' : 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
