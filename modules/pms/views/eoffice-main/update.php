<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\model_main\EofficeMain */

$this->title = 'Update Eoffice Main: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Eoffice Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->STUDENTID, 'url' => ['view', 'id' => $model->STUDENTID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eoffice-main-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
