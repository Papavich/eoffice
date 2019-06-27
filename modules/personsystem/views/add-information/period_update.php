<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\Period */

$this->title = 'Update Period: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->period_id, 'url' => ['view', 'id' => $model->period_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Directors </a></li>
        <li class="active">Update Board Of Director</li>
    </ol><br>
    <a href="add-directors?active=3" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>

<div id="content" class="padding-20">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <?= $this->render('period_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
