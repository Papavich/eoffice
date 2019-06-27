<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_question_id',
            'consult_question_name',
            'consult_satis_id',
            'consult_point_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
