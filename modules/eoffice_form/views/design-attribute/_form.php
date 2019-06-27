<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Designattribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="design-attribute-form">


    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong></strong>
                  </span>
            </div>
            <div class="panel-body">
                <div class="req-template-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'attribute_ref')->textInput(['maxlength' =>'']) ?>

                    <?= $form->field($model, 'attribute_name')->textarea(['maxlength' => true,'rows' => '6']) ?>


                    <?= $form->field($model, 'design_section_id')->hiddenInput(['value' => $design_section_id ,'readonly'=>'true'])->label(false) ?>

                    <?php
                    $attributeFunction = app\modules\eoffice_form\models\attributeFunction::find()->all();
                    $listData=ArrayHelper::map($attributeFunction,'attribute_function_id','attribute_function_name');
                    ?>

                    <?= $form->field($model, 'attribute_function_id')->dropDownList($listData,['options' => ['31' =>  ['Selected'=>true]]],['prompt'=>'-- เลือกประเภท --']) ?>


                    <?php
                    $attributeType = app\modules\eoffice_form\models\attributeType::find()->all();
                    $listData=ArrayHelper::map($attributeType,'attribute_type_id','attribute_type_name');
                    ?>

                    <?= $form->field($model, 'attribute_type_id')->dropDownList($listData,['options' => ['1' =>  ['Selected'=>true]]],['prompt'=>'-- เลือกประเภท --']) ?>

                    <?= $form->field($model, 'attribute_order')->textInput(['type' => 'number']) ?>


                    <div class="form-group">
                        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
