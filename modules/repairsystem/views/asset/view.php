<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Asset */

$this->title = $model->asset_id;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->asset_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->asset_id], [
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
            'asset_id',
            'asset_date',
            'asset_year',
            'asset_get',
            'asset_budget',
            'asset_company',
        ],
    ]) ?>

</div>
