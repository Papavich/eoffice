
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\MajorHasProgram */

$this->title = 'Update Major Has Program: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Major Has Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->major_id, 'url' => ['view', 'major_id' => $model->major_id, 'PROGRAMID' => $model->PROGRAMID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<header id="page-header">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Add Directors </a></li>
        <li class="active">Update Board Of Director</li>
    </ol><br>
    <a href="add-program-major" class="btn btn-sm btn-default"><i class="fa fa-chevron-circle-left"></i> Back</a><br>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <?= $this->render('program_form', [
                    'modelMajor'=>$modelMajor,
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>
</div>

