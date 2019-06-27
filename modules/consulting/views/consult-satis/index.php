<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultSatisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Satis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-satis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Satis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_satis_id',
            'consult_post_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
