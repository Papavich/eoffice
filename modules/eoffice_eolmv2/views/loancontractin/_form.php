<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\eoffice_eolmv2\models\Person;
use app\modules\eoffice_eolmv2\models\EolmApprovalform;
use app\modules\eoffice_eolmv2\models\model_main\EofficeMainProvince;
use app\modules\eoffice_eolmv2\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmLoancontract */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
/*$command = 'SELECT * FROM person LEFT OUTER JOIN eolm_approvalform_has_personal ON eolm_approvalform_has_personal.person_id =person.person_id LEFT OUTER JOIN eolm_approvalform ON eolm_approvalform_has_personal.eolm_app_id =eolm_approvalform.eolm_app_id WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id.' AND eolm_approvalform_has_personal.eolm_app_has_person_type_id =1';
$user = Person::findBySql($command)->one();
$command2 = 'SELECT * FROM eolm_approvalform WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$appform = EolmApprovalform::findBySql($command2)->one();
$command3 = 'SELECT * FROM eoffice_main.province LEFT OUTER JOIN eolm_approvalform_has_province ON eolm_approvalform_has_province.PROVINCE_ID=eoffice_main.province.PROVINCE_ID LEFT OUTER JOIN eolm_approvalform ON eolm_approvalform_has_province.eolm_app_id =eolm_approvalform.eolm_app_id WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
$province= EofficeMainProvince::findBySql($command3)->all();
*/?>
<div class="eolm-loancontract-form">
    <?php
    $command2 = 'SELECT * FROM eolm_approvalform WHERE eolm_approvalform.eolm_app_id ='.$model->eolm_app_id;
    $appform = EolmApprovalform::findBySql($command2)->one();
    $date1 = new DateTime($appform['eolm_app_return_date']);
    $date2 = $date1->modify('+7 day');
    $userType = \app\modules\eoffice_eolmv2\components\AuthHelper::getUserType();
    ?>

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="panel panel-info ">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'eolm_loa_approvers')->dropDownList(['คณบดี' => 'คณบดี', 'อธิอการบดี' => 'อธิอการบดี'])->label( controllers::t( 'label', 'Filed to'));?>
                    </div>

                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($model, 'eolm_loa_date')->input('date',['value'=>$appform['eolm_app_date']])->label( controllers::t( 'label', 'Due date'));?>
                    </div>

                    <?php if ($appform->eolm_status_id == 3 && $userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_ADMIN ){
                        echo '
                        <div class="col-md-3 col-sm-3">
                            '.$form->field($model, 'eolm_loa_number')->textInput()->label( controllers::t( 'label', 'Contract number')).'
                        </div>';
                    }?>

                    <!--<div class="col-md-3 col-sm-3">
                        <?/*= $form->field($model, 'eolm_loa_use_date')->input('date')->label('ต้องใช้เงินวันที่');*/?>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <?/*= $form->field($model, 'eolm_loa_refund_date')->input('date')->label('ส่งคืนวันที่');*/?>
                    </div>-->
                </div>
            </div>
        </div>


    <!--div class="row">
        <div class="col-md-6 col-sm-3">
            <label> ข้าพเจ้า </label>
            <input type="text"  value="<$user->person_name ;?>  <$user->person_surname ;?>" class="form-control" disabled> <br>

        </div>
        <div class="col-md-6 col-sm-3">
            <label> อีเมลล์ </label>
            <input type="text" value="< $user->person_mail ;?>" class="form-control" disabled> <br>

        </div>

    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <label> สังกัด </label>
            <input type="text" name="contact[first_name]" value="ภาควิชาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น จังหวัด ขอนแก่น" class="form-control" disabled> <br>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <label>ดังรายละเอียดต่อไปนี้</label>
            <textarea rows="auto" class="form-control word-count" >ค่าใช้จ่ายในการเดินทางไปราชการระหว่างวันที่ < $appform->eolm_app_deprture_date;?> ถึงวันที่ < echo $appform->eolm_app_return_date;?> ณ จังหวัด < foreach ($province as $key){
                    echo $key->PROVINCE_NAME;
                }

                ?> (ค่าที่พัก  บาท ค่ายานพาหนะ  บาท )</textarea>

        </div>
    </div-->


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsBorrow[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'eolm_bor_periods',
            'eolm_bor_date_spent',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr class="info">
            <th><?= controllers::t( 'label', 'Details of expenses')?></th>
            <!--<th>รายระเอียด</th>-->
            <th>
                <button type="button" class="add-house btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsBorrow as $indexBorrow => $modelBorrow): ?>
            <tr class="house-item info">
                <td class="center">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <?= $form->field($modelBorrow, "[{$indexBorrow}]eolm_bor_periods")->label(controllers::t( 'label', 'The period'))->textInput(['class'=>'form-control stepper','value'=>1]) ?>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <?= $form->field($modelBorrow, "[{$indexBorrow}]eolm_bor_date_spent")->label(controllers::t( 'label', 'Date must to use money'))->input('date') ?>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <?= $form->field($modelBorrow, "[{$indexBorrow}]eolm_bor_date_repay")->label(controllers::t( 'label', 'Refund date'))->input('date',['value'=> $date2->format('Y-m-d')]) ?>

                        </div>
                    </div>

                    <?= $this->render('_form-borrowitems', [
                        'form' => $form,
                        'indexBorrow' => $indexBorrow,
                        'modelsDetail' => $modelsDetail[$indexBorrow],
                    ]) ?>

                </td>
                <td>
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    <div class="panel panel-info ">
        <div class="panel-body">
            <div class="row">
                 <div class="col-md-3 col-sm-3">
                      <?= $form->field($model, 'eolm_loa_total_amout')->textInput([
                          'maxlength' => true,
                          'id' => 'sum',
                            //'disabled' => true
                            ])->label(controllers::t( 'label', 'Total')) ?>
                 </div>
                 <div class="col-md-4 col-sm-4">
                      <?= $form->field($model, 'eolm_loa_total_text')->textInput([
                       'id' => 'money',
                      //'disabled' => true
                         ])->label(controllers::t( 'label', 'Total(text)')) ?>
                 </div>
            </div>
        </div>
    </div>


        <div class="form-group text-center">
            <?php
                $userType = \app\modules\eoffice_eolmv2\components\AuthHelper::getUserType();
                if ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_ADMIN){
                    echo Html::a(controllers::t( 'label', 'Back'), ['approvalformsf/update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']);
                }elseif ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_TEACHER){
                    echo Html::a(controllers::t( 'label', 'Back'), ['approvalformaj/update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']);
            }?>
             <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php
    /* start getting the totalamount */
    $script = <<<EOD
    $(document).on("change", ".sumPart", function() {
        var sum = 0;
        $(".sumPart").each(function(){
            sum += +$(this).val();
        });
        $("#sum").val(sum);
        myFunction().start(); //เรียกfunction แปลงเงิน
    });
    
    $(document).on("click", ".remove-room", function() {
        var sum = 0;
        $(".sumPart").each(function(){
            sum += +$(this).val();
        });
        $("#sum").val(sum);
        myFunction().start(); //เรียกfunction แปลงเงิน
         
    });
    
EOD;
    $this->registerJs($script);
    /*end getting the totalamount */
    ?>
    <script src="<?= Yii::getAlias('@web') ?>/web_eolm/js/thaibath.js"></script>
   <script type="text/javascript">
        function myFunction(){ //function แปลงเงิน
            var monney = document.getElementById("sum").value;
            var bath = ArabicNumberToText(monney);
            document.getElementById("money").value = bath;
        }
    </script>





    <?php ActiveForm::end(); ?>
</div>

