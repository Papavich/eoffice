<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title =controllers::t( 'label', 'Edit Project Type'.' '. $model->name  );
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project Types' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = controllers::t( 'label', 'Edit' );
?>
<div class="project-type-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
