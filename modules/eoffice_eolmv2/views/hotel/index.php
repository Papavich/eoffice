<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolmv2\assets\AppAssetEolm;
use yii\bootstrap\Modal;
AppAssetEolm::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Search accommodation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-hotel-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <p>
        <?= Html::a('<i class="fa fa-plus"></i> '.controllers::t( 'menu','Create a accommodation'), ['create'], ['class' => 'btn btn-social btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'eolm_hotel_id',
            'eolm_hotel_name',
            'eolm_hotel_address',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{view} {update} {delete} ',/*{word} */
                'contentOptions'=>[
                    'noWrap' => true],
                //'options'=> ['style'=>'width:250px;'],
                'buttons'=>[
                    'view' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for accommodation'),$url,['class'=>'btn btn-block btn-social btn-info']);
                    },
                    'update' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-pencil-square-o"></i> '.controllers::t( 'menu','Update a accommodation'),$url,['class'=>'btn btn-block btn-social btn-warning']);
                    },
                    'delete' => function($url,$model,$key){
                        return \kartik\dialog\Dialog::widget([
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
                ],
            ],
        ],
    ]); ?>
</div>
