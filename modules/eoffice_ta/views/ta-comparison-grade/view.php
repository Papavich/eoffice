<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComparisonGrade */

$this->title = $model->ta_comparison_grade_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Comparison Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-comparison-grade-view">
    <div class="panel-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_comparison_grade_id',
            'person_id',
            'subject_id',
            'subject_version',
            'term',
            'year',
            'ta_status_id',
            'grade_name',
            'grade_value',
            'doc_ref',
            'crby',
            'crtime',
            'udby',
            'udtime',
            'subject_id_compar',
            'subject_name_compar',
            'compar_detail:ntext',
        ],
    ]) ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->ta_comparison_grade_id], ['class' => 'btn btn-success pull-right']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->ta_comparison_grade_id], [
                'class' => 'btn btn-danger pull-right',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>
