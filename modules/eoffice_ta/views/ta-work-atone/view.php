<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkAtone */

$this->title = $model->ta_work_atone_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Work Atones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-work-atone-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ta_work_atone_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ta_work_atone_id], [
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
            'ta_work_atone_id',
            'ta_work_plan_id',
            'atone_date',
            'atone_note',
            'ta_status_id',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
