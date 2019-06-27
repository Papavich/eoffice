<?php

use yii\helpers\Html;
use app\modules\eoffice_eolmv2\models\EolmBorrowingplans;
use app\modules\eoffice_eolmv2\models\EolmBorrowingplansItem;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmLoancontract */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Update contract loan');

//$this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบเอกสาร', 'url' => ['index']];
use app\modules\eoffice_eolmv2\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalformsf/approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalformaj/approvalajsearch']];
}
$this->params['breadcrumbs'][] = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Update contract loan');
?>
<div class="eolm-loancontract-update">

    <!--<h1></*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        /*'data' => $data,*/
        'modelsBorrow' => (empty($modelsBorrow)) ? [new EolmBorrowingplans] : $modelsBorrow,
        'modelsDetail' => (empty($modelsDetail)) ? [[new EolmBorrowingplansItem]] : $modelsDetail,
    ]) ?>

</div>
