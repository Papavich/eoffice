<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNewsComment */

$this->title = $model->ta_news_comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta News Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-news-comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_news_comment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_news_comment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_news_comment_id',
            'ta_news_comment_text',
            'ta_news_comment_img',
            'ta_news_id',
            'ta_status',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
