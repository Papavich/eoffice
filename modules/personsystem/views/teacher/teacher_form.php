<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
use app\modules\personsystem\models\AcademicPositions;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\Branch;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\PositionDirectors;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\RegDepartment;
use app\modules\personsystem\models\RegFaculty;
use app\modules\personsystem\models\RegLevel;
use app\modules\personsystem\models\RegNation;
use app\modules\personsystem\models\RegOfficer;
use app\modules\personsystem\models\RegPrefix;
use app\modules\personsystem\models\RegProgram;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\RegSchool;
use app\modules\personsystem\models\Zipcode;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>
<header id="page-header">
    <h1>แบบฟอร์มแก้ไขอาจารย์</h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Edit Infomation</li>
    </ol>
    <a href="admin-edit-teacher-list" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
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
            <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <a href="#tab2_nobg" data-toggle="tab">
                    <i class="fa fa-graduation-cap"></i> <?php echo controllers::t( 'label','History Of Education'); ?>
                </a>
            </li>
            <li class="<?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                <a href="#tab3_nobg" data-toggle="tab">
                    <i class="fa fa-line-chart"></i> <?php echo controllers::t( 'label','Expertise'); ?>
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
<!--                            <div id="smartwizard2" class="sw-main sw-theme-dots">-->
                                <ul>
                                    <li><a href="#step-1"> <small>Step 1</small><br/>
                                            <small><?= controllers::t('label', 'Staff Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-2"> <small>Step 2</small><br/>
                                            <small><?= controllers::t('label', 'Address Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-3"> <small>Step 3</small><br/>
                                            <small><?= controllers::t('label', 'Contact Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-4"> <small>Step 4</small><br/>
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
                                                                <?php
                                                                $person = \app\modules\personsystem\models\Person::findOne($id);
                                                                if ($person->person_img!="") { ?>
                                                                    <div class="img-resize">
                                                                        <img width="150" height="150"
                                                                             class="img-thumbnail" alt=""
                                                                             src="<?= Yii::getAlias('@web') ?>/web_personal/upload/person/<?= $person->person_img ?>"
                                                                             height="34" ALIGN=LEFT><br/>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="img-resize">
                                                                        <img width="150" height="150"
                                                                             class="img-thumbnail" alt=""
                                                                             src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg"
                                                                             height="34" ALIGN=LEFT><br/>
                                                                    </div>
                                                                <?php } ?>
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
                                                                <?= $form->field($model, 'person_card_id')->textInput(['maxlength' => true])->label(controllers::t('label','Teacher ID')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_citizen_id')->textInput(['maxlength' => true])->label(controllers::t('label','ID Card'))  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field( $model, 'prefix_id' )
                                                                    ->widget( Select2::classname(), [
                                                                        'data' => ArrayHelper::map( RegPrefix::find()->all(), 'PREFIXID', 'PREFIXNAME' ),
                                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Prefix' )],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ] )->label( controllers::t( 'label', 'Prefix' ) ); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_gender')->dropDownList(['F' => 'หญิง', 'M' => 'ชาย'],['prompt'=> controllers::t( 'label',"Enter Gender")])->label(controllers::t('label','Gender')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field( $model, 'academic_positions_id' )
                                                                    ->widget( Select2::classname(), [
                                                                        'data' => ArrayHelper::map( AcademicPositions::find()->all(), 'academic_positions_id', 'academic_positions' ),
                                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Academic Ranks' )],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ] )->label( controllers::t( 'label', 'Academic Ranks' ) ); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field( $model, 'major_id' )
                                                                    ->widget( Select2::classname(), [
                                                                        'data' => GetModelController::getMajor(),
                                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Lecturer' )],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ] )->label( controllers::t( 'label', 'Lecturer' ) ); ?>
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_name')->textInput(['maxlength' => true])->label(controllers::t('label','Name')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_surname')->textInput(['maxlength' => true])->label(controllers::t('label','Surname')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_name_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Name (Eng)')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_surname_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Surname (Eng)')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?php
                                                                $dataCategory=ArrayHelper::map(RegFaculty::find()->all(), 'FACULTYID', 'FACULTYNAME');
                                                                echo $form->field($model, 'faculty_id')->dropDownList($dataCategory,
                                                                    ['prompt' => '-Choose a Category-',
                                                                        'onchange' => '
				                                                            $.post( "' . Yii::$app->urlManager->createUrl('personsystem/profile/lists?id=') . '"+$(this).val(), function( data ) {
				                                                            $( "select#DEPARTMENTID" ).html( data );});
			                                                           '])->label(controllers::t('label', 'Faculty Name'));
                                                                ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?php
                                                                $dataPost=ArrayHelper::map(RegDepartment::find()->asArray()->all(), 'DEPARTMENTID', 'DEPARTMENTNAME');
                                                                echo  $form->field($model, 'department_id')
                                                                    ->dropDownList(
                                                                        $dataPost,
                                                                        ['id'=>'DEPARTMENTID']
                                                                    )->label(controllers::t('label', 'Department Name'));
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_birthdate')->widget(\yii\jui\DatePicker::classname(), [
                                                                    'language' => 'th',
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'clientOptions'=>[
                                                                        'changeMonth'=>true,
                                                                        'changeYear'=>true,
                                                                    ],
                                                                    'options'=>['class'=>'form-control','placeholder' => 'YYYY/MM/DD']
                                                                ])->label(controllers::t( 'label','Birthday')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_marital_status')->dropDownList(['สมรส' => 'สมรส', 'โสด' => 'โสด', 'หย่าร้าง' => 'หย่าร้าง','หม้าย'=>'หม้าย'],['prompt'=> controllers::t( 'label',"Enter Marital Status")])->label(controllers::t('label','Marital Status')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_group_blood')->dropDownList(['O' => 'O', 'A' => 'A', 'B' => 'B', 'AB' => 'AB'],['prompt'=> controllers::t( 'label',"Enter Blood Group")])->label(controllers::t('label','Blood Group')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_underlying_disease')->textInput(['maxlength' => true])->label(controllers::t('label','Underlying Disease')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_religion_id')->dropDownList(GetModelController::getReligion(),['prompt'=> controllers::t( 'label',"Enter Religion")])->label(controllers::t('label','Religion')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field( $model, 'person_nation_id' )
                                                                    ->widget( Select2::classname(), [
                                                                        'data' => ArrayHelper::map( RegNation::find()->all(), 'NATIONID', 'NATIONNAME' ),
                                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Nation' )],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ] )->label( controllers::t( 'label', 'Nation' ) ); ?>
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
                                                                    'data'=> $amphurHome,
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
                                                                    'data' =>$districtHome,
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
                                                                    ])->label(controllers::t('label', 'Province')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_amphur')->widget(DepDrop::classname(), [
                                                                    'options'=>['id'=>'ddl-amphur2'],
                                                                    'data'=> $amphurCurrent,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2'],
                                                                        'placeholder'=>'เลือกอำเภอ...',
                                                                        'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'Amphur')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'person_current_district')->widget(DepDrop::classname(), [
                                                                    'data' =>$districtCurrent,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2', 'ddl-amphur2'],
                                                                        'placeholder'=>'เลือกตำบล...',
                                                                        'url'=>Url::to(['/personsystem/address/get-district'])
                                                                    ]
                                                                ])->label(controllers::t('label', 'District')); ?>
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
            <div id="tab2_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==2){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body"><br>
                            <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel History Education') ?></span></h4>
                            <?= \yii\grid\GridView::widget([
                                'dataProvider' => $dataProviderEdu,
                                //'filterModel' => $searchModelEdu,
                                'layout' => '{items}{summary}{pager}',
                                'tableOptions' => [
                                    'class' => 'table  table-bordered table-hover dataTable ',
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'header'=> controllers::t('label','Level Education'),
                                        'attribute'=> 'level_education',
                                    ],
                                    [
                                        'header'=> controllers::t('label','Qualification'),
                                        'attribute'=> 'educational_background',
                                    ],
//                                    [
//                                        'header'=> controllers::t('label','Qualification (Eng)'),
//                                        'attribute'=> 'educational_background_eng',
//                                    ],
                                    [
                                        'header'=> controllers::t('label','Educational Institution'),
                                        'attribute'=> 'educational_institution',
                                    ],
                                    [
                                        'header'=> controllers::t('label','Graduate Year'),
                                        'attribute'=> 'graduate_year',
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'buttons'=>[
                                            'data-method' => 'post',
                                            'view' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',['teacher/edu-view','id'=>$model->history_education_id]);
                                            },
                                            'update' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['teacher/edu-update','id'=>$model->history_education_id,]);
                                            },
                                            'delete' => function($url,$model,$key){
                                                return Html::a('<i class="glyphicon glyphicon-trash"></i>',['teacher/edu-delete','id'=>$model->history_education_id,'person'=>$model->person_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                            }
                                        ],
                                        ],
                                ],
                            ]); ?>
                            <div class="col-md-12" align="right">
                                <a href="edu-create?person=<?= $model->person_id ?>" type="button" class="btn btn-success btn-3d"><i class="fa fa-plus-square"></i><?php echo controllers::t('label','Create'); ?></a><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab3_nobg" class="tab-pane <?php if(!empty($_GET["active"])&& $_GET["active"]==3){echo "active";} ?>">
                <!------------------------------------------- แถบ1 ----------------------------------------------------------------->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                    <h4><span style="color:#428bca;"><?= controllers::t('label','Add Expertise') ?></span></h4>
                                    </div>
                                    <?php $form = ActiveForm::begin(['action'=>'exper-create?id='.$model->person_id]); ?>
                                    <div class="col-md-6 col-sm-6">
                                        <?= $form->field($modelExper, 'expertise_field_name')->textInput(['maxlength' => true])->label(controllers::t('label','Expertise')) ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?= $form->field($modelExper, 'expertise_field_name_eng')->textInput(['maxlength' => true])->label(controllers::t('label','Expertise (Eng)')) ?>
                                    </div>
                                        <?= $form->field($modelExper, 'person_id')->hiddenInput(['value'=> $model->person_id],['disabled' => 'disabled'])->label(false) ?>
                                    <div class="col-md-12">
                                    <?= Html::submitButton(controllers::t('label', 'Save'), ['class' => 'btn btn-success btn-3d']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div><br>
                            <h4><span style="color:#428bca;"><?= controllers::t('label','Tabel Expertise') ?></span></h4>
                            <?= \yii\grid\GridView::widget([
                                'dataProvider' => $dataProviderExper,
                                //'filterModel' => $searchModelExper,
                                'layout' => '{items}{summary}{pager}',
                                'tableOptions' => [
                                    'class' => 'table  table-bordered table-hover dataTable ',
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'header'=> controllers::t('label','Expertise'),
                                        'attribute'=> 'expertise_field_name',
                                    ],
                                    [
                                        'header'=> controllers::t('label','Expertise (Eng)'),
                                        'attribute'=> 'expertise_field_name_eng',
                                    ],

                                    ['class' => 'yii\grid\ActionColumn',
                                        'template'=>'{update}{delete}',
                                      'buttons'=>[
                                        'data-method' => 'post',
                                        'update' => function($url,$model,$key){
                                         return Html::a('<i class="glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;',['teacher/exper-update','id'=>$model->expertise_id,]);
                                        },
                                        'delete' => function($url,$model,$key){
                                        return Html::a('&nbsp;<i class="glyphicon glyphicon-trash"></i>',['teacher/exper-delete','id'=>$model->expertise_id,'person'=>$model->person_id],['onClick' => 'return confirm("Are you sure you want to delete this item?")']);
                                        }
                            ],
                                    ],
                                ],
                            ]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>

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


