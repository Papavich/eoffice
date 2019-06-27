<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultAnswer */

$this->title = $model->consult_answer_id;
$this->params['breadcrumbs'][] = ['label' => 'Consult Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consult-answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->consult_answer_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->consult_answer_id], [
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
            'consult_answer_id',
            'consult_answer_text',
            'consult_post_id',
        ],
    ]) ?>

</div>
