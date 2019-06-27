<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Calendar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Calendar' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-view">



    <p>
        <?= Html::a(controllers::t( 'label', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
        <?= Html::a(controllers::t( 'label', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-3d btn-teal pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
