<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AgencyAward */

$this->title = $model->areward_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Agency Awards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-award-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->areward_order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->areward_order_id], [
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
            'areward_order_id',
            'image',
            'data_detail',
            'locus_areward',
            'countries_areward',
            'cities_areward',
        ],
    ]) ?>

</div>
