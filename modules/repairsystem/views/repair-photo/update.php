<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepairPhoto */

$this->title = 'Update Repair Photo: ' . $model->rep_photo_id;
$this->params['breadcrumbs'][] = ['label' => 'Repair Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_photo_id, 'url' => ['view', 'id' => $model->rep_photo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repair-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
