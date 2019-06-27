<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Participation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'participation_project_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'participation_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
