<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveGroup */

$this->title = 'เพิ่มกลุ่มผู้พิจารณา';
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : ', 'url' => ['req-template/view','id' => $template_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">



                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>

        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class="approve-group-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

                <?php
                $attributeFunction = app\modules\eoffice_form\models\ApproveType::find()->all();
                $listData=ArrayHelper::map($attributeFunction,'approve_type_id','approve_type_name');
                ?>

                <?= $form->field($model, 'approve_type_id')->dropDownList(
                        $listData,
                        ['options' => ['0' =>  ['Selected'=>true]]],
                        ['prompt'=>'-- เลือกประเภท --']
                ) ?>


                <?php
                $attributeFunction = app\modules\eoffice_form\models\ApproveGroupType::find()->all();
                $listData=ArrayHelper::map($attributeFunction,'group_type_id','group_type_name');
                ?>

                <?= $form->field($model, 'group_type_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>


                <?= $form->field($model, 'group_order')->textInput(['type'=>'number']) ?>

                <?= $form->field($model, 'template_id')->hiddenInput(['value'=> $template_id ,'readonly'=>'true'])->label(false) ?>


                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
        <!-- /panel content -->

    </div>
    <!-- /PANEL -->

</div>
