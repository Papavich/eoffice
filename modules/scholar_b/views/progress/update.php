<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbProgressReport */

$this->title = 'Update Scb Progress Report: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Scb Progress Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->progress_seq, 'url' => ['view', 'progress_seq' => $model->progress_seq, 'student_id' => $model->student_id, 'project_year' => $model->project_year, 'project_semester' => $model->project_semester, 'project_code' => $model->project_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scb-progress-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
