<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\personsystem\models\RegStudentbio */

$this->title = 'Update Reg Studentbio: ' . $model->STUDENTBIO;
$this->params['breadcrumbs'][] = ['label' => 'Reg Studentbios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->STUDENTBIO, 'url' => ['view', 'STUDENTBIO' => $model->STUDENTBIO, 'STUDENTID' => $model->STUDENTID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reg-studentbio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
