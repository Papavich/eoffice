<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\PublicationsTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publications Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publications Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pub_type_id',
            'pub_type_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
