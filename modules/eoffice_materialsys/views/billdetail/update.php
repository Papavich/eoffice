<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_materialsys\models\MatsysBillDetail */

$this->title = 'Update Matsys Bill Detail: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Bill Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->material_id, 'url' => ['view', 'material_id' => $model->material_id, 'bill_master_id' => $model->bill_master_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matsys-bill-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
