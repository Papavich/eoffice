<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use yii\jui\DatePicker;

?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Edit Funded grant') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../funded-grant/index"><?= controllers::t('label', 'Funded Grant') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Edit Funded grant') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-funded-update">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <h3><?= Html::encode($this->title) ?></h3>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span>
                                    <b> รายละเอียดนักศึกษา</b>
                                </div>
                                <div class="panel-body">
                                    <label>เลขประจำตัวนักศึกษา : <?php echo $model_funded->student_id ?></label>
                                    <br><label>ชื่อ-สกุล
                                        : <?php echo $main_full->PREFIXNAME ?><?php echo $main_full->STUDENTNAME ?>  <?php echo $main_full->STUDENTSURNAME ?></label>
                                    <br><label>สาขาวิชา : <?php echo $main_full->major_name ?></label>
                                    <br><label>ทุนการศึกษา : </label>
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
            </div>
        </div>
    </div>
</div>
