<?php

use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\PublicType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'label', 'Publications Type' ), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-type-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'crby',
            'udby',
            'crtime',
            'udtime',
            'name',
        ],
    ]) ?>
    <p>
        <?= Html::a(controllers::t( 'label', 'Edit' ), ['update', 'id' => $model->id], ['class' => 'btn btn-3d btn-teal pull-right']) ?>
        <?= Html::a(controllers::t( 'label', 'Delete' ), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-3d btn-teal pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
