<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComparisonGrade */

$this->title = 'Update Ta Comparison Grade: ' . $model->ta_comparison_grade_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Comparison Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_comparison_grade_id, 'url' => ['view', 'id' => $model->ta_comparison_grade_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-comparison-grade-update">

    <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
