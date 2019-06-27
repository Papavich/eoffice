<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\DesignSection */

$this->title = 'แก้ไขหมวดหมู่';
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template->template_name, 'url' => ['req-template/view','id' => $model->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->design_section_name, 'url' => ['view', 'id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = 'แก้ไขหมวดหมู่';
?>
<div class="design-section-form">

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>แก้ไขหมวดหมู่</strong>
                  </span>
            </div>
            <div class="panel-body">
                <div class="req-template-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'design_section_name')->textInput(['maxlength' => true]) ?>

                    <?php
                    $SectionDesignType = app\modules\eoffice_form\models\DesignSectionType::find()->all();
                    $listData=ArrayHelper::map($SectionDesignType,'section_type_id','section_type_name');
                    ?>

                    <?= $form->field($model, 'section_type_id')->dropDownList($listData
                        ,['options' => ['0' =>  ['Selected'=>true]]],
                        ['prompt'=>'-- เลือกประเภท --']) ?>



                    <?= $form->field($model, 'design_section_order')->textInput(['type' => 'number']) ?>



                    <?= $form->field($model, 'template_id')->hiddenInput(['value' => $template_id,'readonly'=>'true'])->label(false) ?>



                    <div class="form-group">
                        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>
