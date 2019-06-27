<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRequest */

$this->title = 'รายละเอียดการร้องขอผู้ช่วยสอน';
$this->params['breadcrumbs'][] = ['label' => 'Ta Requests', 'url' => ['teacher/request-ta']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-request-view">
<div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject_id',
            'term_id',
            'year',
            'degree_bachelor',
            'degree_master',
            'degree_doctorate',
            'amount_ta_all',
            'request_note',
            'property_grade',
            'property_text',
            'ta_type_work_id',
            'ta_status_id',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>
    <p class="pull-right">
        <?= Html::a('Update', ['update',
            's' => $model->subject_id,
            'ver' => $model->subject_version,
            't' => $model->term_id,
            'y' => $model->year
        ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete',
            'subject_id' => $model->subject_id,
            'subject_version' => $model->subject_version,
            'term_id' => $model->term_id, 'year' => $model->year], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
</div>
