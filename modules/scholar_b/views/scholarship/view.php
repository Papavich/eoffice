<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbEnrollScholarship */

$this->title = $model->candidate_id_card;
$this->params['breadcrumbs'][] = ['label' => 'Scb Enroll Scholarships', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-enroll-scholarship-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'candidate_id_card' => $model->candidate_id_card, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'candidate_id_card' => $model->candidate_id_card, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year], [
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
            'candidate_id_card',
            'scholarship_id',
            'scholarship_year',
            'gpax_4to5',
            'gpa_math4',
            'gpa_math4to5',
            'gpa_chem4',
            'gpa_chem5',
            'gpa_math5',
            'gpa_physic4',
            'gpa_physic5',
            'gpa_sum_chem_physic_math_4to5',
            'crby',
            'crtime',
            'udby',
            'udtime',
        ],
    ]) ?>

</div>
