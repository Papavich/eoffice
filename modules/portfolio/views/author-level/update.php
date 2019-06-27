<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\AuthorLevel */

$this->title = 'Update Author Level: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Author Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->auth_level_id, 'url' => ['view', 'id' => $model->auth_level_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="author-level-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
