<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\EofficeCentralViewPisUser */

$this->title = 'Update Eoffice Central View Pis User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Central View Pis Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-central-view-pis-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
