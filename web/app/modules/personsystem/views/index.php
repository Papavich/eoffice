<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\personsystem\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Board Of Directors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-of-directors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Board Of Directors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'board_id',
            'person_id',
            'director_id',
            'period_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
