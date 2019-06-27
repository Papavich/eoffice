<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AdvisorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advisors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'advisors_id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'prefix_id') ?>

    <?= $form->field($model, 'acadmic_positions_id') ?>

    <?php // echo $form->field($model, 'expertise_id') ?>

    <?php // echo $form->field($model, 'areward_order_areward_order_id') ?>

    <?php // echo $form->field($model, 'project_member_pro_member_id') ?>

    <?php // echo $form->field($model, 'publication_order_pub_order_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
