<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ViewPisUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-pis-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'consult_user_id') ?>

    <?= $form->field($model, 'consult_user_fname') ?>

    <?= $form->field($model, 'consult_user_lname') ?>

    <?= $form->field($model, 'consult_user_tel') ?>

    <?= $form->field($model, 'consult_user_email') ?>

    <?php // echo $form->field($model, 'consult__user_password') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
