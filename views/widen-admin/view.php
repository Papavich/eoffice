<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysOrder */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Matsys Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'order_id' => $model->order_id, 'order_id_ai' => $model->order_id_ai], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'order_id' => $model->order_id, 'order_id_ai' => $model->order_id_ai], [
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
            'order_id',
            'person_id',
            'order_date',
            'order_date_accept',
            'order_staff',
            'order_status',
            'order_status_confirm',
            'order_status_notification',
            'order_status_return',
            'order_budget_per_year',
            'order_cancel_description',
            'order_id_ai',
            'order_detail_id',
        ],
    ]) ?>

</div>
