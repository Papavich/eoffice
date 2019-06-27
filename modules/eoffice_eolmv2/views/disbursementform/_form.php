<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\eoffice_eolmv2\models\Person;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_eolmv2\models\EolmApprovalform;
use app\modules\eoffice_eolmv2\models\EolmLoancontract;

use app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasPersonal;
use app\modules\eoffice_eolmv2\assets\AppAssetEolm;

use app\modules\eoffice_eolmv2\controllers;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmDisbursementform */
/* @var $form yii\widgets\ActiveForm */
AppAssetEolm::register($this);
?>

<div class="eolm-disbursementform-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form',
        ]
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
        <tr class="info">
            <th><?php echo controllers::t( 'label', 'Expenses of')?>
            </th>
            <th style="width: 50px;">
                <button type="button" class="add-house btn btn-success btn-xs"><span
                            class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>

        </thead>
        <tbody class="container-items">
        <?php

        foreach ($modelsDisburse as $indexDisburse => $modelDisburse): ?>
            <!--
            $person = EolmApprovalformHasPersonal::find()->where(['eolm_app_id' =>$model->eolm_app_id,'eolm_app_has_person_type_id'=>1])->orWhere(['eolm_app_id' =>$model->eolm_app_id,'eolm_app_has_person_type_id'=>2])->orderBy(['eolm_app_has_person_type_id'=>SORT_DESC])->asArray()->all();
            for($counter = 0; $counter < sizeof($person); $counter++)
            { ?-->
            <tr class="house-item info">

                <td class="center">
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <?= $form->field($modelDisburse, "[{$indexDisburse}]person_id")->dropDownList(
                                ArrayHelper::map(EolmApprovalformHasPersonal::find()->select('person_id')->where(['eolm_app_id' => $model->eolm_app_id, 'eolm_app_has_person_type_id' => 1])->orWhere(['eolm_app_id' => $model->eolm_app_id, 'eolm_app_has_person_type_id' => 2])->all(), 'person_id', function ($modelp) {
                                    $modelp = EofficeMainViewPisPerson::find()->where(['person_id' => $modelp])->one();
                                    return $modelp['academic_positions_abb_thai'] . ' ' . $modelp['person_name'] . ' ' . $modelp['person_surname'];
                                })
                            )->label(false) ?>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_type")->label(false)->dropDownList(
                                ['1' => 'ค่าพาหนะ', '2' => 'ค่าใช้จ่ายอื่นๆ', '3' => 'ค่าเบี้ยเลี้ยง', '4' => 'ค่าที่พัก']
                            ); ?>
                        </div>
                    </div>

                    <!--php

                        $data = json_encode($person[$counter]);
                        $character = json_decode($data);
                        $p= $character->person_id;


                        $p = Person::find()->where(['person_id' => $p])->one();
                        echo $p['person_name'] . ' ' . $p['person_surname'];

                    echo $form->field($modelDisburse, "[{$indexDisburse}]person_id")->hiddenInput(['value' => $character->person_id])->label(false) ?-->


                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_total")->label(false)->textInput(['maxlength' => true]) ?-->
                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_total_text")->label(false)->textInput(['maxlength' => true]) ?-->
                    <!--?= $form->field($modelDisburse, "[{$indexDisburse}]eolm_dis_details_date")->label(false)->input('date') ?-->
                    <?= $this->render('_form-items', [
                        'form' => $form,
                        'indexDisburse' => $indexDisburse,
                        'modelsDetail' => $modelsDetail[$indexDisburse],
                    ]) ?>
                </td>
                <td>
                    <button type="button" class="remove-house btn btn-danger btn-xs"><span
                                class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>


    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'eolm_dis_date')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_go_from')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_go_date')->textInput(['style' => 'display:none;'])->label(false) ?>

    <?= $form->field($model, 'eolm_dis_back_to')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_back_date')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_disburse_for')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_allowance_type')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_allowance_day')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_hotal_day')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_vehicletype')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_vehicle_cost')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_other_expenses')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_other_expenses_cost')->textInput(['style' => 'display:none;'])->label(false) ?>
    <?= $form->field($model, 'eolm_dis_doc_count')->textInput(['style' => 'display:none;'])->label(false) ?>


    <?php ActiveForm::end(); ?>

</div>
