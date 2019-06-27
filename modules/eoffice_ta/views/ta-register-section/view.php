<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegisterSection */

$this->title = $model->section;
$this->params['breadcrumbs'][] = ['label' => 'Ta Register Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-register-section-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'section' => $model->section, 'ta_type_work_id' => $model->ta_type_work_id, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'section' => $model->section, 'ta_type_work_id' => $model->ta_type_work_id, 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year], [
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
            'section',
            'ta_type_work_id',
            'subject_id',
            'subject_version',
            'person_id',
            'term',
            'year',
            'ta_status',
            'ta_payment_sec',
            'ta_pay_max_sec',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
