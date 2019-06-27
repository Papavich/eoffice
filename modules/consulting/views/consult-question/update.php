<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultQuestion */

$this->title = 'Update Consult Question: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_question_id, 'url' => ['view', 'id' => $model->consult_question_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
