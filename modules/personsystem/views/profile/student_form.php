<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\personsystem\controllers;
use app\modules\personsystem\controllers\GetModelController;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\models\Zipcode;
use app\modules\personsystem\models\RegReligion;
use app\modules\personsystem\models\Province;
use app\modules\personsystem\models\District;
use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\RegNation;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\ViewStudentFull */
/* @var $form yii\widgets\ActiveForm */
?>
    <!-- page title -->
    <header id="page-header">
        <h1>Profile</h1>  <?= $model->STUDENTSTATUS ?>
        <ol class="breadcrumb">
            <li><a href="#">Forms</a></li>
            <li class="active">Form Edit Infomation</li>
        </ol>
    </header>
    <div id="content" class="padding-20">
        <div class="row">
            <!-- tabs -->
            <ul class="nav nav-tabs" style="margin-left: 14px;">
                <li class="<?php if (empty($_GET["active"])) {echo "active"; } ?>">
                    <a href="#tab1_nobg" data-toggle="tab">
                        <i class="fa fa-user"></i> <?php echo controllers::t('label', 'Basic Information'); ?>
                    </a>
                </li>
                <li class="<?php if (!empty($_GET["active"]) && $_GET["active"] == 2) {
                    echo "active";
                } ?>">
                    <a href="#tab2_nobg" data-toggle="tab">
                        <i class="fa fa-gears"></i> <?php echo controllers::t('label', 'Reset Password'); ?>
                    </a>
                </li>
            </ul>
            <!-- tabs1 content -->
            <div class="tab-content transparent">
                <div id="tab1_nobg" class="tab-pane active">
                    <!------------------------------------------- แถบระบบข้อมูลบุคคล ----------------------------------------------------------------->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div id="smartwizard2">
                                <ul>
                                    <li><a href="#step-1">Step 1<br/>
                                            <small><?= controllers::t('label', 'Student Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-2">Step 2<br/>
                                            <small><?= controllers::t('label', 'Address Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-3">Step 3<br/>
                                            <small><?= controllers::t('label', 'Contact Information'); ?></small>
                                        </a></li>
                                    <li><a href="#step-4">Step 4<br/>
                                            <small><?= controllers::t('label', 'Parent Information'); ?></small>
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
                                                                $student = \app\modules\personsystem\models\Student::findOne(\Yii::$app->user->identity->person_id);
                                                                if ($student->student_img != "") { ?>
                                                                    <div class="img-resize">
                                                                        <img width="150" height="150"
                                                                             class="img-thumbnail" alt=""
                                                                             src="<?= Yii::getAlias('@web') ?>/web_personal/upload/System/<?= $model->student_img ?>"
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
                                                                <?= $form->field($model, 'student_img')->fileInput(['options' => ['class' => 'input input-file']])->label("") ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Row2 -->
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'STUDENTCODE')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Student Code')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'CITIZENID')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','ID Card')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'STUDENTNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Name')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'STUDENTSURNAME')->textInput(['maxlength' => true,'disabled' => 'disabled'])->label(controllers::t( 'label','Surname')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_height')->textInput(['maxlength' => true])->label(controllers::t( 'label','Height')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_weight')->textInput(['maxlength' => true])->label(controllers::t( 'label','Weight')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_marital_status')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => [ 'โสด' => 'โสด','สมรส' => 'สมรส', 'หย่าร้าง' => 'หย่าร้าง','หม้าย'=>'หม้าย'],
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Marital Status')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Marital Status')); ?>
                                                                </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_blood_group')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ['O' => 'O', 'A' => 'A', 'B' => 'B', 'AB' => 'AB'],
                                                                        'options' => ['placeholder' => controllers::t('label', 'Enter Blood Group')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Blood Group')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_underlying_disease')->textInput(['maxlength' => true])->label(controllers::t( 'label','Underlying Disease')) ?>
                                                            </div>
                                                        </div>
                                                    </div> <br\><br/>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                            <label><b><?php echo controllers::t('label', 'Work Information'); ?></b></label><br/>
                                                            </div>
                                                        </div>
                                                    </div><br/>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_working_status')
                                                                    ->widget(Select2::classname(), [
                                                                        'data' => ['ทำงาน' => 'ทำงาน', 'ว่างงาน' => 'ว่างงาน', 'ไม่ได้ทำงาน' => 'ไม่ได้ทำงาน'],
                                                                        'options' => ['placeholder' => controllers::t('label', 'Work Status')],
                                                                        'pluginOptions' => [
                                                                            'allowClear' => false,
                                                                        ], 'theme' => \kartik\select2\Select2::THEME_DEFAULT,
                                                                    ])->label(controllers::t('label', 'Work Status')); ?>
                                                                </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_working_place')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Work Place')) ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_working_salary')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Salary')) ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br\><br/>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label><b><?php echo controllers::t('label', 'Skill'); ?></b></label><br/>
                                                            </div>
                                                        </div>
                                                    </div><br/>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?= $form->field( $modelStudent, 'skills' )->widget( Select2::classname(), [
                                                                    'data' => ArrayHelper::map(\app\modules\personsystem\models\Skill::find()->all(), 'id_skill', 'skill_name' ),
                                                                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Tools used' ), 'multiple' => true],
                                                                    'pluginOptions' => [
                                                                        'tags' => true,
                                                                        'allowClear' => true,
                                                                        'tokenSeparators' => [','],
                                                                        'maximumInputLength' => 30
                                                                    ],
                                                                ] )->label( controllers::t( 'label', 'Skill Programming' ) );
                                                                ?></div>
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
                                                            <?= $form->field($model, 'student_home_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_home_province_id')->dropdownList(
                                                                    ArrayHelper::map(Province::find()->all(),
                                                                        'PROVINCE_ID',
                                                                        'PROVINCE_NAME'),
                                                                    [
                                                                        'id'=>'ddl-province',
                                                                        'prompt'=>'เลือกจังหวัด'
                                                                    ])->label( controllers::t( 'label', 'Province'));?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_home_amphur_id')->widget(DepDrop::classname(), [
                                                                    'options'=>['id'=>'ddl-amphur'],
                                                                    'data' => $amphurHome,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province'],
                                                                        'placeholder'=>'เลือกอำเภอ...',
                                                                        'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                    ]
                                                                ])->label( controllers::t( 'label', 'Amphur')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_home_district_id')->widget(DepDrop::classname(), [
                                                                    'data' => $districtHome,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province', 'ddl-amphur'],
                                                                        'placeholder'=>'เลือกตำบล...',
                                                                        'url'=>Url::to(['/personsystem/address/get-district'])
                                                                    ]
                                                                ])->label( controllers::t( 'label', 'District')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_home_zipcode_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Zipcode')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12">
                                                                <label><b><?php echo controllers::t('label', 'Address (Current Address)'); ?></b></label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <br>
                                                                <?= $form->field($model, 'student_home_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_current_province_id')->dropdownList(
                                                                    ArrayHelper::map(Province::find()->all(),
                                                                        'PROVINCE_ID',
                                                                        'PROVINCE_NAME'),
                                                                    [
                                                                        'id'=>'ddl-province2',
                                                                        'prompt'=>'เลือกจังหวัด'
                                                                    ])->label( controllers::t( 'label', 'Province')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_current_amphur_id')->widget(DepDrop::classname(), [
                                                                    'options'=>['id'=>'ddl-amphur2'],
                                                                    'data' => $amphurCurrent,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2'],
                                                                        'placeholder'=>'เลือกอำเภอ...',
                                                                        'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                    ]
                                                                ])->label( controllers::t( 'label', 'Amphur')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_current_district_id')->widget(DepDrop::classname(), [
                                                                    'data' => $districtCurrent,
                                                                    'pluginOptions'=>[
                                                                        'depends'=>['ddl-province2', 'ddl-amphur2'],
                                                                        'placeholder'=>'เลือกตำบล...',
                                                                        'url'=>Url::to(['/personsystem/address/get-district'])
                                                                    ]
                                                                ])->label( controllers::t( 'label', 'District')); ?>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <?= $form->field($model, 'student_current_zipcode_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Zipcode')) ?>
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
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?php echo controllers::t('label', 'Contact Information'); ?></b></label><br/>
                                                    </div>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'student_mobile_phone')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Phone Number')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'student_email')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Email')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'student_line_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Line ID')) ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <?= $form->field($model, 'student_facebook_url')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Facebook')) ?><br/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label><b><?php echo controllers::t('label', 'Person Contact'); ?></b></label><br/>
                                                    </div>
                                                </div>
                                            </div><br/>
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
                                        </div>
                                    </div>
                                        <!--                       ---------STEP4---------                      -->
                                        <div id="step-4" class="">
                                            <div class="group-info">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6">
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
                                                                                        'options'=>['class'=>'form-control','placeholder' => 'YYYY/MM/DD']
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
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <?= $form->field($model, 'father_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'father_province_id')->dropdownList(
                                                                                ArrayHelper::map(Province::find()->all(),
                                                                                    'PROVINCE_ID',
                                                                                    'PROVINCE_NAME'),
                                                                                [
                                                                                    'id'=>'ddl-province3',
                                                                                    'prompt'=>'เลือกจังหวัด'
                                                                                ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'father_amphur_id')->widget(DepDrop::classname(), [
                                                                                'options'=>['id'=>'ddl-amphur3'],
                                                                                'data'=> $amphurFather,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province3'],
                                                                                    'placeholder'=>'เลือกอำเภอ...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'father_district_id')->widget(DepDrop::classname(), [
                                                                                'data' =>$districtFather,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province3', 'ddl-amphur3'],
                                                                                    'placeholder'=>'เลือกตำบล...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-district'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'father_zipcode_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Zipcode')) ?>
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
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6">
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
                                                                                        'options'=>['class'=>'form-control','placeholder' => 'YYYY/MM/DD']
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
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <?= $form->field($model, 'marital_status_parents')->dropDownList(  ['อยู่ด้วยกัน' => 'อยู่ด้วยกัน', 'หย่าร้าง' => 'หย่าร้าง'],['maxlength' => true,'prompt'=> controllers::t('label','Enter Marital Status')])->label(controllers::t( 'label','Marital Status')) ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <?= $form->field($model, 'mother_address')->textInput(['maxlength' => true])->label(controllers::t( 'label','Address')) ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'mother_province_id')->dropdownList(
                                                                                ArrayHelper::map(Province::find()->all(),
                                                                                    'PROVINCE_ID',
                                                                                    'PROVINCE_NAME'),
                                                                                [
                                                                                    'id'=>'ddl-province4',
                                                                                    'prompt'=>'เลือกจังหวัด'
                                                                                ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'mother_amphur_id')->widget(DepDrop::classname(), [
                                                                                'options'=>['id'=>'ddl-amphur4'],
                                                                                'data'=> $amphurMother,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province4'],
                                                                                    'placeholder'=>'เลือกอำเภอ...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'mother_district_id')->widget(DepDrop::classname(), [
                                                                                'data' =>$districtMother,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province4', 'ddl-amphur4'],
                                                                                    'placeholder'=>'เลือกตำบล...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-district'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'mother_zipcode_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Zipcode')) ?>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-sm-6">
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
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <?= $form->field($model, 'parent_address')->textarea(['maxlength' => true,])->label(controllers::t( 'label','Address')) ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'parent_province_id')->dropdownList(
                                                                                ArrayHelper::map(Province::find()->all(),
                                                                                    'PROVINCE_ID',
                                                                                    'PROVINCE_NAME'),
                                                                                [
                                                                                    'id'=>'ddl-province5',
                                                                                    'prompt'=>'เลือกจังหวัด'
                                                                                ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'parent_amphur_id')->widget(DepDrop::classname(), [
                                                                                'options'=>['id'=>'ddl-amphur5'],
                                                                                'data'=> $amphurParent,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province5'],
                                                                                    'placeholder'=>'เลือกอำเภอ...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-amphur'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'parent_district_id')->widget(DepDrop::classname(), [
                                                                                'data' =>$districtParent,
                                                                                'pluginOptions'=>[
                                                                                    'depends'=>['ddl-province5', 'ddl-amphur5'],
                                                                                    'placeholder'=>'เลือกตำบล...',
                                                                                    'url'=>Url::to(['/personsystem/address/get-district'])
                                                                                ]
                                                                            ]); ?>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-6">
                                                                            <?= $form->field($model, 'parent_zipcode_id')->textInput(['maxlength' => true,])->label(controllers::t( 'label','Zipcode')) ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                </div>
                <div id="tab2_nobg" class="tab-pane">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body"><br>
                                <h4><span style="color:#428bca;"><?= controllers::t('label','Reset Password') ?></span></h4>
                                <?php $form = ActiveForm::begin(['action' => Yii::getAlias('@web').'/user/settings/account','id'=>'myform2' ]);?>
                                <?php  //$form = ActiveForm::begin(['action' => 'confirm-password-staff','id'=>'myform2' ]); ?>
                                <div class="col-md-6">
                                    <?= $form->field($modelReset, 'email') ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($modelReset, 'username') ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($modelReset, 'current_password')->passwordInput() ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="password"><?= controllers::t('label','New Password') ?></label>
                                    <?= $form->field($modelReset, 'new_password')->passwordInput(['id' => 'password'])->label(false) ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="password_again"><?= controllers::t('label','New Password Again') ?></label>
                                    <input type="password"  id="password_again"name="password_again" class="form-control" ><br/>
                                </div>
                                <div class="col-md-6" >
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6" align="right"><br/>
                                        <?= Html::submitButton(Yii::t('user', 'Save'),  ['class' => 'btn btn-success','id'=>'btn1']) ?><br>
                                    </div>
                                </div>
                                <hr/>

                                <?php ActiveForm::end(); ?>
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
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type='text/javascript'>
  //
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $("#myform2").validate({
    rules: {
      password: "required",
      password_again: {
        equalTo: "#password"
      }
    }
  });

  $("#btn1").click(function(){
    var password = $("#password").val();
    var confirmPassword = $("#password_again").val();
    if (password != confirmPassword){
      swal("รหัสผ่านไม่ตรงกัน", "Passwords do not match!");
      event.preventDefault();
    }else if(password == '' || confirmPassword == ''){
      swal("รหัสผ่านใหม่ว่างเปล่า", "Password is NULL!");
      event.preventDefault();
    }
    else{
      swal("รหัสผ่านถูกต้อง", "Correct");
    }
    $(document).ready(function () {
      $("#password, #password_again").keyup(checkPasswordMatch);
    });
  });
</script>