<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_consult\models\ConsultPostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consult-post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'post_id') ?>

    <?= $form->field($model, 'post_ark_detail') ?>

    <?= $form->field($model, 'post_ark_date') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'post_ans') ?>

    <?php // echo $form->field($model, 'topic_owner_id') ?>

    <?php // echo $form->field($model, 'respon_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
