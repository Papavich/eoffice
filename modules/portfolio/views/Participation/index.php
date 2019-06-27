<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ParticipationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Participation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'participation_project_code',
            'participation_project_name',
            'participation_value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
