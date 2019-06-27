<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_form\models\ApprovePositionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Approve Positions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-position-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Approve Position', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'position_id',
            //'position_name',
            'position_order',
            'approve_group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
