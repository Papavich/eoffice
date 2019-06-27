<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Frequency */

$this->title = 'Update Frequency: ' . $model->frequency_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->frequency_order_id, 'url' => ['view', 'id' => $model->frequency_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frequency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
