<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysBillDetail */

$this->title = $model->material_id;
$this->params['breadcrumbs'][] = ['label' => 'Matsys Bill Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-bill-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'material_id' => $model->material_id, 'bill_master_id' => $model->bill_master_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'material_id' => $model->material_id, 'bill_master_id' => $model->bill_master_id], [
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
            'material_id',
            'bill_master_id',
            'bill_detail_price_per_unit',
            'bill_detaill_amount',
            'bill_detail_use_amount',
            'bill_detail_counter',
        ],
    ]) ?>

</div>
