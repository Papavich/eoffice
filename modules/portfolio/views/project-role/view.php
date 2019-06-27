<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectRole */

$this->title = $model->project_role_id;
$this->params['breadcrumbs'][] = ['label' => 'Project Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->project_role_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->project_role_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_role_id',
            'project_role_name',
        ],
    ]) ?>

</div>
