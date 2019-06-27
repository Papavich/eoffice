<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignField */

$this->title = $model->approve_field_ref;
$this->params['breadcrumbs'][] = ['label' => 'Approve Design Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-design-field-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'approve_field_ref' => $model->approve_field_ref, 'approve_design_id' => $model->approve_design_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'approve_field_ref' => $model->approve_field_ref, 'approve_design_id' => $model->approve_design_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'approve_field_ref',
            'approve_field_name',
            'approve_field_order',
            'approve_design_id',
            'attribute_type_id',
        ],
    ]) ?>

</div>
