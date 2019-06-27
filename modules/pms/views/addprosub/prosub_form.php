<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 29/1/2561
 * Time: 18:58
 */

use app\modules\pms\models\Governance;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\PmsProject;
use Mpdf\Tag\Select;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;
$this->registerJsFile('@web/web_pms/plugins/datepicker/bootstrap-datepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$js = '
jQuery(".dynamicform_wrapperpurpose").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperpurpose .panel-title-address").each(function(purpose) {
        jQuery(this).html("วัถุ: " + (purpose + 1))
    });
});

jQuery(".dynamicform_wrapperpurpose").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperpurpose .panel-title-address").each(function(purpose) {
        jQuery(this).html("ัถุ: " + (purpose + 1))
    });
});

jQuery(".dynamicform_wrapperindicator").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperindicator .panel-title-address").each(function(indicator) {
        jQuery(this).html("ตัวชี้: " + (indicator + 1))
    });
});

jQuery(".dynamicform_wrapperindicator").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperindicator .panel-title-address").each(function(indicator) {
        jQuery(this).html("ตัวชี้: " + (indicator + 1))
    });
});


jQuery(".dynamicform_wrapperplace").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperplace .panel-title-address").each(function(place) {
        jQuery(this).html("สถานที่: " + (place + 1))
    });
});

jQuery(".dynamicform_wrapperplace").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperplace .panel-title-address").each(function(place) {
        jQuery(this).html("สถานที่: " + (place + 1))
    });
});


jQuery(".dynamicform_wrapperexecute").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperexecute .panel-title-address").each(function(execute) {
        jQuery(this).html("กิจกรรมที่: " + (execute + 1))
    });
});

jQuery(".dynamicform_wrapperexecute").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperexecute .panel-title-address").each(function(execute) {
        jQuery(this).html("กิจกรรมที่: " + (execute + 1))
    });
});

jQuery(".dynamicform_wrapperprobudget").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperprobudget .panel-title-address").each(function(probudget) {
        jQuery(this).html("งบประมาณจากรัฐ: " + (probudget + 1))
    });
});

jQuery(".dynamicform_wrapperprobudget").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperprobudget .panel-title-address").each(function(probudget) {
        jQuery(this).html("งบประมาณจากรัฐ: " + (probudget + 1))
    });
});

jQuery(".dynamicform_wrapperprobudgets").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperprobudgets .panel-title-address").each(function(probudgets) {
        jQuery(this).html("งบประมาณจากรายได้: " + (probudgets + 1))
    });
});

jQuery(".dynamicform_wrapperprobudgets").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperprobudgets .panel-title-address").each(function(probudgets) {
        jQuery(this).html("งบประมาณจากรายได้: " + (probudgets + 1))
    });
});

jQuery(".dynamicform_wrapperprobudget3").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperprobudget3 .panel-title-address").each(function(probudget3) {
        jQuery(this).html("งบประมาณอื่นๆ: " + (probudget3 + 1))
    });
});

jQuery(".dynamicform_wrapperprobudget3").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperprobudget3 .panel-title-address").each(function(probudget3) {
        jQuery(this).html("งบประมาณอื่นๆ: " + (probudget3 + 1))
    });
});


jQuery(".dynamicform_wrappercost").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrappercost .panel-title-address").each(function(cost) {
        jQuery(this).html("รายการที่: " + (cost + 1))
    });
});

jQuery(".dynamicform_wrappercost").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrappercost .panel-title-address").each(function(cost) {
        jQuery(this).html("รายการที่: " + (cost + 1))
    });
});

jQuery(".dynamicform_wrapperresult").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperresult .panel-title-address").each(function(result) {
        jQuery(this).html("รายการที่: " + (result + 1))
    });
});

jQuery(".dynamicform_wrapperresult").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperresult .panel-title-address").each(function(result) {
        jQuery(this).html("รายการที่: " + (result + 1))
    });
});


jQuery(".dynamicform_wrappereffect").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrappereffect .panel-title-address").each(function(effect) {
        jQuery(this).html("รายการที่: " + (effect + 1))
    });
});

jQuery(".dynamicform_wrappereffect").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrappereffect .panel-title-address").each(function(effect) {
        jQuery(this).html("รายการที่: " + (effect + 1))
    });
});

jQuery(".dynamicform_wrapperproblem").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperproblem .panel-title-address").each(function(problem) {
        jQuery(this).html("รายการที่: " + (problem + 1))
    });
});

jQuery(".dynamicform_wrapperproblem").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperproblem .panel-title-address").each(function(problem) {
        jQuery(this).html("รายการที่: " + (problem + 1))
    });
});



';
$this->registerJs($js);
$this->registerJsFile('@web/web_pms/js/valid_date.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/web_pms/js/dist/js/bootstrap-datepicker-custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/web_pms/js/dist/locales/bootstrap-datepicker.th.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/web_pms/js/jquery/jquery-2.1.4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<style type="text/css">
    #dynamic-form fieldset:not(:first-of-type) {
        display: none ;
    }
</style>
<?= Html::csrfMetaTags() ?>
<div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
</div>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => [
        'class' => 'prosub-valid-date'
    ]]);?>
<fieldset>
    <h3>ส่วนที่ 1 โครงการย่อย</h3>


    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label>ชื่อโครงการย่อย <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub,'prosub_name')->textInput()->label(false)?>
        </div>

        <div class="col-md-6 col-sm-6">
            <label>รหัสโครงการย่อย <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub,'prosub_code')->textInput()->label(false)->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '99-99-99-99-99-99',
            ])?>
        </div>
    </div>
    <?php
    $yearStart = 2560;
    $year = date("Y");
    $year = $year + 544;
    for($yearStart ; $yearStart <= $year ; $yearStart++){
        $array[$yearStart]=$yearStart;
    }
    ?>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label>ประจำปีงบประมาณ <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub, 'prosub_year')->widget(Select2::classname(), [
                'data'=>$array,
                'options' => ['placeholder' => 'เลือกปีงบประมาณ','id'=>'ddl-year'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme'=>Select2::THEME_DEFAULT
            ])->label(false);?>
        </div>

        <?php
        $data = PmsProject::find()->where(['project_year'=>$modelprosub->prosub_year])->all();
        if($data){
            foreach ($data as $row){
                $dataList[$row->project_code]=$row->project_name;
            }
        }else{
            $dataList = [];
        }
        ?>

        <div class="col-md-6 col-sm-6">
            <label>ภายใต้โครงการหลัก <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub, 'pms_project_project_code')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'options'=>['id'=>'ddl-project'],
                'data'=> $dataList,
                'select2Options'=>[
                    'theme'=>Select2::THEME_DEFAULT,
                ],
                'pluginOptions'=>[
                    'depends'=>['ddl-year'],
                    'placeholder'=>'เลือกโครงการหลัก',
                    'url'=>Url::to(['pms/../addprosub/get-project']),
                ],
            ])->label(false)
            ; ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label>ประเด็นยุทธศาสตร์ <span style="color: #de496f">*</span></label>
            <?php
            foreach ($strtegicisOfYear as $rows){
                $tmp = \app\modules\pms\models\StrategicIssues::find()->where(['strategic_issues_id'=>$rows->strategic_issues_id])->one();
                $arraysi[$tmp->strategic_issues_id]=$tmp->strategic_issues_id.". ".$tmp->strategic_issues_name;
            }
            ?>
            <?= $form->field($modelprosub, 'strategic_issues_id')->widget(Select2::classname(), [
                'data'=>$arraysi,
                'options' => ['placeholder' => 'เลือกประเด็นยุทธศาสตร์','id'=>'ddl-strategicIssues'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme'=>Select2::THEME_DEFAULT
            ])->label(false);?>

        </div>
        <?php
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        if($modelprosub->strategic_issues_id == null){
            $dlist=[];
        }else{
                $datas = \app\modules\pms\models\Strategic::find()->where(['strategic_id'=>$modelprosub->strategic_id,'strategic_issues_strategic_issues_id'=>$modelprosub->strategic_issues_id])->one();
                $dlist[$datas->strategic_id]=$datas->strategic_id.". ".$datas->strategic_name;
        }


        ?>
        <div class="col-md-6 col-sm-6">
            <label>กลยุทธ์ <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub, 'strategic_id')->widget(DepDrop::classname(), [
                'type'=>DepDrop::TYPE_SELECT2,
                'options'=>['id'=>'ddl-strategic'],
                'data'=> $dlist,
                'select2Options'=>[
                    'theme'=>Select2::THEME_DEFAULT,
                ],
                'pluginOptions'=>[
                    'depends'=>['ddl-strategicIssues'],
                    'placeholder'=>'เลือกกลยุทธ์',
                    'url'=>Url::to(['pms/../addprosub/get-strategic']),
                ],
            ])->label(false)
            ; ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <label>ลักษณะโครงการ</label>
            <?= $form->field($modelprosub, 'prosub_type')->dropDownList([
                'งานประจำ (Routine : R)'=>'งานประจำ (Routine : R)',
                'งานเชิงกลยุทธ์ (Strategy : S)'=>'งานเชิงกลยุทธ์ (Strategy : S)',
            ],['prompt'=>'เลือกลักษณะโครงการ'])->label(false)
            ; ?>
        </div>
        <?= $form->field($modelprosub, 'prosub_deparment')->hiddenInput(['value'=>'ภาควิชาวิทยาการคอมพิวเตอร์'])->label(false);?>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>ตอบสนองตามหลักธรรมาภิบาล (สามารถระบุได้มากกว่า 1 ข้อ) <span style="color: #de496f">*</span></label>
            <?php
                foreach ($governanceOfYear as $rows){
                    $tmp = Governance::find()->where(['governance_id'=>$rows->governance_id])->one();
                    $arrayg[$tmp->governance_id]=$tmp->governance_name;
                }

                if($modelprosub->prosub_code != null){
                    foreach (PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all() as $row){
                        $governanceList[]=$row->governance_id;
                    }
                    $modelgovernance->governance_id=$governanceList;
                }

            ?>
            <?= $form->field($modelgovernance, 'governance_id')->inline(true)->checkBoxList($arrayg)->label(false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>หลักการและเหตุ</label>
            <?= $form->field($modelprosub,'prosub_principle')->textarea(['rows' => '10'])->label(false)?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>วัตถุประสงค์</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperpurpose', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemspurpose', // required: css class selector
            'widgetItem' => '.itempurpose', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itempurpose', // css class
            'deleteButton' => '.remove-itempurpose', // css class
            'model' => $modelsPurpose[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'purpose_detail',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class=" container-itemspurpose"><!-- widgetContainer -->
                <?php foreach ($modelsPurpose as $purpose => $modelsPurposes): ?>
                    <div class="itempurpose"><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">
                                <?php
                                // necessary for update action.
    //                            if (!$modelsPurposes->isNewRecord) {
    //                                echo Html::activeHiddenInput($modelsPurposes, "[{$purpose}]id");
    //                            }
                                ?>
                                <?= $form->field($modelsPurposes, "[{$purpose}]purpose_detail")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itempurpose btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itempurpose btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มวัตถุประสงค์</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-sm-5">
            <label>ตัวชี้วัด</label>
        </div>
        <div class="col-md-5 col-sm-5">
            <label>ค่าเป้าหมายของโครงการ</label>
        </div>
        <div class="col-md-12 col-sm-12">

            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperindicator', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsindicator', // required: css class selector
                'widgetItem' => '.itemindicator', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemindicator', // css class
                'deleteButton' => '.remove-itemindicator', // css class
                'model' => $modelsIndicator[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'indicator_detail',
                    'indicator_goalValue',
                ],
            ]); ?>
            <div class="panel panel-default">
                <div class="container-itemsindicator"><!-- widgetContainer -->
                    <?php foreach ($modelsIndicator as $indicator => $modelsIndicators): ?>
                        <div class="itemindicator"><!-- widgetBody -->
                            <div class="panel-body row">
                                <?php
                                // necessary for update action.
                                //                            if (!$modelsIndicators->isNewRecord) {
                                //                                echo Html::activeHiddenInput($modelsIndicators, "[{$indicator}]id");
                                //                            }
                                ?>
                                <div class="col-md-5 col-sm-5">
                                    <?= $form->field($modelsIndicators, "[{$indicator}]indicator_detail")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <?= $form->field($modelsIndicators, "[{$indicator}]indicator_goalValue")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <button type="button" class="pull-right remove-itemindicator btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="">
                    <button type="button" class="pull-right add-itemindicator btn btn-success btn-xs"><i class="fa fa-plus"></i>เพิ่มตัวชี้วัด</button>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>ผู้รับผิดชอบระดับปฏิบัติ <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub, 'prosub_operator')->widget(Select2::classname(), [
                'data' => $operator,
                'options' => ['placeholder' => 'เลือกผู้รับผิดชอบระดับปฏิบัติ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme'=>Select2::THEME_DEFAULT
            ])->label(false);?>
        </div>

        <div class="col-md-12 col-sm-12">
            <label>ผู้รับผิดชอบระดับนโยบาย/บริหาร <span style="color: #de496f">*</span></label>
            <?= $form->field($modelprosub, 'prosub_manager')->widget(Select2::classname(), [
                'data' => $manager,
                'options' => ['placeholder' => 'เลือกผู้รับผิดชอบระดับนโยบาย/บริหาร'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'theme'=>Select2::THEME_DEFAULT
            ])->label(false);?>
        </div>
    </div>
    <input type="button" name="password" class="btn btn-info" id="valid_first_page" value="หน้าถัดไป" />
</fieldset>
<fieldset>
    <h3> ส่วนที่ 2 ระยะเวลาและการดำเนินงาน</h3>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>ระยะเวลาดำเนินการ</label>
        </div>
        <div class="col-md-5 col-sm-5">
            <?= $form->field($modelprosub,'prosub_start_date')->textInput()->label(false)?>

        </div>
        <div class="col-md-1 col-sm-1">
            <center><label>ถึง</label></center>
        </div>
        <div class="col-md-5 col-sm-5">
            <?= $form->field($modelprosub,'prosub_end_date')->textInput()->label(false)?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>สถานที่</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperplace', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsplace', // required: css class selector
            'widgetItem' => '.itemplace', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemplace', // css class
            'deleteButton' => '.remove-itemplace', // css class
            'model' => $modelsPlace[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'place_name',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class=" container-itemsplace"><!-- widgetContainer -->
                <?php foreach ($modelsPlace as $places => $modelsPlaces): ?>
                    <div class="itemplace"><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">
                                <?php
                                // necessary for update action.
    //                            if (!$modelsPlaces->isNewRecord) {
    //                                echo Html::activeHiddenInput($modelsPlaces, "[{$places}]id");
    //                            }
                                ?>
                                <?= $form->field($modelsPlaces, "[{$places}]place_name")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemplace btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemplace btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มสถานที่</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label>การดำเนินการ (ให้ระบุโครงการ / กิจกรรม)</label>
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperexecute', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsexecute', // required: css class selector
                'widgetItem' => '.itemexecute', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemexecute', // css class
                'deleteButton' => '.remove-itemexecute', // css class
                'model' => $modelsExecute[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'execute_name',
                    'execute_timestart',
                    'execute_timeend',
                    'execute_cost',
                    'execute_targetgroup',
                    'execute_amount',
                    'execute_operationplan',
                ],
            ]); ?>
            <div class="panel panel-default">

                <div class=" container-itemsexecute"><!-- widgetContainer -->
                    <?php foreach ($modelsExecute as $execute => $modelsExecutes): ?>
                        <div class="itemexecute "><!-- widgetBody -->
                            <div class="panel-body row">
                                <div class="col-md-11 col-sm-11">

                                    <?php
                                    // necessary for update action.
                                    //                        if (!$modelsExecutes->isNewRecord) {
                                    //                            echo Html::activeHiddenInput($modelsExecutes, "[{$execute}]id");
                                    //                        }
                                    ?>
                                    <div class="col-md-5 col-sm-5">
                                        <label>โครงการ / กิจกรรม</label>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <label>ระยะเวลาดำเนินงาน</label>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <?= $form->field($modelsExecutes, "[{$execute}]execute_name")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?= $form->field($modelsExecutes,"[{$execute}]execute_timestart")->textInput(['class' => 'form-control hasDatepicker'])->label(false)?>

                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        ถึง
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?= $form->field($modelsExecutes,"[{$execute}]execute_timeend")->textInput(['class' => 'form-control hasDatepicker'])->label(false)?>

                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <label>งบประมาณ (บาท)</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>กลุ่มเป้าหมาย</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>จำนวน (คน)</label>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <?= $form->field($modelsExecutes, "[{$execute}]execute_cost")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?= $form->field($modelsExecutes, "[{$execute}]execute_targetgroup")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?= $form->field($modelsExecutes, "[{$execute}]execute_amount")->textInput(['maxlength' => true])->label(false) ?>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <label>รูปแบบการดำเนินงาน (โดยสรุป)</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <?= $form->field($modelsExecutes, "[{$execute}]execute_operationplan")->textarea(['maxlength' => true])->label(false) ?>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <button type="button" class="pull-right remove-itemexecute btn btn-danger btn-xs" onclick="remove_itemexecute()"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="">
                    <button type="button" class="pull-right add-itemexecute btn btn-success btn-xs" onclick="add_itemexecute()"><i class="fa fa-plus"></i>เพิ่มโครงการ / กิจกรรม</button>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <input type="button" name="previous" class="previous btn btn-default" value="ย้อนกลับ" />
    <input type="button" name="next" class="next btn btn-info" value="หน้าถัดไป" />
</fieldset>
<fieldset>
    <h3> ส่วนที่ 3 งบประมาณ</h3>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <label>งบประมาณ</label><br>
        <label>งบประมาณจากรัฐ</label><br>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperprobudget', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsprobudget', // required: css class selector
            'widgetItem' => '.itemprobudget', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemprobudget', // css class
            'deleteButton' => '.remove-itemprobudget', // css class
            'model' => $modelProbudget[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'budget_sub',
                'budget_limit',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class="container-itemsprobudget"><!-- widgetContainer -->
                <?php foreach ($modelProbudget as $probudget => $modelProbudgets): ?>
                    <div class="itemprobudget"><!-- widgetBody -->
                        <div class="panel-body row">
                            <?php
                            // necessary for update action.
                            //                        if (!$modelProbudgets->isNewRecord) {
                            //                            echo Html::activeHiddenInput($modelProbudgets, "[{$probudget1}]id");
                            //                        }
                            ?>
                            <div class="col-md-4 col-sm-4">
                                <label>ประเภทงบรายจ่าย</label>
                                <?php
                                echo $form->field($modelProbudgets, "[{$probudget}]budget_sub")->dropdownList(
                                    ArrayHelper::map(\app\modules\pms\models\BudgetSub::find()->where(['budget_main_budget_id'=>1])->all(),
                                        'budget_id',
                                        'budget_name'),[
                                    //'id'=>"budgetsub-{$probudget}",
                                    'prompt'=>'เลือกรายจ่าย'
                                ])->label(false); ?>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <center><label>จำนวนเงิน</label></center>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>จำนวนเงิน</label>
                                <?= $form->field($modelProbudgets, "[{$probudget}]budget_limit")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                บาท
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemprobudget btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemprobudget btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มงบประมาณ</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>


        <label>งบประมาณรายได้</label><br>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperprobudgets', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsprobudgets', // required: css class selector
            'widgetItem' => '.itemprobudgets', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemprobudgets', // css class
            'deleteButton' => '.remove-itemprobudgets', // css class
            'model' => $modelProbudget2[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'budget_sub',
                'budget_limit',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class="container-itemsprobudgets"><!-- widgetContainer -->
                <?php foreach ($modelProbudget2 as $probudgets => $modelProbudgetss): ?>
                    <div class="itemprobudgets"><!-- widgetBody -->
                        <div class="panel-body row">
                            <?php
                            // necessary for update action.
                            //                        if (!$modelProbudgets->isNewRecord) {
                            //                            echo Html::activeHiddenInput($modelProbudgets, "[{$probudget1}]id");
                            //                        }
                            ?>
                            <div class="col-md-4 col-sm-4">
                                <label>ประเภทงบรายจ่าย</label>
                                <?php
                                echo $form->field($modelProbudgetss, "[{$probudgets}]budget_sub")->dropdownList(
                                    ArrayHelper::map(\app\modules\pms\models\BudgetSub::find()->where(['budget_main_budget_id'=>2])->all(),
                                        'budget_id',
                                        'budget_name'),[
                                    //'id'=>"budgetsub-{$probudget}",
                                    'prompt'=>'เลือกรายจ่าย'
                                ])->label(false); ?>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <center><label>จำนวนเงิน</label></center>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>จำนวนเงิน</label>
                                <?= $form->field($modelProbudgetss, "[{$probudgets}]budget_limit")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                บาท
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemprobudgets btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemprobudgets btn btn-success btn-xs" ><i class="fa fa-plus"></i> เพิ่มงบประมาณ</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>




        <label>งบประมาณอื่นๆ</label><br>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperprobudget3', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsprobudget3', // required: css class selector
            'widgetItem' => '.itemprobudget3', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemprobudget3', // css class
            'deleteButton' => '.remove-itemprobudget3', // css class
            'model' => $modelProbudget3[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'budget_other',
                'budget_limit',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class="container-itemsprobudget3"><!-- widgetContainer -->
                <?php foreach ($modelProbudget3 as $probudget3 => $modelProbudgets3): ?>
                    <div class="itemprobudget3"><!-- widgetBody -->
                        <div class="panel-body row">
                            <?php
                            // necessary for update action.
                            //                        if (!$modelProbudgets->isNewRecord) {
                            //                            echo Html::activeHiddenInput($modelProbudgets, "[{$probudget1}]id");
                            //                        }
                            ?>
                            <div class="col-md-4 col-sm-4">
                                <?php
                                echo $form->field($modelProbudgets3, "[{$probudget3}]budget_other")->textInput(['maxlength' => true])->label(false); ?>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <center><label>จำนวนเงิน</label></center>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelProbudgets3, "[{$probudget3}]budget_limit")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                บาท
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemprobudget3 btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemprobudget3 btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มงบประมาณ</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>

<!-- ---------------------- -->

    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>แจกแจงรายละเอียดค่าใช้จ่าย(สำหรับใช้ประกอบขออนุมัติจัดโครงการหรือขออนุมัติใช้เงิน)</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrappercost', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemscost', // required: css class selector
            'widgetItem' => '.itemcost', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemcost', // css class
            'deleteButton' => '.remove-itemcost', // css class
            'model' => $modelCostplan[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'cost_detail',
                'cost_price',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class=" container-itemscost"><!-- widgetContainer -->
                <?php foreach ($modelCostplan as $cost => $modelsCostplans): ?>
                    <div class="itemcost"><!-- widgetBody -->

                        <div class="panel-body row">
                            <?php
                            // necessary for update action.
    //                        if (!$modelsCostplans->isNewRecord) {
    //                            echo Html::activeHiddenInput($modelsCostplans, "[{$cost}]id");
    //                        }
                            ?>
                            <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelsCostplans, "[{$cost}]cost_detail")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">เป็นเงิน
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelsCostplans, "[{$cost}]cost_price")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">บาท
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="pull-right remove-itemcost btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemcost btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มรายการ</button>

            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>ผลที่คาดว่าจะได้รับ</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperresult', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsresult', // required: css class selector
            'widgetItem' => '.itemresult', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemresult', // css class
            'deleteButton' => '.remove-itemresult', // css class
            'model' => $modelResult[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'result_detail',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class=" container-itemsresult"><!-- widgetContainer -->
                <?php foreach ($modelResult as $result => $modelResults): ?>
                    <div class="itemresult"><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">
                            <?php
                            // necessary for update action.
    //                        if (!$modelResults->isNewRecord) {
    //                            echo Html::activeHiddenInput($modelResults, "[{$result}]id");
    //                        }
                            ?>
                            <?= $form->field($modelResults, "[{$result}]result_detail")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemresult btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemresult btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มผลที่คาดว่าจะได้รับ</button>

            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>ผลกระทบหรือความเสี่ยงอาจจะเกิดขึ้นถ้าไม่ได้ดำเนินโครงการ</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrappereffect', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemseffect', // required: css class selector
            'widgetItem' => '.itemeffect', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemeffect', // css class
            'deleteButton' => '.remove-itemeffect', // css class
            'model' => $modelEffect[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'effect_detail',
            ],
        ]); ?>
        <div class="panel panel-default">

            <div class=" container-itemseffect"><!-- widgetContainer -->
                <?php foreach ($modelEffect as $effect => $modelEffects): ?>
                    <div class="itemeffect"><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">
                            <?php
                            // necessary for update action.
    //                        if (!$modelEffects->isNewRecord) {
    //                            echo Html::activeHiddenInput($modelEffects, "[{$effect}]id");
    //                        }
                            ?>
                            <?= $form->field($modelEffects, "[{$effect}]effect_detail")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemeffect btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemeffect btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มผลกระทบ</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
        <label>ปัญหาอุปสรรคในรอบปีที่ผ่านมา</label>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapperproblem', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-itemsproblem', // required: css class selector
            'widgetItem' => '.itemproblem', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-itemproblem', // css class
            'deleteButton' => '.remove-itemproblem', // css class
            'model' => $modelProblem[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'problem_detail',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="container-itemsproblem"><!-- widgetContainer -->
                <?php foreach ($modelProblem as $problem => $modelProblems): ?>
                    <div class="itemproblem "><!-- widgetBody -->
                        <div class="panel-body row">
                            <div class="col-md-11 col-sm-11">
                            <?php
                            // necessary for update action.
    //                        if (!$modelProblems->isNewRecord) {
    //                            echo Html::activeHiddenInput($modelProblems, "[{$problem}]id");
    //                        }
                            ?>
                            <?= $form->field($modelProblems, "[{$problem}]problem_detail")->textInput(['maxlength' => true])->label(false) ?>
                            </div>
                            <div class="col-md-1 col-sm-1">
                                <button type="button" class="pull-right remove-itemproblem btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="">
                <button type="button" class="pull-right add-itemproblem btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มปัญหาอุปสรรค</button>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <input type="button" name="previous" class="previous btn btn-default" value="ย้อนกลับ" />
<!--    <input type="button" name="next" class="next btn btn-info" value="หน้าถัดไป" />-->
</fieldset>
<br>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="form-group">
            <?= Html::submitButton($modelprosub->isNewRecord ? 'เพิ่ม' : 'บันทึก', ['class' => 'btn btn-3d btn-success pull-right', 'id'=>'submit_prosub']) ?>

        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>

    var id_ex =1;

    function remove_itemexecute() {
//        if(id_ex > 1){setTimeout(function() {
//            var i1 = 0;
//            for(i ; i<=id_ex-1;i++){
//                $('#pmsexecute-'+i1+'-execute_timestart').datepicker({dateFormat:'yy-mm-dd'});
//                $('#pmsexecute-'+i1+'-execute_timeend').datepicker({dateFormat:'yy-mm-dd'});
//            } }, 500);
//            id_ex--;
//        }else{setTimeout(function() {
//            var i2 = 0;
//            for(i ; i<=id_ex;i++){
//                $('#pmsexecute-'+i2+'-execute_timestart').datepicker({dateFormat:'yy-mm-dd'});
//                $('#pmsexecute-'+i2+'-execute_timeend').datepicker({dateFormat:'yy-mm-dd'});
//            }  }, 500);
//        }
//        setTimeout(function() {
//        var numItems = (($('.hasDatepicker').length)-2)/2;
//        alert(numItems);
//        }, 500);

        var numItems = (($('.hasDatepicker').length))/2;
        var row = numItems-1;
        setTimeout(function() {
            var i = 0;
            for(i ; i<row;i++){

                $('#pmsexecute-'+i+'-execute_timestart').datepicker("destroy");
                $('#pmsexecute-'+i+'-execute_timestart').datepicker({
                    language: "th",
                    autoclose: true,
                    startView: 0,
                    format: "yyyy-mm-dd",
                });
                $('#pmsexecute-'+i+'-execute_timeend').datepicker("destroy");
                $('#pmsexecute-'+i+'-execute_timeend').datepicker({
                    language: "th",
                    autoclose: true,
                    startView: 0,
                    format: "yyyy-mm-dd",
                });
            }
            //alert(i);
        }, 500);

    }
    function add_itemexecute() {
        var numItems = (($('.hasDatepicker').length))/2;
        setTimeout(function() {
            var i = 0;
            for(i ; i<=numItems;i++){
                $('#pmsexecute-'+i+'-execute_timestart').datepicker({
                    language: "th",
                    autoclose: true,
                    startView: 0,
                    format: "yyyy-mm-dd",
                });
                $('#pmsexecute-'+i+'-execute_timeend').datepicker({
                    language: "th",
                    autoclose: true,
                    startView: 0,
                    format: "yyyy-mm-dd",
                });
            }
//            alert(numItems);
        }, 500);


    }

    $(document).ready(function(){

        var numItemss = (($('.hasDatepicker').length))/2;
        var i = 0;
        for(i;i<numItemss;i++ ){
            $('#pmsexecute-'+i+'-execute_timestart').datepicker({
                language: "th",
                autoclose: true,
                startView: 0,
                format: "yyyy-mm-dd",
            });
            $('#pmsexecute-'+i+'-execute_timeend').datepicker({
                language: "th",
                autoclose: true,
                startView: 0,
                format: "yyyy-mm-dd",
            });
        }
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;


        $("#valid_first_page").click(function (e) {
            e.preventDefault();
            var form = $(".prosub-valid-date").serialize();
            var datas = "";
            $.ajax({
                url: "../addprosub/rule-input",
                type: 'get',
                async: false,
                data: form,
                success: function (data) {
                    datas = data;
                    console.log(data);
                }
            });

            if (datas == "false") {
                $(".prosub-valid-date").submit();
                return false;
            } else {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                next_step.show();
                current_step.hide();
                setProgressBar(++current);
                return true;
            }

        });


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
            percent = percent.toFixed()-33;
            $(".progress-bar")
                .css("width",percent+"%")
                .html(percent+"%");
        }




//        $('.date-own').datepicker({
//            minViewMode: 2,
//            format: 'yyyy',
//        });

//        $('.datepicker').datepicker({
//            format: 'yyyy-mm-dd',
//            todayBtn: true,
//            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
//            thaiyear: true              //Set เป็นปี พ.ศ.
//        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน


    });
</script>

<?php
$this->registerJs(<<<JS
$(function(){
    $('#pmsprojectsub-prosub_start_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    $('#pmsprojectsub-prosub_end_date').datepicker({
        language: "th",
        autoclose: true,
        startView: 0,
        format: "yyyy-mm-dd",
    });
    
});

JS
);
?>
