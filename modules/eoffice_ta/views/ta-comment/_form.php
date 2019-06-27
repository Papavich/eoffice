<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ta_comment_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_comment_feeling')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
