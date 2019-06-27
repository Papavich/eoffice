<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbProgressReport */

$this->title = $model->progress_seq;
$this->params['breadcrumbs'][] = ['label' => 'Scb Progress Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-progress-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'progress_seq' => $model->progress_seq, 'student_id' => $model->student_id, 'project_year' => $model->project_year, 'project_semester' => $model->project_semester, 'project_code' => $model->project_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'progress_seq' => $model->progress_seq, 'student_id' => $model->student_id, 'project_year' => $model->project_year, 'project_semester' => $model->project_semester, 'project_code' => $model->project_code], [
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
            'progress_seq',
            'student_id',
            'project_year',
            'project_semester',
            'project_code',
            'year',
            'semester',
            'proj_summary:ntext',
            'proj_activity:ntext',
            'proj_factual:ntext',
            'proj_plan_next_year:ntext',
            'plan_year1:ntext',
            'plan_year2:ntext',
            'plan_year3:ntext',
            'plan_year4:ntext',
            'proj_problem:ntext',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
