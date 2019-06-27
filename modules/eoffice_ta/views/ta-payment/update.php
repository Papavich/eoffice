<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaPayment */

$this->title = 'Update Ta Payment: ' . $model->subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject_id, 'url' => ['view', 'subject_id' => $model->subject_id, 'subject_version' => $model->subject_version, 'term' => $model->term, 'year' => $model->year]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
