<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaTopicAssessment */

$this->title = 'Create Ta Topic Assessment';
$this->params['breadcrumbs'][] = ['label' => 'Ta Topic Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-topic-assessment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
