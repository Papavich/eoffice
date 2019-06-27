<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairTracking */

$this->title = 'Create Repair Tracking';
$this->params['breadcrumbs'][] = ['label' => 'Repair Trackings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
