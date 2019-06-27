
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Major */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="major-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'major_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'major_name_eng')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'major_code')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
