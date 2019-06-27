<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\modules\scholar_b\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbFunded */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/web_scb/js/find-student-funded.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?= Html::csrfMetaTags() ?>
<div class="scb-funded-form">
    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model_funded, 'student_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <div>
                <label>ผลการค้นหาข้อมูล : </label>
                <div id="show">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php
            foreach ($year_semester as $rowsyear) {
                $array_year[$rowsyear->year] = $rowsyear->year;
            }
            ?>
            <?= $form->field($model_funded, 'year')->dropDownList($array_year) ?>
        </div>
        <div class="col-md-4">
            <?php
            foreach ($year_semester as $rowssem) {
                $array_semester[$rowssem->semester] = $rowssem->semester;
            }
            ?>
            <?= $form->field($model_funded, 'semester')->dropDownList($array_semester) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php
            foreach ($funded_type as $rows) {
                $array_funded_type[$rows->funded_type_id] = $rows->funded_type_name;
            }
            ?>
            <?= $form->field($model_funded, 'funded_type_id')->dropDownList($array_funded_type) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model_funded, 'funded_amount')->textInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model_funded, 'funded_date')->widget(DatePicker::classname(), [
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

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success'] )  ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
