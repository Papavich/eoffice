<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairDescription */

$this->title = 'Update Repair Description: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Repair Descriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rep_desc_id, 'url' => ['view', 'id' => $model->rep_desc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repair-description-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
