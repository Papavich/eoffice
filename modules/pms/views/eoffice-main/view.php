<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\model_main\EofficeMain */

$this->title = $model->STUDENTID;
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eoffice-main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->STUDENTID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->STUDENTID], [
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
            'STUDENTID',
            'STUDENTCODE',
            'STUDENTNAME',
            'STUDENTSURNAME',
            'STUDENTNAMEENG',
            'STUDENTSURNAMEENG',
            'LEVELNAME',
        ],
    ]) ?>

</div>
