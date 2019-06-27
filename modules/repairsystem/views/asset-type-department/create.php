<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\AssetTypeDepartment */

$this->title = 'Create Asset Type Department';
$this->params['breadcrumbs'][] = ['label' => 'Asset Type Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-type-department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
