<?php
use yii\widgets\ActiveForm;
use app\modules\pms\models\PmsYearBudget;
use yii\helpers\ArrayHelper;
?>
<!-- page title -->
<header id="page-header">
    <h1><strong>เพิ่มโครงการหลักประจำปี</strong></h1>
    <!--
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form Validate</li>
    </ol> -->
</header>
<!-- /page title -->


<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['action'=> '../addpro/addproyear']); ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label>เลือกปีประจำงบประมาณ</label>
                            <?= $form->field($pro,
                                'project_year')->dropDownList(['prompt' => '--เลือกปีประจำงบประมาณ--'])->label(false) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label>กรอกชื่อโครงการหลัก</label>
                            <?= $form->field($pro, 'project_name')->textInput(['placeholder' =>
                                'กรอกชื่อโครงการหลัก'], ['maxlength' => true])->label(false) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label>กรอกรหัสโครงการหลัก</label>
                            <?= $form->field($pro, 'project_id')->textInput(['placeholder' =>
                                'กรอกชื่อโครงการหลัก'], ['maxlength' => true])->label(false) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton($pro->isNewRecord ? 'เพิ่ม' : 'Update', ['class' =>
                            $pro->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

