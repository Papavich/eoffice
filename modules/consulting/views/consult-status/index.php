<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_status_id',
            'consult_status_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
