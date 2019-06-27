<?php
use app\modules\eoffice_eolm\models\model_main\EofficeMainProvince;
use app\modules\eoffice_eolm\models\EolmBudgettype;
use app\modules\eoffice_eolm\models\EolmBudgetplan;
use app\modules\eoffice_eolm\models\EolmExpenditurecategoty;
use app\modules\eoffice_eolm\models\EolmVehicleType;
use app\modules\eoffice_eolm\models\ProjectSub;
use app\modules\eoffice_eolm\models\EolmType;
use app\modules\eoffice_eolm\models\Person;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use app\modules\eoffice_eolm\models\model_main\EofficeMainPerson;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewStudentFull;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_eolm\assets\AppAssetEolm;
use app\modules\eoffice_eolm\controllers;




/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmApprovalform */
/* @var $form yii\widgets\ActiveForm */
AppAssetEolm::register( $this );
?>

<div class="eolm-approvalform-form">
    <!--<div class="panel-heading panel-heading-transparent">
        <h5 align = "right"><?/*= controllers::t( 'label_appform','travel request')*/?></h5>
    </div>-->
    <?php $form = ActiveForm::begin([

    ]); ?>

    <div class="col-md-6">
        <div class="panel panel-info ">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <!-- วันที่ -->
                        <?= $form->field($model, 'eolm_app_date')->input('date',['class'=>'form-control'/*,'value'=> date("Y-m-d"),'disabled' => true*/])->label(controllers::t( 'label_appform','Date') ) ?>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12 col-sm-12">
                        <?= $form->field($model, 'eolm_app_subject')->textarea(['rows' => '4'])->label(controllers::t( 'label_appform','Subject')) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <!-- อาจารย์ผู้ขออนุมัติ --->
                        <?=$form->field($model, 'person_ids1')
                            ->dropDownList(
                                ArrayHelper::map(EofficeMainViewPisPerson::find()->asArray()->where(['person_type' => 1])->all(), 'person_id' ,
                                    function($model) {
                                        return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'];
                                }
                        ))->label(controllers::t( 'label_appform','User approval'))
                        ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- จังหวัด -->
                        <?= $form->field($model, 'provinces')->widget(Select2::className(), [
                            'model' => $model,
                            'attribute' => 'provinces',
                            'data' => ArrayHelper::map(EofficeMainProvince::find()->asArray()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
                            'options' => [
                                'multiple' => true,
                                'placeholder' => controllers::t( 'label_appform','Select...')
                            ],
                            'pluginOptions' => [
                                /*'EolmProvs' => true,*/
                                'allowClear' => true,
                            ],
                        ])->label(controllers::t( 'label_appform','Province') ) ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <!-- ผู้ติดตาม -->
                        <?= $form->field($model, 'person_ids')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(EofficeMainViewPisPerson::find()->where(['person_type' => 1])->all(), 'person_id', function($model) {
                                return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'];
                            } /*'ใส่ชื่อและนามสกุล'*/),
                            'model' => $model,
                            'attribute' => 'person_ids',
                            'language' => 'th',
                            'options' => ['placeholder' => controllers::t( 'label_appform','Select...')],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ],
                        ])->label(controllers::t( 'label_appform','Follower') ) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- นักศึกษาที่ไปด้วย -->
                        <?= $form->field($model, 'person_ids2')->widget(Select2::className(), [
                            'data' => ArrayHelper::map(EofficeMainViewStudentFull::find()/*->where(['type_id' => 3])*/->all(), 'STUDENTID', function($model) {
                                return $model['STUDENTNAME'].' '.$model['STUDENTSURNAME'];
                            } /*'ใส่ชื่อและนามสกุล'*/),
                            'model' => $model,
                            'attribute' => 'person_ids2',
                            'language' => 'th',
                            'options' => ['placeholder' => controllers::t( 'label_appform','Select...')],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ],
                        ])->label(controllers::t( 'label_appform','Student follower') ) ?>
                    </div>

                </div>
                <?php if ($model->eolm_status_id == 3){
                echo '<div class="row">
                    <div class="col-md-6 col-sm-6">
                         '.$form->field($model, 'eolm_app_number')->textInput()->label(controllers::t( 'label_appform','MOE')).'
                    </div>
                    <div class="col-md-6 col-sm-6">
                         '.$form->field($model, 'eolm_app_number2')->textInput()->label(controllers::t( 'label_appform','MOE')).'
                    </div>
                </div>';
                 }?>

            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="panel panel-info ">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <!-- ออกเดินทางจากที่พัก/ที่ทำงานตั้งแต่วันที่่ -->
                        <?= $form->field($model, 'eolm_app_deprture_date')->input('date'/*,['style'=>'width:180px']*/)->label(controllers::t( 'label_appform','Day of departure') ) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <!-- เดินทางกลับถึงที่พัก/ที่ทำงานในวันที -->
                        <?= $form->field($model, 'eolm_app_retuen_date')->input('date'/*,['style'=>'width:180px']*/)->label(controllers::t( 'label_appform','Day of return')  ) ?>
                    </div>
                </div>
                <div class="row">
                    <!---div class="col-md-6 col-sm-6">
                        <?=$form->field($model, 'eolm_app_number', [
                        ])->textInput(['maxlength' => true,'disabled' => true])->label(controllers::t( 'label_appform','MOE')  ) ?>
                    </div-->
                    <div class="col-md-12 col-sm-12">
                        <!-- โครงการ -->
                        <?=
                        $form->field($model, 'pro_id')
                            ->dropDownList(
                                ArrayHelper::map(ProjectSub::find()->asArray()->all(), 'ProSub_id', 'ProSub_name')
                            )->label(controllers::t( 'label_appform','The project') ) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?=
                        $form->field($model, 'eolm_budp_id')
                            ->dropDownList(
                                ArrayHelper::map(EolmBudgetplan::find()->asArray()->all(), 'eolm_budp_id', 'eolm_budp_name')
                            )->label(controllers::t( 'label_appform','From budget plan') ) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?=
                        $form->field($model, 'eolm_exp_id')
                            ->dropDownList(
                                ArrayHelper::map(EolmExpenditurecategoty::find()->asArray()->all(), 'eolm_exp_id', 'eolm_exp_name')
                            )->label(controllers::t( 'label_appform','Group disbursement') ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <?= $form->field($model, 'eolm_app_event_date')->input('date')->label(controllers::t( 'label_appform','Date event')) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        $model->eolm_budt_id = '1';
                        echo $form->field($model, 'eolm_budt_id')->radioList(
                            ArrayHelper::map(EolmBudgettype::find()->asArray()->all(), 'eolm_budt_id', 'eolm_budt_name'), [/*'separator' => '<br>',*/'itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]]
                        )->label(controllers::t( 'label_appform','Budgets') ) ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <!-- แนบลิงค์ -->
                        <?= $form->field($model, 'eolm_link')->textInput(['maxlength' => true])->label(controllers::t( 'label_appform','Link')) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <!-- ประเภทการไปราชการ -->
                        <?=
                        $form->field($model, 'eolm_type_id')
                            ->dropDownList(
                                ArrayHelper::map(EolmType::find()->asArray()->all(), 'eolm_type_id', 'eolm_type_name')
                            )->label(controllers::t( 'label_appform','Type to be on duty as a civil servan')) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php /*echo $form->field($model, 'eolm_budget_year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                        'yearStart' => 543,
                        'yearEnd' => 548,
                    ])->label('ปีงบประมาณ') */?>
                        <?= $form->field($model, 'eolm_budget_year')->textInput(['value'=>date("Y") +543])->label(controllers::t( 'label_appform','Budget year')) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <div class="row">
            <?= Html::a(controllers::t( 'label','Back'), Yii::$app->request->referrer,['class' => 'btn btn-primary']);?>

            <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label','Save') : controllers::t( 'label','Update'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'save']) ?>
        </div>

    </div>








    <?php ActiveForm::end(); ?>
</div>

