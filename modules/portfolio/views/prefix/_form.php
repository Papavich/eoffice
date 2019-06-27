<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Prefix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prefix-form">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'prefix_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'prefix_name')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>



</div>
