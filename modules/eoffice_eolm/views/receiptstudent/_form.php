<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewStudentFull;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\components\AuthHelper;
use kartik\widgets\DepDrop;

use app\modules\eoffice_eolm\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmReceiptStudent */
/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Address: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="eolm-receipt-student-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form'])?>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <!--<div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
                    <?php /*$userType = AuthHelper::getUserType();
                    if ($userType==AuthHelper::TYPE_ADMIN){
                        echo $form->field($model, 'eolm_app_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(EolmApprovalform::find()->asArray()->all(),'eolm_app_id','eolm_app_subject'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                           // 'language' => 'th',
                            'options' => ['placeholder' => 'เลือก...','id'=>'apps'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label("แบบขออนุมัติเดินทาง" );
                    }elseif ($userType==AuthHelper::TYPE_TEACHER||AuthHelper::TYPE_APPROVERS){
                        echo $form->field($model, 'eolm_app_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(EolmApprovalform::find()->where(['crby' => Yii::$app->user->identity->getId()])->asArray()->all(),'eolm_app_id','eolm_app_subject'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            //'language' => 'th',
                            'options' => ['placeholder' => 'เลือก...','id'=>'apps'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label("แบบขออนุมัติเดินทาง" ); }*/?>
                </div>-->
                <div class="col-md-3 col-sm-3">
                    <?php
                    $i='';
                    if ($model->isNewRecord){
                        $i =$_GET["id"];
                    }else{
                        $i =$_GET["eolm_app_id"];
                    }
                    $sql = 'SELECT * FROM eolm_approvalform_has_student 
left join eoffice_central.view_student_full on eolm_approvalform_has_student.STUDENTID = eoffice_central.view_student_full.STUDENTID
where eolm_approvalform_has_student.eolm_app_id='.$i ?>
                    <?= $form->field($model, 'person_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(EofficeMainViewStudentFull::findBySql($sql)->all(), 'STUDENTID', function($model) {
                            return $model['STUDENTNAME'].' '.$model['STUDENTSURNAME'];
                        } /*'ใส่ชื่อและนามสกุล'*/),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        //'language' => 'th',
                        'options' => ['placeholder' => controllers::t( 'label','Select....'),'id'=>'std'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(controllers::t( 'label','Student') ) ?>
                </div>
            </div>
        </div>
    </div>


    
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAddress[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'eolm_rec_std_detail_date',
            'eolm_rec_std_detail_detail',
            'eolm_rec_std_detail_amount',
            'eolm_rec_std_detail_note'
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr class="info">
            <th><?= controllers::t( 'label','Details')?></th>
            <th class="text-center">
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsAddress as $index => $modelAddress): ?>
            <tr class="item">
                <td>
                    <div class="row">
                        <div class="col-sm-3">
                            <?= $form->field($modelAddress, "[{$index}]eolm_rec_std_detail_date")->input('date')->label(controllers::t( 'label','Date'))?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($modelAddress, "[{$index}]eolm_rec_std_detail_detail")->textInput(['maxlength' => true])->label(controllers::t( 'label','Details of expenses')) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelAddress, "[{$index}]eolm_rec_std_detail_amount")->textInput(['maxlength' => true,'class' => 'sumPart form-control'])->label(controllers::t( 'label','Amount')) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($modelAddress, "[{$index}]eolm_rec_std_detail_note")->textInput(['maxlength' => true])->label(controllers::t( 'label','Note')) ?>
                        </div>
                    </div>
                </td>
                <td style="width: 50px;">
                    <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

    <?php DynamicFormWidget::end(); ?>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <?= $form->field($model, 'eolm_rec_std_total')->textInput([
                'maxlength' => true,
                'id' => 'sum',
                //'disabled' => true
            ]) ->label(controllers::t( 'label','Total')) ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'eolm_rec_std_text')->textInput([
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
    
    $(document).on("click", ".remove-item", function() {
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

