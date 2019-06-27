<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:47
 */


use app\modules\pms\models\BudgetSub;
use app\modules\pms\models\PmsCompactHasExecute;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;
use yii\bootstrap\Alert;

$this->registerJsFile('@web/web_pms/plugins/datepicker/bootstrap-datepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('@web/web_pms/js/valid_date.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>

<?php
if (!$modelcompacthasprosub->isNewRecord) {
    $form = ActiveForm::begin(['action' => '../compact/nextcompactpandb', 'options' => [
        'class' => 'compact_pandb-valid-date'
    ]]);
} else {
    $form = ActiveForm::begin(['action' => '../compact/addcompactpandb', 'options' => [
        'class' => 'compact_pandb-valid-date'
    ]]);
}
?>
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0"
             aria-valuemax="100"></div>
    </div>
    <fieldset>
        <h3 style="margin-bottom: 0px">ส่วนที่ 1 เลือกกิจกรรม</h3>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label><b>ก. ขออนุมัติจัดโครงการ</b></label><br>
                <input type="hidden" name="id" value="<?= $modelprosub->prosub_code ?>">
                <label>1. ชื่อโครงการย่อย <?= $modelprosub->prosub_name ?></label>
                <br>
                <label>เลือกกิจกรรมที่ขอจัด</label><br>

                <?php
                if (!$modelcompacthasprosub->isNewRecord) {
                    echo "<input type='hidden' name='compact' value='" . $compact . "'>";
                }
                if (isset($compact)) {
                    foreach ($execute as $key => $row) {
                        $i = $key + 1;
                        $data = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id, 'pms_compact_has_prosub_id' => $compact])->one();
                        if ($data) {
                            echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" checked='checked' name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";
                        } else {
                            $checkCES = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id])->one();
                            if (!$checkCES) {
                                echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";
                            }

                        }
                    }
                } else {
                    foreach ($execute as $key => $row) {
                        $i = $key + 1;
                        $checkCES = PmsCompactHasExecute::find()->where(['pms_execute_execute_id' => $row->execute_id])->one();
                        if (!$checkCES) {
                            echo "<div class=\"row\" style='margin-bottom: 0px !important;margin-left: 10px;'><div class='col-md-5'><label >กิจกรรมที่ 1." . $row->execute_no . " " . $row->execute_name . "</label></div><div class='col-md-7'><input type=\"checkbox\" name=\"executecheck[]\" value=\"" . $row->execute_id . "\"/></div></div>";
                        }
                    }
                }

                ?>


                <label>2. รหัสโครงการ <?= $modelprosub->prosub_code ?></label><br>
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
                        foreach ($prosubbudget as $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 1) {
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $BudgetSub->budget_name . "</span></td><td>" . $row->budget_limit . "</td></tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td><span class="pull-left">งบประมาณ(งบรายได้)</span></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach ($prosubbudget as $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 2) {
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $BudgetSub->budget_name . "</span></td><td>" . $row->budget_limit . "</td></tr>";
                            }
                        }
                        ?>
                        <tr>
                            <td><span class="pull-left">งบอื่นๆ</span></td>
                            <td></td>
                        </tr>
                        <?php
                        foreach ($prosubbudget as $row) {
                            $BudgetSub = BudgetSub::findOne($row->budget_sub);
                            if ($row->budget_main == 3) {
                                echo "<tr><td><span class=\"pull-left\" style='padding-left: 20px;'>- " . $row->budget_other . "</span></td><td>" . $row->budget_limit . "</td></tr>";
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
                <?= $form->field($modelcompacthasprosub, 'start_date')->textInput()->label(false) ?>
            </div>
            <div class="col-md-1 col-sm-1">
                <center><label>ถึง</label></center>
            </div>
            <div class="col-md-5 col-sm-5">
                <?= $form->field($modelcompacthasprosub, 'end_date')->textInput()->label(false) ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <label>เบอร์โทรศัพท์</label>
                <?= $form->field($modelcompacthasprosub, 'phone_no')->textInput(['maxlength' => 10])->label(false) ?>
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
                echo Html::submitButton('หน้าถัดไป', ['class' => 'btn btn-3d btn-info pull-right', 'id' => 'submit_pandb']);
                ?>


                <?php
                if (!$modelcompacthasprosub->isNewRecord) {
                    if ($modelcompacthasprosub->compact_save == "true") {
                        echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../tablepro/track-project\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                    } else {
                        echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../compact/deletepandb?compact=" . $compact . "\"><i
                        class=\"glyphicon glyphicon-arrow-left\"></i>ย้อนกลับ</a>";
                    }


                } else {
                    if (isset($compact)) {
                        echo "<a class=\"btn btn-3d btn-blue pull-left\" href=\"../compact/deletepandb?compact=" . $compact . "\"><i
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
<?php
$this->registerJs(<<<JS
$(function(){
    $('#pmscompacthasprosub-start_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    $('#pmscompacthasprosub-end_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    
});

JS
);
?>