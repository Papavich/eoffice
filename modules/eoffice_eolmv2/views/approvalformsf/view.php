<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;
use app\modules\eoffice_eolmv2\models\EolmApprovalformHasProvince;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmApprovalform */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Details for approval form');
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Check document'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [   'attribute'=> 'eolm_app_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_date, 'long')." "
            ],
            'eolm_app_subject',
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','User approval'),
                'value' => function($model) {
                    return $model->person1['academic_positions_abb_thai']." ".$model->person1['person_name']." ".$model->person1['person_surname'];
                }
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Follower'),
                'value' => function($model) {
                    return $model->person2['academic_positions_abb_thai']." ".$model->person2['person_name']." ".$model->person2['person_surname'];
                }
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Province'),
                'value' => function($model) {
                    $sql = 'SELECT * FROM eoffice_eolmv2.eolm_approvalform_has_province  
                    LEFT JOIN eoffice_central.province ON eoffice_eolmv2.eolm_approvalform_has_province.PROVINCE_ID = eoffice_central.province.PROVINCE_ID 
                    WHERE eoffice_eolmv2.eolm_approvalform_has_province.eolm_app_id='.$model->eolm_app_id;
                    $model = EolmApprovalformHasProvince::findBySql($sql)->asArray()->all();
                    $txt= "";
                    foreach($model as $m){
                        if ($m === reset($model)){
                            $txt=$m['PROVINCE_NAME'];
                        }else{
                            $txt=$txt.','.$m['PROVINCE_NAME'];
                        }
                    }
                    return $txt;
                }
            ]
           ,
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Student follower'),
                'value' => function($model) {
                    $sql = 'SELECT * FROM eoffice_eolmv2.eolm_approvalform_has_student  
                    LEFT JOIN eoffice_central.view_student_full ON eoffice_eolmv2.eolm_approvalform_has_student.STUDENTID = eoffice_central.view_student_full.STUDENTID 
                    WHERE eoffice_eolmv2.eolm_approvalform_has_student.eolm_app_id='.$model->eolm_app_id;
                    $model = \app\modules\eoffice_eolmv2\models\EolmApprovalformHasStudent::findBySql($sql)->asArray()->all();
                    $txt= "";
                    foreach($model as $m){
                        if ($m === reset($model)){
                            $txt=$m['STUDENTNAME']." ".$m['STUDENTSURNAME'];
                        }else{
                            $txt=$txt.','.$m['STUDENTNAME']." ".$m['STUDENTSURNAME'];
                        }
                    }
                    return $txt;
                }
            ]
            ,
            [   'attribute'=> 'eolm_app_deprture_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_deprture_date, 'long')." "
            ],
            [   'attribute'=> 'eolm_app_return_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_return_date, 'long')." "
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Project'),
                'value' => $model->pro->ProSub_name
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','From budget plan'),
                'value' => $model->eolmBudp->eolm_budp_name
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Group disbursement'),
                'value' => $model->eolmExp->eolm_exp_name
            ],
            [   'attribute'=> 'eolm_app_event_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_event_date, 'long')." "
            ],
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Budgets'),
                'value' => $model->eolmBudt->eolm_budt_name
            ],
            'eolm_link',
            [
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Type to be on duty as a civil servan'),
                'value' => $model->eolmType->eolm_type_name
            ],
            'eolm_budget_year'

            /*[
                'label' =>\app\modules\eoffice_eolmv2\controllers::t('label_appform','Status'),
                'value' => $model->eolmStatus->eolm_status_name
            ],*/


        ],
    ]) ?>

    <div class="form-group text-center">
        <?php
        if($model->eolm_status_id==0){
            echo Dialog::widget([
                'libName' => 'krajeeDialogCust', // a custom lib name
                'overrideYiiConfirm' => true,'options' => [  // customized BootstrapDialog options
                    //'size' => Dialog::SIZE_LARGE, // large dialog text
                    // 'type' => Dialog::TYPE_SUCCESS, // bootstrap contextual color
                    'title' => controllers::t('label', 'Confirm'),
                    'btnOKClass' => 'btn-warning',
                    'btnOKLabel' => /*Dialog::ICON_OK . ' ' . */controllers::t('label', 'Ok'),
                    'btnCancelLabel' => /*Dialog::ICON_CANCEL . ' ' . */controllers::t('label', 'Cancel')]
            ]);
            echo Html::a(controllers::t( 'label','Back'), Yii::$app->request->referrer, ['class' => 'btn btn-primary']).' ',
                 /*Html::a('แก้ไข', ['update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']).' ',*/
                 Html::a(controllers::t( 'label','Forward for approval'), ['checked', 'id' => $model->eolm_app_id], ['class' => 'btn btn-default',
                     'data' => [
                         'confirm' => controllers::t( 'label','Forward for approval?'),
                         'method' => 'post',
                     ],
                 ]);
        }else{
            echo Html::a(controllers::t( 'label','Back'),  Yii::$app->request->referrer, ['class' => 'btn btn-primary']);
        }?>
    </div>
</div>