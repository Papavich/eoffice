<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmReceiptHotel */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Details for accommodation');
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
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search details for accommodation'), 'url' => ['index', 'id' => $_GET["eolm_app_id"]]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-hotel-view">

   <!-- <h1><?/*= Html::encode($this->title) */?></h1>

    <p>
        <?/*= Html::a('Update', ['update', 'eolm_app_id' => $model->eolm_app_id, 'eolm_hotel_id' => $model->eolm_hotel_id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'eolm_app_id' => $model->eolm_app_id, 'eolm_hotel_id' => $model->eolm_hotel_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>
-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'eolm_app_id',
            'eolm_hotel_id',
            'eolm_rec_hotel_stay_date',
            'eolm_rec_hotel_checkout_date',
            'eolm_rec_hotel_room_amount',
            'eolm_rec_hotel_nights_amount',
            'eolm_rec_hotel_price_per_room',
            'eolm_rec_hotel_amount',
            'eolm_rec_hotel_amount_text',
        ],
    ]) ?>
    <div class="form-group text-center">
        <?php
        $userType = \app\modules\eoffice_eolmv2\components\AuthHelper::getUserType();
        if ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_ADMIN){
            echo Html::a(\app\modules\eoffice_eolmv2\controllers::t( 'menu','Back'), ['index','id'=>$model->eolm_app_id], ['class' => 'btn btn-primary']);
        }elseif ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_TEACHER){
            echo Html::a(\app\modules\eoffice_eolmv2\controllers::t( 'menu','Back'), ['index','id'=>$model->eolm_app_id], ['class' => 'btn btn-primary']);
        }?>
    </div>


</div>
