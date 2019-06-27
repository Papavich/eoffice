<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectOrder */

$this->title = 'Update Project Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Project Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_order_id, 'url' => ['view', 'id' => $model->project_order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
