<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Institution */

$this->title = 'Update Institution: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ag_award_id, 'url' => ['view', 'id' => $model->ag_award_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
