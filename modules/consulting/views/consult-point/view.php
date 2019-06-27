<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPoint */

$this->title = $model->consult_point_id;
$this->params['breadcrumbs'][] = ['label' => 'Consult Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-point-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->consult_point_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->consult_point_id], [
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
            'consult_point_id',
            'consult_point_name',
        ],
    ]) ?>

</div>
