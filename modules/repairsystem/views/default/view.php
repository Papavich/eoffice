<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\repairsystem\models\RepDes */

$this->title = $model->rep_des_id;
$this->params['breadcrumbs'][] = ['label' => 'Rep Des', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rep-des-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rep_des_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rep_des_id], [
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
            'rep_des_id',
            'fname',
            'lname',
            'email:email',
            'tel',
            'rep_date',
            'asset_code',
            'asset_type_dept_id',
            'building_id',
            'room_id',
            'rep_des_detail',
            'rep_status_id',
            'rep_photo_id',
        ],
    ]) ?>

</div>
