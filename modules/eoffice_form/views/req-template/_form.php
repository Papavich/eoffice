<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ReqTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="req-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'template_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template_description')->textarea(['rows' => 6])  ?>

    <?= $form->field($model, 'template_level')->dropDownList(['ปริญญาตรี' => 'ปริญญาตรี', 'บัณฑิตศึกษา' => 'บัณฑิตศึกษา'],['prompt'=>'Select Option'])?>

    <?= $form->field($model, 'template_operation')->dropDownList(['ดำเนินการภายในคณะ' => 'ดำเนินการภายในคณะ', 'ดำเนินการภายนอกคณะ' => 'ดำเนินการภายนอกคณะ'],['prompt'=>'Select Option'])?>

    <?= $form->field($model, 'template_category')->dropDownList(['คำร้องทั่วไป' => 'คำร้องทั่วไป', 'คำร้องลงทะเบียน' => 'คำร้องลงทะเบียน'],['prompt'=>'Select Option'])?>

    <?= $form->field($model, 'template_file')->fileInput() ?>

    <?= $form->field($model, 'template_available')->dropDownList(['เปิดใช้งาน' => 'เปิดใช้งาน', 'ปิดใช้งาน' => 'ปิดใช้งาน'],['prompt'=>'Select Option'])?>

    <?= $form->field($model, 'cr_date')->textInput(['value' => date('Y-m-d'),'readonly' => 'true' ]) ?>

    <?= $form->field($model, 'cr_by')->textInput(['value' => Yii::$app->user->identity->username,'readonly' => 'true']) ?>

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
