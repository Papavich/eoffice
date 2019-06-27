<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'project_name_thai',
            'project_name_eng',
            'project_start',
            'project_end',
            //'project_duration',
            //'project_budget',
            //'repayment',
            //'project_url:url',
            //'std_id',
            //'person_id',
            //'participation',
            //'cities_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
