<?php
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainProvince;

use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisUser;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewStudentFull;
use app\modules\eoffice_eolmv2\models\EolmBudgettype;
use app\modules\eoffice_eolmv2\models\EolmBudgetplan;
use app\modules\eoffice_eolmv2\models\EolmExpenditurecategoty;
use app\modules\eoffice_eolmv2\models\EolmVehicleType;
use app\modules\eoffice_eolmv2\models\ProjectSub;
use app\modules\eoffice_eolmv2\models\EolmType;
use app\modules\eoffice_eolmv2\models\Person;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_eolmv2\assets\AppAssetEolm;
use app\modules\eoffice_eolmv2\controllers;




/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmApprovalform */
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
                        <?= $form->field($model, 'eolm_app_subject')->textarea(['rows' => '2'])->label(controllers::t( 'label_appform','Subject') ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <!-- อาจารย์ผู้ขออนุมัติ --->
                        <?php
                        $per = EofficeMainViewPisUser::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
                        $txt=$per->getAttribute('person_id');
                        $model->person_ids1 = $txt;
                        $command = 'SELECT * FROM eoffice_central.view_pis_person WHERE person_id ='.$per->getAttribute('person_id');
                        $user = EofficeMainViewPisPerson::findBySql($command)->one();
                        ?>
                        <!--?/*=
                        $form->field($model, 'person_ids1')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(EofficeMainViewPisPerson::find()->where(['person_type' => 1])->all(), 'person_id', function($model) {
                                return $model['person_name'].' '.$model['person_surname'];
                            } /*'ใส่ชื่อและนามสกุล'*/),
                            'theme' => Select2::THEME_DEFAULT,
                            'language' => 'th',
                            'options' => ['placeholder' => controllers::t( 'label_appform','Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(controllers::t( 'label_appform','Applicant') ) */? -->
                        <label><?= controllers::t( 'label_appform','User approval');?></label>
                        <input type="text" class="form-control" disabled value="<?php echo $user->academic_positions_abb_thai ;?> <?php echo $user->person_name ;?>  <?php echo $user->person_surname ;?>" >

                        <?php $model->person_ids1 = $txt;
                       echo $form->field($model, 'person_ids1')->hiddenInput()->label(false) ?>
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
                        ])->label(controllers::t( 'label_appform','Province')) ?>
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
                        <?= $form->field($model, 'eolm_app_return_date')->input('date'/*,['style'=>'width:180px']*/)->label(controllers::t( 'label_appform','Day of return')  ) ?>
                    </div>
                </div>


                <div class="row">

                    <div class="col-sm-6 col-md-6">
                        <?= $form->field($model, 'eolm_app_event_date')->input('date')->label(controllers::t( 'label_appform','Date event') ) ?>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <!-- แนบลิงค์ -->
                        <?= $form->field($model, 'eolm_link')->textInput(['maxlength' => true])->label(controllers::t( 'label_appform','Link') ) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <!-- ประเภทการไปราชการ -->
                        <?=
                        $form->field($model, 'eolm_type_id')
                            ->dropDownList(
                                ArrayHelper::map(EolmType::find()->asArray()->all(), 'eolm_type_id', 'eolm_type_name')
                            )->label(controllers::t( 'label_appform','Type to be on duty as a civil servan') ) ?>
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
    <div class="col-md-12">
        <div class="row">
            <?= $form->field($model, 'eolm_status_id')->hiddenInput(['value'=> '1'])->label(false); ?><!-- ซ่อน input set เป็น รอการตรวจสอบ=1 -->
            <div class="form-group text-center">
                <?= Html::a(controllers::t( 'label','Back'), Yii::$app->request->referrer,['class' => 'btn btn-primary']);?>

                <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label','Save') : controllers::t( 'label','Update'), [
                    'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'save']) ?>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
/*$this->registerJs("
    $(document).ready(function() {
        if($('#eolmapprovalform-vdate1').val().length==0){
            $('#eolmapprovalform-vdate1').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount1').attr('disabled', !this.checked);
        }
        if($('#eolmapprovalform-vdate2').val().length==0){
            $('#eolmapprovalform-vdate2').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount2').attr('disabled', !this.checked);
        }
        if($('#eolmapprovalform-vehicle_detail3').val().length == 0){
           $('#eolmapprovalform-vehicle_detail3').attr('disabled', !this.checked);
           $('#eolmapprovalform-vdate3').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount3').attr('disabled', !this.checked);
        }
        if($('#eolmapprovalform-vehicle_detail4').val().length==0){
            $('#eolmapprovalform-vehicle_detail4').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate4').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount4').attr('disabled', !this.checked);
        }
        if($('#eolmapprovalform-vehicle_detail5').val().length==0){
            $('#eolmapprovalform-vehicle_detail5').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate5').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount5').attr('disabled', !this.checked);
        }
        if($('#eolmapprovalform-vehicle_detail6').val().length==0){
            $('#eolmapprovalform-vehicle_detail6').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate6').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount6').attr('disabled', !this.checked);
        }
    });
    $('#eolmapprovalform-vehicle1').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vdate1').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount1').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vdate1').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate1').val(\"\");
            $('#eolmapprovalform-vamount1').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount1').val(\"\");
        }
    })
    $('#eolmapprovalform-vehicle2').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vdate2').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount2').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vdate2').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate2').val(\"\");
            $('#eolmapprovalform-vamount2').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount2').val(\"\");
        }
    })
    $('#eolmapprovalform-vehicle3').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vehicle_detail3').removeAttr(\"disabled\");
             $('#eolmapprovalform-vdate3').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount3').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vehicle_detail3').attr('disabled', !this.checked);
            $('#eolmapprovalform-vehicle_detail3').val(\"\");
            $('#eolmapprovalform-vdate3').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate3').val(\"\");
            $('#eolmapprovalform-vamount3').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount3').val(\"\");
        }
    })
    $('#eolmapprovalform-vehicle4').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vehicle_detail4').removeAttr(\"disabled\");
            $('#eolmapprovalform-vdate4').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount4').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vehicle_detail4').attr('disabled', !this.checked);
            $('#eolmapprovalform-vehicle_detail4').val(\"\");
            $('#eolmapprovalform-vdate4').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate4').val(\"\");
            $('#eolmapprovalform-vamount4').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount4').val(\"\");
        }
    })
    $('#eolmapprovalform-vehicle5').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vehicle_detail5').removeAttr(\"disabled\");
            $('#eolmapprovalform-vdate5').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount5').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vehicle_detail5').attr('disabled', !this.checked);
            $('#eolmapprovalform-vehicle_detail5').val(\"\");
            $('#eolmapprovalform-vdate5').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate5').val(\"\");
            $('#eolmapprovalform-vamount5').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount5').val(\"\");
        }
    })
    $('#eolmapprovalform-vehicle6').on('change', function(){ 
       if(this.checked) 
        {
            $('#eolmapprovalform-vehicle_detail6').removeAttr(\"disabled\");
            $('#eolmapprovalform-vdate6').removeAttr(\"disabled\");
            $('#eolmapprovalform-vamount6').removeAttr(\"disabled\");
        }else{
            $('#eolmapprovalform-vehicle_detail6').attr('disabled', !this.checked);
            $('#eolmapprovalform-vehicle_detail6').val(\"\");
            $('#eolmapprovalform-vdate6').attr('disabled', !this.checked);
            $('#eolmapprovalform-vdate6').val(\"\");
            $('#eolmapprovalform-vamount6').attr('disabled', !this.checked);
            $('#eolmapprovalform-vamount6').val(\"\");
        }
    })


");*/
?>
