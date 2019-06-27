<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolmv2\models\EolmStatus;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Check document');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

         <!-- echo Html::a('ทำแบบขออนุมัติหลักการ', ['create'], ['class' => 'btn btn-success']) -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'eolm_app_id',
            [
                'attribute'=>'eolm_app_date',
                'headerOptions' => ['style' => 'width:25%'],
                'options' => [
                    'format' => 'YYYY-MM-DD',
                ],
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => ([
                    'attribute' => 'eolm_app_date',
                    'presetDropdown' => true,
                    'convertFormat' => false,
                    'pluginOptions' => [
                        'separator' => ' - ',
                        'format' => 'YYYY-MM-DD',
                        'locale' => [
                            'format' => 'YYYY-MM-DD'
                        ],
                    ],
                    'pluginEvents' => [
                        "apply.daterangepicker" => "function() { apply_filter('eolm_app_date') }",
                    ],
                ])
            ],
            'eolm_app_subject',
            //'eolm_app_number',
            //'eolm_app_deprture_date',
            // 'eolm_app_return_date',
            // 'eolm_app_vehicle_type',
            // 'eolm_app_vehicle_detail',
            // 'eolm_app_borrow_money',
            // 'eolm_approver_major',
            // 'eolm_approver_dean',
            // 'eolm_approver_finance',
            // 'eolm_budget_year',
            // 'eolm_link',
            // 'eolm_type_id',
             [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
              'attribute' => 'eolm_status_id',
              'format'=>'html',
              'filter'=>ArrayHelper::map(EolmStatus::find()->all(),'eolm_status_id','eolm_status_name'),
              'value'=>function($model, $key, $index, $column){
                if ($model->eolm_status_id==1) {
                    return "<span class=\"label label-info\">รอตรวจสอบ</span>";
                }elseif ($model->eolm_status_id==2) {
                    return "<span class=\"label label-warning\">รออนุมัติ</span>";
                }elseif ($model->eolm_status_id==3) {
                    return "<span class=\"label label-success\">อนุมัติ</span>";
                }elseif ($model->eolm_status_id==4) {
                    return "<span class=\"label label-danger\">ไม่อนุมัติ</span>";
                } elseif ($model->eolm_status_id == 0) {
                    return "<span class=\"label label-primary\">ตรวจสอบแล้ว</span>";
                }
              }
            ],
            // 'eolm_prot_id',
            // 'eolm_budp_id',
            // 'eolm_budt_id',
            // 'eolm_exp_id',
            // 'eolm_act_id',
            // 'pro_id',
            // 'crby',
            // 'crtime',
            // 'udby',
            // 'udtime',
            //['class' => 'yii\grid\ActionColumn'],
            [
              'class' => 'yii\grid\ActionColumn',
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'{view} {loancontractin/view} {disbursementform/view} {update} {delete} ',/*{word} */
              'contentOptions'=>[
                'noWrap' => true],
              //'options'=> ['style'=>'width:250px;'],
              'buttons'=>[
                    'view' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Travel request view'),$url,['class'=>'btn btn-block btn-social btn-info']);
                      },
                      'loancontractin/view' => function($url,$model,$key){

                          $loan = \app\modules\eoffice_eolmv2\models\EolmLoancontract::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                          return $loan != null ? Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for contract loan'),$url,['class'=>'btn btn-block btn-social btn-info']): null;
                      },
                      'disbursementform/view' => function($url,$model,$key){

                          $loan = \app\modules\eoffice_eolmv2\models\EolmDisbursementform::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                          return $loan != null ? Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for expenses'),$url,['class'=>'btn btn-block btn-social btn-info']): null;
                      },
                    'update' => function($url,$model,$key){
                        return $model->eolm_status_id == 1 ? Html::a('<i class="fa fa-pencil-square-o"></i> '.controllers::t( 'menu','Check document'),$url,['class'=>'btn btn-block btn-social btn-warning']): null;
                      },
                    'delete' => function($url,$model,$key){
                        return $model->eolm_status_id == 1 ?
                            Dialog::widget([
                                'libName' => 'krajeeDialogCust', // a custom lib name
                                'overrideYiiConfirm' => true,'options' => [  // customized BootstrapDialog options
                                    //'size' => Dialog::SIZE_LARGE, // large dialog text
                                    // 'type' => Dialog::TYPE_SUCCESS, // bootstrap contextual color
                                    'title' => controllers::t('label', 'Confirm'),
                                    'btnOKClass' => 'btn-warning',
                                    'btnOKLabel' => /*Dialog::ICON_OK . ' ' . */controllers::t('label', 'Ok'),
                                    'btnCancelLabel' => /*Dialog::ICON_CANCEL . ' ' . */controllers::t('label', 'Cancel')]
                            ]).
                            Html::a('<i class="fa fa-trash"></i> '.controllers::t( 'menu','Delete'),$url,['class'=>'btn btn-block btn-social btn-red','data' => ['confirm' => controllers::t('label', 'Are you sure you want to delete this item?'),'method' => 'post']]): null;
                      },
                    /*'word' => function($url,$model,$key){
                        return $model->eolm_status_id != 1 ? Html::a('<i class="et-printer"></i>พิมพ์',$url,['class'=>'btn btn-default']): null;
                    },*/
                ],
            ],
            
            
        ],
    ]); ?>
</div>
