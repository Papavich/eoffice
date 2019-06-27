<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\scholar_b\controllers;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;

$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'View Portfolio') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../portfolio/index"><?= controllers::t('label', 'Upload Portfolio') ?></a></li>
        <li><a href="../portfolio/create"><?= controllers::t('label', 'Create Portfolio') ?></a></li>
        <li class="active"><?= controllers::t('label', 'View Portfolio') ?></a></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-portfolio-view">
    <div id="content" class="padding-20">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_name')->textInput(['disabled' => true]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'port_type_id')->dropDownList(controllers\GetModelController::getPortType(),
                            [   'disabled' => true,
                                'prompt' => '- ระดับผลงาน -'
                            ]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'project_code')->dropDownList(controllers\GetModelController::getProject(),
                            [   'disabled' => true,
                                'prompt' => '- เลือกผลงาน -'
                            ]) ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'year')->dropDownList(controllers\GetModelController::getYear(),
                            [   'disabled' => true,
                                'prompt' => '- ปีการศึกษา -'
                            ]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'semester')->dropDownList(controllers\GetModelController::getSemester(),
                            [   'disabled' => true,
                                'prompt' => '- เทอม -'
                            ]) ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'port_date')->widget(DatePicker::classname(), [
                            'language' => 'th',
                            'dateFormat' => 'yyyy-MM-dd',
                            'clientOptions' => [
                                'changeMonth' => true,
                                'changeYear' => true,
                            ],
                            'options' => ['class' => 'form-control',
                                'disabled' => true,]
                        ]) ?>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_location')->textInput(['disabled' => true]) ?>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?php echo Html::img('@web/web_scb/uploads/portfolio/images/' . $model->port_img, ['width' => 200]) ?>
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?php echo Html::a(' ' . controllers::t('label', 'Click for Download',
                                [
                                    'class' => 'btn btn-primary']), '@web/web_scb/uploads/portfolio/' . $model->port_file,
                                [
                                    'class' => 'glyphicon glyphicon-download-alt btn btn-warning btn-sm']) ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 col-sm-4">
                        <?= $form->field($model, 'port_detail')->textarea(['rows' => '6','disabled' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="form-group" align="right">
                <?= Html::a(controllers::t('label', 'Update'), ['update', 'id' => $model->id_portfolio], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(controllers::t('label', 'Delete'), ['delete', 'id' => $model->id_portfolio], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

            <?= $form->field($model, 'student_id')->hiddenInput(['value' => Yii::$app->user->identity->username])
                ->label(false)->error(false) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
