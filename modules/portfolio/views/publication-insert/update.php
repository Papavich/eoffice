<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */

$this->title = 'Update Asset Detail: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Asset Details', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $modelsAssetDetail->asset_detail_id, 'url' => ['view', 'id' => $model->asset_detail_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelAsset' => $modelProject,
        'modelsAssetDetail' =>  $modelsProjectMember
    ]) ?>

</div>
