<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbConditionHasStudent */

$this->title = 'Update Scb Condition Has Student: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Scb Condition Has Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->condi_id, 'url' => ['view', 'condi_id' => $model->condi_id, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year, 'student_id' => $model->student_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scb-condition-has-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
