<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ContributorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contributors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contributor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'contributor_id',
            'contributor_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
