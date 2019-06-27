<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\Asset */

$this->title = 'Update Asset: ' . $model->asset_id;
$this->params['breadcrumbs'][] = ['label' => 'Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asset_id, 'url' => ['view', 'id' => $model->asset_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
