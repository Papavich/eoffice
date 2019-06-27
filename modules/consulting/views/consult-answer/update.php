<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultAnswer */

$this->title = 'Update Consult Answer: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_answer_id, 'url' => ['view', 'id' => $model->consult_answer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
