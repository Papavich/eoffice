<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\modules\eoffice_eolmv2\models\EolmStatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolmv2\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\eoffice_eolmv2\controllers;
$this->title = controllers::t( 'menu','Consider approval');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-index2">

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
             [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
              'attribute' => 'eolm_status_id',
              'format'=>'html',
              'filter'=>ArrayHelper::map(EolmStatus::find()->where(['eolm_status_id' => 2])->orWhere(['eolm_status_id' => 3])->orWhere(['eolm_status_id' => 4])->all(),'eolm_status_id','eolm_status_name'),
              'value'=>function($model, $key, $index, $column) {
                  if ($model->eolm_status_id == 2) {
                      return "<span class=\"label label-warning\">รออนุมัติ</span>";
                  } elseif ($model->eolm_status_id == 3) {
                      return "<span class=\"label label-success\">อนุมัติ</span>";
                  } elseif ($model->eolm_status_id == 4) {
                      return "<span class=\"label label-danger\">ไม่อนุมัติ</span>";
                  }
              }
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'{view} {loancontractin/view} {disbursementform/view}',/* {update} {delete} */ /*{word}  */
              'contentOptions'=>[
                'noWrap' => true],
              //'options'=> ['style'=>'width:250px;'],
              'buttons'=>[
                    'view' => function($url,$model,$key){
                        if ($model->eolm_status_id == 2) {
                            return Html::a('<i class="fa fa-pencil-square-o"></i> '.controllers::t( 'menu','Consider approval'), $url, ['class' => 'btn btn-block btn-social btn-warning']);
                        }else{
                            return Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Travel request view'),$url,['class'=>'btn btn-block btn-social btn-info']);
                        }
                    },
                    'loancontractin/view' => function($url,$model,$key){

                          $loan = \app\modules\eoffice_eolmv2\models\EolmLoancontract::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                          return $loan != null ? Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for contract loan'),$url,['class'=>'btn btn-block btn-social btn-info']): null;
                    },
                    /*'disbursementform/view' => function($url,$model,$key){

                      $loan = \app\modules\eoffice_eolmv2\models\EolmDisbursementform::findAll(['eolm_app_id'=> $model->eolm_app_id]);

                      return $loan != null ? Html::a('<i class="fa fa-eye"></i> รายละเอียดใบเบิกจ่าย',$url,['class'=>'btn btn-block btn-social btn-info']): null;
                    },*/
                    /*'update' => function($url,$model,$key){
                        return $model->eolm_status_id == 1 ? Html::a('<i class="et-edit"></i>แก้ไข',$url,['class'=>'btn btn-default']): null;
                      },
                    'delete' => function($url,$model,$key){
                        return $model->eolm_status_id == 1 ? Html::a('<i class="et-scissors"></i>ลบ',$url,['class'=>'btn btn-default','data' => ['confirm' => 'คุณต้องการลบ ?','method' => 'post']]): null;
                      },*/
                    /*'word' => function($url,$model,$key){
                        return $model->eolm_status_id != 1 ? Html::a('<i class="et-printer"></i>พิมพ์',$url,['class'=>'btn btn-default']): null;
                    },*/

                ],
            ],
            
            
        ],
    ]); ?>

</div>
