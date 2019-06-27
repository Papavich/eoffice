<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 22/4/2561
 * Time: 20:04
 */
?>
<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
?>
<style type="text/css">
    #dynamic-form fieldset:not(:first-of-type) {
        display: none ;
    }
</style>
<header id="page-header">
    <?php
        if($modelcompacthasprosub->compact_save == "true"){
            echo "<h1><strong>แก้ไขเอกสารอนุมัติขอใช้งบประมาณ</strong></h1>";
        }else{
            echo "<h1><strong>เพิ่มเอกสารอนุมัติขอใช้งบประมาณ</strong></h1>";
        }
    ?>

</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php
                //
                    if($comhasexecute!= null) {
                        ?>
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => [
                                'class' => 'execute-budget'
                            ] ,'method' => 'post', 'action' => '../compact/saveexecute']); ?>
                            <input type="hidden" name="id" id="id_prosub" value="<?= $id ?>">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar"
                                     aria-valuemin="100" aria-valuemax="100"></div>
                            </div>
                            <fieldset>
                                <input type="hidden" name="compact" id="compact" value="<?= $compact ?>">
                                <h3 style="margin-bottom: 0px">ส่วนที่ 2 ค่าใช้จ่าย</h3>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>กิจกรรมที่จัดมีค่าใช้จ่ายดังนี้</label>
                                        <?php DynamicFormWidget::begin([
                                            'widgetContainer' => 'dynamicform_wrapperexecute', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                            'widgetBody' => '.container-itemsexecute', // required: css class selector
                                            'widgetItem' => '.itemexecute', // required: css class
                                            'limit' => 10, // the maximum times, an element can be cloned (default 999)
                                            'min' => 1, // 0 or 1 (default 1)
                                            'insertButton' => '.add-itemexecutes', // css class
                                            'deleteButton' => '.remove-itemexecute', // css class
                                            'model' => $comhasexecute[0],
                                            'formId' => 'dynamic-form',
                                            'formFields' => [
                                                'execute_name',
                                            ],
                                        ]); ?>
                                        <div class="panel panel-default">

                                            <div class=" container-itemsexecute"><!-- widgetContainer -->
                                                <?php foreach ($comhasexecute as $execute => $modelsExecutes): ?>
                                                    <div class="itemexecute "><!-- widgetBody -->
                                                        <div class="panel-body row">
                                                            <div class="col-md-11 col-sm-11">

                                                                <?php
                                                                // necessary for update action.
                                                                if (!$modelsExecutes->isNewRecord) {
                                                                    echo Html::activeHiddenInput($modelsExecutes, "[{$execute}]pms_compact_has_prosub_id");
                                                                    echo Html::activeHiddenInput($modelsExecutes, "[{$execute}]pms_execute_execute_id");
                                                                }

                                                                $executeName = \app\modules\pms\models\PmsExecute::findOne($modelsExecutes->pms_execute_execute_id);
                                                                $i = $execute + 1;
                                                                echo "<div class='col-md-12 col-sm-12'>กิจกรรมที่ " . $executeName->execute_no . " " . $executeName->execute_name . "</div>";
                                                                ?>
                                                                <?php
                                                                //echo var_dump($modelsExecuteCost[$execute])."<br><br>";
                                                                ?>
                                                                <?= $this->render('compact_cost', [
                                                                    'form' => $form,
                                                                    'key' => $execute,
                                                                    'modelsExecuteCost' => $modelsExecuteCost[$execute],
                                                                ]) ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                        </div>
                                        <?php DynamicFormWidget::end(); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <a class="btn btn-3d btn-default pull-left"
                                           href="../compact/previouscompactbudget?compact=<?= $compact ?>&id=<?= $id ?>">ย้อนกลับ</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <button type="button" id="submit_executeb" class="btn btn-3d btn-success pull-right">บันทึก</button>
                                    </div>
                                </div>
                            </fieldset>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <span style="font-size: 24px;color: #a94442;">กรุณาเลือกกิจกรรมก่อนทำรายการต่อไป!</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a class="btn btn-3d btn-default pull-left"
                                       href="../compact/previouscompactbudget?compact=<?= $compact ?>&id=<?= $id ?>">ย้อนกลับ</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        $(".next").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed()-50;
            $(".progress-bar")
                .css("width",percent+"%")
                .html(percent+"%");
        }
    });
</script>