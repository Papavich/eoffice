<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_repair\models\RepairDescription */

$this->title = $model->rep_desc_id;
$this->params['breadcrumbs'][] = ['label' => 'Repair Descriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-description-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rep_desc_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rep_desc_id], [
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
            'rep_desc_id',
            'rep_desc_fname',
            'rep_desc_lname',
            'rep_desc_email:email',
            'rep_desc_tel',
            'rep_desc_detail',
            'rep_desc_cost',
            'rep_desc_comment',
            'rep_desc_request_date',
            'rep_image_id',
            'rep_status_id',
            'rep_location',
            'asset_detail_id',
            'asset_detail_name',
            'staff',
        ],
    ]) ?>

</div>
