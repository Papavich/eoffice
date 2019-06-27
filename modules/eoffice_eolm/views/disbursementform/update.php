<?php

use yii\helpers\Html;
use app\modules\eoffice_eolm\models\EolmDisbursementformDetails;
use app\modules\eoffice_eolm\models\EolmDisbursementformDetailsItem;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmDisbursementform */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Update record details expenses');

use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['disbursementform/approvalajsearch']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-disbursementform-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modelsDisburse' => (empty($modelsDisburse)) ? [new EolmDisbursementformDetails] : $modelsDisburse,
        'modelsDetail' => (empty($modelsDetail)) ? [[new EolmDisbursementformDetailsItem]] : $modelsDetail
    ]) ?>

</div>
