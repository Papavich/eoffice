<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */

$this->title = 'Update Areward: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Arewards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->areward_id, 'url' => ['view', 'id' => $model->areward_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="areward-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'persons' => $persons,
        'stds' => $stds,
    ]) ?>

</div>
