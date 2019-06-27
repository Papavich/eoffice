<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetDetail */

$this->title = $model->asset_detail_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->asset_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->asset_detail_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'asset_detail_id',
            'asset_univ_code_start',
            'asset_univ_type',
            'asset_dept_code_start',
            'asset_dept_type',
            'asset_detail_name',
            'asset_detail_brand',
            'asset_detail_amount',
            'asset_detail_age',
            'asset_detail_price',
            'asset_detail_price_wreck',
            'asset_detail_insurance',
            'asset_detail_building',
            'asset_detail_room',
            'asset_asset_id',
        ],
    ]) ?>

</div>
