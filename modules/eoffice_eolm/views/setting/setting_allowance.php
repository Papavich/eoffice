<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\eoffice_eolm\models\model_main\EofficeMainAcademicPositions;

use app\modules\eoffice_eolm\controllers;
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 10/1/2561
 * Time: 23:51
 */
?>
<div class="eolm-rate-cost-form">
    <br>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="col-md-6 col-sm-6">
                <?=
                $form->field($model2, 'academic_positions_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(EofficeMainAcademicPositions::find()->asArray()->all(),'academic_positions_id','academic_positions'),
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'language' => 'th',
                    'options' => ['placeholder' => controllers::t( 'label', 'Select position....'),'id'=>'positions'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(controllers::t( 'label', 'Position')) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model2, 'eolm_pos_allowance_rate')->textInput(['maxlength' => true, 'id'=>'allowance'])->label(controllers::t( 'label', 'Rate of allowance')) ?>

            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model2, 'eolm_pos_singlebed_rate')->textInput(['maxlength' => true, 'id'=>'singlebed'])->label(controllers::t( 'label', 'Flat rate (Single bed)')) ?>

            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model2, 'eolm_pos_singlebed_rate2')->textInput(['maxlength' => true, 'id'=>'singlebed2'])->label(controllers::t( 'label', 'Rate of receipts (Single bed)')) ?>

            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model2, 'eolm_pos_twinbeds_rate')->textInput(['maxlength' => true, 'id'=>'twinbeds'])->label(controllers::t( 'label', 'Flat rate (Double bed)')) ?>

            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model2, 'eolm_pos_twinbeds_rate2')->textInput(['maxlength' => true, 'id'=>'twinbeds2'])->label(controllers::t( 'label', 'Rate of receipts (Double bed)')) ?>

                <div class="form-group">
                    <?= Html::submitButton(controllers::t( 'label', 'Update'), ['class' => 'btn btn-primary pull-right']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('#positions').change(function(){
    var positionId = $(this).val();
    $.get('get-rate',{ positionId : positionId },function(data){
        var data = $.parseJSON(data);
        $('#allowance').attr('value',data.eolm_pos_allowance_rate);
        $('#singlebed').attr('value',data.eolm_pos_singlebed_rate);
        $('#twinbeds').attr('value',data.eolm_pos_twinbeds_rate);
        $('#singlebed2').attr('value',data.eolm_pos_singlebed_rate2);
        $('#twinbeds2').attr('value',data.eolm_pos_twinbeds_rate2);
        
        
    });
 });
JS;
$this->registerJS($script);
?>


