<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationsType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publications-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pub_type_id')->textInput() ?>

    <?= $form->field($model, 'pub_type_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
