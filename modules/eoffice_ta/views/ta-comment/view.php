<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComment */

$this->title = $model->ta_comment_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_comment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_comment_id], [
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
            'ta_comment_id',
            'subject_id',
            'section',
            'ta_id',
            'term',
            'year',
            'ta_comment_text',
            'ta_comment_feeling',
            'ta_status_id',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
