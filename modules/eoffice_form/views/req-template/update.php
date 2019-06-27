<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTemplate */

$this->title = 'Update Req Template: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->template_name, 'url' => ['view', 'id' => $model->template_id]];
$this->params['breadcrumbs'][] = 'แก้ไขแบบฟอร์ม';
?>
<div class="req-template-update">

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>แก้ไขแบบฟอร์ม</strong>
                  </span>
            </div>
            <div class="panel-body">
                <div class="req-template-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'template_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'template_description')->textarea(['rows' => 6])  ?>

                    <?= $form->field($model, 'template_level')->dropDownList(['ปริญญาตรี' => 'ปริญญาตรี', 'บัณฑิตศึกษา' => 'บัณฑิตศึกษา'],['prompt'=>'Select Option'])?>

                    <?= $form->field($model, 'template_operation')->dropDownList(['ดำเนินการภายในคณะ' => 'ดำเนินการภายในคณะ', 'ดำเนินการภายนอกคณะ' => 'ดำเนินการภายนอกคณะ'],['prompt'=>'Select Option'])?>

                    <?= $form->field($model, 'template_category')->dropDownList(['คำร้องทั่วไป' => 'คำร้องทั่วไป', 'คำร้องลงทะเบียน' => 'คำร้องลงทะเบียน'],['prompt'=>'Select Option'])?>

                    <!-- $form->field($model, 'template_file')->fileInput() -->

                    <?= $form->field($model, 'template_file')->widget(FileInput::classname(), [
                        'options' => [
                            //'accept' => 'image/*',
                            'multiple' => false
                        ],
                        'pluginOptions' => [
                            'initialPreview'=>$model->initialPreview($model->template_file,'docx','file'), //<-----
                            'initialPreviewConfig'=>$model->initialPreview($model->template_file,'docx','config'),//<-----
                            'allowedFileExtensions'=>['doc','docx','xls','xlsx'],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial'=>true
                        ]
                    ]); ?>



                    <?= $form->field($model, 'template_available')->dropDownList(['เปิดใช้งาน' => 'เปิดใช้งาน', 'ปิดใช้งาน' => 'ปิดใช้งาน'],['prompt'=>'Select Option'])?>

                    <?= $form->field($model, 'ud_date')->textInput(['value' => date('Y-m-d'),'readonly' => 'true' ]) ?>

                    <?= $form->field($model, 'ud_by')->textInput(['value' => Yii::$app->user->identity->username,'readonly' => 'true']) ?>

                    <div class="form-group">
                        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

</div>
