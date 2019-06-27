<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsInboxLabel */

$this->title = $model->inbox_label_id;
$this->params['breadcrumbs'][] = ['label' => 'Cms Inbox Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-inbox-label-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'inbox_label_id' => $model->inbox_label_id, 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'inbox_label_id' => $model->inbox_label_id, 'user_id' => $model->user_id], [
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
            'inbox_label_id',
            'label_name',
            'user_id',
        ],
    ]) ?>

</div>
