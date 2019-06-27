<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairTrackingSearch;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_repair\modelsRepairTrackingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การติดตามงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="repair-tracking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <?php //echo $this->render('_search', ['model' => $searchModel]); ?> -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
        'columns' => [
        //  ['class' => 'yii\grid\SerialColumn'],

          //  'rep_track_id',
             'rep_desc_id',
         //    ['attribute' => 'rep_desc_id',
         // 'label' =>'หมายเลขรายการแจ้งซ่อม'
         //  'headerOptions' => ['style' => 'width:20%'],
         //'contentOptions' => ['style' => 'width:200px;  min-width:170px;  '],


            // [
            //   'label' => 'ชื่อ',
            //   'attribute'=>'rep_desc_id',
            //   'filter'=>ArrayHelper::map(RepairDescription::find()->all(),'rep_desc_id','rep_desc_fname'),
            //   'value'=>function($model){
            //     return $model->repDesc->rep_desc_fname;
            //   }
            // ],
            [

              'label' => 'หมายเลขครุภัณฑ์',
              'attribute'=>'rep_desc_id',
              'filter'=>ArrayHelper::map(RepairDescription::find()->all(),'rep_desc_id','asset_detail_id'),
              'value'=>function($model){
                return $model->repDesc->asset_detail_id;
              }
            ],
            [

                'label' => 'ชื่อครุภัณฑ์',
              'attribute'=>'rep_desc_id',
              'filter'=>ArrayHelper::map(RepairDescription::find()->all(),'rep_desc_id','asset_detail_name'),
              'value'=>function($model){
                return $model->repDesc->asset_detail_name;
              }
            ],

          //  'rep_status_id',
            [
              'attribute'=>'rep_status_id',
              'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
              'value'=>function($model){
                return $model->repStatus->rep_status_name;
              }
            ],
            [
                'attribute'=>'rep_tracking_date',
                'headerOptions' => ['style' => 'width:25%'],
                'options' => [
                    'format' => 'YYYY-MM-DD',
                ],
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => ([
                    'attribute' => 'rep_tracking_date',
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
                        "apply.daterangepicker" => "function() { apply_filter('rep_tracking_date') }",
                    ],
                ])
            ],

        //    ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
