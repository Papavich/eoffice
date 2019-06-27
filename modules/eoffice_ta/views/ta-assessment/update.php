<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessment */

$this->title = 'Update Ta Assessment';
$this->params['breadcrumbs'][] = ['label' => 'Ta Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_assessment_id, 'url' => ['view', 'ta_assessment_id' => $model->ta_assessment_id, 'past' => $model->past]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-assessment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
