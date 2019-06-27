<?php
//หากมี fileInput form จะสร้าง enctype="multipart/form-data ให้อัตโนมัตินะ (v2.0.8)
use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin()?>

<?=$form->field($model, 'title')?>

<?=$form->field($model, 'file')->fileInput()?>

<?=Html::submitButton('<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'])?>

<?php ActiveForm::end()?>

