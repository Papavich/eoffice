<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */

$this->title = $model->board_id;
$this->params['breadcrumbs'][] = ['label' => 'Board Of Directors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-of-directors-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'board_id' => $model->board_id, 'person_id' => $model->person_id, 'director_id' => $model->director_id, 'period_id' => $model->period_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'board_id' => $model->board_id, 'person_id' => $model->person_id, 'director_id' => $model->director_id, 'period_id' => $model->period_id], [
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
            'board_id',
            'person_id',
            'director_id',
            'period_id',
        ],
    ]) ?>

</div>
