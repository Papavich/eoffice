<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbCalendar */

$this->title = $model->calendar_id;
$this->params['breadcrumbs'][] = ['label' => 'Scb Calendars', 'url' => ['calendar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-calendar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->calendar_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->calendar_id], [
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
            'calendar_id',
            'staff_id_card',
            'calendar_topic',
            'calendar_detail',
            'calendar_date_start',
            'calendar_date_end',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
