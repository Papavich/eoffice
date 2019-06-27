
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Expertise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expertise-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'person_id')->hiddenInput(['disabled' => 'disabled'])->label(false) ?>
    <?= $form->field($model, 'expertise_field_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'expertise_field_name_eng')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>