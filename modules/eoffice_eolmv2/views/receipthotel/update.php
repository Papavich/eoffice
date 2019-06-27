<?php

use yii\helpers\Html;
use app\modules\eoffice_eolmv2\models\EolmReceiptHotelDetails;
use app\modules\eoffice_eolmv2\models\EolmReceiptHotelDetailsPersonal;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmReceiptHotel */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Update details for accommodation');

use app\modules\eoffice_eolmv2\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch']];
}
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search details for accommodation'), 'url' => ['index', 'id' => $_GET["eolm_app_id"]]];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search details for accommodation'), 'url' => ['indexaj', 'id' => $_GET["eolm_app_id"]]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-hotel-update">



    <?= $this->render('_form', [
        'model' => $model,
        'modelsHotel' => (empty($modelsHotel)) ? [new EolmReceiptHotelDetails] : $modelsHotel,
        'modelsDetail' => (empty($modelsDetail)) ? [[new EolmReceiptHotelDetailsPersonal]] : $modelsDetail,
    ]) ?>

</div>
