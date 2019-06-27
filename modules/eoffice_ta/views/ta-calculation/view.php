<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculation */

$this->title = $model->ta_calculate_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-calculation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_calculate_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_calculate_id], [
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
            'ta_calculate_id',
            'symbol',
            'symbol_value',
            'status_symbol',
            'ta_rule_id',
            'order',
        ],
    ]) ?>

</div>
