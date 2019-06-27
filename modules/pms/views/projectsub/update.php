<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pms\models\PmsProjectSub */

$this->title = 'Update Pms Project Sub: ' . $model->prosub_id;
$this->params['breadcrumbs'][] = ['label' => 'Pms Project Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prosub_id, 'url' => ['view', 'id' => $model->prosub_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pms-project-sub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
