<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationsType */

$this->title = 'Update Publications Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Publications Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pub_type_id, 'url' => ['view', 'id' => $model->pub_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publications-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
