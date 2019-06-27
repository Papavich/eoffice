<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Points';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-point-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Point', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_point_id',
            'consult_point_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
