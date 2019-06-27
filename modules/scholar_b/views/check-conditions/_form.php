<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbConditionHasStudent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-condition-has-student-form">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'condi_id')->textInput() ?>

                    <?= $form->field($model, 'scholarship_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'scholarship_year')->textInput() ?>

                    <?= $form->field($model, 'student_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'condition_pass')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">Panel with panel-success class</div>
                        <div class="panel-body">
                            <label>เงื่อนไขที่ อุฟวยฟ่วยฟวย</label>
                            <label class="checkbox">
                                <input type="checkbox" value="1">
                                <i></i> Checkbox 1
                            </label>


                        </div>
                    </div>





                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
