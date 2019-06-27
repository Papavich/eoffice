<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegister */

$this->title = $model->subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Registers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-register-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year], [
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
            'subject_id',
            'subject_version',
            'person_id',
            'term',
            'year',
            'ta_status_id',
            'doc_ref01',
            'doc_ref02',
            'doc_ref03',
            'doc_ref04',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
