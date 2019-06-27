<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainPerson;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson;
use app\modules\eoffice_eolmv2\models\EolmApprovalform;
use app\modules\eoffice_eolmv2\models\EolmLoancontract;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainProvince;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolmv2\models\EolmDisbursementformDetailsItem;
use app\modules\eoffice_eolmv2\models\EolmRateCost;
use app\modules\eoffice_eolmv2\assets\AppAssetEolm;
use app\modules\eoffice_eolmv2\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmDisbursementform */
/* @var $form yii\widgets\ActiveForm */
AppAssetEolm::register( $this );
?>
<?php
$de1 = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' => $model->eolm_app_id, 'eolm_app_has_person_type_id' => 1])->one();
if ($de1!=null) {
    $u = $de1->person_id;


//echo $u;
//$command = 'SELECT * FROM eoffice_main.person WHERE person_id ='.$u;
$user = EofficeMainViewPisPerson::find()->where(['person_id'=>$u])->one();
}
//$user = EofficeMainPerson::find()->where(['person_id'=>$u])->all();
$command2 = 'SELECT * FROM eolm_approvalform WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$appform = EolmApprovalform::findBySql($command2)->one();
$command3 = 'SELECT * FROM eoffice_central.province LEFT OUTER JOIN eolm_approvalform_has_province ON eolm_approvalform_has_province.PROVINCE_ID=eoffice_central.province.PROVINCE_ID LEFT OUTER JOIN eolm_approvalform ON eolm_approvalform_has_province.eolm_app_id =eolm_approvalform.eolm_app_id WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$province= EofficeMainProvince::findBySql($command3)->all();
$command4 = 'SELECT * FROM eolm_loancontract WHERE eolm_loancontract.eolm_app_id ='.$model->eolm_app_id;
$loan = EolmLoancontract::findBySql($command4)->one();

?>
<div class="eolm-disbursementform-form">

    <?php $form = ActiveForm::begin([/*'id' => 'dynamic-form',*/
        'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
    <div class="row text-muted">
        <div class="col-md-6 col-sm-6">
            <b><?= controllers::t( 'label', 'Contract number')?></b> <span class="text-success">  <?php echo $loan->eolm_loa_number ;?> </span> <br/>
            <b><?= controllers::t( 'label', 'Name of the borrower')?></b> <span class="text-success"> <?php echo $user->academic_positions_abb_thai ;?> <?php echo $user->person_name ;?> <?php echo $user->person_surname ;?> </span>
        </div>
        <div class="col-md-6 col-sm-6">
            <b><?= controllers::t( 'label', 'Date')?></b> <span class="text-success"> <?php echo $loan->eolm_loa_date ;?> </span><br/>
            <b><?= controllers::t( 'label', 'Amount')?></b> <span class="text-success"> <?php echo $loan->eolm_loa_total_amout ;?> </span><b>บาท</b>
        </div>
        <!--<div class="col-md-4 col-sm-4 text-right">
            <b><?/*= controllers::t( 'label', 'PART 1') */?></b><br/>
            <b><?/*= controllers::t( 'label', 'PART 1') */?></b>
        </div>-->
    </div>

    <!--hr/>
    <div class="row text-muted">
        <div class="col-md-12 col-sm-12 text-center">
            <h4 class="text-muted">ใบเบิกค่าใช้จ่ายในการเดินทางไปราชการ</h4>
        </div>
        <div class="col-md-12 col-sm-12 text-right">
            ที่ทำการ ภาควิชาวิทยาการคอมพิวเตอร์<br/>
            วันที <span class="text-success"> </span>
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
            <?= $form->field($model, 'eolm_dis_go_from')->radioList(['บ้านพัก'=>controllers::t( 'label', 'House'),'สำนักงาน'=>controllers::t( 'label', 'Office'),'ประเทศไทย'=>controllers::t( 'label', 'Thailand')], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label(controllers::t( 'label', 'Departing from')) ?>
            <?= $form->field($model, 'eolm_dis_back_to')->radioList(['บ้านพัก'=>controllers::t( 'label', 'House'),'สำนักงาน'=>controllers::t( 'label', 'Office'),'ประเทศไทย'=>controllers::t( 'label', 'Thailand')], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label(controllers::t( 'label', 'Return to')) ?>

        </div>
        <div class="col-md-3 col-sm-3">
            <?= $form->field($model, 'eolm_dis_go_date')->label(controllers::t( 'label', 'Departure date'))->input('date',['id'=>'inputDate']) ?>
            <?= $form->field($model, 'eolm_dis_back_date')->label(controllers::t( 'label', 'Return date'))->input('date',['id'=>'inputFinishDate']) ?>

        </div>
        <div class="col-md-2 col-sm-2">
            <?= $form->field($model, 'eolm_dis_go_time')->label(controllers::t( 'label', 'Departure time'))->input('time',['id'=>'inputTime']) ?>
            <?= $form->field($model, 'eolm_dis_back_time')->label(controllers::t( 'label', 'Return time'))->input('time',['id'=>'inputFinishTime']) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-8 col-sm-1 col-sm-offset-8">
            <?= $form->field($model, 'eolm_dis_date_count')->textInput(['maxlength' => true,'id'=>'calDate','readonly' => true])->label(controllers::t( 'label', 'Amount(day)')) ?>

        </div>
        <div class="col-md-2 col-sm-2">
            <?= $form->field($model, 'eolm_dis_time')->textInput(['maxlength' => true,'id'=>'calTime','readonly' => true])->label(controllers::t( 'label', 'As a (Hours)')) ?>

        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <?= $form->field($model, 'eolm_dis_disburse_for')->radioList(['ข้าพเจ้า'=>controllers::t( 'label', 'Me'),'คณะเดินทาง'=>controllers::t( 'label', 'Follower')], ['itemOptions' => ['disabled' => false, 'divOptions' => ['class' => 'radio-success']]])->label(controllers::t( 'label', 'Expense reimbursement for travel to the government for the')) ?>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_dis_allowance_type')->dropDownList(['ก' => 'ก', 'ข' => 'ข'],['style'=>'width:80px'])->label(controllers::t( 'label', 'Allowance type')); ?>
        </div>
        <?php
        $vehicle = EolmDisbursementformDetailsItem::find()->where(['eolm_app_id'=>$model->eolm_app_id,'eolm_dis_type'=>3])->asArray()->all();
        $rate= 0;
        if(!empty($vehicle)) {
            echo '<div class="col-md-7 col-sm-7" style="border: 2px solid pink;border-radius: 5px;">';
            echo '<div class="col-md-9 col-sm-9 text-center info"><label> '.controllers::t( 'label', 'Allowance of').' </label></div><div class="col-md-2 col-sm-2 text-center"><label> '.controllers::t( 'label', 'Amount').' </label></div>';

            foreach ($vehicle as &$value) {
                $person = EofficeMainViewPisPerson::find()->where(['person_id'=>$value['person_id']])->one();
                echo '<div class="col-md-9 col-sm-9">'.$person->academic_positions_abb_thai.' '.$person->person_name.' '.$person->person_name.'</div><div class="col-md-2 col-sm-2">'.$value['eolm_dis_detail_amout'].'</div>';
                $rate= $rate +$value['eolm_dis_detail_amout'];
            }
            echo '</div >';
            echo '<div class="col-md-1 col-md-offset-4 col-sm-1 col-sm-offset-4">'.$form->field($model, 'eolm_dis_allowance_day')->textInput(['maxlength' => 3,'id'=>'allowDate','readonly' => true])->label(controllers::t( 'label', 'Number (day)')).'</div>';
            echo '<div class="col-md-2 col-sm-2">'.$form->field($model, 'eolm_dis_allowance_cost')->textInput(['maxlength' => true,'readonly' => true,'id'=>'allow'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }else{
            echo '<div class="col-md-1 col-md-offset-4 col-sm-1 col-sm-offset-4">'.$form->field($model, 'eolm_dis_allowance_day')->textInput(['maxlength' => 3,'id'=>'allowDate','readonly' => true])->label(controllers::t( 'label', 'Number (day)')).'</div>';
            echo '<div class="col-md-2 col-sm-2">'.$form->field($model, 'eolm_dis_allowance_cost')->textInput(['maxlength' => true,'value'=>0,'readonly' => true,'id'=>'allow'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }?>
    </div>

    <hr/>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_dis_hotal_type')->dropDownList(['ก' => 'ก', 'ข' => 'ข'],['style'=>'width:80px'])->label(controllers::t( 'label', 'Rent type of property')); ?>
        </div>
        <?php
        $vehicle = EolmDisbursementformDetailsItem::find()->where(['eolm_app_id'=>$model->eolm_app_id,'eolm_dis_type'=>4])->asArray()->all();
        $room= 0;
        if(!empty($vehicle)) {
            echo '<div class="col-md-7 col-sm-7" style="border: 2px solid pink;border-radius: 5px;">';
            echo '<div class="col-md-9 col-sm-9 text-center info"><label> '.controllers::t( 'label', 'Rent of').' </label></div><div class="col-md-2 col-sm-2 text-center"><label> '.controllers::t( 'label', 'Amount').' </label></div>';

            foreach ($vehicle as &$value) {
                $person = EofficeMainViewPisPerson::find()->where(['person_id'=>$value['person_id']])->one();
                echo '<div class="col-md-9 col-sm-9">'.$person->academic_positions_abb_thai.' '.$person->person_name.' '.$person->person_name.'</div><div class="col-md-2 col-sm-2">'.$value['eolm_dis_detail_amout'].'</div>';
                $room= $room +$value['eolm_dis_detail_amout'];
            }
            echo '</div >';
            echo '<div class="col-md-1 col-md-offset-4 col-sm-1 col-sm-offset-4">'.$form->field($model, 'eolm_dis_hotal_day')->textInput(['maxlength' => 3,'id'=>'hoDate','readonly' => true])->label(controllers::t( 'label', 'Number (day)')).'</div>';
            echo '<div class="col-md-2 col-sm-2">'.$form->field($model, 'eolm_dis_hotal_cost')->textInput(['maxlength' => true,'readonly' => true,'id'=>'hotel'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }else{
            echo '<div class="col-md-1 col-md-offset-4 col-sm-1 col-sm-offset-4">'.$form->field($model, 'eolm_dis_hotal_day')->textInput(['maxlength' => 3,'id'=>'hoDate','readonly' => true])->label(controllers::t( 'label', 'Number (day)')).'</div>';
            echo '<div class="col-md-2 col-sm-2">'.$form->field($model, 'eolm_dis_hotal_cost')->textInput(['maxlength' => true,'value'=>0,'readonly' => true,'id'=>'hotel'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }?>
    </div>


    <hr/>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_vehicletype')->dropDownList(['เงินชดเชยค่าพาหนะในลักษณะเหมาจ่าย' => 'เงินชดเชยค่าพาหนะในลักษณะเหมาจ่าย', 'ค่าตั๋วเครื่องบินและค่ารถรับจ้าง' => 'ค่าตั๋วเครื่องบินและค่ารถรับจ้าง','ค่ารถประจำทางและค่ารถรับจ้าง'=>'ค่ารถประจำทางและค่ารถรับจ้าง'])->label(controllers::t( 'label', 'Rate of vehicle')); ?>
        </div>
        <?php
        $vehicle = EolmDisbursementformDetailsItem::find()->where(['eolm_app_id'=>$model->eolm_app_id,'eolm_dis_type'=>1])->asArray()->all();
        if(!empty($vehicle)) {
            echo '<div class="col-md-7 col-sm-7" style="border: 2px solid pink;border-radius: 5px;">';
            echo '<div class="col-md-6 col-sm-6 text-center info"><label> '.controllers::t( 'label', 'vehicle of').' </label></div><div class="col-md-3 col-sm-3 text-center"><label> '.controllers::t( 'label', 'Details').'</label></div><div class="col-md-2 col-sm-2 text-center"><label> '.controllers::t( 'label', 'Amount').' </label></div>';
                $total=0;
                foreach ($vehicle as &$value) {
                    $person = EofficeMainViewPisPerson::find()->where(['person_id'=>$value['person_id']])->one();
                    echo '<div class="col-md-6 col-sm-6">'.$person->academic_positions_abb_thai.' '.$person->person_name.' '.$person->person_name.'</div><div class="col-md-3 col-sm-3">'.$value['eolm_dis_detail_detail'].'</div><div class="col-md-2 col-sm-2">'.$value['eolm_dis_detail_amout'].'</div>';
                    $total= $total +$value['eolm_dis_detail_amout'];
                }
            echo '</div >';
                echo '<div class="col-md-2 col-md-offset-9 col-sm-2 col-sm-offset-9">'.$form->field($model, 'eolm_dis_vehicle_cost')->textInput(['maxlength' => true,'value'=>$total,'readonly' => true,'id'=>'vehi'])->label(controllers::t( 'label', 'Amount')).'</div>';
            }else{
                echo '<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5">'.$form->field($model, 'eolm_dis_vehicle_cost')->textInput(['maxlength' => true,'value'=>0,'readonly' => true,'id'=>'vehi'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }?>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_dis_other_expenses')->textInput(['maxlength' => true])->label(controllers::t( 'label', 'Other Costs')); ?>
        </div>
        <?php
        $other = EolmDisbursementformDetailsItem::find()->where(['eolm_app_id'=>$model->eolm_app_id,'eolm_dis_type'=>2])->asArray()->all();
        if(!empty($other)) {
            echo '<div class="col-md-7 col-sm-7" style="border: 2px solid pink;border-radius: 5px;">';
            echo '<div class="col-md-6 col-sm-6 text-center"><label> '.controllers::t( 'label', 'Other Costs of').' </label></div><div class="col-md-3 col-sm-3 text-center"><label> '.controllers::t( 'label', 'Details').'</label></div><div class="col-md-2 col-sm-2 text-center"><label> '.controllers::t( 'label', 'Amount').' </label></div>';
            $total2=0;
            foreach ($other as &$value) {
                $person2 = EofficeMainViewPisPerson::find()->where(['person_id'=>$value['person_id']])->one();

                echo '<div class="col-md-6 col-sm-6">'.$person2->academic_positions_abb_thai.' '.$person2->person_name.' '.$person2->person_surname.'</div><div class="col-md-3 col-sm-3"><!--<input type="text" class="form-control" disabled value="-->'.$value['eolm_dis_detail_detail'].
                     '</div><div class="col-md-2 col-sm-2 text-center">'.$value['eolm_dis_detail_amout'].'</div>';
                $total2= $total2 +$value['eolm_dis_detail_amout'];
            }
            echo '</div >';
            echo '<div class="col-md-2 col-md-offset-9 col-sm-2 col-sm-offset-9">'.$form->field($model, 'eolm_dis_other_expenses_cost')->textInput(['maxlength' => true,'value'=>$total2,'readonly' => true,'id'=>'other'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }else{
            echo '<div class="col-md-2 col-md-offset-5 col-sm-2 col-sm-offset-5">'.$form->field($model, 'eolm_dis_other_expenses_cost')->textInput(['maxlength' => true,'value'=>0,'readonly' => true,'id'=>'other'])->label(controllers::t( 'label', 'Amount')).'</div>';
        }?>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_dis_doc_count')->textInput(['maxlength' => true,'style'=>'width:80px'])->label(controllers::t( 'label', 'The number of the attached document')) ?>
        </div>
        <div class="col-md-5 col-sm-5">
            <?= $form->field($model, 'eolm_dis_total_text')->textInput(['maxlength' => true,'id'=>'txt'])->label(controllers::t( 'label', 'Total(text)')) ?>

        </div>
        <div class="col-md-2 col-sm-2">
            <?= $form->field($model, 'eolm_dis_total')->textInput(['maxlength' => true,'id'=>'sum'])->label(controllers::t( 'label', 'Total')) ?>

        </div>
    </div>
    <?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>
    <div class="form-group field-upload_files">
        <label class="control-label" for="upload_files[]"> <?= controllers::t( 'label', 'Attached document')?> </label>
        <div>
            <?= FileInput::widget([
                'name' => 'upload_ajax[]',
                'options' => ['multiple' => true/*,'accept' => 'image/*'*/], //'accept' => 'image/*' หากต้องเฉพาะ image
                'pluginOptions' => [
                    'overwriteInitial'=>false,
                    'initialPreviewShowDelete'=>true,
                    'initialPreview'=> $initialPreview,
                    'initialPreviewConfig'=> $initialPreviewConfig,
                    'uploadUrl' => Url::to(['/eoffice_eolmv2/disbursementform/upload-ajax']),
                    'uploadExtraData' => [
                        'ref' => $model->ref,
                    ],
                    'maxFileCount' => 100
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group text-center">
        <?= $form->field($model, 'eolm_dis_date')->hiddenInput(['value'=> date("Y-m-d")])->label(false); ?>
        <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
/* start getting the totalamount */
$script = <<<EOD
    $(document).on("change", "#inputDate", function() {       
        myDate().start(); 
        myFunction().start();
    });
    $(document).on("change", "#inputFinishDate", function() {
        myDate().start();  
        myFunction().start();     
    });
    $(document).on("change", "#inputTime", function() { 
        myDate().start(); 
        myFunction().start();   
    });
    $(document).on("change", "#inputFinishTime", function() {
        myDate().start(); 
        myFunction().start(); 
    });
    $( document ).ready(function() {
        myDate().start(); 
        
    });
    
    
EOD;
$this->registerJs($script);
/*end getting the totalamount */
?>
<script type="text/javascript">
    function myDate(){
        var dat1 = document.getElementById('inputDate').value;
        var date1 = new Date(dat1);
        var dat2 = document.getElementById('inputFinishDate').value;
        var date2 = new Date(dat2);
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((date1.getTime() - date2.getTime()) / (oneDay));

        if (isNaN(diffDays)) diffDays = 0;
        document.getElementById("calDate").value = diffDays;



        //------------------------------ Time--------------------------------
        var tim1 = document.getElementById('inputTime').value;
        var time2 = document.getElementById('inputFinishTime').value;
        var t1 = tim1.split(':');
        var t2 = time2.split(':');
        var d1 = new Date(0, 0, 0, t1[0], t1[1]);
        var d2 = new Date(0, 0, 0, t2[0], t2[1]);
        var one =  60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffTime = Math.abs((d1.getTime() - d2.getTime())/one) ;




        if (isNaN(diffTime)){
            diffTime = '0 : 0';
            document.getElementById("calTime").value = diffTime;
        } else {

            var x = diffTime*60;

            var hours   = Math.floor(x / 3600);
            var minutes = Math.floor((x - (hours * 3600)) / 60);
            var seconds = x - (hours * 3600) - (minutes * 60);

            // round seconds
            seconds = Math.round(seconds * 100) / 100;
            if (minutes>=13){
                minutes=0;
                seconds=0;
                var dd = document.getElementById('calDate').value;
                var new_dd = Math.abs(parseInt(dd)+ 1);
                if (isNaN(new_dd)) new_dd = '0 : 0';
                document.getElementById("calDate").value = new_dd;

            }
             //result = (hours < 10 ? "0" + hours : hours);
                //result = (minutes < 10 ? "0" + minutes : minutes);
                //result += " : " + (seconds  < 10 ? "0" + seconds : seconds);
            var result = minutes+" . "+seconds;
            document.getElementById("calTime").value = result;
        }

        var da = document.getElementById('calDate').value;
        document.getElementById("allowDate").value = da; //จำนวนวันเบี้ยเลี้ยง

        var allow_date = "<?php echo $rate; ?>";
        var allowtt = Math.abs(parseInt(da)*parseInt(allow_date));
        document.getElementById("allow").value = allowtt;

        var ho = Math.abs(parseInt(da)- 1);
        if (isNaN(ho)) ho = 0;
        document.getElementById("hoDate").value = ho; //จำนวนวันที่พัก
        var room_date = "<?php echo $room; ?>";
        var roomtt = Math.abs(parseInt(ho)*parseInt(room_date));
        document.getElementById("hotel").value = roomtt;
        /*if($('.room').is(':visible')) {
            var ho_date = "<php echo room; ?>";
            var hott = Math.abs(parseInt(ho)*parseInt(ho_date));
            document.getElementById("hotel").value = hott;
        }
        if($('.room2').is(':visible')) {
            var ho_date = "<php echo $room2; ?>";
            var hott = Math.abs(parseInt(ho)*parseInt(ho_date));
            document.getElementById("hotel").value = hott;
        }
        if($('.room3').is(':visible')) {
            var ho_date = "<php echo $room3; ?>";
            var hott = Math.abs(parseInt(ho)*parseInt(ho_date));
            document.getElementById("hotel").value = hott;
        }
        if($('.room4').is(':visible')) {
            var ho_date = "<php echo $room4; ?>";
            var hott = Math.abs(parseInt(ho)*parseInt(ho_date));
            document.getElementById("hotel").value = hott;
        }
*/





        // sum total
        var allow = document.getElementById('allow').value;
        var hotal = document.getElementById('hotel').value;
        var vehi = document.getElementById('vehi').value;
        var other = document.getElementById('other').value;
        var sum = Math.abs(parseInt(allow)+parseInt(hotal)+parseInt(vehi)+parseInt(other));
        document.getElementById("sum").value = sum;
        //convert text number
        var bath = ArabicNumberToText(sum);
        document.getElementById("txt").value = bath;

    }


</script>
<script src="<?= Yii::getAlias('@web') ?>/web_eolm/js/thaibath.js"></script>

<?php
/* start getting the totalamount

 $(function(){var numberOfSpans;
    numberOfSpans = $('.divAllow').children('span').length;
    alert(numberOfSpans);
})();

$script = <<<EOD
    
   
    $('#element').click(function() {
       if($('#a1').is(':checked')) { 
          $( ".room" ).hide();
          console.log('<?php echo $rate; ?>';);
       }
       if($('#a2').is(':checked')) { 
          $( ".room" ).show();
          console.log(2);
       }
    });
    
EOD;
$this->registerJs($script);
/*end getting the totalamount */
?>