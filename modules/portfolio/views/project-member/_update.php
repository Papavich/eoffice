<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-member-form">
    <div class="row">
        <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'member_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'member_lname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'project_project_id')->textInput(['id'=>'project_project_id','readOnly'=> true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'project_role_project_role_id')->textInput(['id'=>'project_role_project_role_id','readOnly'=> true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'person_id')->textInput(['id'=>'person_id','readOnly'=> true]) ?>
            </div>
            <div class="col-md-6 col-sm-6">
               &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            </div>



    <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
