<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkloadTeacher */

$this->title = 'รายละเอียด';
$this->params['breadcrumbs'][] = ['label' => 'Ta Workload Teachers', 'url' => ['index',
    's'=>$model->subject_id,'ver'=>$model->subject_version,'t'=>$model->term,'y'=>$model->year]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-workload-teacher-view">
<div class="panel-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_wload_teacher_id',
            'section',
            'subject_id',
            'subject_version',
            'term',
            'year',
            'ta_type_work_id',
            'ta_status_id',
            'time_start',
            'time_end',
            'lec_inspect',
            'lect_check_list_std',
            'lec_other',
            'lab_hr',
            'time_start_lab',
            'time_end_lab',
            'day_lect',
            'day_lab',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'ta_wload_teacher_id' => $model->ta_wload_teacher_id, 'section' => $model->section, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ta_wload_teacher_id' => $model->ta_wload_teacher_id, 'section' => $model->section, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
</div>
