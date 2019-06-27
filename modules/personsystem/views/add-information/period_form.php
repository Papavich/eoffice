
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\modules\personsystem\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Period */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="period-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'period_describe')->textInput(['maxlength' => true]) ?>
    <?= $form->field( $model, 'date' )->widget(
        DatePicker::className(), [
        'language' => 'th',
        'clientOptions'=>[
            'changeMonth'=>true,
            'changeYear'=>true,
        ],
        'options' => ['class'=>'form-control','placeholder' => controllers::t( 'label','date of period') ],
        'dateFormat'=>'yyyy-MM-dd',
    ] )->label(''); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
