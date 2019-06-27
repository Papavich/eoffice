<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pms Project Subs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pms-project-sub-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pms Project Sub', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'prosub_id',
            'prosub_name',
            'prosub_code',
            'prosub_years',
            'prosub_type',
            // 'prosub_deparment',
            // 'prosub_principle',
            // 'prosub_timestart',
            // 'prosub_timeend',
            // 'prosub_status',
            // 'prosub_relevant_person',
            // 'prosub_relevant_position',
            // 'prosub_result_evaluate',
            // 'project_rate',
            // 'project_project_id',
            // 'crby',
            // 'crtime',
            // 'duby',
            // 'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
