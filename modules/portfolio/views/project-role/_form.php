<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'project_role_name')->textInput(['maxlength' => true]) ?>
    </div>
    <br class="form-group">
    &nbsp;&nbsp;  <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>


    <?php ActiveForm::end(); ?>

</div>
