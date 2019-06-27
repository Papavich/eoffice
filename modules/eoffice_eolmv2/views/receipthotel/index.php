<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dialog\Dialog;
use app\modules\eoffice_eolmv2\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmReceiptHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search details for accommodation');
use app\modules\eoffice_eolmv2\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch', 'id' => $_GET["id"]]];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch', 'id' => $_GET["id"]]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-hotel-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="	fa fa-plus"></i>'.\app\modules\eoffice_eolmv2\controllers::t( 'menu','Create Details for accommodation'), '@web/eoffice_eolmv2/receipthotel/create?id='.$_GET['id'], ['class'=>'btn btn-social btn-success'],[
        'title' => Yii::t('app', 'ทำสัญญา')
        ]);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'eolm_app_id',
                'value'=>'eolmApp.eolm_app_subject',
                'label' => \app\modules\eoffice_eolmv2\controllers::t( 'label_appform','Subject'),
            ],
            ['attribute' => 'eolm_hotel_id',
                'value'=>'eolmHotel.eolm_hotel_name',
                'label' => \app\modules\eoffice_eolmv2\controllers::t( 'label','Stay at'),
            ],['attribute' => 'eolm_rec_hotel_stay_date',
                'label' => \app\modules\eoffice_eolmv2\controllers::t( 'label','Check in date'),
            ],['attribute' => 'eolm_rec_hotel_checkout_date',
                'label' => \app\modules\eoffice_eolmv2\controllers::t( 'label','Check out date'),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{view} {update} {delete} {excel}',
                'contentOptions'=>[
                    'noWrap' => true],
                //'options'=> ['style'=>'width:250px;'],
                'buttons'=>[
                    'view' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for accommodation'),$url,['class'=>'btn btn-block btn-social btn-info']);
                    },
                    'update' => function($url,$model,$key){
                        return  Html::a('<i class="fa fa-pencil-square-o"></i> '.controllers::t( 'menu','Update a Hotel receipt'),$url,['class'=>'btn btn-block btn-social btn-warning']);
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
                            Html::a('<i class="fa fa-trash"></i> '.controllers::t( 'menu','Delete'),$url,['class'=>'btn btn-block btn-social btn-red','data' => ['confirm' => controllers::t('label', 'Are you sure you want to delete this item?'),'method' => 'post']]);
                    },
                    'excel' => function($url,$model,$key){
                        return  Html::a('<i class="fa fa-file-excel-o"></i> '.controllers::t( 'menu','Print'),$url,['class'=>'btn btn-block btn-social btn-success']);
                    },

                ],
            ],


        ],
    ]); ?>
</div>

