<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaSchedule */

$this->title = 'รายละเอียดกำหนดการ';
$this->params['breadcrumbs'][] = ['label' => 'Ta Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-schedule-view">
    <div class="panel-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'ta_schedule_id',
            'ta_schedule_title',
            'ta_schedule_url:url',
            'time_start',
            'time_end',
            'ta_schedule_detail',
            'ta_schedule_type',
            'term',
            'year',
            'active_status',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_schedule_id], ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_schedule_id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
</div>
