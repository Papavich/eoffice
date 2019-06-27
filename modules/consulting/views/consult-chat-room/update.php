<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultChatRoom */

$this->title = 'Update Consult Chat Room: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Chat Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_chat_room_id, 'url' => ['view', 'id' => $model->consult_chat_room_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-chat-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
