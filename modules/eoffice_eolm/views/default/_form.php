<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\eoffice_eolm\models\Person;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use app\modules\eoffice_eolm\models\EolmLoancontract;
use app\modules\eoffice_eolm\models\EolmProvince;
use app\modules\eoffice_eolm\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolm\assets\AppAssetEolm;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmDisbursementform */
/* @var $form yii\widgets\ActiveForm */
AppAssetEolm::register( $this );
?>

<div class="eolm-disbursementform-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form',
        'fieldClass' => 'justinvoelker\awesomebootstrapcheckbox\ActiveField',
    ]); ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsDisburse[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'person_id',
            'eolm_dis_details_total',
            'eolm_dis_details_total_text',
            'eolm_dis_details_date',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th style="width: 85px;">รายละเอียดค่าใช้จ่ายของ <button type="button" class="add-house btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button></th>
        </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsDisburse as $indexDisburse => $modelDisburse): ?>
            <tr class="house-item">
                <td class="vcenter">
                    <div class="col-md-3 col-sm-2">
                        <?= $form->field($modelDisburse, "[{$indexDisburse}]person_id")->dropDownList(
                            ArrayHelper::map(EolmApprovalformHasPersonal::find()->select('person_id')->where(['eolm_app_id' =>$model->eolm_app_id])->all(), 'person_id', function($modelp) {
                                $modelp=Person::find()->where(['person_id'=>$modelp])->one();
                                return $modelp['person_name'].' '.$modelp['person_surname'];
                            } /*'ใส่ชื่อและนามสกุล'*/)
                        )->label(false) ?>
                    </div>

                    <button type="button" class="remove-house btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_total")->label(false)->textInput(['maxlength' => true]) ?-->
                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_total_text")->label(false)->textInput(['maxlength' => true]) ?-->
                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_date")->label(false)->input('date') ?-->
                    <?= $this->render('_form-items', [
                        'form' => $form,
                        'indexDisburse' => $indexDisburse,
                        'modelsDetail' => $modelsDetail[$indexDisburse],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'eolm_dis_go_from')->textInput(['style'=>'display:none;'])->label(false)?>


    <?php ActiveForm::end(); ?>

</div>
