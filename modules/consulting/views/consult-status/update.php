<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultStatus */

$this->title = 'Update Consult Status: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_status_id, 'url' => ['view', 'id' => $model->consult_status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
