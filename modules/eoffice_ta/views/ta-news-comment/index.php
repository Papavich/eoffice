<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaNewsCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta News Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-news-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta News Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ta_news_comment_id',
            'ta_news_comment_text',
            'ta_news_comment_img',
            'ta_news_id',
            'ta_status',
            // 'crby',
            // 'crtime',
            // 'udby',
            // 'udtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
