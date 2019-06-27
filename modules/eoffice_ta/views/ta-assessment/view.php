<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessment */

$this->title = $model->ta_assessment_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-assessment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_assessment_id, 'past' => $model->past], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_assessment_id, 'past' => $model->past], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ta_assessment_id',
            'past',
            'ta_assessment_name',
            'ta_assessment_detail',
            'type_user',
            'ta_assessment_note',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
