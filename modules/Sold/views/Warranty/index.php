<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\Sold\WarrantySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Warranties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warranty-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Warranty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_at',
            'create_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
