<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationsType */

$this->title = $model->pub_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Publications Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pub_type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pub_type_id], [
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
            'pub_type_id',
            'pub_type_name',
        ],
    ]) ?>

</div>
