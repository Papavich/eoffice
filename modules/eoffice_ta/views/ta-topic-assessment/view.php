<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTopicAssessment */

$this->title = $model->assessment_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Topic Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-topic-assessment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->assessment_id, 'past' => $model->past], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->assessment_id, 'past' => $model->past], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'topic_ass_id',
            'topic_ass_name',
            'assessment_id',
            'past',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
