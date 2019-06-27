<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\DatePicker;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\models\Zipcode;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\RegNation;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\ViewStudentFull */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label','Edit Student Information'); ?> : <?= $model->STUDENTCODE ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Forms</a></li>
        <li class="active">Form  Edit Infomation</li>
    </ol>
    <a href="admin-edit-student-list" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="">
            <div class="">
                <div class="tab-content transparent">
                    <div id="tab1_nobg" class="tab-pane active">
                        <!------------------------------------------- แถบระบบข้อมูลบุคคล ----------------------------------------------------------------->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <!------------------------------------------- Student form ----------------------------------------------------------------->
                                <div class="panel-body">
                                    <fieldset>
                                        <br>
                                        <h4><span style="color:#428bca;"><?= controllers::t('label','Student Information'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTID')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Person ID')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTCODE')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Student Code')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'CITIZENID')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','ID Card')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6"><?php
                                                    if($model->STUDENTSEX=="M"){
                                                        $model->STUDENTSEX = "ชาย";
                                                    }else if($model->STUDENTSEX=="F"){
                                                        $model->STUDENTSEX = "หญิง";
                                                    }else{
                                                        $model->STUDENTSEX = "N/A";
                                                    } ?>
                                                    <?= $form->field($model, 'PREFIXNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Prefix')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTSEX')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Gender')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Name')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTSURNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Surname')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTNAMEENG')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Name (Eng)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTSURNAMEENG')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Surname (Eng)')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'BIRTHDATE')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Birth Date')) ?></div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_height')->textInput(['maxlength' => true])->label(controllers::t( 'label','Height')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_weight')->textInput(['maxlength' => true])->label(controllers::t( 'label','Weight')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_marital_status')->dropDownList([ 'โสด' => 'โสด','สมรส' => 'สมรส', 'หย่าร้าง' => 'หย่าร้าง','หม้าย'=>'หม้าย'],['prompt'=> controllers::t('label','Enter Marital Status')])->label(controllers::t( 'label','Marital Status')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_blood_group')->dropDownList(
                                                        ['O' => 'O', 'A' => 'A', 'B' => 'B', 'AB' => 'AB'],['prompt'=> controllers::t('label','Enter Blood Group')])->label(controllers::t( 'label','Blood Group')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_underlying_disease')->textInput(['maxlength' => true])->label(controllers::t( 'label','Underlying Disease')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'RELIGIONID')->dropDownList(GetModelController::getReligion(),['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Religion')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'NATIONID')->dropDownList(GetModelController::getNational(),['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Nation')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->
                                        <br>
                                            <h4><span style="color:#428bca;"><?php echo controllers::t('label','Contact Information'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTMOBILE')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Phone Number (In Register)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_mobile_phone')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Phone Number (In System)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTEMAIL')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Email (In Register)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_email')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Email (In System)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_line_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Line ID')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_facebook_url')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Facebook')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!------------------------------------------- ที่อยู่ ----------------------------------------------------------------->
                                        <br>
                                            <h4><span style="color:#428bca;"><?php echo controllers::t('label','Address'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <?= $form->field($model, 'student_home_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address (Register Home)')) ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <?= $form->field( $model, 'student_home_province_id' )
                                                    ->widget( Select2::classname(), [
                                                    'data' => ArrayHelper::map( Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME' ),
                                                    'options' => ['placeholder' => controllers::t( 'label', 'Enter Province' )],
                                                    'pluginOptions' => [
                                                        'allowClear' => false,
                                                    ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                ] )->label( controllers::t( 'label', 'Province' )); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <?= $form->field( $model, 'student_home_amphur_id' )
                                                    ->widget( Select2::classname(), [
                                                        'data' => ArrayHelper::map( Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME' ),
                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Amphur' )],
                                                        'pluginOptions' => [
                                                            'allowClear' => false,
                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                    ] )->label( controllers::t( 'label', 'Amphur' ) ); ?>
                                                </div>
                                            <div class="col-md-6 col-sm-6">
                                                <?= $form->field( $model, 'student_home_district_id' )
                                                    ->widget( Select2::classname(), [
                                                        'data' => ArrayHelper::map( District::find()->all(), 'DISTRICT_ID', 'DISTRICT_NAME' ),
                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter District' )],
                                                        'pluginOptions' => [
                                                            'allowClear' => false,
                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                    ] )->label( controllers::t( 'label', 'District' ) ); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <?= $form->field( $model, 'student_home_zipcode_id' )
                                                    ->widget( Select2::classname(), [
                                                        'data' => ArrayHelper::map( Zipcode::find()->all(), 'ZIPCODE_ID', 'ZIPCODE' ),
                                                        'options' => ['placeholder' => controllers::t( 'label', 'Enter Zipcode' )],
                                                        'pluginOptions' => [
                                                            'allowClear' => false,
                                                        ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                    ] )->label( controllers::t( 'label', 'Zipcode' ) ); ?>
                                                 </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <?= $form->field($model, 'student_current_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address (Current Address)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'student_current_province_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Province' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Province' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'student_current_amphur_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Amphur' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Amphur' ) ); ?>
                                                   </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'student_current_district_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( District::find()->all(), 'DISTRICT_ID', 'DISTRICT_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter District' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'District' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'student_current_zipcode_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Zipcode::find()->all(), 'ZIPCODE_ID', 'ZIPCODE' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Zipcode' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Zipcode' ) ); ?>
                                                   </div>
                                            </div>
                                        </div>
                                        <!------------------------------------------- บุคคลที่สามารถติดต่อได้ ----------------------------------------------------------------->
                                        <br>
                                        <h4><span style="color:#428bca;"><?php echo controllers::t('label','Person Contact'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Name')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'contact_relation')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Relation')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Phone Number')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4><span style="color:#428bca;"><?php echo controllers::t('label','Work Information'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_working_status')->dropDownList(
                                                        ['ทำงาน' => 'ทำงาน', 'ว่างงาน' => 'ว่างงาน', 'ไม่ได้ทำงาน' => 'ไม่ได้ทำงาน'],['prompt'=> controllers::t('label','Work Status')])->label(controllers::t( 'label','Work Status')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_working_place')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Work Place')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'student_working_salary')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Salary')) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                   </div>

                            </div>

                            <!-- /----- -->
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <fieldset>
                                        <!------------------------------------------- ข้อมูลการศึกษา Tab 1 ----------------------------------------------------------------->
                                        <br>
                                            <h4><span style="color:#428bca;"><?php echo controllers::t('label','Avata'); ?></span></h4><hr>
                                        <div class="col-md-12 col-sm-12">
                                            <?php if($model->student_img!=""){?>
                                                <img width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/System/<?= $model->student_img ?>" height="34" ALIGN=LEFT>
                                            <?php  }else{?>
                                                <img width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/web_personal/upload/noavatar.jpg" height="34" ALIGN=LEFT>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="sky-form">
                                                <div class="col-md-8">
                                              <?= $form->field($model, 'student_img')->fileInput(['options' => ['class' => 'input input-file']])->label("") ?>
                                                   <br>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                        <!------------------------------------------- ข้อมูลผู้ปกครอง ----------------------------------------------------------------->
                                        <br>
                                            <h4><span style="color:#428bca;"><?php echo controllers::t('label','Parent Information'); ?></span></h4><hr>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTFATHERNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Father Name')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_birthday')->widget(\yii\jui\DatePicker::classname(), [
                                                        'language' => 'th',
                                                        'dateFormat' => 'yyyy-MM-dd',
                                                        'clientOptions'=>[
                                                            'changeMonth'=>true,
                                                            'changeYear'=>true,
                                                        ],
                                                        'options'=>['class'=>'form-control']
                                                    ])->label(controllers::t( 'label','Birthday')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_highest_qualification')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Highest Qualification')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_career')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Career')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_work_place')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Work Place')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_income_per_month')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Income Per Month')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_mobile')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Phone Number')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <?= $form->field($model, 'father_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'father_province_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Province' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Province' ) ); ?>
                                                   </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'father_amphur_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Amphur' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Amphur' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'father_district_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( District::find()->all(), 'DISTRICT_ID', 'DISTRICT_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter District' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'District' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'father_zipcode_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Zipcode::find()->all(), 'ZIPCODE_ID', 'ZIPCODE' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Zipcode' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Zipcode' ) ); ?>
                                                     </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'father_religion')->dropDownList(GetModelController::getReligion(),['maxlength' => true,'prompt'=> controllers::t( 'label',"Enter Religion")])->label(controllers::t( 'label','Religion')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'father_nationality' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( RegNation::find()->all(), 'NATIONID', 'NATIONNAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Nation' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Nation' ) ); ?>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'STUDENTMOTHERNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Mother Name')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_birthday')->widget(\yii\jui\DatePicker::classname(), [
                                                        'language' => 'th',
                                                        'dateFormat' => 'yyyy-MM-dd',
                                                        'clientOptions'=>[
                                                            'changeMonth'=>true,
                                                            'changeYear'=>true,
                                                        ],
                                                        'options'=>['class'=>'form-control']
                                                    ])->label(controllers::t( 'label','Birthday')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_highest_qualification')->textInput(['maxlength' => true])->label(controllers::t( 'label','Highest Qualification')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_career')->textInput(['maxlength' => true])->label(controllers::t( 'label','Career')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_work_place')->textInput(['maxlength' => true])->label(controllers::t( 'label','Work Place')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_income_permonth')->textInput(['maxlength' => true])->label(controllers::t( 'label','Income Per Month')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_mobile')->textInput(['maxlength' => true])->label(controllers::t( 'label','Phone Number')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <?= $form->field($model, 'mother_address')->textInput(['maxlength' => true])->label(controllers::t( 'label','Address')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'mother_province_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Province' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Province' ) ); ?>
                                                   </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'mother_amphur_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Amphur' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Amphur' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'mother_district_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( District::find()->all(), 'DISTRICT_ID', 'DISTRICT_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter District' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'District' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'mother_zipcode_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Zipcode::find()->all(), 'ZIPCODE_ID', 'ZIPCODE' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Zipcode' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Zipcode' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'mother_religion')->dropDownList(GetModelController::getReligion(),['maxlength' => true,'prompt'=> controllers::t( 'label',"Enter Religion")])->label(controllers::t( 'label','Religion')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'mother_nationality' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( RegNation::find()->all(), 'NATIONID', 'NATIONNAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Nation' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Nation' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'marital_status_parents')->dropDownList(  ['อยู่ด้วยกัน' => 'อยู่ด้วยกัน', 'หย่าร้าง' => 'หย่าร้าง'],['maxlength' => true,'prompt'=> controllers::t('label','Enter Marital Status')])->label(controllers::t( 'label','Marital Status')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'PARENTNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Parent Name')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'parent_career')->textInput(['maxlength' => true])->label(controllers::t( 'label','Career')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'PARENTPHONENO')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Phone Number (In Register)')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field($model, 'parent_mobile')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Phone Number (In System)')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <?= $form->field($model, 'parent_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'parent_province_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Province' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Province' ) ); ?>
                                                   </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'parent_amphur_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Amphur::find()->all(), 'AMPHUR_ID', 'AMPHUR_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Amphur' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Amphur' ) ); ?>
                                                    </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'parent_district_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( District::find()->all(), 'DISTRICT_ID', 'DISTRICT_NAME' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter District' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'District' ) ); ?>
                                                   </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <?= $form->field( $model, 'parent_zipcode_id' )
                                                        ->widget( Select2::classname(), [
                                                            'data' => ArrayHelper::map( Zipcode::find()->all(), 'ZIPCODE_ID', 'ZIPCODE' ),
                                                            'options' => ['placeholder' => controllers::t( 'label', 'Enter Zipcode' )],
                                                            'pluginOptions' => [
                                                                'allowClear' => false,
                                                            ], 'theme'=> \kartik\select2\Select2::THEME_DEFAULT,
                                                        ] )->label( controllers::t( 'label', 'Zipcode' ) ); ?>
                                                   </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <br>
                                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
                                                <?php ActiveForm::end(); ?></div>
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