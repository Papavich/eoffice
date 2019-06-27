<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultSatis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-satis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consult_satis_id')->textInput() ?>

    <?= $form->field($model, 'consult_post_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
