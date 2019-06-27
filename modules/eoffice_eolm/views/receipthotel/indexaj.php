<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dialog\Dialog;
use app\modules\eoffice_eolm\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmReceiptHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Search a Hotel receipt');
use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-hotel-indexaj">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> ทำรายละเอียดค่าที่พัก', ['create'], ['class' => 'btn btn-social btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'eolm_app_id',
                'value'=>'eolmApp.eolm_app_subject'],
            ['attribute' => 'eolm_hotel_id',
                'value'=>'eolmHotel.eolm_hotel_name'],
            'eolm_rec_hotel_stay_date',
            'eolm_rec_hotel_checkout_date',
            //'eolm_rec_hotel_room_amount',
            //'eolm_rec_hotel_nights_amount',
            //'eolm_rec_hotel_price_per_room',
            //'eolm_rec_hotel_amount',
            //'eolm_rec_hotel_amount_text',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{view} {update} {delete} ',
                'contentOptions'=>[
                    'noWrap' => true],
                //'options'=> ['style'=>'width:250px;'],
                'buttons'=>[
                    'view' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-eye"></i> รายละเอียด',$url,['class'=>'btn btn-block btn-social btn-info']);
                    },
                    'update' => function($url,$model,$key){
                        return  Html::a('<i class="fa fa-pencil-square-o"></i> แก้ไข',$url,['class'=>'btn btn-block btn-social btn-warning']);
                    },
                    'delete' => function($url,$model,$key){
                        return Dialog::widget([
                                'libName' => 'krajeeDialogCust', // a custom lib name
                                'overrideYiiConfirm' => true,'options' => [  // customized BootstrapDialog options
                                    //'size' => Dialog::SIZE_LARGE, // large dialog text
                                    // 'type' => Dialog::TYPE_SUCCESS, // bootstrap contextual color
                                    'title' => controllers::t('label', 'Confirm'),
                                    'btnOKClass' => 'btn-warning',
                                    'btnOKLabel' => /*Dialog::ICON_OK . ' ' . */controllers::t('label', 'Ok'),
                                    'btnCancelLabel' => /*Dialog::ICON_CANCEL . ' ' . */controllers::t('label', 'Cancel')]
                            ]).
                            Html::a('<i class="fa fa-trash"></i> ลบ',$url,['class'=>'btn btn-block btn-social btn-red','data' => ['confirm' => controllers::t('label', 'Are you sure you want to delete this item?'),'method' => 'post']]);
                    },

                ],
            ],


        ],
    ]); ?>
</div>

