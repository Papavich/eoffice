<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetBorrowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Borrows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-borrow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asset Borrow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'borrow_id',
            'borrow_user_fname',
            'borrow_user_lname',
            'borrow_user_tel',
            'borrow_date',
            //'borrow_object',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>