<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaAssessmentOpen */

$this->title = 'Create Ta Assessment Open';
$this->params['breadcrumbs'][] = ['label' => 'Ta Assessment Opens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-assessment-open-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
