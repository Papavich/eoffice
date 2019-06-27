<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ViewPisUser */

$this->title = 'Update View Pis User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'View Pis Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_user_id, 'url' => ['view', 'id' => $model->consult_user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="view-pis-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
