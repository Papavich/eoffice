<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbConditionHasStudent */

$this->title = $model->condi_id;
$this->params['breadcrumbs'][] = ['label' => 'Scb Condition Has Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-condition-has-student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'condi_id' => $model->condi_id, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year, 'student_id' => $model->student_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'condi_id' => $model->condi_id, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year, 'student_id' => $model->student_id], [
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
            'condi_id',
            'scholarship_id',
            'scholarship_year',
            'student_id',
            'condition_pass',
        ],
    ]) ?>

</div>
