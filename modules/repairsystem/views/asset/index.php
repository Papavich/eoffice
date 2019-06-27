<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\repairsystem\models\AssetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asset', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'asset_id',
            'asset_date',
            'asset_year',
            'asset_get',
            'asset_budget',
            // 'asset_company',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
