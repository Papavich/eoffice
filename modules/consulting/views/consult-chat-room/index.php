<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\consulting\models\ConsultChatRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Consult Chat Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-chat-room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consult Chat Room', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'consult_chat_room_id',
            'consult_chat_room_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
