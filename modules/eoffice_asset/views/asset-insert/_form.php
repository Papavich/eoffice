<?php
//use yii\base\Model;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker ;
use kartik\widgets\DepDrop;
use wbraganca\multiselect\MultiSelectWidget;

use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetGet;
use app\modules\eoffice_asset\models\AssetCompany;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\AssetTypeUniversity;

use app\modules\eoffice_asset\models\AssetRoom;
use app\modules\eoffice_asset\models\AssetBuilding;

use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\FileInput;

$this->params['breadcrumbs'][] = $this->title;

?>


<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div id="content" class="padding-20">   <!-- required [php action request] -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> ฟอร์มนำเข้าครุภัณฑ์ (ส่วนที่ 1)
            </div>

            <div class="panel-body">

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">

                            <?= $form->field($modelAsset, 'asset_date')->widget(DatePicker::classname(), [
                                'language' => 'th',
                                'dateFormat' => 'yyyy-MM-dd',
                                'clientOptions'=>[
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                ],
                                'options'=>['class'=>'form-control']
                            ]) ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelAsset, 'asset_year')->textInput(['maxlength' => 4]) ?>
                        </div>
                        <div class="col-md-4 col-sm-4 ">

                            <?php echo $form->field($modelAsset, 'asset_get')->dropDownList(ArrayHelper::map(AssetGet::find()->all(), 'asset_get_id', 'asset_get_name'),['prompt'=>'เลือกวิธีการได้มา']) ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelAsset, 'asset_budget')->textInput() ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php echo $form->field($modelAsset, 'asset_company')->dropDownList(ArrayHelper::map(AssetCompany::find()->all(),
                                'asset_company_id', 'asset_company_name'),['prompt'=>'เลือกบริษัท']) ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>




    <!-----------------------------end insert asset-------------------------->


    <!------------------- insert asset detail (multi-form)----------------------->
    <?php DynamicFormWidget::begin([
      //  'options'=>'multipart/form-data',
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAssetDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'asset_univ_code_start',
            'asset_univ_type',
            'asset_dept_code_start',
            'asset_dept_type',
            'asset_detail_name',
            'asset_detail_brand',
            'asset_detail_amount',
            'asset_detail_age',
            'asset_detail_price',
            'asset_detail_price_wreck',
            'asset_detail_insurance',
            'asset_detail_building',
            'asset_detail_room',
            'asset_detail_image',

        ],
    ]); ?>

    
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-envelope"></i> ฟอร์มนำเข้าครุภัณฑ์ (ส่วนที่ 2)
                    <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> เพิ่มฟอร์ม</button>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-body container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsAssetDetail as $AssetDetail => $modelAssetDetail): ?>
                        <div class="item panel panel-success"><!-- widgetBody -->
                            <div class="panel-heading">
                                <?php $x=1; ?>
                                <span class="panel-title-address">ประเภทครุภัณฑ์กลุ่มที่: <?php echo $x++ ?></span>
                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
        //                        if (!$modelAssetDetail->isNewRecord) {
        //                            echo Html::activeHiddenInput($modelAssetDetail, "[{$AssetDetail}]asset_detail_id");
        //                        }
                                ?>



                                <div class="row">
                                    <div class="form-group ">
                                        <div class="col-md-6 col-sm-6 " readonly>
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_univ_code_start")->textInput(['maxlength' => 13]) ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <?php echo $form->field($modelAssetDetail, "[{$AssetDetail}]asset_univ_type")->dropDownList(ArrayHelper::map(AssetTypeUniversity::find()->all(), 'asset_type_univ_id', 'asset_type_univ_name'),['prompt'=>'เลือกประเภทครุภัณฑ์มหาวิทยาลัย']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-md-6 col-sm-6 ">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_dept_code_start")->textInput(['maxlength' => 12])  ?>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <?php echo $form->field($modelAssetDetail, "[{$AssetDetail}]asset_dept_type")->dropDownList(ArrayHelper::map(AssetTypeDepartment::find()->all(),'asset_type_dept_id','asset_type_dept_name'),['prompt'=>'เลือกประเภทครุภัณฑ์ภาควิชา']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 ">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_name")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4 ">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_brand")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4 ">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_amount")->textInput() ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_age")->textInput() ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4 ">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_price")->textInput() ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_price_wreck")->textInput() ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_insurance")->textInput() ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <?php echo $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_building")->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->groupBy('buildings_id')->all(), 'rooms_id', 'buildings_id'),['prompt'=>'เลือกอาคาร']) ?>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <?php echo $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_room")->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->groupBy('rooms_name')->all(), 'rooms_id', 'rooms_name'),['prompt'=>'เลือกห้อง/สถานที่']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6">
                                            <?= $form->field($modelAssetDetail, "[{$AssetDetail}]asset_detail_image")->label(false)->widget(FileInput::classname(), [
                                                'options' => [
                                                    'multiple' => false,
                                                    'accept' => 'image/*',
                                                    'class' => 'optionvalue-img'
                                                ],
                                                'pluginOptions' => [
                                                    'previewFileType' => 'image',
                                                    'showCaption' => false,
                                                    'showUpload' => false,
                                                    'browseClass' => 'btn btn-default btn-sm',
                                                    'browseLabel' => ' Pick image',
                                                    'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                                                    'removeClass' => 'btn btn-danger btn-sm',
                                                    'removeLabel' => ' Delete',
                                                    'removeIcon' => '<i class="fa fa-trash"></i>',
                                                    'previewSettings' => [
                                                        'image' => ['width' => '138px', 'height' => 'auto']
                                                    ],
                                                    //'initialPreview' => $initialPreview,
                                                    'layoutTemplates' => ['footer' => '']
                                                ]
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                    <?php DynamicFormWidget::end(); ?>
                    <div class="form-group ">
                        <div class="col-md-4 col-sm-4 "></div>
                        <div class="col-md-4 col-sm-4 ">
                            <?= Html::submitButton($modelAssetDetail->isNewRecord ? 'ยกเลิก' : '', ['class' => 'btn btn-3d btn-danger']) ?>
                            <?= Html::submitButton($modelAssetDetail->isNewRecord ? 'บันทึกข้อมูลครุภัณฑ์' : 'Update', ['class' => 'btn btn-3d btn-dirtygreen']) ?>

                        </div>
                        <div class="col-md-4 col-sm-4 "></div>
                    </div>
                </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>