<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\AgencyAwardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-award-index">
    <header id="page-header">
        <h1>หน่วยงานที่ให้รางวัล </h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>

            <li class="active">หน่วยงานที่ให้รางวัล </li>
        </ol>
    </header>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <center><?= Html::a('สร้างหน่วยงานที่ให้รางวัล', ['create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'areward_order_id',
           // 'image',
            'data_detail',
            'locus_areward',
            'countries_areward',
            //'cities_areward',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
