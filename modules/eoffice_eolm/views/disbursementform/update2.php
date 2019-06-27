<?php

use yii\helpers\Html;
use app\modules\eoffice_eolm\models\EolmDisbursementformDetails;
use app\modules\eoffice_eolm\models\EolmDisbursementformDetailsItem;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmDisbursementform */
use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Create a Disbursement form');
use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalajsearch']];
}
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Create record details expense'), 'url' => ['disbursementform/update', 'id' => $model->eolm_app_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-disbursementform-update2">


    <?= $this->render('_form2', [
        'model' => $model,
        'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
