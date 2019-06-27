<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\repairsystem\models\RepairStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repair Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Repair Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rep_status_id',
            'rep_status_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
