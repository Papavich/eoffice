<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Sponsor */

$this->title = 'Update Sponsor: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sponsors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sponsor_id, 'url' => ['view', 'id' => $model->sponsor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sponsor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
