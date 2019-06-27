<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\eoffice_eolm\controllers;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    //'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'eolm_bor_type_id',
        'eolm_bor_detail',
        'eolm_bor_amount_date',
        'eolm_bor_amount',
        'eolm_bor_note',
    ],
]); ?>

    <table class="table table-bordered">
        <thead>
        <tr class="warning">
            <th><?= controllers::t( 'label', 'Travelling expenses')?></th>
           <!-- <th>จำนวนวัน/ระยะทาง</th>
            <th>จำนวนเงิน</th>
            <th>เหตุผลความจำเป็น</th>-->
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-rooms">
        <?php foreach ($modelsDetail as $indexDetail => $modelDetail): ?>
            <tr class="room-item warning">
                <td class="center">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelDetail, "[{$indexBorrow}][{$indexDetail}]eolm_bor_type_id")->label(false)
                        ->dropDownList(
                            \yii\helpers\ArrayHelper::map(\app\modules\eoffice_eolm\models\EolmBorrowingplansType::find()->asArray()->all(), 'eolm_bor_type_id', 'eolm_bor_type_name')
                        )->label(false) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelDetail, "[{$indexBorrow}][{$indexDetail}]eolm_bor_detail", [
                        'inputOptions' => [
                            'placeholder' => controllers::t( 'label', 'Details'),
                            'class'=>'form-control',
                        ],
                    ])->label(false)->textInput(['maxlength' => true]) ?>
                            <small id="emailHelp" class="form-text text-muted"><?= controllers::t( 'label', 'For example, Car registration number, flight')?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <?= $form->field($modelDetail, "[{$indexBorrow}][{$indexDetail}]eolm_bor_amount_date")->label(controllers::t( 'label', 'Number of days/distance'))->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <?= $form->field($modelDetail, "[{$indexBorrow}][{$indexDetail}]eolm_bor_amount")->label(controllers::t( 'label', 'Amount'))->textInput(['maxlength' => true,'class' => 'sumPart form-control']) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelDetail, "[{$indexBorrow}][{$indexDetail}]eolm_bor_note")->label(controllers::t( 'label', 'Necessity'))->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </td>
                <td class="text-center center" style="width: 50px;">
                    <button type="button" class="remove-room btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>

<?php DynamicFormWidget::end(); ?>

