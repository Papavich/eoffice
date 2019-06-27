<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\ProjectOrder */

$this->title = $model->project_order_id;
$this->params['breadcrumbs'][] = ['label' => 'Project Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->project_order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->project_order_id], [
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
            'project_order_id',
            'project_role_project_role_id',
            'project_member_pro_member_id',
            'project_project_id',
            'person_id',
            'sponsor_sponsor_id',
        ],
    ]) ?>

</div>
