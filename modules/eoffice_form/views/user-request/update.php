<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\UserRequest */

$this->title = 'Update User Request: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'User Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
