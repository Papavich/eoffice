<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:47
 */

use app\modules\pms\models\GroupSubsidizedStrategy;
use app\modules\pms\models\PmsCompactHasExecute;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\jui\DatePicker;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;
use yii\bootstrap\Alert;


?>
<?= Html::csrfMetaTags() ?>
<style type="text/css">
    #dynamic-form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<?php
if (!$modelcompacthasprosub->isNewRecord) {
    $form = ActiveForm::begin(['id' => 'dynamic-form', 'action' => '../compact/nextcompactbudget']);
} else {
    $form = ActiveForm::begin(['id' => 'dynamic-form', 'action' => '../compact/addcompactbudget']);
}


?>
<div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0"
         aria-valuemax="100"></div>
</div>
<fieldset>
    <h3 style="margin-bottom: 0px">ส่วนที่ 1 เลือกกิจกรรม</h3>
    <input type="hidden" name="id" value="<?= $id ?>">

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>อุดหนุนยุทธศาสตร์</label>
            <?= $form->field($modelcompacthasprosub, "group_subsidized_strategy")->dropdownList(
                ArrayHelper::map(GroupSubsidizedStrategy::find()->all(),
                    'id',
                    'name'), [
                'prompt' => 'เลือกอุดหนุนยุทธศาสตร์ที่ใช้'
            ])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>เลือกกิจกรรมที่ขอจัด</label><br>

            <?php
            if (!$modelcompacthasprosub->isNewRecord) {
                echo "<input type='hidden' name='compact' value='" . $compact . "'>";
            }
            foreach ($execute as $key => $row) {
                if (isset($compact)) {
                    $checkCE = PmsCompactHasExecute::find()->where(['pms_compact_has_prosub_id' => $compact, 'pms_execute_execute_id' => $row->execute_id])->one();
                    if ($checkCE) {
                        echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" checked='checked' name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";

                    } else {
                        $checkCES = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id])->one();
                        if (!$checkCES) {
                            echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";
                        }

                    }
                } else {
                    $checkCES = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id])->one();
                    if (!$checkCES) {
                        echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <label>ผู้รับผิดชอบระดับนโยบาย/บริหาร</label>
            <?= $form->field($modelcompacthasprosub, 'compact_manager')->widget(Select2::classname(), [
                'data' => $manager,
                'options' => ['placeholder' => 'เลือกผู้รับผิดชอบระดับนโยบาย/บริหาร'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme' => Select2::THEME_DEFAULT
            ])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <?php
            //                if(isset($compact)){
            //                    echo "<a class='btn btn-3d btn-blue pull-right' href='../compact/nextcompactbudget?id=".$id."&compact=".$compact."'></a>";
            //                }else{
            echo Html::submitButton('หน้าถัดไป', ['class' => 'btn btn-3d btn-info pull-right']);
            //}
            ?>

            <?php
            if (!$modelcompacthasprosub->isNewRecord) {
                if ($modelcompacthasprosub->compact_save == "true") {
                    echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../tablepro/track-project\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                } else {
                    echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../compact/deletebudget?compact=" . $compact . "\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                }


            } else {
                if (isset($compact)) {
                    echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../compact/deletebudget?compact=" . $compact . "\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                } else {
                    echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../tablepro/track-project\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                }

            }
            ?>

        </div>
    </div>
</fieldset>
<fieldset>
</fieldset>
<?php ActiveForm::end(); ?>


</div>
</div>
</div>
</div>
</div>
<!--step page-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var current = 1, current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);

        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed() - 50;
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });
</script>