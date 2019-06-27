<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ArewardOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areward-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'areward_order_id') ?>

    <?= $form->field($model, 'areward_name') ?>

    <?= $form->field($model, 'date_areward') ?>

    <?= $form->field($model, 'level_level_id') ?>

    <?= $form->field($model, 'advisor_id') ?>

    <?php // echo $form->field($model, 'std_id') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'institution_ag_award_id') ?>

    <?php // echo $form->field($model, 'data_detail') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'cities_id') ?>

    <?php // echo $form->field($model, 'member_member_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
