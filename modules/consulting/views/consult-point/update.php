<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultPoint */

$this->title = 'Update Consult Point: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_point_id, 'url' => ['view', 'id' => $model->consult_point_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
