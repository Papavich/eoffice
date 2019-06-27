<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\PmsProjectSub */

$this->title = $model->prosub_id;
$this->params['breadcrumbs'][] = ['label' => 'Pms Project Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pms-project-sub-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->prosub_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->prosub_id], [
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
            'prosub_id',
            'prosub_name',
            'prosub_code',
            'prosub_years',
            'prosub_type',
            'prosub_deparment',
            'prosub_principle',
            'prosub_timestart',
            'prosub_timeend',
            'prosub_status',
            'prosub_relevant_person',
            'prosub_relevant_position',
            'prosub_result_evaluate',
            'project_rate',
            'project_project_id',
            'crby',
            'crtime',
            'duby',
            'udtime',
        ],
    ]) ?>

</div>
