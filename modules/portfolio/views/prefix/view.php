<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Prefix */

$this->title = $model->prefix_id;
$this->params['breadcrumbs'][] = ['label' => 'Prefixes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefix-view">


    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->prefix_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->prefix_id], [
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
            'prefix_id',
            'prefix_name',
        ],
    ]) ?>

</div>
