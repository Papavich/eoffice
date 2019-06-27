<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolm\models\EolmStatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile(
    '@web/web_eolm/js/thaibath.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Download document');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-document">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

         <!-- echo Html::a('ทำแบบขออนุมัติหลักการ', ['create'], ['class' => 'btn btn-success']) -->
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
           // 'eolm_app_date',
            [ // แสดงชื่อ
                'attribute'=>'person1',
                'format'=>'html',
                'filter'=>ArrayHelper::map(\app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson::find()->all(),'person_id', function($model) {
                    return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'];
                }),
                'label' => controllers::t('label_appform','User approval'),
                'value'=> /*'person1.person_surname'*/function($model) {
                    return $model->person1['academic_positions_abb_thai']." ".$model->person1['person_name']." ".$model->person1['person_surname'];
                }
            ],
            'eolm_app_subject',
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => controllers::t('label','Download document'),
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="col-md-6 col-sm-6"> {word2} {word} {loancontractin/word} {disbursementform/word} </div><div class="col-md-6 col-sm-6"> {disbursementform/excel} {disbursementform/excel2} {disbursementform/download}</div>',/*{repayform/word}*//*  */
              'contentOptions'=>[
                'noWrap' => true],
             /// 'options'=> ['style'=>'width:250px;'],
              'buttons'=>[
                    'word2' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-file-word-o"></i> '.controllers::t( 'menu','Approval form for teachers'),$url,['class'=>'btn btn-block btn-social btn-blue btn-xs']);
                    },
                    'word' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-file-word-o"></i> '.controllers::t( 'menu','Approval form'),$url,['class'=>'btn btn-block btn-social btn-blue btn-xs']);
                    },
                    'loancontractin/word' => function($url,$model,$key){

                          $loan = \app\modules\eoffice_eolm\models\EolmLoancontract::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                          return $loan != null ? Html::a('<i class="fa fa-file-word-o"></i> '.controllers::t( 'menu','Loan agreement'),$url,['class'=>'btn btn-block btn-social btn-blue btn-xs']): null;
                    },
                    'disbursementform/word' => function($url,$model,$key){

                      $loan = \app\modules\eoffice_eolm\models\EolmDisbursementform::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                      return $loan != null ? Html::a('<i class="fa fa-file-word-o"></i> '.controllers::t( 'menu','Disbursement form'),$url,['class'=>'btn btn-block btn-social btn-blue btn-xs']): null;
                    },
                    'disbursementform/excel' => function($url,$model,$key){

                      $loan = \app\modules\eoffice_eolm\models\EolmDisbursementform::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                      return $loan != null ? Html::a('<i class="fa fa-file-excel-o"></i> '.controllers::t( 'menu','Proof of payment'),$url,['class'=>'btn btn-block btn-social btn-success btn-xs']): null;
                    },
                    'disbursementform/excel2' => function($url,$model,$key){

                      $items = \app\modules\eoffice_eolm\models\EolmDisbursementformDetailsItem::find()->where(['eolm_app_id'=> $model->eolm_app_id,'eolm_dis_detail_bill'=>2,'eolm_dis_type'=>1])->orWhere(['eolm_dis_type'=>2])->groupBy('person_id')
                          ->all();
                        $button='';
                        foreach($items as $item) {
                            $per1 = \app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson::find()->where(['person_id'=>$item["person_id"]])->one();
                            $person_id = $per1['academic_positions_abb_thai']." ".$per1['person_name']." ".$per1['person_surname'];

                            $button= $button.Html::a('<i class="fa fa-file-excel-o"></i> '.controllers::t( 'menu','Receipt of ').$person_id, ['disbursementform/excel2','id'=>$model->eolm_app_id ,'person_id'=>$item["person_id"]],['class'=>'btn btn-block btn-social btn-success btn-xs']);

                        }
                        return $button;
                    },
                  'disbursementform/download' => function($url,$model,$key){
                        $modeld=\app\modules\eoffice_eolm\models\EolmDisbursementform::find()->where(['eolm_app_id'=> $model->eolm_app_id])->one();

                        $file=\app\modules\eoffice_eolm\models\Uploads::find()->where(['ref'=>$modeld->ref])->asArray()->all();

                        $button2='';
                        foreach($file as $item) {
                            $button2= $button2.Html::a('<i class="fa fa-paperclip"></i> '.$item['file_name'], ['disbursementform/download','ref'=>$modeld->ref ,'name'=>$item['real_filename']],['class'=>'btn btn-block btn-social btn-amber btn-xs']);

                        }
                        return $button2;
                    },
                    /*'repayform/word' => function($url,$model,$key){

                      $loan = \app\modules\eoffice_eolm\models\EolmRepay::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                      return $loan != null ? Html::a('<i class="fa fa-file-word-o"></i> บันทึกคืนเงินยืม',$url,['class'=>'btn btn-block btn-social btn-blue btn-xs']): null;
                    },*/
                ],
            ],
            
            
        ],
    ]); ?>

</div>
