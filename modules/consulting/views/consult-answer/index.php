<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_answer_id',
            'consult_answer_text',
            'consult_post_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
