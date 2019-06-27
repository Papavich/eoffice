<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-role-form">
    <div class="row">
        <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'project_role_id')->textInput(['id'=>'project_role_id','readOnly'=> true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'project_role_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">

            </div>
            <div class="col-md-6 col-sm-6">
                <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>



    <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
