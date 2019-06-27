<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_materialsys\models\MatsysBillDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matsys Bill Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-bill-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Matsys Bill Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'material_id',
            'bill_master_id',
            'bill_detail_price_per_unit',
            'bill_detaill_amount',
            'bill_detail_use_amount',
            //'bill_detail_counter',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
