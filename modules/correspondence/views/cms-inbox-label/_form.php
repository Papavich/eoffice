<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsInboxLabel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-inbox-label-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'label_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
