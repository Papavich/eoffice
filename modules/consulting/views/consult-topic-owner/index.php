<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultTopicOwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Topic Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-topic-owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Topic Owner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'topic_owner_id',
            'topic_owner_name',
            'respon_id',
            'topic_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
