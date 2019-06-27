<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultSatis */

$this->title = $model->consult_satis_id;
$this->params['breadcrumbs'][] = ['label' => 'Consult Satis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-satis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->consult_satis_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->consult_satis_id], [
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
            'consult_satis_id',
            'consult_post_id',
        ],
    ]) ?>

</div>
