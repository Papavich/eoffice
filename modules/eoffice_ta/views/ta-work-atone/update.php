<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaWorkAtone */

$this->title = 'Update Ta Work Atone: ' . $model->ta_work_atone_id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Work Atones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ta_work_atone_id, 'url' => ['view', 'id' => $model->ta_work_atone_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-work-atone-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
