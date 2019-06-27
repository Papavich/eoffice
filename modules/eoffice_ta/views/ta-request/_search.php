<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'term_id') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'degree_bachelor') ?>

    <?php // echo $form->field($model, 'degree_master') ?>

    <?php // echo $form->field($model, 'degree_doctorate') ?>

    <?php // echo $form->field($model, 'amount_ta_all') ?>

    <?php // echo $form->field($model, 'request_note') ?>

    <?php // echo $form->field($model, 'property_grade') ?>

    <?php // echo $form->field($model, 'property_text') ?>

    <?php // echo $form->field($model, 'ta_type_work_id') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

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
