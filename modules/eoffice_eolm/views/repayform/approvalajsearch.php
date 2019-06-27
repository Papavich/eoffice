<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 13/11/2560
 * Time: 12:47
 */


use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolm\models\EolmStatus;
use app\modules\eoffice_eolm\models\EolmRepay;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-approvalajsearch">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- echo Html::a('ทำแบบขออนุมัติหลักการ', ['create'], ['class' => 'btn btn-success']) -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
                'attribute' => 'eolm_app_id',
                'value' => 'eolmApp.eolm_app_subject',
            ],
            'eolm_loa_date',
            'eolm_loa_use_date',
            'eolm_loa_refund_date',
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

                            if(empty($mo)){
                                return Html::a('<i class="fa fa-pencil-square-o"></i> บันทึกคืนเงินยืม', '@web/eoffice_eolm/repayform/create?id='.$model->eolm_app_id, ['class'=>'btn btn-block btn-social btn-success'],[
                                    'title' => Yii::t('app', 'ทำแบบขออนุมัติเบิกจ่าย')
                                ]);
                            }else{
                                $mo2 = \app\modules\eoffice_eolm\models\EolmApprovalform::find()->where('eolm_app_id='.$model->eolm_app_id)->one();
                                if ($mo2->eolm_status_id=1){
                                    return Html::a('<i class="fa fa-pencil-square-o"></i> แก้ไขบันทึกคืนเงินยืม', '@web/eoffice_eolm/repayform/update?eolm_app_id='.$model->eolm_app_id.'&eolm_repay_date='.$mo->eolm_repay_date, ['class'=>'btn btn-block btn-social btn-warning'],[
                                        'title' => Yii::t('app', 'แก้ไขแบบขออนุมัติเบิกจ่าย')
                                    ]);
                                }

                            }



                    },
                ],
            ],


        ],
    ]); ?>
</div>
