<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use app\modules\eoffice_eolmv2\assets\AppAssetEolm;
use yii\bootstrap\Modal;
use app\modules\eoffice_eolmv2\controllers;
AppAssetEolm::register($this);

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmReceiptHotel */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="eolm-receipt-hotel-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <!--<div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
                    <?/*= $form->field($model, 'eolm_app_id')->widget(Select2::classname(), [
                        //'data' => ArrayHelper::map(\app\modules\eoffice_eolmv2\models\EolmApprovalform::find()->joinWith('person1')->leftJoin('eoffice_central.view_pis_user', 'eoffice_central.view_pis_user.person_id = eolm_approvalform_has_personal.person_id')->where(['eoffice_central.view_pis_user.id'=>Yii::$app->user->identity->id])->asArray()->all(),'eolm_app_id','eolm_app_subject'),
                        'data' => ArrayHelper::map(\app\modules\eoffice_eolmv2\models\EolmApprovalform::find()->asArray()->all(),'eolm_app_id','eolm_app_subject'),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'language' => 'th',
                        'options' => ['placeholder' => 'เลือก...','id'=>'apps'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label("แบบขออนุมัติเดินทาง" ) */?>
                </div>-->
                <div class="col-md-3 col-sm-3">
                    <?php $s1='SELECT eolm_hotel_id FROM eolm_receipt_hotel Where eolm_app_id='.$model->eolm_app_id;

                    echo $form->field($model, 'eolm_hotel_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\modules\eoffice_eolmv2\models\EolmHotel::find()->asArray()->all(),'eolm_hotel_id','eolm_hotel_name'),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'language' => 'th',
                        'options' => ['placeholder' => controllers::t( 'label','Select....')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(controllers::t( 'label','Stay at') ) ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <?= $form->field($model, 'eolm_rec_hotel_room_amount')->textInput(['maxlength' => true])->label(controllers::t( 'label','Number of stay (room)') ) ?>
                </div>

                <div class="col-md-2 col-sm-2">
                    <?= $form->field($model, 'eolm_rec_hotel_price_per_room')->textInput(['maxlength' => true])->label(controllers::t( 'label','Rates are per room (bath)') ) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($model, 'eolm_rec_hotel_stay_date')->input('date',['id'=>'inputDate'])->label(controllers::t( 'label','check in date') ) ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($model, 'eolm_rec_hotel_checkout_date')->input('date',['id'=>'inputFinishDate'])->label(controllers::t( 'label','check out date') ) ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <?= $form->field($model, 'eolm_rec_hotel_nights_amount')->input(['maxlength' => true,'id'=>'calDate','readOnly'=>true])->label(controllers::t( 'label','Number (night)') ) ?>
                </div>
            </div>
        </div>
    </div>


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsHotel[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'eolm_rec_hotel_details_room_name',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr class="info">
            <th><?=controllers::t( 'label','Details')?></th>
            <th class="text-center"  style="width: 50px;">
                <button type="button" class="add-house btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsHotel as $indexHotel => $modelHotel): ?>
            <tr class="house-item info">
                <td class="center">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelHotel, "[{$indexHotel}]eolm_rec_hotel_details_room_name")->label(controllers::t( 'label','Room name'))->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <?= $this->render('_form-items', [
                                    'model'=>$model,
                                'form' => $form,
                                'indexHotel' => $indexHotel,
                                'modelsDetail' => $modelsDetail[$indexHotel],
                            ]) ?>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <?= $form->field($model, 'eolm_rec_hotel_amount')->textInput([
                'maxlength' => true,
                'id' => 'sum',
                //'disabled' => true
            ]) ->label(controllers::t( 'label','Total')) ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_rec_hotel_amount_text')->textInput([
                'id' => 'money',
                //'disabled' => true
            ]) ->label(controllers::t( 'label','Total(text)')) ?>
        </div>
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



    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
/* start getting the totalamount */
$script = <<<EOD
    $(document).on("change", "#inputDate", function() {       
        myDate().start(); 
    });
    $(document).on("change", "#inputFinishDate", function() {
        myDate().start();       
    });
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
    
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






    }


</script>

