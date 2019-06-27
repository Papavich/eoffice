<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Major */

$this->title = 'Update Major: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Majors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->major_id, 'url' => ['view', 'id' => $model->major_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information </a></li>
        <li class="active">Update Major</li>
    </ol><br>
    <a href="add-program-major?active=2" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <?= $this->render('major_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
