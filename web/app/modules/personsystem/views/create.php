<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\BoardOfDirectors */

$this->title = 'Create Board Of Directors';
$this->params['breadcrumbs'][] = ['label' => 'Board Of Directors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="board-of-directors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
