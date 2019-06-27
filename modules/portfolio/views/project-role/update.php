<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectRole */

$this->title = 'Update Project Role: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Project Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_role_id, 'url' => ['view', 'id' => $model->project_role_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
