<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultTopicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-topic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Topic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_topic_id',
            'consult_topic_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
