<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;
use app\modules\eoffice_eolm\models\EolmApprovalformHasProvince;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmApprovalform */
use app\modules\eoffice_eolm\controllers;
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
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','User approval'),
                'value' => function($model) {
                    return $model->person1['academic_positions_abb_thai']." ".$model->person1['person_name']." ".$model->person1['person_surname'];
                }
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Follower'),
                'value' => function($model) {
                    return $model->person2['academic_positions_abb_thai']." ".$model->person2['person_name']." ".$model->person2['person_surname'];
                }
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Province'),
                'value' => function($model) {
                    $sql = 'SELECT * FROM eoffice_olm.eolm_approvalform_has_province  
                    LEFT JOIN eoffice_central.province ON eoffice_olm.eolm_approvalform_has_province.PROVINCE_ID = eoffice_central.province.PROVINCE_ID 
                    WHERE eoffice_olm.eolm_approvalform_has_province.eolm_app_id='.$model->eolm_app_id;
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
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Student follower'),
                'value' => function($model) {
                    $sql = 'SELECT * FROM eoffice_olm.eolm_approvalform_has_student  
                    LEFT JOIN eoffice_central.view_student_full ON eoffice_olm.eolm_approvalform_has_student.STUDENTID = eoffice_central.view_student_full.STUDENTID 
                    WHERE eoffice_olm.eolm_approvalform_has_student.eolm_app_id='.$model->eolm_app_id;
                    $model = \app\modules\eoffice_eolm\models\EolmApprovalformHasStudent::findBySql($sql)->asArray()->all();
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
            [   'attribute'=> 'eolm_app_retuen_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_retuen_date, 'long')." "
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Project'),
                'value' => $model->pro->ProSub_name
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','From budget plan'),
                'value' => $model->eolmBudp->eolm_budp_name
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Group disbursement'),
                'value' => $model->eolmExp->eolm_exp_name
            ],
            [   'attribute'=> 'eolm_app_event_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_app_event_date, 'long')." "
            ],
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Budgets'),
                'value' => $model->eolmBudt->eolm_budt_name
            ],
            'eolm_link',
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Type to be on duty as a civil servan'),
                'value' => $model->eolmType->eolm_type_name
            ],
            'eolm_budget_year'

            /*[
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Status'),
                'value' => $model->eolmStatus->eolm_status_name
            ],*/


        ],
    ]) ?>

    <p class="text-center">

        <?php

        use app\modules\eoffice_eolm\components\AuthHelper;
        $userType = AuthHelper::getUserType();
        if ($userType==AuthHelper::TYPE_APPROVERS){
            if($model->eolm_status_id==1){
                echo Html::a(controllers::t( 'label','Back'), ['index'], ['class' => 'btn btn-primary']).' ' ,
                Html::a(controllers::t( 'label','Update'), ['update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']);
            }elseif($model->eolm_status_id==2){

                echo Dialog::widget([
                    'libName' => 'krajeeDialogCust', // a custom lib name
                    'overrideYiiConfirm' => true,'options' => [  // customized BootstrapDialog options
                        //'size' => Dialog::SIZE_LARGE, // large dialog text
                       // 'type' => Dialog::TYPE_SUCCESS, // bootstrap contextual color
                        'title' => controllers::t('label', 'Confirm'),
                        'btnOKClass' => 'btn-warning',
                        'btnOKLabel' => controllers::t('label', 'Ok'),
                        'btnCancelLabel' => controllers::t('label', 'Cancel')]
                ]);
                echo Html::a(controllers::t( 'label','Back'),  Yii::$app->request->referrer, ['class' => 'btn btn-primary']).' ',
                    Html::a(controllers::t( 'label','Approve'), ['checked_ok', 'id' => $model->eolm_app_id], ['class' => 'btn btn-success',
                        'data' => [
                            'confirm' => controllers::t( 'label','Approve the document?'),
                            'method' => 'post',
                        ],
                    ]).' ',
                Html::a(controllers::t( 'label','Disapproved'), ['checked_no', 'id' => $model->eolm_app_id], ['class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => controllers::t( 'label','Disapprovedt?'),
                        'method' => 'post',
                    ],
                ]);
            }else{
                echo Html::a(controllers::t( 'label','Back'), ['index'], ['class' => 'btn btn-primary']);
            }
        }else{
            if($model->eolm_status_id==1){
                echo Html::a(controllers::t( 'label','Back'), Yii::$app->request->referrer, ['class' => 'btn btn-primary']).' ' ,
                Html::a(controllers::t( 'label','Update'), ['update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']);
            }else{
                echo Html::a(controllers::t( 'label','Back'), ['index'], ['class' => 'btn btn-primary']);
            }

        }
        ?> </p>
</div>