<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;
use yii\jui\DatePicker;


?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Activity') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class=""><a href="../activity/index#jtab1_nobg"><?= controllers::t('label', 'Activity Main') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Edit Activity') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-activity-main-update">
    <div class="row">
        <div class="panel-body">
            <div class="container">

                <h1>ชื่อกิจกรรม : <?= $model->act_main_name ?></h1>
                <?php $form = ActiveForm::begin([]); ?>

                <form role="form" action="" method="post">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2">
                                <?= $form->field($model, 'year')->dropDownList(controllers\GetModelController::getYear()) ?>
                            </div>

                            <div class="col-md-2 col-sm-2">
                                <?= $form->field($model, 'act_type_id')->dropDownList(controllers\GetModelController::getActivitytype()) ?>
                            </div>


                            <div class="col-md-2 col-sm-2">
                                <?= $form->field($model, 'act_main_id')->textInput(['disabled' => 'true']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <?= $form->field($model, 'act_main_name')->textInput(['placeholder' => 'ชื่อกิจกรรม']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <?= $form->field($model, 'act_main_detail')->textarea(['rows' => '8',
                                    'placeholder' => 'รายละเอียด']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <?= $form->field($model, 'act_main_location')->textInput(['placeholder' => 'สถานที่']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <?= $form->field($model, 'act_main_date_start')->widget(DatePicker::classname(), [
                                    'language' => 'th',
                                    'dateFormat' => 'yyyy-MM-dd',
                                    'clientOptions' => [
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                    ],
                                    'options' => ['class' => 'form-control',
                                        'placeholder' => 'วันที่เริ่มกิจกรรม']
                                ]) ?>
                            </div>

                            <div class="col-md-4">
                                <?= $form->field($model, 'act_main_date_end')->widget(DatePicker::classname(), [
                                    'language' => 'th',
                                    'dateFormat' => 'yyyy-MM-dd',
                                    'clientOptions' => [
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                    ],
                                    'options' => ['class' => 'form-control',
                                        'placeholder' => 'วันที่จบกิจกรรม']
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-success'] )  ?>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
