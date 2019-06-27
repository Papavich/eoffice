<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="#"></i> รายการครุภัณฑ์
    </div>

    <div class="panel-body">

        <div class="row">
            <div class="col-md-12 col-sm-12">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <?php echo Html::a('เพิ่มรายการครุภัณฑ์', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'asset_detail_id',
            'asset_univ_code_start',
            //'asset_univ_type',
            'asset_dept_code_start',
           // 'asset_dept_type',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div></div></div></div>
