<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Leave */

$this->title = 'แก้ไข การลา: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'การลา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="leave-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
