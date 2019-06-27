<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignSection */

$this->title = $model->approve_design_id;
$this->params['breadcrumbs'][] = ['label' => 'Approve Design Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-design-section-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->approve_design_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->approve_design_id], [
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
            'approve_design_id',
            'approve_design_name',
            'approve_design_order',
            'approve_group_id',
            'section_type_id',
        ],
    ]) ?>

</div>
