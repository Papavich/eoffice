<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorking */

$this->title = $model->ta_work_plan_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Workings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-working-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_work_plan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_work_plan_id], [
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
            'ta_work_plan_id',
            'person_id',
            'subject_id',
            'subject_version',
            'section',
            'term_id',
            'year_id',
            'ta_type_work_id',
            'ta_work_title',
            'ta_work_role',
            'time_start',
            'time_end',
            'hr_working',
            'ta_working_note',
            'working_date',
            'ta_status_id',
            'crby',
            'crtime',
            'udby',
            'udtime',
            'active_status',
            'working_evidence',
        ],
    ]) ?>

</div>
