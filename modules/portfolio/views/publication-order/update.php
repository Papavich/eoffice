<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrder */

$this->title = 'Update Publication Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Publication Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pub_order_id, 'url' => ['view', 'id' => $model->pub_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publication-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
