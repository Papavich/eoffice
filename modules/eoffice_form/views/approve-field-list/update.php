<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveFieldList */

$this->title = 'Update Approve Field List: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Approve Field Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->approve_field_list_id, 'url' => ['view', 'id' => $model->approve_field_list_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="approve-field-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
