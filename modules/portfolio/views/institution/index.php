<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\InstitutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Institutions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index">
    <header id="page-header">
        <h1>สถาบันที่ให้รางวัล</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">สถาบันที่ให้รางวัล</li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สถาบันที่ให้รางวัล', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ag_award_id',
            'ag_award_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
