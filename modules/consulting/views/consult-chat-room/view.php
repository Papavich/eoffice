<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultChatRoom */

$this->title = $model->consult_chat_room_id;
$this->params['breadcrumbs'][] = ['label' => 'Consult Chat Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-chat-room-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->consult_chat_room_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->consult_chat_room_id], [
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
            'consult_chat_room_id',
            'consult_chat_room_name',
        ],
    ]) ?>

</div>
