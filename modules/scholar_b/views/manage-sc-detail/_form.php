<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;
use app\modules\scholar_b\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbScholarshipTypeHasYear */

/* @var $form yii\widgets\ActiveForm */

use wbraganca\dynamicform\DynamicFormWidget;

$detail = controllers::t('label', 'Conditions');
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html( "เงื่อนไข: " + (index + 3))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html( "เงื่อนไข: " + (index + 3))
    });
});
';

$this->registerJs($js);
$this->registerJsFile('@web/ckeditor/ckeditor.js')
?>

<div class="scb-scholarship-type-has-year-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-8">
            <?php
            foreach ($sc_main as $rows) {
                $array_sc[$rows->scholarship_id] = $rows->scholarship_name;
            }
            ?>
            <?= $form->field($model_sc_detail, 'scholarship_id')->dropDownList($array_sc, [
                'prompt' => 'เลือกโครงการทุนในแต่ละปี', [
                    'disabled' => true,
                ]
            ]) ?>
        </div>

        <div class="col-md-2">
            <?php
            foreach ($sc_year as $rows) {
                $array[$rows->year] = $rows->year;
            }
            ?>

            <?= $form->field($model_sc_detail, 'scholarship_year')->dropDownList($array, [
                'prompt' => 'ปีการศึกษา', [
                    'disabled' => true,
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model_sc_detail, 'scholarship_image')->fileInput(['accept' => 'image/*']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model_sc_detail, 'date_start')->widget(DatePicker::classname(), [
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => ['class' => 'form-control']
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model_sc_detail, 'scholarship_file')->fileInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model_sc_detail, 'date_end')->widget(DatePicker::classname(), [
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => ['class' => 'form-control']
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model_sc_detail, 'scholarship_condition')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'standard',
//        'clientOptions' => [
//            'filebrowserUploadUrl' => yii\helpers\Url::toRoute(['site/upload']),
//    ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="fancy-form fancy-form-select">
                <select class="form-control select2" name="con[]">
                    <option value="1">ผลการศึกษาแต่ละเทอมไม่ต่ำกว่า</option>
                    <option value="2">ผลการศึกษาแต่ละปีการศึกษาไม่ต่ำกว่า</option>
                </select>

                <!--
                    .fancy-arrow
                    .fancy-arrow-double
                -->
                <i class="fancy-arrow-"></i>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <input type="text" class="form-control" name="con_val[]">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="fancy-form fancy-form-select">
                <select class="form-control select2" name="con[]">
                    <option value="3">เข้าร่วมการประกวด-แข่งขันหรือบทความวิชาการระดับภูมิภาคอย่างน้อย</option>
                    <option value="4">เข้าร่วมการประกวด-แข่งขันอย่างน้อย</option>
                </select>

                <!--
                    .fancy-arrow
                    .fancy-arrow-double
                -->
                <i class="fancy-arrow-"></i>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <input type="text" class="form-control" name="con_val[]">
            </div>
        </div>
    </div>


    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 100, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $model_conditions[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'condi_name',
            'condi_value',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="glyphicon glyphicon-list-alt"></i> Terms and Conditions
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($model_conditions as $index => $models): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">เงื่อนไข: <?= ($index + 3) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                    class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        //                            if (!$modelAddress->isNewRecord) {
                        //                                echo Html::activeHiddenInput($modelAddress, "[{$index}]id");
                        //                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-9">
                                <?= $form->field($models, "[{$index}]condi_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($models, "[{$index}]condi_value")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- end:row -->


                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
            Conditions
        </button>

    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i>' . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
