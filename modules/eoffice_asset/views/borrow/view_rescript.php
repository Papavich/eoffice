<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */

$this->title = $model->borrow_rescript_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrow Rescripts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-borrow-rescript-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->borrow_rescript_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->borrow_rescript_id], [
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
            'borrow_rescript_id',
            'asset_borrow_detail_id',
            'borrow_rescript_date',
            'borrow_rescript_time',
            'borrow_rescript_location',
            'borrow_rescript_staff',
        ],
    ]) ?>

</div>
