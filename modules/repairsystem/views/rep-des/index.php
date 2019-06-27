<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\modules\repairsystem\models\AssetTypeDepartment;
use app\modules\repairsystem\models\Building;
use app\modules\repairsystem\models\RepDes;
use app\modules\repairsystem\models\Room;
use app\modules\repairsystem\models\RepairPhoto;
use app\modules\repairsystem\models\RepairStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\repairsystem\models\RepDesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการแจ้งซ่อม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rep-des-index">

  <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],

          //  'rep_des_id',
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
            // 'building_id',
            // 'room_id',
             'rep_des_detail',
            // 'rep_status_id',
            [
               'attribute'=>'rep_status_id',
               'filter'=>ArrayHelper::map(RepairStatus::find()->all(),'rep_status_id','rep_status_name'),
               'value'=>function($model){
                   return $model->repStatus->rep_status_name;
               }
           ],
            // 'rep_photo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
