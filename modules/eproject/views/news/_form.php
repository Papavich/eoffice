<?php

use app\modules\eproject\controllers;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile( '@web/ckeditor/ckeditor.js' )
?>


<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'title' )->textInput( ['maxlength' => true] ) ?>

    <?= $form->field( $model, 'details' )->widget( CKEditor::className(), [
        'options' => ['rows' => 1],
        'preset' => 'full',
        'clientOptions' => [
            'filebrowserUploadUrl' => \yii\helpers\Url::toRoute(['site/upload']),
        ]
    ] ) ?>
    <div class="form-group">
        <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br/>
<br/>
