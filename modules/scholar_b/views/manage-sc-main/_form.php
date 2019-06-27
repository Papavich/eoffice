<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbScholarshipType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-scholarship-type-form">

    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-sm-3 col-md-2">
                <?= $form->field($model, 'scholarship_id')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6 col-md-6">
                <?= $form->field($model, 'scholarship_name')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Html::submitButton('<i class="fa fa-save"></i>'.\app\modules\scholar_b\controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success'] )  ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>


</div>
