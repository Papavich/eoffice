<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairDescriptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-description-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rep_desc_id') ?>

    <?= $form->field($model, 'rep_desc_fname') ?>

    <?= $form->field($model, 'rep_desc_lname') ?>

    <?= $form->field($model, 'rep_desc_email') ?>

    <?= $form->field($model, 'rep_desc_tel') ?>

    <?php // echo $form->field($model, 'rep_desc_detail') ?>

    <?php // echo $form->field($model, 'rep_desc_cost') ?>

    <?php // echo $form->field($model, 'rep_desc_comment') ?>

    <?php // echo $form->field($model, 'rep_desc_request_date') ?>

    <?php // echo $form->field($model, 'rep_image_id') ?>

    <?php // echo $form->field($model, 'rep_status_id') ?>

    <?php // echo $form->field($model, 'rep_location') ?>

    <?php // echo $form->field($model, 'asset_detail_id') ?>

    <?php // echo $form->field($model, 'asset_detail_name') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
