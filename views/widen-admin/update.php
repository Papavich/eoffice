<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysOrder */

$this->title = 'Update Matsys Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'order_id' => $model->order_id, 'order_id_ai' => $model->order_id_ai]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matsys-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
