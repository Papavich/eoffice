<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Frequency */

$this->title = $model->frequency_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frequency-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->frequency_order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->frequency_order_id], [
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
            'frequency_order_id',
            'frequency_name',
            'frequency_id',
        ],
    ]) ?>

</div>
