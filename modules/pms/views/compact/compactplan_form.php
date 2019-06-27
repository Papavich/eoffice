<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:47
 */

use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\jui\DatePicker;
use yii\bootstrap\Progress;

use yii\jui\ProgressBar;
$this->registerJsFile('@web/web_pms/plugins/datepicker/bootstrap-datepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('@web/web_pms/js/valid_date.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>
<?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => [
    'class' => 'compact_place-valid-date'
]]); ?>
    <fieldset>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <input type="hidden" name="id" value="<?=$modelprosub->prosub_code?>">
                <label>1. ชื่อโครงการย่อย <?= $modelprosub->prosub_name?></label>
                <br>
                <label>เลือกกิจกรรมที่ขอจัด</label><br>

                    <?php
                    if(isset($compact)){
                        foreach ($execute as $key => $row){
                            $i = $key+1;
                            $data = \app\modules\pms\models\PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row->execute_id,'pms_compact_has_prosub_id'=>$compact])->one();
                            if($data){
                                echo "<div class=\"row\" style='margin-bottom: 0px !important;'><div class='col-md-12'><label >กิจกรรมที่ 1.".$i." ".$row->execute_name."</label></div></div>";
                            }else{
                                echo "<div class=\"row\" style='margin-bottom: 0px !important;'><div class='col-md-12'><label >กิจกรรมที่ 1.".$i." ".$row->execute_name."</label></div></div>";
                            }
                        }
                    }else {
                        foreach ($execute as $key => $row) {
                            $i = $key+1;
                            echo "<div class=\"row\" style='margin-bottom: 0px !important;'><div class='col-md-12'><label >กิจกรรมที่ 1." . $i . " " . $row->execute_name . "</label></div></div>";

                        }
                    }

                    ?>


                <label>2. รหัสโครงการ <?= $modelprosub->prosub_code?></label><br>
                <label>3. งบประมาณของโครงการที่ระบุในแผนปฏิบัติการ</label><br>
                <label style='padding-left: 14px;padding-right: 14px;'>3.1 งบจากรัฐ (งบแผ่นดิน)</label><br>
                <div class="panel-body">
                    <table class="table table-striped table-hover table-bordered"
                           id="">
                        <thead style="text-align: center">
                        <tr>
                            <td>แหล่งงบประมาณ / ประเภทงบรายจ่าย</td>
                            <td>จำนวนเงิน(บาท)</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="pull-left">งบประมาณ(งบจากรัฐ)</span></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach ($prosubbudget as $row){
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 1){
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$BudgetSub->budget_name."</span></td><td>".$row->budget_limit."</td></tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td><span class="pull-left">งบประมาณ(งบรายได้)</span></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach ($prosubbudget as $row){
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 2){
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$BudgetSub->budget_name."</span></td><td>".$row->budget_limit."</td></tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td><span class="pull-left">งบอื่นๆ</span></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach ($prosubbudget as $row){
                            $BudgetSub = \app\modules\pms\models\BudgetSub::findOne($row->budget_sub);
                            if($row->budget_main == 3){
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- ".$row->budget_other."</span></td><td>".$row->budget_limit."</td></tr>";
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label>4. กำหนดจัดโครงการ</label>
            </div>
            <div class="col-md-5 col-sm-5">
                <?= $form->field($modelprosub,'compact_start_date')->textInput()->label(false)?>

            </div>
            <div class="col-md-1 col-sm-1">
                <center><label>ถึง</label></center>
            </div>
            <div class="col-md-5 col-sm-5">
                <?= $form->field($modelprosub,'compact_end_date')->textInput()->label(false)?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <label>เบอร์โทรศัพท์</label>
                <?= $form->field($modelprosub,'compact_phone')->textInput(['maxlength' => 10])->label(false)?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label>ผู้รับผิดชอบระดับนโยบาย/บริหาร</label>
                <?= $form->field($modelprosub, 'compact_manager')->widget(Select2::classname(), [
                    'data' => $manager,
                    'options' => ['placeholder' => 'เลือกผู้รับผิดชอบระดับนโยบาย/บริหาร'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'theme'=>Select2::THEME_DEFAULT
                ])->label(false);?>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <?= Html::submitButton($modelprosub->isNewRecord ? 'เพิ่ม' : 'บันทึก', ['class' => 'btn btn-3d btn-success pull-right','id'=>'submit_place']) ?>
                <a class="btn btn-3d btn-blue pull-left" href="../tablepro/track-project"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
            </div>

        </div>
    </fieldset>
<?php ActiveForm::end(); ?>



</div>
</div>
</div>
</div>
</div>
<?php
$this->registerJs(<<<JS
$(function(){
    $('#pmsprojectsub-compact_start_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    $('#pmsprojectsub-compact_end_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    
});

JS
);
?>