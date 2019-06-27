<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignField */

$this->title = 'Update Approve Design Field: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Approve Design Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->approve_field_ref, 'url' => ['view', 'approve_field_ref' => $model->approve_field_ref, 'approve_design_id' => $model->approve_design_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="approve-design-field-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
