<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\consulting\models\ConsultSatis */

$this->title = 'Update Consult Satis: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consult Satis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consult_satis_id, 'url' => ['view', 'id' => $model->consult_satis_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consult-satis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
