<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */

$this->title = 'Update Asset Borrow: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borrow_id, 'url' => ['view', 'id' => $model->borrow_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-borrow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'person' => $person
    ]) ?>

</div>
