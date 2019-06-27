<?php

use yii\helpers\Html;
use app\modules\eoffice_eolm\models\EolmBorrowingplans;
use app\modules\eoffice_eolm\models\EolmBorrowingplansItem;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmLoancontract */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Create Contract loan');
use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Create approval form'), 'url' => ['approvalformsf/update', 'id' => $model->eolm_app_id]];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Create approval form'), 'url' => ['approvalformaj/update', 'id' => $model->eolm_app_id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-loancontract-create">

    <!--<h1></*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelsBorrow' => (empty($modelsBorrow)) ? [new EolmBorrowingplans] : $modelsBorrow,
        'modelsDetail' => (empty($modelsDetail)) ? [[new EolmBorrowingplansItem]] : $modelsDetail,
    ]) ?>

</div>
