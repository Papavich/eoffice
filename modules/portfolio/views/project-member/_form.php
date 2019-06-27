<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_order_id')->textInput() ?>

    <?= $form->field($model, 'project_role_project_role_id')->textInput() ?>

    <?= $form->field($model, 'project_member_pro_member_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
