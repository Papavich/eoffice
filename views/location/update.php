<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\materialsystem\models\MatsysLocation */

$this->title = 'Update Matsys Location: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Matsys Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->location_id, 'url' => ['view', 'id' => $model->location_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matsys-location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
