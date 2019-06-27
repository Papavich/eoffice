<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetGet */

$this->title = 'Update Asset Get: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Asset Gets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asset_get_id, 'url' => ['view', 'id' => $model->asset_get_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-get-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
