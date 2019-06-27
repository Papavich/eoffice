<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\SponsorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Sponsors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsor-index">
    <header id="page-header">
        <h1>ผู้สนับสนุน</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">ผู้สนับสนุน</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างผู้สนับสนุน', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'sponsor_id',
            'sponsor_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
