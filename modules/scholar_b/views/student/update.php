<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\model_main\EofficeMainStudent */

$this->title = 'Update Eoffice Main Student: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Main Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->studentbio_id, 'url' => ['view', 'studentbio_id' => $model->studentbio_id, 'STUDENTID' => $model->STUDENTID, 'adviser_id' => $model->adviser_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-main-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
