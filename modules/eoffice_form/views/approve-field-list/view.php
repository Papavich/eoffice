<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveFieldList */

$this->title = $model->approve_field_list_id;
$this->params['breadcrumbs'][] = ['label' => 'Approve Field Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-field-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->approve_field_list_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->approve_field_list_id], [
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
            'approve_field_list_id',
            'approve_field_list_name',
            'approve_field_list_order',
            'approve_field_ref',
        ],
    ]) ?>

</div>
