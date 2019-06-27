<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaPayment */

$this->title = $model->subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year], [
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
            'subject_id',
            'subject_version',
            'program_id',
            'term',
            'year',
            'workload_value',
            'ta_payment',
            'ta_payment_max',
            'ta_status_id',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
