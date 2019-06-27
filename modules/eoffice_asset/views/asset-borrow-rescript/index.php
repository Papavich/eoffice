<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetBorrowRescriptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Borrow Rescripts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-borrow-rescript-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asset Borrow Rescript', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'borrow_rescript_id',
            'asset_borrow_detail_id',
            'borrow_rescript_date',
            'borrow_rescript_time',
            'borrow_rescript_location',
            //'borrow_rescript_staff',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
