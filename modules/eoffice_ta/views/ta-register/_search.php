<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegisterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-register-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'term') ?>

    <?= $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

    <?php // echo $form->field($model, 'ta_image') ?>

    <?php // echo $form->field($model, 'doc_ref01') ?>

    <?php // echo $form->field($model, 'doc_ref02') ?>

    <?php // echo $form->field($model, 'doc_ref03') ?>

    <?php // echo $form->field($model, 'doc_ref04') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
