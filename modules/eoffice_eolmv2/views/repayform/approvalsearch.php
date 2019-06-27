<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 13/11/2560
 * Time: 12:47
 */


use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolmv2\models\EolmDisbursementform;
use app\modules\eoffice_eolmv2\models\EolmRepay;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-approvalsearch">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข

                'attribute' => 'eolm_app_id',
                'value' => 'eolmApp.eolm_app_subject',
                'label'=>\app\modules\eoffice_eolmv2\controllers::t( 'menu','Approval form'),
            ],
            [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข

                'attribute' => 'eolm_loa_date',
                'label'=>\app\modules\eoffice_eolmv2\controllers::t( 'menu','Date of maturity'),
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
                        $mo = EolmRepay::find()->where('eolm_app_id='.$model->eolm_app_id)->one();
                        $dis = EolmDisbursementform::find()->where('eolm_app_id='.$model->eolm_app_id)->one();

                        if(empty($mo)){
                            if (empty($dis)){
                                return Html::a('<i class="fa fa-plus"></i> '.\app\modules\eoffice_eolmv2\controllers::t( 'menu','Create a Disbursement form'), '@web/eoffice_eolmv2/disbursementform/create?id='.$model->eolm_app_id, ['class'=>'btn btn-block btn-social btn-success'],[
                                    'title' => Yii::t('app', 'ทำแบบขออนุมัติเบิกจ่าย')
                                ]);
                            }else{
                                return Html::a('<i class="fa fa-plus"></i> '.\app\modules\eoffice_eolmv2\controllers::t( 'menu','Create repay form'), '@web/eoffice_eolmv2/repayform/create?id='.$model->eolm_app_id, ['class'=>'btn btn-block btn-social btn-success'],[
                                    'title' => Yii::t('app', 'บันทึกคืนเงินยืม')
                                ]);
                            }

                        }else{
                           /* $mo2 = \app\modules\eoffice_eolmv2\models\EolmApprovalform::find()->where('eolm_app_id='.$model->eolm_app_id)->one();
                            if ($mo2->eolm_status_id==1){*/
                                return Html::a('<i class="fa fa-pencil-square-o"></i> '.\app\modules\eoffice_eolmv2\controllers::t( 'menu','Update repay form'), '@web/eoffice_eolmv2/repayform/update?eolm_app_id='.$model->eolm_app_id.'&eolm_repay_date='.$mo->eolm_repay_date, ['class'=>'btn btn-block btn-social btn-warning'],[
                                    'title' => Yii::t('app', 'แก้ไขแบบขออนุมัติเบิกจ่าย')
                                ]).''.Html::a('<i class="fa fa-eye"></i> '.\app\modules\eoffice_eolmv2\controllers::t( 'menu','Details for repay form'), '@web/eoffice_eolmv2/repayform/view?eolm_app_id='.$model->eolm_app_id.'&eolm_repay_date='.$mo->eolm_repay_date, ['class'=>'btn btn-block btn-social btn-info'],[
                                        'title' => Yii::t('app', 'รายละเอียดแบบขออนุมัติเบิกจ่าย')
                                    ]);
                            /*}*/

                        }



                    },
                ],
            ],


        ],
    ]); ?>
</div>

