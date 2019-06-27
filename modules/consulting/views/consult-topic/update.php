<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultTopic */

$this->title = 'Update Consult Topic: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_topic_id, 'url' => ['view', 'id' => $model->consult_topic_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-topic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
