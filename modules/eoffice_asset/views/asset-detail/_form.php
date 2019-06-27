<?php

use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker ;
use kartik\widgets\DepDrop;
use wbraganca\multiselect\MultiSelectWidget;

use app\modules\eoffice_asset\models\EofficeCentralViewPisRoom;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\AssetTypeUniversity;
use app\modules\eoffice_asset\models\AssetRoom;
use app\modules\eoffice_asset\models\AssetBuilding;
use wbraganca\dynamicform\DynamicFormWidget;

?>
<div class="asset-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> ฟอร์มแก้ไขครุภัณฑ์
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->

                    <div class="item panel panel-success"><!-- widgetBody -->
                        <div class="panel-heading">
                            <?php $x=1; ?>
                            <span class="panel-title-address">ประเภทครุภัณฑ์กลุ่มที่: <?php echo $x++ ?></span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">


                            <div class="row">
                                <div class="form-group ">
                                    <div class="col-md-6 col-sm-6 " readonly>
                                        <?= $form->field($model, 'asset_univ_code_start')->textInput(['disabled'=>'disabled']) ?>                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($model,'asset_univ_type')->dropDownList(ArrayHelper::map(AssetTypeUniversity::find()->all(), 'asset_type_univ_id', 'asset_type_univ_name'),['prompt'=>'เลือกประเภทครุภัณฑ์มหาวิทยาลัย']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group ">
                                    <div class="col-md-6 col-sm-6 ">
                                        <?= $form->field($model ,'asset_dept_code_start')->textInput(['disabled'=>'disabled'])  ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($model, 'asset_dept_type')->dropDownList(ArrayHelper::map(AssetTypeDepartment::find()->all(),'asset_type_dept_id','asset_type_dept_name'),['prompt'=>'เลือกประเภทครุภัณฑ์ภาควิชา']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4 ">
                                        <?= $form->field($model, 'asset_detail_name')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <?= $form->field($model, 'asset_detail_brand')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <?= $form->field($model, 'asset_detail_amount')->textInput(['disabled'=>'disabled']) ?>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model, 'asset_detail_age')->textInput() ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <?= $form->field($model, 'asset_detail_price')->textInput() ?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <?= $form->field($model, 'asset_detail_price_wreck')->textInput() ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <?= $form->field($model, 'asset_detail_insurance')->textInput() ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($model, 'asset_detail_building')->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->groupBy('buildings_id')->all(), 'rooms_id', 'buildings_id'),['prompt'=>'เลือกอาคาร']) ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($model, 'asset_detail_room')->dropDownList(ArrayHelper::map(EofficeCentralViewPisRoom::find()->all(), 'rooms_id', 'rooms_name'),['prompt'=>'เลือกห้อง/สถานที่']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                <div class="form-group ">
                    <div class="col-md-4 col-sm-4 "></div>
                    <div class="col-md-4 col-sm-4 ">

                        <?= Html::submitButton($model->isNewRecord ? 'update' : 'บันทึกข้อมูลครุภัณฑ์', ['class' => 'btn btn-3d btn-dirtygreen']) ?>

                    </div>
                    <div class="col-md-4 col-sm-4 "></div>
                </div>
            </div>


    <?php ActiveForm::end(); ?>

</div>