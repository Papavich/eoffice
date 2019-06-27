<?php

use yii\helpers\Html;
use app\modules\eoffice_eolmv2\models\EolmDisbursementformDetails;
use app\modules\eoffice_eolmv2\models\EolmDisbursementformDetailsItem;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmDisbursementform */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Create record details expenses');
$userType = \app\modules\eoffice_eolmv2\components\AuthHelper::getUserType();
if ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalsearch']];
}elseif ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_TEACHER||$userType == \app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalajsearch']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-disbursementform-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDisburse' => (empty($modelsDisburse)) ? [new EolmDisbursementformDetails] : $modelsDisburse,
        'modelsDetail' => (empty($modelsDetail)) ? [[new EolmDisbursementformDetailsItem]] : $modelsDetail,
    ]) ?>

</div>
