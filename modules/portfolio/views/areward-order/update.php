<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ArewardOrder */

$this->title = 'Update Areward Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Areward Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->areward_order_id, 'url' => ['view', 'id' => $model->areward_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="areward-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
