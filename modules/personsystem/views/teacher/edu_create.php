<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\HistoryEducation */
/* @var $form yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1>เพิ่มข้อมูลประวัติการศึกษา</h1>
    <ol class="breadcrumb">
        <li><a href="#">Teacher Information </a></li>
        <li class="active">History Education</li>
    </ol><br>
    <a href="admin-update-teacher?id=<?= $person ?>&active=2" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <div class="history-education-create">

    <?php $form = ActiveForm::begin(['action'=>'edu-create?person='.$person]); ?>
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-6"> <?= $form->field($model, 'educational_background')->textInput(['maxlength' => true])->label(controllers::t('label','Qualification')) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'educational_background_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Qualification (Eng)')) ?></div>
        </div>
        <div class="col-md-12">
        <div class="col-md-6"><?= $form->field($model, 'educational_institution')->textInput(['maxlength' => true])->label(controllers::t('label','Educational Institution')) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'educational_institution_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Educational Institution (Eng)')) ?></div>
        </div>
        <div class="col-md-12">
        <div class="col-md-6"> <?= $form->field($model, 'level_education')->dropDownList(['ปริญญาบัณฑิต'=>'ปริญญาบัณฑิต','ปริญญามหาบัณฑิต'=>'ปริญญามหาบัณฑิต','ปริญญาดุษฎีบัณฑิต'=>'ปริญญาดุษฎีบัณฑิต'],['maxlength' => true])->label(controllers::t('label','Level Education')) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'graduate_year')->textInput(['maxlength' => true])->label(controllers::t('label','Graduate Year')) ?></div>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'person_id')->hiddenInput(['value'=> $person],['disabled' => 'disabled'])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
            </div>
        </div>
    </div>
</div>
</div>