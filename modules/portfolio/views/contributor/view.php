<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Contributor */

$this->title = $model->contributor_id;
$this->params['breadcrumbs'][] = ['label' => 'Contributors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->contributor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->contributor_id], [
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
            'contributor_id',
            'contributor_name',
        ],
    ]) ?>

</div>
