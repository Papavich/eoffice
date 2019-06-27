<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectMember */

$this->title = $model->pro_member_id;
$this->params['breadcrumbs'][] = ['label' => 'Project Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pro_member_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pro_member_id], [
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
            'pro_member_id',
            'member_name',
            'member_lname',
            'project_project_id',
            'project_role_project_role_id',
            'person_id',
        ],
    ]) ?>

</div>
