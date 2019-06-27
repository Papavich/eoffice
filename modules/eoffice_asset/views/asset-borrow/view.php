<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */

$this->title = $model->borrow_id;
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-borrow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->borrow_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->borrow_id], [
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
            'borrow_id',
            'borrow_user_fname',
            'borrow_user_lname',
            'borrow_user_tel',
            'borrow_date',
            'borrow_object',
        ],
    ]) ?>

</div>