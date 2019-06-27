<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\models\ScbProject;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbPortfolio */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>
<?= Html::csrfMetaTags() ?>
<div class="scb-portfolio-form">
    <div id="content" class="padding-20">
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_name')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'port_type_id')->dropDownList(controllers\GetModelController::getPortType(),
                            [
                                'prompt' => controllers::t('label', 'Level')
                            ]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'project_code')->dropDownList(
                            \yii\helpers\ArrayHelper::map(ScbProject::find()
                                ->where(['crby' => Yii::$app->user->identity->getId()])
                                ->asArray()->all(), 'project_code', 'project_name'),
                            [
                                'prompt' => controllers::t('label', 'Enter Project')
                            ]) ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'year')->dropDownList(controllers\GetModelController::getYear(),
                            [
                                'prompt' => controllers::t('label', 'Enter Year')
                            ]) ?>
                    </div>

                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'semester')->dropDownList(controllers\GetModelController::getSemester(),
                            [
                                'prompt' => controllers::t('label', 'Semester')
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
                            'options' => ['class' => 'form-control']
                        ]) ?>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_location')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_img')->fileInput() ?>
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'port_file')->fileInput() ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 col-sm-4">
                        <?= $form->field($model, 'port_detail')->widget(CKEditor::className(), [
                            'options' => ['rows' => 1],
                            'preset' => 'basic',
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="form-group" align="right">
                <?= Html::submitButton('<i class="fa fa-save"></i>'
                    . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
            </div>

            <?= $form->field($model, 'student_id')->hiddenInput(['value' => Yii::$app->user->identity->username])
                ->label(false)->error(false) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

