<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 14/2/2561
 * Time: 22:25
 */

use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasMethod;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\Governance;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\DepDrop;
use yii\jui\DatePicker;
use yii\bootstrap\Progress;
use yii\jui\ProgressBar;

use dosamigos\fileupload\FileUploadUI;

$this->registerJsFile('@web/web_pms/js/uploadfile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = '
jQuery(".dynamicform_wrapperproblem").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperproblem .panel-title-address").each(function(problem) {
        jQuery(this).html("วัถุ: " + (problem + 1))
    });
});

jQuery(".dynamicform_wrapperprobleme").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperproblem .panel-title-address").each(function(problem) {
        jQuery(this).html("ัถุ: " + (problem + 1))
    });
});


jQuery(".dynamicform_wrappersuggest").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrappersuggest .panel-title-address").each(function(suggest) {
        jQuery(this).html("วัถุ: " + (suggest + 1))
    });
});

jQuery(".dynamicform_wrappersuggest").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrappersuggest .panel-title-address").each(function(suggest) {
        jQuery(this).html("ัถุ: " + (suggest + 1))
    });
});

jQuery(".dynamicform_wrapperresult").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapperresult .panel-title-address").each(function(result) {
        jQuery(this).html("วัถุ: " + (result + 1))
    });
});

jQuery(".dynamicform_wrapperresult").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapperresult .panel-title-address").each(function(result) {
        jQuery(this).html("ัถุ: " + (result + 1))
    });
});

jQuery(".dynamicform_wrappertarget").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrappertarget .panel-title-address").each(function(target) {
        jQuery(this).html("วัถุ: " + (target + 1))
    });
});

jQuery(".dynamicform_wrappertarget").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrappertarget .panel-title-address").each(function(target) {
        jQuery(this).html("ัถุ: " + (target + 1))
    });
});
';


$this->registerJs($js);

?>
<?php
function YearThai($strDate){
    $result = validateDate($strDate);
    if($result == true){
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4,4);
        $year = $date+543;
        $reDate = str_replace($date,$year,$dateTh);
        return $reDate;
    }else{
        $strDate = Yii::$app->formatter->asDate($strDate, 'medium');
        return $strDate;
    }
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
$this->registerJsFile('@web/web_pms/js/table_status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= Html::csrfMetaTags() ?>
<?php $form = ActiveForm::begin(['id' => 'dynamic-form','options' => ['enctype' => 'multipart/form-data']]);?>
<fieldset>
    <input type="hidden" name="id_compact" value="<?=$id_compact?>">
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>1. ชื่อโครงการ : </b><?= $modelprosub->prosub_name?></label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label><b>2. รหัสโครงการ : </b><?= $modelprosub->prosub_code?></label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label><b>3. ผู้รับผิดชอบ : </b></label><br>
            <div style="padding-left: 30px">
ชื่อหน่วยงานที่รับผิดชอบ <?= $modelprosub->prosub_deparment?><br>
ชื่อผู้รับผิดชอบโครงการ  <?php
                $datar = EofficeCentralViewPisUser::find()->where(['id'=>$modelprosub->prosub_responsible_id])->one();
                echo " ".$datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                ?>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <label><b>4. ระยะเวลาดำเนินงาน : </b>วันที่ <?= YearThai($modelprosub->prosub_start_date)?> ถึง <?= YearThai($modelprosub->prosub_end_date)?></label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label><b>5. สถานที่ดำเนินโครงการ : </b> </label><br>
            <div style="padding-left: 30px">
                <?php
                    foreach ($modelsPlace as $key => $row){
                        $i = $key + 1;
                        echo $i.". ".$row->place_name."<br>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <label><b>6. สอดคล้องกับยุทธศาสตร์ของคณะวิทยาศาสตร์ : </b> </label><br>
            <div style="padding-left: 30px">
                <label>6.1 ประเด็นยุทธศาสตร์ที่ <?php echo $modelprosub->strategic_issues_id?></label><br>
                <label>6.2 กลยุทธ์ที่ <?php echo $modelprosub->strategic_issues_id.".".$modelprosub->strategic_id?></label><br>
                <div class="row">
                    <div class="col-md-1 col-sm-1" style="padding-right: 0px !important;">
                        <label class="text-center padding-top-10">6.3 ตัวชี้วัด :</label>
                    </div>
                    <div class="col-md-2 col-sm-2" style="padding-left: 0px !important;">
                        <?php

                        ?>
                        <?= $form->field($modelcomhasprosub, "indicator")->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>7. ผลการดำเนินงานตอบสนองตามหลักธรรมาภิบาล </b> (ตามที่ได้ระบุไว้ในแบบเสนอโครงการ_แผน 103)  </label><br>
            <div class="panel-body">
                <table style="text-align: center;border-collapse: collapse;" class="table table-striped table-hover table-bordered"
                       id="">
                    <thead>
                    <tr>
                        <th>หลักธรรมาภิบาล</th>
                        <th>การดำเนินงาน
                            (ให้ระบุวิธีการ/กระบวนการดำเนินงานอย่างสังเขป)
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all();



                    $i = 1;
                    foreach ($governanceOfYear as $key => $rows){
                        $j = 0;
                        foreach ($governancehaspro as $key => $rows2) {
                            if($rows['governance_id'] == $rows2['governance_id']){
                                $j++;
                            }
                        }
                        $data = Governance::find()->where(['governance_id'=>$rows->governance_id])->one();
                        if($j == 1){
                            $data2 =PmsGovernanceHasProjectSub::find()->where(['governance_id'=>$data->governance_id,'pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->one();
                            if($data2 != null){
                                $data3 = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact,'pms_governance_has_project_sub_governance_id'=>$data->governance_id,'pms_governance_has_project_sub_pms_project_sub_prosub_code'=>$id])->one();
                                if($data3){
                                    echo "<tr><td>".$i.". ".$data->governance_name."</td><td><input class=\"form-control required \" value='".$data3->method_detail."' type='text' name='governancedetail[]'> </td></tr>";
                                }else{
                                    echo "<tr><td>".$i.". ".$data->governance_name."</td><td><input class=\"form-control required \" value='' type='text' name='governancedetail[]'> </td></tr>";
                                }
                            }else{
                                echo "<tr><td>".$i.". ".$data->governance_name."</td><td><input class=\"form-control required \" type='text' name='governancedetail[]'> </td></tr>";
                            }


                        }else {
                            echo "<tr><td>".$i.". ".$data->governance_name."</td><td> </td></tr>";
                        }
                        $i++;
                    }
                    //'.$data2->method_detail.'
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php //exit;?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>8. ผลการดำเนินงาน </b> (ตามวัตถุประสงค์ของโครงการ)  </label><br>
            <div class="row">
                <div class="col-md-12 col-sm-12" style="padding-left: 30px">
                    <label><b>8.1 เชิงปริมาณ </b></label><br>
                </div>
                <div class="col-md-3 col-sm-3" style="padding-left: 30px">
                    <label>ผู้เข้าร่วมโครงการ (ตามกลุ่มเป้าหมาย)</label>
                </div>
                <div class="col-md-5 col-sm-5" style="padding-left: 30px">
                    <label>จำนวน(คน)</label>
                </div>
            </div>
            <div class="row">

                <?php
                    foreach ($modeltarget as $row){
                        echo "<div class='row' style=\"padding-left: 30px\"><div class='col-md-3 col-sm-3' style=\"padding-left: 30px\">".$row->targetgroup."</div><div class='col-md-2 col-sm-2'><input type='text' class='form-control' value='".$row->result_amount."' name='targetgroup_amount[]' /></div></div>";
                    }
                ?>


            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12" style="padding-left: 30px">
                    <label><b>8.2 เชิงคุณภาพ </b>(ผลที่ได้รับจากโครงการ)</label><br>
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapperresult', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-itemsresult', // required: css class selector
                        'widgetItem' => '.itemresult', // required: css class
                        'limit' => 10, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-itemresult', // css class
                        'deleteButton' => '.remove-itemresult', // css class
                        'model' => $modelresult[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'quality_detail',
                        ],
                    ]); ?>
                    <div class="panel panel-default">

                        <div class=" container-itemsresult"><!-- widgetContainer -->
                            <?php foreach ($modelresult as $result => $modelresults): ?>
                                <div class="itemresult"><!-- widgetBody -->
                                    <div class="panel-body row">
                                        <div class="col-md-11 col-sm-11">
                                            <?php
                                            // necessary for update action.
                                            //                                    if (!$modelproblems->isNewRecord) {
                                            //                                        echo Html::activeHiddenInput($modelEffects, "[{$effect}]id");
                                            //                                    }
                                            //                                    ?>
                                            <?= $form->field($modelresults, "[{$result}]quality_detail")->textInput(['maxlength' => true])->label(false) ?>
                                        </div>
                                        <div class="col-md-1 col-sm-1">
                                            <button type="button" class="pull-right remove-itemresult btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="">
                            <button type="button" class="pull-right add-itemresult btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่ม</button>
                        </div>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>9. ผลการประเมินโครงการ  : </b></label><br>
            <div class="row" style="padding-left: 30px">
                <div class="col-md-6 col-sm-6">
                    <label>ผลการประเมินโครงการ (โดยสรุป) </label>
                    <?= $form->field($modelcomhasprosub, "result_evaluate")->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>ระดับความพึงพอใจ </label>
                    <?= $form->field($modelcomhasprosub, "rate")->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>10. งบประมาณ</b></label><br>
            <div class="panel-body">
                <table style="text-align: center;border-collapse: collapse;" class="table table-striped table-hover table-bordered"
                       id="">
                    <thead>
                    <tr>
                        <th>งบประมาณ</th>
                        <th>จำนวนเงิน (บาท)</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr><td>งบประมาณที่ได้รับจัดสรร</td><td><?=$sumCost?></td></tr>
                    <tr><td>งบประมาณที่ใช้จ่ายจริง</td><td><?= $form->field($modelcomhasprosub, "sum_payment")->textInput(['maxlength' => true])->label(false) ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>11.ปัญหาอุปสรรค</b></label>
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapperproblem', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemsproblem', // required: css class selector
                'widgetItem' => '.itemproblem', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemproblem', // css class
                'deleteButton' => '.remove-itemproblem', // css class
                'model' => $modelproblem[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'problem_detail',
                ],
            ]); ?>
            <div class="panel panel-default">

                <div class=" container-itemsproblem"><!-- widgetContainer -->
                    <?php foreach ($modelproblem as $problem => $modelproblems): ?>
                        <div class="itemproblem"><!-- widgetBody -->
                            <div class="panel-body row">
                                <div class="col-md-11 col-sm-11">
                                    <?php
                                    // necessary for update action.
//                                    if (!$modelproblems->isNewRecord) {
//                                        echo Html::activeHiddenInput($modelEffects, "[{$effect}]id");
//                                    }
//                                    ?>
                                    <?= $form->field($modelproblems, "[{$problem}]problem_detail")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <button type="button" class="pull-right remove-itemproblem btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="">
                    <button type="button" class="pull-right add-itemproblem btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่ม</button>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>12. ข้อเสนอแนะ/แนวทางในการปรับปรุงของปีถัดไป</b></label>
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrappersuggest', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-itemssuggest', // required: css class selector
                'widgetItem' => '.itemsuggest', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-itemsuggest', // css class
                'deleteButton' => '.remove-itemsuggest', // css class
                'model' => $modelsuggest[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'suggest_detail',
                ],
            ]); ?>
            <div class="panel panel-default">

                <div class=" container-itemssuggest"><!-- widgetContainer -->
                    <?php foreach ($modelsuggest as $suggest => $modelsuggests): ?>
                        <div class="itemsuggest"><!-- widgetBody -->
                            <div class="panel-body row">
                                <div class="col-md-11 col-sm-11">
                                    <?php
                                    // necessary for update action.
                                    //                                    if (!$modelproblems->isNewRecord) {
                                    //                                        echo Html::activeHiddenInput($modelEffects, "[{$effect}]id");
                                    //                                    }
                                    //                                    ?>
                                    <?= $form->field($modelsuggests, "[{$suggest}]suggest_detail")->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                                <div class="col-md-1 col-sm-1">
                                    <button type="button" class="pull-right remove-itemsuggest btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="">
                    <button type="button" class="pull-right add-itemsuggest btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่ม</button>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <label><b>13. แนบเอกสารรายงานผลการประเมินโครงการ</b> <span style="color: red">*</span>(ขนาดไฟล์ไม่เกิน 10 MB)</label>
        </div>
<input type="hidden" id="id_compact" name="id_compact" value="<?=$id_compact?>">
        <div class="col-md-12 col-sm-12" style="padding-left: 30px;" id="showdoc">
           <?php
                if($modeldocument != null){
                    foreach ($modeldocument as $row){
                        echo "<div class=\"col-md-5 col-sm-5\"><a href='../../web_pms/uploads/".$row->document_name."'>".$row->document_name."</a></div> <div class=\"col-md-7 col-sm-7\"><a class=\"btn deletedoc btn-xs btn-danger\" data=\"".$row->document_name."\" ><i class=\"glyphicon glyphicon-minus\"></i>ลบ</a></div>";
                    }
                }
           ?>
        </div>



        <label class="control-label col-sm-4">อัปโหลดไฟล์เพิ่มเติม:</label>
        <br>
        <div class="col-md-12 col-sm-12">
            <?php
            echo FileUploadUI::widget([
                'model' => $model_file,
                'attribute' => 'file',
                'url' => ['addprosubresult/add-file?id_compact='.$id_compact],
                'gallery' => false,
                'fieldOptions' => [
                    'accept' => '/*',
                ],
                'clientOptions' => [
                    'maxFileSize' => 10000000,
                    'maxFiles' => 10,
                    'autoUpload' => true
                ],
                // ...
                'clientEvents' => [
                    'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                                
                            }',
                    'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);                                                        
                            }',

                ],
            ]);

            ?>
        </div>
    </div>



</fieldset>

<div class="col-md-12 col-sm-12">
        <?= Html::submitButton( 'บันทึก' , ['class' => 'btn btn-success pull-right']) ?>
    <a class="btn btn-blue pull-left" href="../addprosubresult/result-select"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
</div>

<?php ActiveForm::end(); ?>
</div>
</div>
</div>
</div>
</div>
