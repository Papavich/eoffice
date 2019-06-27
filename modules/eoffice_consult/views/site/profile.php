<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;


use app\modules\eoffice_consult\models\EofficeCentralViewStudentFull;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_repair\models\RepairDescriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'รายการแจ้งซ่อม';
//$this->params['breadcrumbs'][] = $this->title;


?>

<!-- Head -->
<header id="page-header" style="margin-bottom: 20px">
    <h1>รายการแจ้งซ่อม</h1>

</header>
<div class="repair-description-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!-- <p>
  <?= Html::a('Create Repair Description', ['create'], ['class' => 'btn btn-success']) ?>
</p> -->








<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
  //  ['class' => 'yii\grid\SerialColumn'],
'OFFICERNAME',
//     [
//       'attribute'=>'rep_desc_fname',
//
//       'value'=>function($model){
//         return $model->rep_desc_fname.' '.$model->rep_desc_lname;
//       }
//     ],
//     // 'email:email',
//     //'rep_desc_tel',
//     [
//         'attribute'=>'rep_desc_request_date',
//         'headerOptions' => ['style' => 'width:25%'],
//         'options' => [
//             'format' => 'YYYY-MM-DD',
//         ],
//         'filterType' => GridView::FILTER_DATE_RANGE,
//         'filterWidgetOptions' => ([
//             'attribute' => 'rep_desc_request_date',
//             'presetDropdown' => true,
//             'convertFormat' => false,
//             'pluginOptions' => [
//                 'separator' => ' - ',
//                 'format' => 'YYYY-MM-DD',
//                 'locale' => [
//                     'format' => 'YYYY-MM-DD'
//                 ],
//             ],
//             'pluginEvents' => [
//                 "apply.daterangepicker" => "function() { apply_filter('rep_desc_request_date') }",
//             ],
//         ])
//     ],
//     //'rep_desc_request_date',
//     'asset_detail_id',
//     'asset_detail_name',
//     // [
//     //   'attribute'=>'asset_detail_id',
//     //   'filter'=>ArrayHelper::map(AssetDetail::find()->all(),'asset_detail_id','asset_dept_code_start'),
//     //   'value'=>function($model){
//     //     return $model->assetDetail->asset_dept_code_start;
//     //   }
//     // ],
//
//     // [
//     //   'attribute'=>'rep_status_id',
//     //   'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
//     //   'value'=>function($model){
//     //     return $model->repStatus->rep_status_name;
//     //   }
//     // ],
//
//     // [
//     //   'attribute'=>'rooms_id',
//     //   'filter'=>ArrayHelper::map(Rooms::find()->all(),'rooms_id','rooms_name'),
//     //   'value'=>function($model){
//     //     return $model->rooms->rooms_name;
//     //   }
//     // ],
//
//     //'rep_desc_detail',
//
//     [
//       'attribute'=>'rep_status_id',
//       'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
//       'value'=>function($model){
//         return $model->repStatus->rep_status_name;
//       }
//     ],
//
//     [
//       'class' => 'yii\grid\ActionColumn',
//         'buttonOptions'=>['class'=>'btn btn-default'],
//   'header'=>'',
//   'template'=>'{view}',
//         'contentOptions'=>[
//     'noWrap' => true],
//     //'options'=> ['style'=>'width:250px;'],
//     'buttons'=>[
//     'view' => function($url,$model,$key){
//         return Html::a('<i class="fa fa-eye"></i> รายละเอียด',$url,['class'=>'btn btn-block btn-social btn-info']);
//     },
//
// ],],
 ],

]); ?>
</div>
</div>
