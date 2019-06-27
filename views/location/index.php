<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\materialsystem\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matsys Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-location-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Matsys Location', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'location_id',
            'location_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
