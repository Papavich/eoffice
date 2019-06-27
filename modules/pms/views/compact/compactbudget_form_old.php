<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:47
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\jui\DatePicker;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;
use yii\bootstrap\Alert;


?>
<?= Html::csrfMetaTags() ?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<fieldset>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>ข. ขออนุมัติใช้เงินงบประมาณ <?php
                    //$data = \app\modules\pms\models\BudgetMain::findOne($budget->budget_main);
                    echo $budget;
                    ?></b></label><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <input type="hidden" value="<?=$modelcompacthasprosub->id?>" name="id_compact">
            <input type="hidden" value="<?=$id_pro?>" name="id_pro">
            <label>แผนงานที่ใช้</label>
            <?= $form->field($modelcompacthasprosub, "group_plan")->dropdownList(
                ArrayHelper::map(\app\modules\pms\models\GroupPlan::find()->all(),
                    'id',
                    'name'), [
                'prompt' => 'เลือกแผนงานที่ใช้'
            ])->label(false); ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>อุดหนุนยุทธศาสตร์</label>
            <?= $form->field($modelcompacthasprosub, "group_subsidized_strategy")->dropdownList(
                ArrayHelper::map(\app\modules\pms\models\GroupSubsidizedStrategy::find()->all(),
                    'id',
                    'name'), [
                'prompt' => 'เลือกอุดหนุนยุทธศาสตร์ที่ใช้'
            ])->label(false); ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>ค่าใช้จ่าย</label>
            <?= $form->field($modelcompacthasprosub, "group_expenses")->dropdownList(
                ArrayHelper::map(\app\modules\pms\models\GroupExpenses::find()->all(),
                    'id',
                    'name'), [
                'prompt' => 'เลือกประเภทค่าใช้จ่าย'
            ])->label(false); ?>
        </div>
    </div>
    <?php
    Yii::$app->getSession()->setFlash('alert', [
        'body' => 'ลงทะเบียนงานวิจัยเสร็จเรียบร้อย! เจ้าหน้าที่จะติดต่อกลับไปเร็วที่สุด..',
        'options' => ['class' => 'alert-success']
    ]);
    ?>

    <?php //echo var_dump($modelsExecute);exit;?>
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
                                    echo "<div class='col-md-12 col-sm-12'>กิจกรรมที่ " . $i . " " . $executeName->execute_name . "</div>";
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
            <?= Html::submitButton($modelcompacthasprosub->isNewRecord ? 'เพิ่ม' : 'บันทึก', ['class' => 'btn btn-3d btn-success']) ?>
            <a class="btn btn-3d btn-blue" href="../tableprois/table-compact-budget"><i
                        class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
        </div>
    </div>
</fieldset>
<?php ActiveForm::end(); ?>


</div>
</div>
</div>
</div>
</div>
