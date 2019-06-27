<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\AssetTypeDepartment */

$this->title = 'Update Asset Type Department: ' . $model->asset_type_dept_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Type Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asset_type_dept_id, 'url' => ['view', 'id' => $model->asset_type_dept_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-type-department-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
