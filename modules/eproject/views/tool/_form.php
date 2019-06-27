<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Tool */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tool-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
