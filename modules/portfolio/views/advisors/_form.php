<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Advisors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advisors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'prefix_id')->textInput() ?>

    <?= $form->field($model, 'acadmic_positions_id')->textInput() ?>

    <?= $form->field($model, 'expertise_id')->textInput() ?>

    <?= $form->field($model, 'areward_order_areward_order_id')->textInput() ?>

    <?= $form->field($model, 'project_member_pro_member_id')->textInput() ?>

    <?= $form->field($model, 'publication_order_pub_order_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
