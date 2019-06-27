<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\AssetTypeDepartment */

$this->title = $model->asset_type_dept_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Type Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-type-department-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->asset_type_dept_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->asset_type_dept_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'asset_type_dept_id',
            'asset_type_dept_name',
            'asset_type_dept_code',
        ],
    ]) ?>

</div>
