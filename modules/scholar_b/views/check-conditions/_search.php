<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbConditionHasStudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-condition-has-student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'condi_id') ?>

    <?= $form->field($model, 'scholarship_id') ?>

    <?= $form->field($model, 'scholarship_year') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'condition_pass') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
