<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Participation */

$this->title = 'Update Participation: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Participations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->participation_project_code, 'url' => ['view', 'id' => $model->participation_project_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="participation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
