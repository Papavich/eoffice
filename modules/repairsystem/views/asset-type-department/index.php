<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\repairsystem\models\AssetTypeDepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Type Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-type-department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asset Type Department', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'asset_type_dept_id',
            'asset_type_dept_name',
            'asset_type_dept_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
