<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use app\modules\eoffice_eolm\controllers;
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'eolm_bor_activities',
        'eolm_bor_amount',
        'eolm_bor_note',
    ],
]); ?>

    <table class="table table-bordered">
        <thead>
        <tr class="warning">
            <th><?=controllers::t( 'label','Details of')?></th>
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-rooms">
        <?php foreach ($modelsDetail as $indexDetail => $modelDetail): ?>
            <tr class="room-item warning">
                <td>
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <?php
                            $i='';
                            if ($model->isNewRecord){
                                $i =$_GET["id"];
                            }else{
                                $i =$_GET["eolm_app_id"];
                            }
                            $sql = 'SELECT * FROM eolm_approvalform_has_personal 
left join eolm_approvalform_has_student on eolm_approvalform_has_personal.eolm_app_id = eolm_approvalform_has_student.eolm_app_id
left join eoffice_central.view_pis_person on eolm_approvalform_has_personal.person_id = eoffice_central.view_pis_person.person_id
left join eoffice_central.view_student_full on eolm_approvalform_has_student.STUDENTID = eoffice_central.view_student_full.STUDENTID
where eolm_approvalform_has_personal.eolm_app_id='.$i ?>
                            <?= $form->field($modelDetail, "[{$indexHotel}][{$indexDetail}]person_id")->dropDownList(ArrayHelper::map(EofficeMainViewPisPerson::findBySql($sql)->all(), 'person_id', function($model) {
                                    return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'];
                                }))->label(controllers::t( 'label','Name'));?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                        <?= $form->field($modelDetail, "[{$indexHotel}][{$indexDetail}]eolm_rec_hotel_details_personal_amount")->label(controllers::t( 'label','Amount'))->textInput(['maxlength' => true,'class' => 'sumPart form-control']) ?>
                        </div>
                    </div>
                </td>
                <td style="width: 50px;">
                    <button type="button" class="remove-room btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php DynamicFormWidget::end(); ?>