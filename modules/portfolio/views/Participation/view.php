<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Participation */

$this->title = $model->participation_project_code;
$this->params['breadcrumbs'][] = ['label' => 'Participations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->participation_project_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->participation_project_code], [
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
            'participation_project_code',
            'participation_project_name',
            'participation_value',
        ],
    ]) ?>

</div>
