<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */

$this->title = 'Update Board Of Directors: ' . $model->board_id;
$this->params['breadcrumbs'][] = ['label' => 'Board Of Directors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->board_id, 'url' =>
    [
        'view', 'board_id' => $model->board_id,
        'person_id' => $model->person_id,
        'director_id' => $model->director_id,
        'period_id' => $model->period_id]
];
$this->params['breadcrumbs'][] = 'Update';
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Information </a></li>
        <li class="active">Update Major</li>
    </ol><br>
    <a href="add-directors" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>

<div id="content" class="padding-20">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
    <?= $this->render('directors_form', [
        'model' => $model,
        'modelPerson' => $modelPerson,
        'modelDirector'=> $modelDirector,
        'modelPeriod' => $modelPeriod,

    ]) ?>

            </div>
        </div>
    </div>
</div>
