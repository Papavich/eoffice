<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\materialsystem\models\WidenAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matsys Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Matsys Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'person_id',
            'order_date',
            'order_date_accept',
            'order_staff',
            //'order_status',
            //'order_status_confirm',
            //'order_status_notification',
            //'order_status_return',
            //'order_budget_per_year',
            //'order_cancel_description',
            //'order_id_ai',
            //'order_detail_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
