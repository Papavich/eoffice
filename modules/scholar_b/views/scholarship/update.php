<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbEnrollScholarship */

$this->title = 'Update Scb Enroll Scholarship: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Scb Enroll Scholarships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->candidate_id_card, 'url' => ['view', 'candidate_id_card' => $model->candidate_id_card, 'scholarship_id' => $model->scholarship_id, 'scholarship_year' => $model->scholarship_year]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scb-enroll-scholarship-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
