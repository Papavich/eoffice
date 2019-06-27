<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use app\modules\eoffice_eolm\models\Person;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use app\modules\eoffice_eolm\models\model_main\EofficeMainProvince;
use app\modules\eoffice_eolm\assets\AppAssetEolm;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmDisbursementform */
/* @var $form yii\widgets\ActiveForm */
AppAssetEolm::register( $this );
?>
<?php
$command = 'SELECT * FROM person LEFT OUTER JOIN eolm_approvalform_has_personal ON eolm_approvalform_has_personal.person_id =person.person_id LEFT OUTER JOIN eolm_approvalform ON eolm_approvalform_has_personal.eolm_app_id =eolm_approvalform.eolm_app_id WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id.' AND eolm_approvalform_has_personal.eolm_app_has_person_type_id =1';
$user = Person::findBySql($command)->one();
$command2 = 'SELECT * FROM eolm_approvalform WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$appform = EolmApprovalform::findBySql($command2)->one();
$command3 = 'SELECT * FROM eoffice_main.province LEFT OUTER JOIN eolm_approvalform_has_province ON eolm_approvalform_has_province.PROVINCE_ID=eoffice_main.province.PROVINCE_ID LEFT OUTER JOIN eolm_approvalform ON eolm_approvalform_has_province.eolm_app_id =eolm_approvalform.eolm_app_id WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$province= EofficeMainProvince::findBySql($command3)->all();
$command4 = 'SELECT * FROM eolm_loancontract WHERE eolm_loancontract.eolm_app_id ='.$model->eolm_app_id;
$loan = EolmLoancontract::findBySql($command4)->one();
?>
<div class="eolm-disbursementform-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form',
        'fieldClass' => 'justinvoelker\awesomebootstrapcheckbox\ActiveField',
        'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
    <div class="row text-muted">
        <div class="col-md-4 col-sm-4">
            <b>สัญญาเงินยืมเลขที่</b> <span class="text-success">  <?php echo $loan->eolm_loa_number ;?> </span> <br/>
            <b>ชื่อผู้ยืม</b> <span class="text-success"> <?php echo $user->person_name ;?>  <?php echo $user->person_surname ;?> </span>
        </div>
        <div class="col-md-4 col-sm-4 text-center">
            <b>วันที่</b> <span class="text-success"> <?php echo $loan->eolm_loa_date ;?> </span><br/>
            <b>จำนวนเงิน</b> <span class="text-success"> <?php echo $loan->eolm_loa_total_amout ;?> </span><b>บาท</b>
        </div>
        <div class="col-md-4 col-sm-4 text-right">
            <b>ส่วนที่ 1 </b><br/>
            <b>แบบ 8708</b>
        </div>
    </div>

    <!--hr/>
    <div class="row text-muted">
        <div class="col-md-12 col-sm-12 text-center">
            <h4 class="text-muted">ใบเบิกค่าใช้จ่ายในการเดินทางไปราชการ</h4>
        </div>
        <div class="col-md-12 col-sm-12 text-right">
            ที่ทำการ ภาควิชาวิทยาการคอมพิวเตอร์<br/>
            วันที <span class="text-success"> <?= date("Y-m-d")?></span>
        </div>
        <div class="col-md-12 col-sm-12" >
            <b>เรื่อง</b> ขออนุมัติเบิกค่าใช้จ่ายในการเดินทางไปราชการ <br/>
            <b>เรียน</b> คณบดี
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
                ตามคำสั่ง/บันทึก ที่ ศธ.0514.2.9/<span class="text-success"> <php echo $appform->eolm_app_number ;?> </span>
                ลงวันที่ <span class="text-success"> <php echo $appform->eolm_app_date ;?> </span> ได้อนุมัติให้
                ข้าพเจ้า <span class="text-success"> <php echo $user->person_name ;?>  <php echo $user->person_surname ;?> </span>  ตำแหน่ง ... สังกัด ภาควิชาวิทยาการคอมพิวเตอร์
                พร้อมด้วย <span class="text-success"> อ.สมชาย ใจจริง,อ.สมหญิง จริงใจ </span>
                เดินทางไปปฏิบัติราชการ <span class="text-success"> กรุงเทพมหานคร </span>
            <= $form->field($model, 'eolm_dis_docs')->hiddenInput()->label(false); ?>
        </div>
    </div-->
    <hr/>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'eolm_dis_go_from')->radioList(['บ้านพัก'=>'บ้านพัก ','สำนักงาน'=>'สำนักงาน ','ประเทศไทย'=>'ประเทศไทย '], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label('โดยออกเดินทางจาก') ?>

        </div>
        <div class="col-md-3 col-sm-2">
            <?= $form->field($model, 'eolm_dis_go_date')->textInput([
                'maxlength' => true,
                'id' => 'TextBox1',
            ]) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3">
            <?= $form->field($model, 'eolm_dis_back_to')->radioList(['บ้านพัก'=>'บ้านพัก ','สำนักงาน'=>'สำนักงาน ','ประเทศไทย'=>'ประเทศไทย '], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label('กลับถึง ') ?>
        </div>
        <div class="col-md-3 col-sm-2">
            <?= $form->field($model, 'eolm_dis_back_date')->textInput([
                'maxlength' => true,
                'id' => 'TextBox2',
            ]) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-3">

        </div>
        <div class="col-md-3 col-sm-2">
            <label>รวมวันไปราชการครั้งนี้</label>
            <input type="text" id="TextBox3" class="form-control" disabled >
        </div>
        <div class="col-md-3 col-sm-2">
            <label>คิดเป็น (ชั่วโมง) </label>
            <input type="text"  value="" class="form-control" disabled >
        </div>
    </div>


    <hr/>
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <?= $form->field($model, 'eolm_dis_disburse_for')->radioList(['ข้าพเจ้า'=>'ข้าพเจ้า ','คณะเดินทาง'=>'คณะเดินทาง '], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label('ข้าพเจ้าขอเบิกค่าใช้จ่ายในการเดินทางไปราชการสำหรับ ') ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <?= $form->field($model, 'eolm_dis_allowance_type')->dropDownList(['ก' => 'ก', 'ข' => 'ข'],['style'=>'width:80px']); ?>
        </div>
        <div class="col-md-4 col-sm-2">
            <?= $form->field($model, 'eolm_dis_allowance_day')->textInput() ?>
        </div>
        <div class="col-md-2 col-sm-1">
            <label>  รวมเป็นเงิน (บาท) </label>
            <input type="text"  value="" class="form-control" disabled >
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <?= $form->field($model, 'eolm_dis_hotal_type')->dropDownList(['ก' => 'ก', 'ข' => 'ข'],['style'=>'width:80px']); ?>
        </div>
        <div class="col-md-4 col-sm-2">
            <?= $form->field($model, 'eolm_dis_hotal_day')->textInput() ?>
        </div>
        <div class="col-md-2 col-sm-1">
            <label>  รวมเป็นเงิน (บาท) </label>
            <input type="text"  value="" class="form-control" disabled >
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3">
            <?= $form->field($model, 'eolm_vehicletype')->dropDownList(['เงินชดเชยค่าพาหนะในลักษณะเหมาจ่าย' => 'เงินชดเชยค่าพาหนะในลักษณะเหมาจ่าย', 'ค่าตั๋วเครื่องบินและค่ารถรับจ้าง' => 'ค่าตั๋วเครื่องบินและค่ารถรับจ้าง','ค่ารถประจำทางและค่ารถรับจ้าง'=>'ค่ารถประจำทางและค่ารถรับจ้าง']); ?>
        </div>
        <div class="col-md-4 col-sm-2">
            <?= $form->field($model, 'eolm_dis_vehicle_cost')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-3">
            <?= $form->field($model, 'eolm_dis_other_expenses')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4 col-sm-2">
            <?= $form->field($model, 'eolm_dis_other_expenses_cost')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 col-sm-3">
            <!--<td><input type="date" name="date1" class='form-control date1' id="startd" required/> <br>
            <td><input type="date" name="date2" class='form-control date2' id="endd" required /> <br>
            <td><input type="text" name='leavehmd' class='form-control date3' id="lhmd"/><br>-->

        </div>
        <div class="col-md-4 col-sm-2">
            <label> รวมเงินทั้งสิ้น (บาท) </label>
            <input type="text"  value="" class="form-control" disabled >
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <?= $form->field($model, 'eolm_dis_doc_count')->textInput(['style'=>'width:100px;']) ?>
        </div>
        <div class="col-md-12 col-sm-6">

            <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
            <div class="form-group field-upload_files">
                <label class="control-label" for="upload_files[]"> แนบหลักฐาน </label>
                <div>
                    <?= FileInput::widget([
                        'name' => 'upload_ajax[]',
                        'options' => ['multiple' => true/*,'accept' => 'image/*'*/], //'accept' => 'image/*' หากต้องเฉพาะ image
                        'pluginOptions' => [
                            'overwriteInitial'=>false,
                            'initialPreviewShowDelete'=>true,
                            'initialPreview'=> $initialPreview,
                            'initialPreviewConfig'=> $initialPreviewConfig,
                            'uploadUrl' => Url::to(['disbursementform/upload-ajax']),
                            'uploadExtraData' => [
                                'ref' => $model->ref,
                            ],
                            'maxFileCount' => 100
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
/* start getting the totalamount */
$script = <<<EOD
    $(document).on("select", ".date1", function() {
        myFunction().start(); //เรียกfunction 
    });
    $(document).on("select", ".date2", function() {
        myFunction().start(); //เรียกfunction 
    });
    
EOD;
$this->registerJs($script);
/*end getting the totalamount */
?>
<script type="text/javascript">
    function myFunction() {
        var date1 = document.getElementById("startd").value;
        var date2 = document.getElementById("endd").value;
        if (date1 && date2) {
            document.getElementById("lhmd").value = daydiff(parseDate(date1.val()), parseDate(date2.val()));
        }

        function parseDate(str) {
            var mdy = str.split('/');
            return new Date(mdy[2], mdy[0] - 1, mdy[1]);
        }

        function daydiff(first, second) {
            return Math.round((second - first) / (1000 * 60 * 60 * 24));
        }


        //var chng1 = document.getElementById("endd");
       // var chng2 = document.getElementById("startd");
       // chng1.onchange = displayCurrentDayDifference();
        //chng2.onchange = displayCurrentDayDifference();




    }
</script>