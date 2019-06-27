<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prefix */

$this->title = 'แก้ไข: ' . ' ' . $model->prefix_id;
$this->params['breadcrumbs'][] = ['label' => 'Prefixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prefix_id, 'url' => ['view', 'id' => $model->prefix_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prefix-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
