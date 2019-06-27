<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Project Types' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-type-view">



    <p>
        <?= Html::a(controllers::t('label','Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
        <?= Html::a(controllers::t('label','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-3d btn-teal pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'crby',
            'udby',
            'crtime',
            'udtime',
        ],
    ]) ?>

</div>
