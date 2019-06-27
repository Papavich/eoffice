<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\AttributeData */
/* @var $form yii\widgets\ActiveForm */
?>


<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="attribute-data-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'design_section_id')->hiddenInput(['value' => $design_section_id ,'readonly'=>'true'])->label(false) ?>


                <?= $form->field($model, 'attribute_ref')->hiddenInput(['value' => $attribute_ref ,'readonly'=>'true'])->label(false)  ?>



                <?= $form->field($model, 'attribute_data')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'attribute_order')->textInput(['type'=>'number']) ?>


                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

