<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\LevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Levels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-index">
    <header id="page-header">
        <h1>อันดับรางวัล</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">อันดับรางวัล</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างอันดับรางวัล', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'level_id',
            'level_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
