<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\UserRequest */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-request-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year], [
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
            'user_id',
            'template_id',
            'cr_date',
            'cr_term',
            'cr_year',
            'req_json:ntext',
            'req_doc:ntext',
        ],
    ]) ?>

</div>
