<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairTracking */

$this->title = 'Update Repair Tracking: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Repair Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_track_id, 'url' => ['view', 'id' => $model->rep_track_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repair-tracking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
