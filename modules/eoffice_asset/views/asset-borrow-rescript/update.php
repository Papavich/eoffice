<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */

$this->title = 'Update Asset Borrow Rescript: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrow Rescripts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borrow_rescript_id, 'url' => ['view', 'id' => $model->borrow_rescript_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asset-borrow-rescript-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
