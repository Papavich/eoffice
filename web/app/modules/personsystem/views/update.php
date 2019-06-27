<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */

$this->title = 'Update Board Of Directors: ' . $model->board_id;
$this->params['breadcrumbs'][] = ['label' => 'Board Of Directors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->board_id, 'url' => ['view', 'board_id' => $model->board_id, 'person_id' => $model->person_id, 'director_id' => $model->director_id, 'period_id' => $model->period_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="board-of-directors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
