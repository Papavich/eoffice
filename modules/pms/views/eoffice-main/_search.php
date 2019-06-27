<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\model_main\Serach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eoffice-main-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'STUDENTID') ?>

    <?= $form->field($model, 'STUDENTCODE') ?>

    <?= $form->field($model, 'STUDENTNAME') ?>

    <?= $form->field($model, 'STUDENTSURNAME') ?>

    <?= $form->field($model, 'STUDENTNAMEENG') ?>

    <?php // echo $form->field($model, 'STUDENTSURNAMEENG') ?>

    <?php // echo $form->field($model, 'LEVELNAME') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
