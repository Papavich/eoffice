<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 13/11/2560
 * Time: 12:47
 */


use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolmv2\models\EolmStatus;
use app\modules\eoffice_eolmv2\models\EolmLoancontract;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_eolmv2\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-approvalsearch">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- echo Html::a('ทำแบบขออนุมัติหลักการ', ['create'], ['class' => 'btn btn-success']) -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'eolm_app_id',
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
            /*[ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
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
            ],*/
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

            [ // แสดงชื่อ
                'attribute'=>'person1',
                'format'=>'html',
                'filter'=>ArrayHelper::map(\app\modules\eoffice_eolmv2\models\model_main\EofficeMainViewPisPerson::find()->all(),'person_id', function($model) {
                    return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'];
                }),
                'label' => controllers::t( 'label_appform','User approval'),
                'value'=> /*'person1.person_surname'*/function($model) {
                    return $model->person1['academic_positions_abb_thai']." ".$model->person1['person_name']." ".$model->person1['person_surname'];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{loan}',
                'contentOptions'=>[
                    'noWrap' => true],
                //'options'=> ['style'=>'width:250px;'],
                'buttons'=>[
                    /*'view' => function($url,$model,$key){
                        return Html::a('<i class="et-search"></i>ดู',$url,['class'=>'btn btn-default']);
                    },*/
                    'loan' => function ($url, $model,$key) {
                            return Html::a('<i class="	fa fa-plus"></i> '.controllers::t( 'menu','Create a Receipt for Student'), '@web/eoffice_eolmv2/receiptstudent/index?id='.$model->eolm_app_id, ['class'=>'btn btn-block btn-social btn-success'],[
                                'title' => Yii::t('app', 'ทำใบแทนใบเสร็จของนักศึกษา')
                            ]);


                    },
                ],
            ],


        ],
    ]); ?>
</div>
