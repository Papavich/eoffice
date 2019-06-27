<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepairStatus */

$this->title = 'Update Repair Status: ' . $model->rep_status_id;
$this->params['breadcrumbs'][] = ['label' => 'Repair Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_status_id, 'url' => ['view', 'id' => $model->rep_status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repair-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
