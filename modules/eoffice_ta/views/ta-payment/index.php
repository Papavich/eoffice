<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject_id',
            'subject_version',
            'program_id',
            'term',
            'year',
            //'workload_value',
            //'ta_payment',
            //'ta_payment_max',
            //'ta_status_id',
            //'crby',
            //'crtime',
            //'udby',
            //'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
