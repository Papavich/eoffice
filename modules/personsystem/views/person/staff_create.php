<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
use app\modules\personsystem\models\AcademicPositions;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\PositionDirectors;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\RegNation;
use app\modules\personsystem\models\RegOfficer;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\RegSchool;
use app\modules\personsystem\models\Zipcode;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1><?= controllers::t( 'label','Form Add Staff'); ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Edit Infomation</li>
    </ol>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <!-- tabs -->
        <ul class="nav nav-tabs" style="margin-left: 14px;">
            <li class="<?php if(empty($_GET["active"])){echo "active";}?>">
                <a href="#tab1_nobg" data-toggle="tab">
                    <i class="fa fa-user"></i> <?php echo controllers::t( 'label','Basic Information'); ?>
                </a>
            </li>
        </ul>
        <!-- tabs1 content -->
        <div class="tab-content transparent">
            <div id="tab1_nobg" class="tab-pane <?php if(empty($_GET["active"])){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="smartwizard2">
                                <ul>
                                    <li><a href="#step-1">Step 1<br/>
                                            <small><?= controllers::t('label', 'Staff Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-2">Step 2<br/>
                                            <small><?= controllers::t('label', 'Address Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-3">Step 3<br/>
                                            <small><?= controllers::t('label', 'Contact Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-4">Step 4<br/>
                                            <small><?= controllers::t('label', 'Registration Information'); ?></small>
                                        </a></li>
                                </ul>
                                <br/>
                                <div>
                                    <div id="step-1" class="">
                                        <div class="group-info">
                                            <div class="row">
                                                <!-- Row1 -->
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                    <div class="img-resize">
                                                                        <img width="150" height="150"
                                                                             class="img-thumbnail" alt=""
                                                                             src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg"
                                                                             height="34" ALIGN=LEFT><br/>
                                                                    </div>
                                                                <?php $form = ActiveForm::begin(); ?>
                                                                <?= $form->field($model, 'person_img')->fileInput(['options' => ['class' => 'input input-file']])->label("&nbsp;") ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Row2 -->
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_card_id')->textInput(['maxlength' => true])->label(controllers::t('label', 'Staff ID')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_citizen_id')->textInput(['maxlength' => true])->label(controllers::t('label', 'ID Card')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'prefix_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(RegPrefix::find()->all(), 'PREFIXID', 'PREFIXNAME'),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Prefix')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Prefix')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_gender')->dropDownList(['F' => 'หญิง', 'M' => 'ชาย'], ['prompt' => controllers::t('label', "Enter Gender")])->label(controllers::t('label', 'Gender')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'academic_positions_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(AcademicPositions::find()->all(), 'academic_positions_id', 'academic_positions'),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Academic Ranks')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Academic Ranks')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_position_staff')->textInput(['maxlength' => true])->label(controllers::t('label', 'Position Staff')) ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_name')->textInput(['maxlength' => true])->label(controllers::t('label', 'Name')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_surname')->textInput(['maxlength' => true])->label(controllers::t('label', 'Surname')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_name_eng')->textInput(['maxlength' => true])->label(controllers::t('label', 'Name (Eng)')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_surname_eng')->textInput(['maxlength' => true])->label(controllers::t('label', 'Surname (Eng)')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'faculty_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(RegFaculty::find()->all(), 'FACULTYID', 'FACULTYNAME'),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Faculty')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Faculty Name')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'department_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(RegDepartment::find()->all(), 'DEPARTMENTID', 'DEPARTMENTNAME'),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Department')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Department Name')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_birthdate')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Birth Date')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_marital_status')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ['สมรส' => 'สมรส', 'โสด' => 'โสด', 'หย่าร้าง' => 'หย่าร้าง', 'หม้าย' => 'หม้าย'],
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Marital Status')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Marital Status')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_group_blood')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ['O' => 'O', 'A' => 'A', 'B' => 'B', 'AB' => 'AB'],
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Blood Group')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Blood Group')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_underlying_disease')->textInput(['maxlength' => true])->label(controllers::t('label', 'Underlying Disease')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_religion_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => GetModelController::getReligion(),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Religion')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Religion')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_nation_id')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ArrayHelper::map(RegNation::find()->all(), 'NATIONID', 'NATIONNAME'),
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Nation')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Nation')); ?>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2" class="">
                                        <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                                        <div class="group-info">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label><b><?php echo controllers::t('label', 'Address (Register Home)'); ?></b></label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <br>
                                                                <?= $form->field($model, 'person_home_address')->textInput(['maxlength' => true])->label(controllers::t('label', 'Address')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_home_province')->dropdownList(
                                                                    ArrayHelper::map(Province::find()->all(),
                                                                        'PROVINCE_ID',
                                                                        'PROVINCE_NAME'),
                                                                    [
                                                                        'id'=>'ddl-province',
                                                                        'prompt'=>'เลือกจังหวัด'
                                                                    ])->label(controllers::t('label', 'Province')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_home_amphur')->widget(DepDrop::classname(), [
                                                                    'options'=>['id'=>'ddl-amphur'],
                                                                    'data'=> [],
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province'],
                                                                        'placeholder'=>'เลือกอำเภอ...',
                                                                        'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'Amphur')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_home_district')->widget(DepDrop::classname(), [
                                                                    'data' =>[],
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province', 'ddl-amphur'],
                                                                        'placeholder'=>'เลือกตำบล...',
                                                                        'url'=>Url::to(['/personsystem/address/get-district'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'District')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_home_zipcode')->textInput(['maxlength' => true])->label(controllers::t('label', 'Zipcode')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label><b><?php echo controllers::t('label', 'Address (Current Address)'); ?></b></label>
                                                                <br><br>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                                <?= $form->field($model, 'person_current_address')->textInput(['maxlength' => true])->label(controllers::t('label', 'Address')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_province')->dropdownList(
                                                                    ArrayHelper::map(Province::find()->all(),
                                                                        'PROVINCE_ID',
                                                                        'PROVINCE_NAME'),
                                                                    [
                                                                        'id'=>'ddl-province2',
                                                                        'prompt'=>'เลือกจังหวัด'
                                                                    ])->label(controllers::t('label', 'Province'));?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_amphur')->widget(DepDrop::classname(), [
                                                                    'options'=>['id'=>'ddl-amphur2'],
                                                                    'data'=> [],
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2'],
                                                                        'placeholder'=>'เลือกอำเภอ...',
                                                                        'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'Amphur')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_district')->widget(DepDrop::classname(), [
                                                                    'data' =>[],
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2', 'ddl-amphur2'],
                                                                        'placeholder'=>'เลือกตำบล...',
                                                                        'url'=>Url::to(['/personsystem/address/get-district'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'District'));?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_zipcode')->textInput(['maxlength' => true])->label(controllers::t('label', 'Zipcode')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-3" class="">
                                        <div class="group-info">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_mobile')->textInput(['maxlength' => true])->label(controllers::t('label', 'Phone Number')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_fax')->textInput(['maxlength' => true])->label(controllers::t('label', 'Fax Number')) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_email')->input('email')->label(controllers::t('label', 'Email')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_website')->textInput(['maxlength' => true])->label(controllers::t('label', 'Web Site')) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_line')->textInput(['maxlength' => true])->label('Line ID') ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_facbook')->textInput(['maxlength' => true])->label('Facebook') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--        ---------STEP4---------                      -->
                                    <div id="step-4" class="">
                                        <div class="group-info">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <br>
                                                        <?= $form->field($model, 'person_operate_status')->textInput(['maxlength' => true])->label(controllers::t('label', 'Operational Status')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_start_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control', 'placeholder' => 'YYYY/MM/DD',]
                                                                ])->label(controllers::t('label', 'Start Date')) ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_contract_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Contract Date')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_current_work_place')->textInput(['maxlength' => true])->label(controllers::t('label', 'Current Work Place')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_expire_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Expire Date')) ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_confirmed_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Confirmed Date')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_person_type')->dropDownList(['พนักงานมหาวิทยาลัย' => 'พนักงานมหาวิทยาลัย', 'ลูกจ้างมหาวิทยาลัย' => 'ลูกจ้างมหาวิทยาลัย', 'พนักงานราชการ' => 'พนักงานราชการ', 'ข้าราชการ' => 'ข้าราชการ', 'ลูกจ้างประจำ' => 'ลูกจ้างประจำ', 'ลูกจ้างชั่วคราว' => 'ลูกจ้างชั่วคราว', 'ลูกจ้างชั่วคราวโครงการ' => 'ลูกจ้างชั่วคราวโครงการ'], ['prompt' => controllers::t('label', "Enter Person Type")], ['maxlength' => true])->label(controllers::t('label', 'Person Type')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_pass_probation_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Pass Probation Date')) ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_retire_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Retire Date')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_account_hold')->textInput(['maxlength' => true])->label(controllers::t('label', 'Account Hold')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_position_type')->dropDownList(['วิชาการ' => 'วิชาการ', 'สนับสนุน' => 'สนับสนุน'], ['prompt' => controllers::t('label', "Enter Position Type")], ['maxlength' => true])->label(controllers::t('label', 'Position Type')) ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?= $form->field($model, 'person_decommission_date')->widget(
                                                                    \yii\jui\DatePicker::className(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions' => [
                                                                        'changeMonth' => true,
                                                                        'changeYear' => true,
                                                                    ],
                                                                    'options' => ['class' => 'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t('label', 'Decommission Staff Date')) ?></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_salary')->textInput()->label(controllers::t('label', 'Salary')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_salary_position')->textInput(['maxlength' => true])->label(controllers::t('label', 'Salary Position')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_pension')->textInput(['maxlength' => true])->label(controllers::t('label', 'Pension')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'person_pension_withdraw')->dropDownList(['เงินงบประมาณ' => 'เงินงบประมาณ', 'เงินรายได้' => 'เงินรายได้'], ['prompt' => controllers::t('label', "Enter Pension Withdraw")], ['maxlength' => true])->label(controllers::t('label', 'pension Withdraw')) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <br>
                                                        <?= $form->field($model, 'person_type')->hiddenInput(['value'=> '2'],['disabled' => 'disabled'])->label(false) ?>
                                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        // Step show event
        $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
            //alert("You are on step "+stepNumber+" now");
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
            } else if (stepPosition === 'final') {
                $("#next-btn").addClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
            }
        });

        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function () {
                alert('Finish Clicked');
            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function () {
                $('#smartwizard').smartWizard("reset");
            });

        // Please note enabling option "showStepURLhash" will make navigation conflict for multiple wizard in a page.
        // so that option is disabling => showStepURLhash: false

        // Smart Wizard 1
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'arrows',
            transitionEffect: 'fade',
            showStepURLhash: false,
            toolbarSettings: {
                toolbarPosition: 'both',
                toolbarExtraButtons: [btnFinish, btnCancel]
            }
        });

        // Smart Wizard 2
        $('#smartwizard2').smartWizard({
            selected: 0,
            theme: 'default',
            transitionEffect: 'fade',
            showStepURLhash: false
        });

    });
</script>


