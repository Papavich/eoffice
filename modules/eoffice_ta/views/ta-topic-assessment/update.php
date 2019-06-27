<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTopicAssessment */

$this->title = 'Update Ta Topic Assessment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ta Topic Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->topic_ass_id, 'url' => ['view', 'id' => $model->topic_ass_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-topic-assessment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
