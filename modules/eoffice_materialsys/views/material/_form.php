<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matsys-material-form">

    <?php $form = ActiveForm::begin([
        'id' => 'detail-material',
        'action' => null,
    ]); ?>

    <?= $form->field($model, 'material_id',[
            'option'=>[
                    'class'=>'form-group col-md-3',
            ]
    ])->textInput(['maxlength' => true,'class'=>'']) ?>

    <?= $form->field($model, 'material_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material_amount_check')->textInput() ?>

    <?= $form->field($model, 'material_order_count')->textInput() ?>

    <?= $form->field($model, 'material_unit_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material_type_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
