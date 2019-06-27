<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Room */

$this->title = 'Update Room: ' . $model->room_id;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->room_id, 'url' => ['view', 'id' => $model->room_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
