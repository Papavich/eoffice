<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areward-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'areward_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_areward')->textInput() ?>

    <?= $form->field($model, 'level_level_id')->textInput() ?>

    <?= $form->field($model, 'institution_ag_award_id')->textInput() ?>

    <?= $form->field($model, 'data_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'base_tambon_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
