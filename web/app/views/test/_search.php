<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reg-studentbio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'STUDENTBIO') ?>

    <?= $form->field($model, 'STUDENTID') ?>

    <?= $form->field($model, 'NATIONID') ?>

    <?= $form->field($model, 'RELIGIONID') ?>

    <?= $form->field($model, 'SCHOOLID') ?>

    <?php // echo $form->field($model, 'ENTRYTYPE') ?>

    <?php // echo $form->field($model, 'ENTRYDEGREE') ?>

    <?php // echo $form->field($model, 'BIRTHDATE') ?>

    <?php // echo $form->field($model, 'STUDENTFATHERNAME') ?>

    <?php // echo $form->field($model, 'STUDENTMOTHERNAME') ?>

    <?php // echo $form->field($model, 'STUDENTSEX') ?>

    <?php // echo $form->field($model, 'ADMITACADYEAR') ?>

    <?php // echo $form->field($model, 'ADMITSEMESTER') ?>

    <?php // echo $form->field($model, 'ENTRYGPA') ?>

    <?php // echo $form->field($model, 'CITIZENID') ?>

    <?php // echo $form->field($model, 'PARENTNAME') ?>

    <?php // echo $form->field($model, 'PARENTRELATION') ?>

    <?php // echo $form->field($model, 'CONTACTPERSON') ?>

    <?php // echo $form->field($model, 'STUDENTMOBILE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
