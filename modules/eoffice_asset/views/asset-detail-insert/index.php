<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetDetailInsertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asset Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'asset_detail_id',
          //  'asset_univ_code_start',
            'asset_univ_type',
            'asset_dept_code_start',
            'asset_dept_type',
            'asset_detail_name',
            //'asset_detail_brand',
            //'asset_detail_amount',
            //'asset_detail_age',
            //'asset_detail_price',
            //'asset_detail_price_wreck',
            //'asset_detail_insurance',
            //'asset_detail_building',
            //'asset_detail_room',
            //'asset_asset_id',
            //'asset_image_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
