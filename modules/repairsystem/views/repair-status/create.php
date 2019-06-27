<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepairStatus */

$this->title = 'Create Repair Status';
$this->params['breadcrumbs'][] = ['label' => 'Repair Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
