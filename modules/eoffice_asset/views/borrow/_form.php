<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\selectivity\SelectivityWidget;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\EofficeCentralViewPisUser;

use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */
/* @var $form yii\widgets\ActiveForm */
/* @var $asset array */
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<!--==============================================USER========================================================-->
<div id="panel-info" class="panel panel-default cs-remargin" style="margin-top: 20px">
    <div class="panel-heading">
        ข้อมูลผู้ยืมครุภัณฑ์
    </div>
    <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <span><?php if($person['user_type_id'] == 0){
                        echo 'รหัสนักศึกษา ';
                        }
                        else
                        echo 'รหัสอาจารย์/เจ้าหน้าที่ ';
                    ?></span>: <span><?php echo $person['user_id']; ?></span>
                </div>
                <div class="col-md-4">
                    <span>ชื่อ - นามสกุล</span>: <span><?php echo $person['PREFIXNAME'];?>

                        <?php
                        if($person['user_type_id'] == 0){
                            echo $person['student_fname_th'];?>&nbsp;<?php echo $person['student_lname_th'];
                           // $person['person_fname_th'] = $modelBorrow['borrow_user_fname'];
                          //  $person['student_lname_th'] = $modelBorrow['borrow_user_lname'];


                        }
                        else
                            echo $person['person_fname_th'];?>&nbsp;<?php echo $person['person_lname_th'];
                                $person['person_fname_th'] = $modelBorrow['borrow_user_lname'];



                        ?></span>
                </div>
                <div class="col-md-4">
                    <span>วันที่</span>: <span><?php $time = time();
                        Yii::$app->formatter->locale = 'th_TH';
                       echo Yii::$app->formatter->asDate($time, 'php:Y-m-d');
                        ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <span>อีเมลล์</span>: <span><?php echo $person['email']; ?></span>
                </div>
                <div class="col-md-4">
                    <span>เบอร์โทรศัพท์</span>: <span><?php echo $person['STUDENTMOBILE'];?></span>
                </div>
            </div>
    </div>
</div>

<?php


?>

<!--===============================================================================================-->

<div id="panel-info" class="panel panel-default cs-remargin" style="margin-top: 20px">
    <div class="panel panel-default">
        <div class="panel-heading">
            คำร้องขอยืมครุภัณฑ์
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <?= $form->field($modelBorrow, 'borrow_object')->textarea() ?>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>

        <div class="padding-v-md">
            <div class="line line-dashed"></div>
        </div>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsBorrowDetail[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'borrow_detail_asset_id' ,
                //'borrow_detail_status'
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                 รายการยืมครุภัณฑ์
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>เพิ่มรายการยืมครุภัณฑ์</button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items"><!-- widgetContainer -->
                <?php foreach ($modelsBorrowDetail as $i => $modelBorrowDetail): ?>
             
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">รายการที่: <?= ($i + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                        <?php
                            // necessary for update action.
                            if (! $modelBorrowDetail->isNewRecord) {
                                echo Html::activeHiddenInput($modelBorrowDetail, "[{$i}]id");
                            }
                        ?>


                            <div class="row">
                                <div class="col-sm-6">
                                    <?php echo $form->field($modelBorrowDetail,
                                        "[{$i}]borrow_detail_asset_id")->dropDownList(ArrayHelper::map(AssetDetail::find()->all(),
                                        'asset_detail_id', 'asset_detail_name'),['prompt'=>'เลือกครุภัณฑ์']);
                                    ?>
                                </div>

                            </div><!-- end:row -->

                            <!-- end:row -->
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($modelBorrowDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



    </div>


        <!--==================================================================================-->
