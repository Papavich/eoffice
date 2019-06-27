<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


use app\modules\repairsystem\models\Building;
use app\modules\repairsystem\models\RepDes;
use app\modules\repairsystem\models\AssetTypeDepartment;
use app\modules\repairsystem\models\Room;
use app\modules\repairsystem\models\RepairPhoto;
use app\modules\repairsystem\models\RepairStatus;


/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDes */

$this->title = $model->rep_des_id;
$this->params['breadcrumbs'][] = ['label' => 'Rep Des', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rep-des-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'rep_des_id',
            'fname',
            'lname',
            'email:email',
            'tel',
            'rep_date',
            'asset_code',
            [
               'attribute'=>'asset_type_dept_id',
               'filter'=>ArrayHelper::map(AssetTypeDepartment::find()->all(),'asset_type_dept_id','asset_type_dept_name'),
               'value'=>function($model){
                   return $model->assetTypeDept->asset_type_dept_name;
               }
           ],
           [
              'attribute'=>'building_id',
              'filter'=>ArrayHelper::map(Building::find()->all(),'building_id','building_name'),
              'value'=>function($model){
                  return $model->building->building_name;
              }



          ],
          [
             'attribute'=>'room_id',
             'filter'=>ArrayHelper::map(Room::find()->all(),'room_id','room_name'),
             'value'=>function($model){
                 return $model->room->room_name;
             }
         ],
          //'building_id',
            //'room_id',
          //   'rep_des_detail',
          //   [
          //      'attribute'=>'rep_status_id',
          //      'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
          //      'value'=>function($model){
          //          return $model->repStatus->rep_status_name;
          //      }
          //  ],
          //   //'rep_status_id',
          //   'rep_photo_id',
        ],
    ]) ?>

</div>
  <?php $form = ActiveForm::begin(); ?>
<div class="panel panel-primary">
  <div class="panel-heading panel-heading-transparent">

    <strong>แก้ไขสถานะ</strong>
  </div>
</div>
<div class="row">
  <div class="form-group">

    <div class="col-md-4 col-sm-4">
      <?= $form->field($model, 'rep_status_id')->dropDownList(ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),['prompt'=>'-- เลือกสถานะ --']) ?>


</div></div></div>


    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary']) ?>
    </div>
      <?php ActiveForm::end(); ?>
