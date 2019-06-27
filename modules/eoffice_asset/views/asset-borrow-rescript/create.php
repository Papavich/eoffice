<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */

$this->title = 'Create Asset Borrow Rescript';
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrow Rescripts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-borrow-rescript-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'person' => $person
    ]) ?>

</div>
