<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaNewsComment */

$this->title = 'Update Ta News Comment: ' . $model->ta_news_comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta News Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_news_comment_id, 'url' => ['view', 'id' => $model->ta_news_comment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-news-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
