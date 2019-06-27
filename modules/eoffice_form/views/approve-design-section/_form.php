<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="approve-design-section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'approve_design_name')->textInput(['maxlength' => true]) ?>
    <?php
    $SectionDesignType = app\modules\eoffice_form\models\DesignSectionType::find()->all();
    $listData=ArrayHelper::map($SectionDesignType,'section_type_id','section_type_name');
    ?>

    <?= $form->field($model, 'section_type_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>

    <?= $form->field($model, 'approve_design_order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'approve_group_id')->textInput(['value' => $group_id,'readonly' => 'true']) ?>



    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
