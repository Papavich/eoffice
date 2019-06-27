<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Advisors */

$this->title = 'Update Advisors: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Advisors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->advisors_id, 'url' => ['view', 'id' => $model->advisors_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advisors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
