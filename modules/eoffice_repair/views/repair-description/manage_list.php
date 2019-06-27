<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;


use app\modules\eoffice_repair\models\RepairDescription;
use app\modules\eoffice_repair\models\RepairImage;
use app\modules\eoffice_repair\models\RepairStatus;
use app\modules\eoffice_repair\models\RepairTracking;
use app\modules\eoffice_repair\models\RepairDescriptionSearch;
use app\modules\eoffice_repair\models\Staff;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_repair\models\RepairDescriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'รายการแจ้งซ่อม';
// $this->params['breadcrumbs'][] = $this->title;
?>
<!-- Head -->
<header id="page-header" style="margin-bottom: 20px">
    <h1>จัดการรายการแจ้งซ่อม</h1>

</header>
<div class="repair-description-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!-- <p>
  <?= Html::a('Create Repair Description', ['create'], ['class' => 'btn btn-success']) ?>
</p> -->

<!-- <div class="asset-search">

  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
  ]); ?>

  <div class="row">
    <div class="form-group">
      <div class="col-md-3 col-sm-3 pull-right">
        <?= $form->field($searchModel, 'rep_desc_id') ?>


</div></div></div> -->




<?php ActiveForm::end(); ?>


<?= GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'columns' => [
  //  ['class' => 'yii\grid\SerialColumn'],
'rep_desc_id',
    [
      'attribute'=>'rep_desc_fname',

      'value'=>function($model){
        return $model->rep_desc_fname.' '.$model->rep_desc_lname;
      }
    ],
    // 'email:email',
    'rep_desc_tel',
    'rep_desc_request_date',
    // [
    //   'attribute'=>'asset_detail_id',
    //   'filter'=>ArrayHelper::map(AssetDetail::find()->all(),'asset_detail_id','asset_dept_code_start'),
    //   'value'=>function($model){
    //     return $model->assetDetail->asset_dept_code_start;
    //   }
    // ],

    [
      'attribute'=>'rep_status_id',
      'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
      'value'=>function($model){
        return $model->repStatus->rep_status_name;
      }
    ],

    // [
    //   'attribute'=>'staff_id',
    //   'filter'=>ArrayHelper::map(Staff::find()->all(),'staff_id','staff_name'),
    //   'value'=>function($model){
    //     return $model->staff->staff_name;
    //   }
    // ],

    //'rep_desc_detail',
    [
      'attribute'=>'staff.staff_name',
        'label'=>'เจ้าหน้าที่ดูแล',

    ],
      // 'staff.staff_name',
    // [
    //   'attribute'=>'staff_id',
    //   'filter'=>ArrayHelper::map(Staff::find()->all(),'staff_id','staff_name'),
    //   'value'=>function($model){
    //     return $model->staff->staff_name;
    //   }
    // ],


    // [
    //   'attribute'=>'staff',
    //   'filter'=>ArrayHelper::map(Staff::find()->all(),'staff_id','staff_name'),
    //   'value'=>function($model){
    //     return $model->staff->staff;
    //   }
    // ],
    // [
    //                         'format' => 'raw',
    //                         'value' => function($model, $key, $index, $column) {
    //                             return Html::a('แลกเปลี่ยน', ['form',
    //                                 'rep_desc_id' => $model->rep_desc_id,
    //
    //
    //                                 ['class'=>'']]
    //                               );
    //                         },
    //                     ]



    // [
    //     'class' => 'yii\grid\ActionColumn',
    //     'buttonOptions'=>['class'=>'btn btn-default'],
    //     'header'=>'',
    //     'template'=>'{update}',
    //     'contentOptions'=>[
    //         'noWrap' => true],
    //     //'options'=> ['style'=>'width:250px;'],
    //     'buttons'=>[
    //         'update' => function($url,$model,$key){
    //             return  Html::a('<i class="fa fa-pencil-square-o"></i>มอบหมายงาน',$url,['class'=>'btn btn-block btn-social btn-warning']);
    //         },
    //
    //     ],],
   ],

]); ?>
</div>
