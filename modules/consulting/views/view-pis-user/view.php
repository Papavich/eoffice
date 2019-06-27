<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ViewPisUser */

$this->title = $model->consult_user_id;
$this->params['breadcrumbs'][] = ['label' => 'View Pis Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-pis-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->consult_user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->consult_user_id], [
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
            'consult_user_id',
            'consult_user_fname',
            'consult_user_lname',
            'consult_user_tel',
            'consult_user_email:email',
            'consult__user_password',
        ],
    ]) ?>

</div>
