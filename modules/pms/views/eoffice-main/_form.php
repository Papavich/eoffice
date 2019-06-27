<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\model_main\EofficeMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'STUDENTID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTSURNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTNAMEENG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STUDENTSURNAMEENG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LEVELNAME')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
