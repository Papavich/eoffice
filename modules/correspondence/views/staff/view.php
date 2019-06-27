<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DocRoll */

$this->title = $model->doc_roll_id;
$this->params['breadcrumbs'][] = ['label' => 'Doc Rolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="middle">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->doc_roll_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->doc_roll_id], [
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
            'doc_roll_id',
            'doc_id',
            'doc_roll_doing',
            'doc_roll_note',
            'doc_roll_type',
        ],
    ]) ?>

</section>
