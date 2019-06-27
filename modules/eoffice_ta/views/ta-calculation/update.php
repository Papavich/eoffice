<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaCalculation */

$this->title = 'Update Ta Calculation: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ta Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_calculate_id, 'url' => ['view', 'id' => $model->ta_calculate_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-calculation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
